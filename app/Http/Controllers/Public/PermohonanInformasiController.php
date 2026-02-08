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
                    'url' => route('admin.permohonan-informasi.show', $permohonan->id_permohonan),
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
}