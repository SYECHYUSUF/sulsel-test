<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermohonanInformasiRequest;
use App\Models\PermohonanInformasi;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PermohonanInformasiController extends Controller
{
    /**
     * Simpan permohonan informasi baru.
     */
    public function store(Request $request): JsonResponse
    {
        $formRequest = new StorePermohonanInformasiRequest();
    
        // Validasi manual menggunakan rules dari FormRequest
        $validator = Validator::make($request->all(), $formRequest->rules(), $formRequest->messages());

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            // Ambil data yang divalidasi dan hapus field non-database
            $validated = $validator->validated();
            $data = collect($validated)->except(['foto_ktp', 'website', '_form_timestamp'])->toArray();
            
            // Proses upload KTP dengan nama file unik
            if ($request->hasFile('foto_ktp')) {
                $file = $request->file('foto_ktp');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('permohonan/ktp', $filename, 'public');
                $data['foto_ktp'] = $path;
            }

            $data['status'] = PermohonanInformasi::STATUS_PENDING;
            $data['is_cek'] = '0';
            
            $permohonan = PermohonanInformasi::create($data);

            // Berikan notifikasi ke semua admin
            $adminUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->get();

            foreach ($adminUsers as $admin) {
                Notification::send([
                    'to_user_id' => $admin->id,
                    'type' => 'info',
                    'title' => 'Permohonan Informasi Baru',
                    'message' => "Permohonan baru dari {$permohonan->nama}",
                    'url' => env('FRONTEND_URL') . '/admin/permohonan-informasi/' . $permohonan->id_permohonan,
                    'notifiable_type' => 'App\\Models\\PermohonanInformasi',
                    'notifiable_id' => $permohonan->id_permohonan,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Permohonan informasi berhasil dikirim.',
                'data' => $permohonan
            ], 201);

        } catch (\Exception $e) {
            Log::error('Permohonan Store Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses permohonan.'
            ], 500);
        }
    }

    /**
     * Cari status permohonan berdasarkan email.
     */
    public function search(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        $email = $request->email;

        try {
            // Ambil permohonan berdasarkan email, urutkan dari yang terbaru
            $permohonan = PermohonanInformasi::where('email', $email)
                ->orderBy('created_at', 'desc')
                ->limit(5) // Batasi 5 riwayat terakhir
                ->get()
                ->map(function ($item) {
                    // Fallback logic: If parent `jawaban` or `file` is missing, check relations
                    // This handles legacy data or cases where sync might have been missed
                    $keterangan = $item->jawaban;
                    $fileUrl = $item->file ? url('/uploads/' . $item->file) : null;

                    if (!$keterangan || !$fileUrl) {
                        // Check if there is a completed disposition with response
                        // Load relation if not already loaded (though we should Eager Load it for performance)
                        // For now, lazy load is fine for 5 records max
                        $latestRespon = $item->disposisi()
                            ->where('status', 'selesai')
                            ->with('respon') // Load respon relation
                            ->get()
                            ->pluck('respon')
                            ->flatten()
                            ->sortByDesc('created_at')
                            ->first();
                        
                        // If we found a response from OPD
                        if ($latestRespon) {
                            if (!$keterangan) {
                                $keterangan = $latestRespon->respon;
                            }
                            if (!$fileUrl && $latestRespon->file) {
                                $fileUrl = url('/uploads/' . $latestRespon->file);
                            }
                        }
                    }

                    return [
                        'id_permohonan' => $item->id_permohonan,
                        'tgl_permohonan' => $item->created_at->format('Y-m-d'),
                        'rincian' => $item->rincian_informasi,
                        'status' => $item->status_label, // Menggunakan accessor dari model
                        'status_code' => $item->status,
                        // Fix for tgl_selesai: if status is finished, show updated_at
                        'tgl_selesai' => ($item->status == 2 || $item->status == 5) ? $item->updated_at->format('Y-m-d') : null, 
                        'keterangan' => $keterangan ?? '-',
                         // Jika ada file (jawaban), format URL sesuai request user
                        'file_url' => $fileUrl
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $permohonan
            ], 200);

        } catch (\Exception $e) {
            Log::error('Permohonan Search Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mencari data.'
            ], 500);
        }
    }
}