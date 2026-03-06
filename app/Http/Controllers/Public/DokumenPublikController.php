<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\DokumenPublik;
use App\Models\MasterTahun;
use App\Models\DownloadLog;
use App\Models\Ikphn;
use App\Models\KategoriInformasi;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DokumenPublikController extends Controller
{
    /**
     * Memperoleh saran pencarian untuk dokumen publik.
     */
    public function suggestions(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'query' => 'required|string|min:2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $query = $request->get('query');

        $results = DokumenPublik::join('tbl_kat_informasi', 'tbl_informasi.id_kat_info', '=', 'tbl_kat_informasi.id_kat_info')
            ->where('tbl_informasi.verify', 'y')
            ->where(function ($q) use ($query) {
                $q->where('tbl_informasi.judul', 'LIKE', "%{$query}%")
                    ->orWhere('tbl_informasi.ket', 'LIKE', "%{$query}%");
            })
            ->limit(5)
            ->get([
                'tbl_informasi.id_informasi',
                'tbl_informasi.judul',
                'tbl_informasi.ket',
                'tbl_kat_informasi.nm_kat_info'
            ]);

        return response()->json([
            'success' => true,
            'data' => $results
        ]);
    }

    /**
     * Ambil data dokumen berdasarkan slug kategori dengan filter pencarian dan tahun.
     */
    public function getByCategory(Request $request, $slug): JsonResponse
    {
        $kategori = KategoriInformasi::where('slug', $slug)->firstOrFail();

        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori informasi tidak ditemukan'
            ], 404);
        }

        // Query dokumen dengan relasi terkait
        $query = DokumenPublik::with([
            'skpd:id_skpd,nm_skpd',
            'kategori:id_kat_info,nm_kat_info,slug'
        ])
            ->where('id_kat_info', $kategori->id_kat_info)
            ->where('verify', 'y');

        // Filter Pencarian (Judul/Keterangan)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('ket', 'like', '%' . $search . '%');
            });
        }

        // Filter Berdasarkan Tahun
        if ($request->filled('year')) {
            $query->where('tahun', $request->year);
        }

        // Eksekusi pagination
        $data = $query->latest('tgl_upload')->paginate(10);

        // Ambil Master Tahun untuk kebutuhan filter di frontend
        $availableYears = MasterTahun::orderBy('waktu', 'desc')->get();

        return response()->json([
            'category' => [
                'id' => $kategori->id_kat_info,
                'name' => $kategori->nm_kat_info,
            ],
            'data' => $data,
            'available_years' => $availableYears
        ]);
    }

    /**
     * Ambil data dokumen publik berdasarkan tahun.
     */
    public function getByYear(Request $request, $year): JsonResponse
    {
        $query = DokumenPublik::with([
            'skpd:id_skpd,nm_skpd',
            'kategori:id_kat_info,nm_kat_info,slug'
        ])
            ->where('verify', 'y')
            ->whereYear('tgl_upload', $year);

        // Filter pencarian opsional
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('ket', 'like', '%' . $search . '%');
            });
        }

        $data = $query->latest('tgl_upload')->paginate(10);

        $availableYears = MasterTahun::orderBy('waktu', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $data,
            'year' => $year,
            'available_years' => $availableYears,
        ]);
    }

    /**
     * Menampilkan detail dokumen publik berdasarkan ID.
     */
    public function show($id): JsonResponse
    {
        $informasi = DokumenPublik::with([
            'skpd:id_skpd,nm_skpd',
            'kategori:id_kat_info,nm_kat_info,slug'
        ])->find($id);

        if (!$informasi) {
            return response()->json([
                'success' => false,
                'message' => 'Dokumen tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $informasi
        ]);
    }

    /**
     * Daftar pengadaan (Ikphn) dengan filter pencarian dan tahun.
     */
    public function pengadaan(Request $request): JsonResponse
    {
        $search = $request->query('search');
        $year = $request->query('year');

        $query = Ikphn::query();

        // Filter pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_jabatan', 'ilike', "%{$search}%")
                    ->orWhere('nama_pejabat', 'ilike', "%{$search}%")
                    ->orWhere('informasi_rencana', 'ilike', "%{$search}%");
            });
        }

        // Filter tahun
        if ($year) {
            $query->where('tahun', $year);
        }

        $ikphns = $query->latest()->paginate(10);

        // Ambil Master Tahun untuk kebutuhan filter di frontend
        $availableYears = MasterTahun::orderBy('waktu', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $ikphns,
            'available_years' => $availableYears,
            'filters' => [
                'search' => $search,
                'year' => $year
            ]
        ]);
    }

    /**
     * Unduh berkas dokumen publik.
     */
    public function download($id)
    {
        // Cari data informasi publik berdasarkan ID
        /** @var DokumenPublik $informasi */
        $informasi = DokumenPublik::find($id);

        if (!$informasi) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // Update statistik jumlah unduhan secara atomik
        $informasi->update([
            'jumlah_download' => DB::raw('COALESCE(jumlah_download, 0) + 1')
        ]);

        // Catat log unduhan untuk keperluan statistik
        DownloadLog::create([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'downloadable_type' => DokumenPublik::class,
            'downloadable_id' => $informasi->getKey(),
        ]);

        $filePath = $informasi->file;

        if (!$filePath) {
            return response()->json([
                'success' => false,
                'message' => 'Path berkas kosong'
            ], 404);
        }

        // Jika path berupa URL eksternal, lakukan redirect
        if (str_starts_with($filePath, 'http')) {
            return redirect($filePath);
        }

        // Gunakan storage_path untuk memastikan file ditemukan oleh sistem
        $fullPath = storage_path('app/public/' . $filePath);

        if (!file_exists($fullPath)) {
            return response()->json([
                'success' => false,
                'message' => 'Berkas fisik tidak ditemukan di server'
            ], 404);
        }

        // Menggunakan response()->download() sebagai alternatif yang lebih stabil daripada Storage::download()
        return response()->download(
            $fullPath,
            $informasi->judul . '.' . pathinfo($fullPath, PATHINFO_EXTENSION)
        );
    }
}