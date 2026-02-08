<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\DokumenPublik;
use App\Models\MasterTahun;
use App\Models\DownloadLog;
use App\Models\KategoriInformasi;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DokumenPublikController extends Controller
{
    /**
     * Get search suggestions for documents.
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
     * Reusable logic for document categories.
     */
    private function getDocumentsByCategory(Request $request, int $categoryId): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'search' => 'nullable|string|max:255',
            'tahun'  => 'nullable|integer|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $search = $request->query('search');
        $tahun = $request->query('tahun');
        
        $availableYears = MasterTahun::whereNotNull('waktu')
            ->orderBy('waktu', 'desc')
            ->pluck('waktu'); // Hanya ambil tahunnya saja untuk efisiensi API

        $informasiData = DokumenPublik::with(['kategori', 'skpd'])
            ->where('id_kat_info', $categoryId)
            ->where('verify', 'y')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('judul', 'LIKE', "%{$search}%")
                        ->orWhere('ket', 'LIKE', "%{$search}%");
                });
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->whereYear('tgl_upload', $tahun);
            })
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $informasiData,
            'available_years' => $availableYears,
            'filters' => [
                'search' => $search,
                'tahun' => $tahun
            ]
        ]);
    }

    /**
     * Ambil data dokumen berdasarkan slug kategori dengan filter pencarian dan tahun.
     */
    public function getByCategory(Request $request, $id): JsonResponse
    {
        // Validasi keberadaan kategori berdasarkan ID
        $kategori = KategoriInformasi::find($id);

        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori informasi tidak ditemukan'
            ], 404);
        }

        // Query dokumen dengan relasi terkait
        $query = DokumenPublik::with(['skpd', 'kategori'])
            ->where('id_kat_info', $id)
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
            'success' => true,
            'category' => [
                'id' => $kategori->id_kat_info,
                'name' => $kategori->nm_kat_info,
            ],
            'data' => $data,
            'available_years' => $availableYears
        ]);
    }

    public function show($id): JsonResponse
    {
        $informasi = DokumenPublik::with(['kategori', 'skpd'])->find($id);

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
     * Unduh berkas dokumen publik.
     */
    public function download($id)
    {
        // Cari data informasi publik berdasarkan ID
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