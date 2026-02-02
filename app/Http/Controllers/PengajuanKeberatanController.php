<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengajuanKeberatanRequest;
use Illuminate\Http\Request;

class PengajuanKeberatanController extends Controller
{
    public function store(StorePengajuanKeberatanRequest $request)
    {
        // Validation and sanitization already handled by Form Request
        $validated = $request->validated();

        // Cari Data Permohonan Asli untuk mendapatkan ID SKPD
        $permohonan = \App\Models\PermohonanInformasi::where('no_pendaftaran', $validated['no_pendaftaran'])->first();
        $id_skpd = $permohonan ? $permohonan->id_skpd : null;

        $pengajuan = \App\Models\PengajuanKeberatan::create([
            'no_pendaftaran' => $validated['no_pendaftaran'],
            'id_skpd' => $id_skpd,
            'tujuan' => $validated['tujuan'],
            'nama_pemohon' => $validated['nama_pemohon'],
            'alamat_pemohon' => $validated['alamat_pemohon'],
            'address_pemohon' => $validated['address_pemohon'],
            'apt_pemohon' => $validated['apt_pemohon'] ?? null,
            'city_pemohon' => $validated['city_pemohon'],
            'state_pemohon' => $validated['state_pemohon'],
            'pekerjaan_pemohon' => $validated['pekerjaan_pemohon'],
            'no_telp_pemohon' => $validated['no_telp_pemohon'],
            'email_pemohon' => $validated['email_pemohon'],
            // Kuasa (Optional)
            'nama_kuasa' => $validated['nama_kuasa'] ?? null,
            'alamat_kuasa' => $validated['alamat_kuasa'] ?? null,
            'address_kuasa' => $validated['address_kuasa'] ?? null,
            'apt_kuasa' => $validated['apt_kuasa'] ?? null,
            'city_kuasa' => $validated['city_kuasa'] ?? null,
            'state_kuasa' => $validated['state_kuasa'] ?? null,
            'no_telp_kuasa' => $validated['no_telp_kuasa'] ?? null,
            'kasus' => $validated['kasus'],
            'status' => 'n', // New
            'metode_respon' => $validated['metode_respon'],
        ]);

        foreach ($validated['alasan'] as $alasan) {
            \App\Models\AlasanPengajuan::create([
                'id_pengajuan' => $pengajuan->id_pengajuan,
                'alasan' => $alasan,
            ]);
        }

        $msg = 'Pengajuan keberatan berhasil dikirim.';
        if($validated['metode_respon'] == 'whatsapp') {
            $msg .= ' Tanggapan akan dikirimkan melalui WhatsApp ke nomor yang Anda daftarkan.';
        } else {
            $msg .= ' Silakan cek status pengajuan secara berkala melalui menu "Cek Status".';
        }

        return back()->with('success', $msg);
    }
    public function checkStatus(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $pengajuan = \App\Models\PengajuanKeberatan::with(['feedbackBy', 'alasanPengajuan'])
            ->where('email_pemohon', $request->email)
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
                // Status: 'p' = pending/proses, 'y' = disetujui, 't' = ditolak, 'a' = dijawab
                $labels = [
                    'p' => 'Dalam Proses',
                    'y' => 'Disetujui',
                    't' => 'Ditolak',
                    'a' => 'Dijawab',
                ];
                
                // Check if feedback is empty/null - override status label
                if (empty($item->feedback) && $item->status != 't') {
                    $item->status_label = 'Belum Direspon';
                    $item->display_status = 'belum_direspon'; // Custom status for frontend
                } else {
                    $item->status_label = $labels[$item->status] ?? 'Status Tidak Diketahui';
                    $item->display_status = $item->status;
                }
                
                $item->formatted_date = $item->created_at->translatedFormat('d F Y H:i') . ' WITA';
                
                return $item;
            });

            return response()->json([
                'success' => true,
                'data' => $pengajuan
            ]);
        }

        return view('pages.layanan.cek-status-keberatan', compact('pengajuan'));
    }

    public function formCheckStatus()
    {
        return view('pages.layanan.cek-status-keberatan');
    }
}
