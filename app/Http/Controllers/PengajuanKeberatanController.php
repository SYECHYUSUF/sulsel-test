<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanKeberatanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required|string|max:255',
            'tujuan' => 'required|string|max:500',
            'nama_pemohon' => 'required|string|max:255',
            'alamat_pemohon' => 'required|string',
            'address_pemohon' => 'nullable|string',
            'city_pemohon' => 'nullable|string',
            'state_pemohon' => 'nullable|string',
            'pekerjaan_pemohon' => 'required|string|max:255',
            'no_telp_pemohon' => ['required', 'string', 'regex:/^[0-9+\-\s()]+$/'],
            'email_pemohon' => 'required|email:rfc,dns',
            'alasan' => 'required|array|min:1',
            'alasan.*' => 'string',
            'kasus' => 'required|string',
        ], [
            'no_pendaftaran.required' => 'Nomor pendaftaran wajib diisi.',
            'tujuan.required' => 'Tujuan penggunaan informasi wajib diisi.',
            'nama_pemohon.required' => 'Nama lengkap wajib diisi.',
            'alamat_pemohon.required' => 'Alamat lengkap wajib diisi.',
            'pekerjaan_pemohon.required' => 'Pekerjaan wajib dipilih atau diisi.',
            'no_telp_pemohon.required' => 'Nomor telepon wajib diisi.',
            'no_telp_pemohon.regex' => 'Nomor telepon hanya boleh berisi angka, +, -, (), dan spasi.',
            'email_pemohon.required' => 'Email wajib diisi.',
            'email_pemohon.email' => 'Format email tidak valid.',
            'alasan.required' => 'Minimal pilih satu alasan keberatan.',
            'alasan.min' => 'Minimal pilih satu alasan keberatan.',
            'kasus.required' => 'Kasus posisi wajib diisi.',
        ]);

        // Cari Data Permohonan Asli untuk mendapatkan ID SKPD
        $permohonan = \App\Models\PermohonanInformasi::where('no_pendaftaran', $request->no_pendaftaran)->first();
        $id_skpd = $permohonan ? $permohonan->id_skpd : null;

        $pengajuan = \App\Models\PengajuanKeberatan::create([
            'no_pendaftaran' => $request->no_pendaftaran,
            'id_skpd' => $id_skpd, // Save ID SKPD
            'tujuan' => $request->tujuan,
            'nama_pemohon' => $request->nama_pemohon,
            'alamat_pemohon' => $request->alamat_pemohon,
            'address_pemohon' => $request->address_pemohon,
            'apt_pemohon' => $request->apt_pemohon,
            'city_pemohon' => $request->city_pemohon,
            'state_pemohon' => $request->state_pemohon,
            'pekerjaan_pemohon' => $request->pekerjaan_pemohon,
            'no_telp_pemohon' => $request->no_telp_pemohon,
            'email_pemohon' => $request->email_pemohon,
            // Kuasa (Optional)
            'nama_kuasa' => $request->nama_kuasa,
            'alamat_kuasa' => $request->alamat_kuasa,
            'address_kuasa' => $request->address_kuasa,
            'apt_kuasa' => $request->apt_kuasa,
            'city_kuasa' => $request->city_kuasa,
            'state_kuasa' => $request->state_kuasa,
            'no_telp_kuasa' => $request->no_telp_kuasa,
            'kasus' => $request->kasus,
            'status' => 'p', // Changed from 'n' to 'p' (Pending)
            'metode_respon' => 'website', // Default to website since form doesn't have this field
        ]);

        foreach ($request->alasan as $alasan) {
            \App\Models\AlasanPengajuan::create([
                'id_pengajuan' => $pengajuan->id_pengajuan,
                'alasan' => $alasan,
            ]);
        }

        // Send notification to all admins about new submission
        $admins = \App\Models\User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();
        foreach ($admins as $admin) {
            \App\Models\Notification::send([
                'to_user_id' => $admin->id,
                'type' => 'warning',
                'title' => 'Pengajuan Keberatan Baru',
                'message' => 'Pengajuan keberatan baru dari ' . $request->nama_pemohon . ' (#' . $request->no_pendaftaran . ') menunggu verifikasi.',
                'url' => route('admin.pengajuan-keberatan.show', $pengajuan->id_pengajuan),
                'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
                'notifiable_id' => $pengajuan->id_pengajuan,
            ]);
        }

        return back()->with('success', 'Pengajuan keberatan berhasil dikirim. Silakan cek status pengajuan secara berkala melalui menu "Cek Status".');
    }
    /**
     * Check status by email (supports AJAX and regular requests).
     */
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
