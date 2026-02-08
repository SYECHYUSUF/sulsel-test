<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermohonanInformasiRequest;
use App\Models\PermohonanInformasi;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PermohonanInformasiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermohonanInformasiRequest $request): JsonResponse
    {
        // Validasi otomatis ditangani oleh Form Request
        $validated = $request->validated();

        try {
            $data = collect($validated)->except(['foto_ktp', 'website', '_form_timestamp'])->toArray();
            
            // Handle File Upload dengan secure filename
            if ($request->hasFile('foto_ktp')) {
                $file = $request->file('foto_ktp');
                
                // Generate secure random filename
                $extension = $file->getClientOriginalExtension();
                $filename = Str::uuid() . '.' . $extension;
                
                $path = $file->storeAs('permohonan/ktp', $filename, 'public');
                $data['foto_ktp'] = $path;
            }

            // Set default values
            $data['status'] = PermohonanInformasi::STATUS_PENDING;
            $data['is_cek'] = '0';
            
            // Simpan data permohonan
            $permohonan = PermohonanInformasi::create($data);

            // Kirim notifikasi ke semua admin
            $adminUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->get();

            foreach ($adminUsers as $admin) {
                Notification::send([
                    'to_user_id' => $admin->id,
                    'type' => 'info',
                    'title' => 'Permohonan Informasi Baru',
                    'message' => 'Permohonan informasi baru dari ' . $permohonan->nama . ' (' . $permohonan->email . ')',
                    'url' => route('admin.permohonan-informasi.show', $permohonan->id_permohonan),
                    'notifiable_type' => 'App\\Models\\PermohonanInformasi',
                    'notifiable_id' => $permohonan->id_permohonan,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Permohonan informasi berhasil dikirim.',
                'data' => [
                    'id' => $permohonan->id_permohonan,
                    'no_pendaftaran' => $permohonan->no_pendaftaran,
                    'nama' => $permohonan->nama,
                    'status' => 'Menunggu Verifikasi'
                ]
            ], 201);

        } catch (\Exception $e) {
            Log::error('Permohonan Informasi Store Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem saat memproses permohonan.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Check progress by email.
     * Mengembalikan list permohonan dalam format JSON.
     */
    public function checkProgress(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            $permohonan = PermohonanInformasi::with(['skpd', 'disposisi.skpd', 'disposisi.respon'])
                ->where('email', $request->email)
                ->orderBy('created_at', 'desc')
                ->get();

            if ($permohonan->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada permohonan ditemukan dengan email tersebut.'
                ], 404);
            }

            // Transform data untuk memperkaya response JSON
            $permohonan->transform(function ($item) {
                $labels = [
                    0 => 'Menunggu Verifikasi',
                    1 => 'Diproses',
                    2 => 'Selesai',
                    3 => 'Ditolak',
                    4 => 'Dibatalkan',
                    5 => 'Disposisi'
                ];
                
                $item->status_label = $labels[$item->status] ?? 'Status Tidak Diketahui';
                $item->formatted_date = $item->created_at->translatedFormat('d F Y H:i') . ' WITA';
                
                return $item;
            });

            return response()->json([
                'success' => true,
                'message' => 'Data ditemukan.',
                'data' => $permohonan
            ], 200);

        } catch (\Exception $e) {
            Log::error('Permohonan Informasi Check Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data.'
            ], 500);
        }
    }
}