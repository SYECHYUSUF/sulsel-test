<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePengajuanKeberatanRequest;
use App\Models\AlasanPengajuan;
use App\Models\Notification;
use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Validator;

class PengajuanKeberatanController extends Controller
{
    /**
     * Simpan pengajuan keberatan baru.
     */
    public function store(Request $request): JsonResponse
    {
        $formRequest = new StorePengajuanKeberatanRequest();
    
        // Validasi manual untuk menghindari redirect otomatis
        $validator = Validator::make($request->all(), $formRequest->rules(), $formRequest->messages());

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Ambil data yang sudah lulus validasi
        $validated = $validator->validated();

        try {
            // Cari relasi ke permohonan informasi
            $permohonan = PermohonanInformasi::where('no_pendaftaran', $validated['no_pendaftaran'])->first();
            $id_skpd = $permohonan ? $permohonan->id_skpd : null;

            $pengajuan = PengajuanKeberatan::create([
                'no_pendaftaran' => $validated['no_pendaftaran'],
                'id_skpd' => $id_skpd,
                'tujuan' => $validated['tujuan'],
                'nama_pemohon' => $validated['nama_pemohon'],
                'alamat_pemohon' => $validated['alamat_pemohon'],
                'pemohon_domisili_id' => $validated['pemohon_domisili_id'],

                'nama_kuasa' => $validated['nama_kuasa'] ?? null,
                'alamat_kuasa' => $validated['alamat_kuasa'] ?? null,
                'kuasa_domisili_id' => $validated['kuasa_domisili_id'] ?? null,
                'no_telp_kuasa' => $validated['no_telp_kuasa'] ?? null,

                'pekerjaan_id' => $validated['pekerjaan_id'],
                'no_telp_pemohon' => $validated['no_telp_pemohon'],
                'email_pemohon' => $validated['email_pemohon'],
                'nama_kuasa' => $validated['nama_kuasa'] ?? null,
                'kasus' => $validated['kasus'],
                'status' => 'n',
            ]);

            // Simpan daftar alasan yang dipilih
            foreach ($validated['alasan'] as $alasan) {
                AlasanPengajuan::create([
                    'id_pengajuan' => $pengajuan->id_pengajuan,
                    'alasan' => $alasan,
                ]);
            }

            // Kirim notifikasi ke user dengan role admin
            $adminUsers = User::whereHasRole('admin')->get();

            foreach ($adminUsers as $admin) {
                Notification::send([
                    'to_user_id' => $admin->id,
                    'type' => 'info',
                    'title' => 'Pengajuan Keberatan Baru',
                    'message' => "Keberatan baru dari {$pengajuan->nama_pemohon}",
                    'url' => env('FRONTEND_URL') . '/admin/pengajuan-keberatan/' . $pengajuan->id_pengajuan,
                    'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
                    'notifiable_id' => $pengajuan->id_pengajuan,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan keberatan berhasil dikirim.',
                'data'    => $pengajuan
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error saat menyimpan pengajuan keberatan', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem.'
            ], 500);
        }
    }
}