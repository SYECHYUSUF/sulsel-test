<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\DokumenPublik;
use App\Models\MasterTahun;
use App\Models\DownloadLog;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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

    public function sertaMerta(Request $request): JsonResponse
    {
        return $this->getDocumentsByCategory($request, 22);
    }

    public function setiapSaat(Request $request): JsonResponse
    {
        return $this->getDocumentsByCategory($request, 33);
    }

    public function berkala(Request $request): JsonResponse
    {
        return $this->getDocumentsByCategory($request, 103);
    }

    public function dikecualikan(Request $request): JsonResponse
    {
        return $this->getDocumentsByCategory($request, 100);
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

    public function download($id)
    {
        // Method download tetap mengembalikan BinaryFileResponse atau Redirect
        // karena ini adalah aksi unduh file langsung, bukan sekadar data JSON.
        
        $informasi = DokumenPublik::find($id);

        if (!$informasi) {
            return response()->json(['success' => false, 'message' => 'File tidak ditemukan'], 404);
        }

        // Update download count
        $informasi->update([
            'jumlah_download' => DB::raw('COALESCE(jumlah_download, 0) + 1')
        ]);

        // Log the download
        DownloadLog::create([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'downloadable_type' => DokumenPublik::class,
            'downloadable_id' => $informasi->getKey(),
        ]);

        $filePath = $informasi->file;

        if (!$filePath) {
            return response()->json(['success' => false, 'message' => 'Path file kosong'], 404);
        }

        if (str_starts_with($filePath, 'http')) {
            return redirect($filePath);
        }

        if (!Storage::disk('public')->exists($filePath)) {
            return response()->json(['success' => false, 'message' => 'File fisik tidak ditemukan di storage'], 404);
        }

        return Storage::disk('public')->download(
            $filePath, 
            $informasi->judul . '.' . pathinfo($filePath, PATHINFO_EXTENSION)
        );
    }
}