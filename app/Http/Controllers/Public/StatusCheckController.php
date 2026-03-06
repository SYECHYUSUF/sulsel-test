<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermohonanInformasi;
use App\Models\PengajuanKeberatan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class StatusCheckController extends Controller
{
    /**
     * Check status for both permohonan and keberatan.
     */
    public function checkStatus(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'type' => 'required|in:permohonan,keberatan',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $type = $request->input('type');
        $email = $request->input('email');

        if ($type === 'permohonan') {
            return $this->checkPermohonanStatus($email);
        }

        return $this->checkKeberatanStatus($email);
    }

    /**
     * Check permohonan informasi status.
     */
    private function checkPermohonanStatus(string $email): JsonResponse
    {
        $permohonan = PermohonanInformasi::with(['skpd', 'disposisi.skpd', 'disposisi.respon'])
            ->where('email', $email)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($permohonan->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada permohonan ditemukan dengan email tersebut.'
            ], 404);
        }

        $permohonan->transform(function ($item) {
            $labels = [
                0 => 'Menunggu Verifikasi',
                1 => 'Diproses',
                2 => 'Selesai',
                3 => 'Ditolak',
                4 => 'Dibatalkan',
                5 => 'Disposisi'
            ];

            $item->status_label_display = $labels[$item->status] ?? 'Status Tidak Diketahui';
            $item->formatted_date = $item->created_at->translatedFormat('d F Y H:i') . ' WITA';

            return $item;
        });

        return response()->json([
            'success' => true,
            'type' => 'permohonan',
            'data' => $permohonan
        ]);
    }

    /**
     * Check pengajuan keberatan status.
     */
    private function checkKeberatanStatus(string $email): JsonResponse
    {
        // Mengambil data dengan relasi yang diperlukan saja
        $pengajuan = PengajuanKeberatan::with([
            'feedbackBy:id,name', 
            'alasanPengajuan:id,id_pengajuan,alasan',
            'disposisi' => function($query) {
                $query->select('id_disposisi', 'id_pengajuan', 'id_skpd', 'catatan_disposisi', 'status', 'created_at');
            },
            'disposisi.skpd:id_skpd,nm_skpd'
        ])
        ->where('email_pemohon', $email)
        ->orderBy('created_at', 'desc')
        ->get();

        if ($pengajuan->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada pengajuan keberatan ditemukan dengan email tersebut.'
            ], 404);
        }

        $pengajuan->transform(function ($item) {
            // Pemetaan status sesuai dengan Enum di database: n, y, t, a, d
            $labels = [
                'n' => 'Menunggu Verifikasi', // Baru masuk
                'd' => 'Sedang Didisposisikan', // Diteruskan ke SKPD
                'y' => 'Keberatan Disetujui',   // Diterima
                't' => 'Keberatan Ditolak',    // Ditolak
                'a' => 'Selesai / Dijawab',    // Sudah diberi feedback/jawaban
            ];

            // Logika label display
            if ($item->status === 'n' && empty($item->feedback)) {
                $item->status_label_display = 'Menunggu Verifikasi';
            } else {
                $item->status_label_display = $labels[$item->status] ?? 'Status Tidak Diketahui';
            }

            // Mapping kode warna/status untuk frontend
            $item->display_status_code = $item->status;
            $item->formatted_date = $item->created_at->translatedFormat('d F Y H:i') . ' WITA';

            return $item;
        });

        return response()->json([
            'success' => true,
            'type' => 'keberatan',
            'data' => $pengajuan
        ]);
    }
}