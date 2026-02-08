<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Sop;
use App\Models\DownloadLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

class SopController extends Controller
{
    /**
     * Menampilkan daftar SOP dalam format JSON.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Sop::query();

            if ($request->filled('search')) {
                $query->where('judul', 'ilike', '%' . $request->search . '%');
            }

            $sopData = $query->latest()->paginate(10);

            return response()->json([
                'success' => true,
                'data'    => $sopData
            ], 200);

        } catch (\Exception $e) {
            Log::error('SOP Index Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat daftar SOP.'
            ], 500);
        }
    }

    /**
     * Mengunduh file SOP.
     * Menggunakan response()->download() untuk memperbaiki error 'Undefined method download' pada Storage facade.
     */
    public function download($id)
    {
        try {
            $sop = Sop::find($id);

            if (!$sop) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data SOP tidak ditemukan.'
                ], 404);
            }

            $sop->update([
                'jumlah_download' => DB::raw('COALESCE(jumlah_download, 0) + 1')
            ]);

            DownloadLog::create([
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'downloadable_type' => Sop::class,
                'downloadable_id' => $sop->getKey(),
            ]);

            $filePath = storage_path('app/public/sop/' . $sop->file);

            if (!file_exists($filePath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Berkas fisik tidak ditemukan di storage.'
                ], 404);
            }

            return response()->download(
                $filePath, 
                $sop->judul . '.' . pathinfo($sop->file, PATHINFO_EXTENSION)
            );

        } catch (\Exception $e) {
            Log::error('SOP Download Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses unduhan.'
            ], 500);
        }
    }
}