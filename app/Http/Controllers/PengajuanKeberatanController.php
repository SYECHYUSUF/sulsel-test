<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengajuanKeberatanRequest;
use App\Models\AlasanPengajuan;
use App\Models\Notification;
use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PengajuanKeberatanController extends Controller
{
    public function store(StorePengajuanKeberatanRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $permohonan = PermohonanInformasi::where('no_pendaftaran', $validated['no_pendaftaran'])->first();
            $id_skpd = $permohonan ? $permohonan->id_skpd : null;

            $pengajuan = PengajuanKeberatan::create([
                'no_pendaftaran' => $validated['no_pendaftaran'],
                'id_skpd' => $id_skpd,
                'tujuan' => $validated['tujuan'],
                'nama_pemohon' => $validated['nama_pemohon'],
                'alamat_pemohon' => $validated['alamat_pemohon'],
                'address_pemohon' => $validated['address_pemohon'] ?? null,
                'apt_pemohon' => $validated['apt_pemohon'] ?? null,
                'city_pemohon' => $validated['city_pemohon'],
                'state_pemohon' => $validated['state_pemohon'],
                'pekerjaan_pemohon' => $validated['pekerjaan_pemohon'],
                'no_telp_pemohon' => $validated['no_telp_pemohon'],
                'email_pemohon' => $validated['email_pemohon'],
                'nama_kuasa' => $validated['nama_kuasa'] ?? null,
                'alamat_kuasa' => $validated['alamat_kuasa'] ?? null,
                'address_kuasa' => $validated['address_kuasa'] ?? null,
                'apt_kuasa' => $validated['apt_kuasa'] ?? null,
                'city_kuasa' => $validated['city_kuasa'] ?? null,
                'state_kuasa' => $validated['state_kuasa'] ?? null,
                'no_telp_kuasa' => $validated['no_telp_kuasa'] ?? null,
                'kasus' => $validated['kasus'],
                'status' => 'n',
            ]);

            foreach ($validated['alasan'] as $alasan) {
                AlasanPengajuan::create([
                    'id_pengajuan' => $pengajuan->id_pengajuan,
                    'alasan' => $alasan,
                ]);
            }

            $adminUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->get();

            foreach ($adminUsers as $admin) {
                Notification::send([
                    'to_user_id' => $admin->id,
                    'type' => 'info',
                    'title' => 'Pengajuan Keberatan Baru',
                    'message' => 'Pengajuan keberatan baru dari ' . $pengajuan->nama_pemohon . ' (' . $pengajuan->email_pemohon . ')',
                    'url' => route('admin.pengajuan-keberatan.show', $pengajuan->id_pengajuan),
                    'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
                    'notifiable_id' => $pengajuan->id_pengajuan,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data domisili berhasil ditambahkan.',
                'data'    => $pengajuan
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim pengajuan.'
            ], 500);
        }
    }

    public function checkStatus(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $pengajuan = PengajuanKeberatan::with(['feedbackBy', 'alasanPengajuan'])
            ->where('email_pemohon', $request->email)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($pengajuan->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada pengajuan keberatan ditemukan dengan email tersebut.'
            ], 404);
        }

        $pengajuan->transform(function ($item) {
            $labels = [
                'p' => 'Dalam Proses',
                'y' => 'Disetujui',
                't' => 'Ditolak',
                'a' => 'Dijawab',
            ];

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
            'data'    => $pengajuan
        ], 200);
    }

    public function showDetail($no_pendaftaran): JsonResponse
    {
        $pengajuan = PengajuanKeberatan::with(['alasanPengajuan', 'feedbackBy'])
            ->where('no_pendaftaran', $no_pendaftaran)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data'    => $pengajuan
        ], 200);
    }
}