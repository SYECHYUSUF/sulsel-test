<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermohonanInformasi;
use App\Models\PengajuanKeberatan;

class StatusCheckController extends Controller
{
    /**
     * Check status for both permohonan and keberatan.
     */
    public function checkStatus(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'type' => 'required|in:permohonan,keberatan',
        ]);

        $type = $request->input('type');
        $email = $request->input('email');

        if ($type === 'permohonan') {
            return $this->checkPermohonanStatus($request, $email);
        } else {
            return $this->checkKeberatanStatus($request, $email);
        }
    }

    /**
     * Check permohonan informasi status.
     */
    private function checkPermohonanStatus(Request $request, string $email)
    {
        $permohonan = PermohonanInformasi::with(['skpd', 'disposisi.skpd', 'disposisi.respon'])
            ->where('email', $email)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($permohonan->isEmpty()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada permohonan ditemukan dengan email tersebut.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Tidak ada permohonan ditemukan dengan email tersebut.');
        }

        // Transform data untuk menyertakan label status dan format tanggal
        if ($request->expectsJson() || $request->ajax()) {
            $permohonan->transform(function ($item) {
                // Mapping status secara manual
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
                'data' => $permohonan,
                'type' => 'permohonan'
            ]);
        }

        return view('pages.layanan.cek-status', compact('permohonan'))->with('type', 'permohonan');
    }

    /**
     * Check pengajuan keberatan status.
     */
    private function checkKeberatanStatus(Request $request, string $email)
    {
        $pengajuan = PengajuanKeberatan::with(['feedbackBy', 'alasanPengajuan'])
            ->where('email_pemohon', $email)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($pengajuan->isEmpty()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada pengajuan keberatan ditemukan dengan email tersebut.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Tidak ada pengajuan keberatan ditemukan dengan email tersebut.');
        }

        // Transform data untuk menyertakan label status
        if ($request->expectsJson() || $request->ajax()) {
            $pengajuan->transform(function ($item) {
                // Mapping status untuk pengajuan keberatan
                $labels = [
                    'p' => 'Dalam Proses',
                    'y' => 'Disetujui',
                    't' => 'Ditolak',
                    'a' => 'Dijawab',
                ];

                // Check if feedback is empty/null - override status label
                if (empty($item->feedback) && $item->status != 't') {
                    $item->status_label_display = 'Belum Direspon';
                    $item->display_status_code = 'belum_direspon';
                } else {
                    $item->status_label_display = $labels[$item->status] ?? 'Status Tidak Diketahui';
                    $item->display_status_code = $item->status;
                }

                $item->formatted_date = $item->created_at->translatedFormat('d F Y H:i') . ' WITA';

                return $item;
            });

            return response()->json([
                'success' => true,
                'data' => $pengajuan,
                'type' => 'keberatan'
            ]);
        }

        return view('pages.layanan.cek-status', compact('pengajuan'))->with('type', 'keberatan');
    }
}
