<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MaklumatController extends Controller
{
    /**
     * Ambil data maklumat pelayanan.
     */
    public function index(): JsonResponse
    {
        $profil = Profil::getByTipe('maklumat');
        
        if (!$profil) {
            $profil = [
                'nm_profil' => 'Maklumat Pelayanan',
                'slug' => 'maklumat-pelayanan',
                'tipe' => 'maklumat',
                'deskripsi' => ''
            ];
        }
        
        return response()->json([
            'success' => true,
            'data' => $profil
        ]);
    }

    /**
     * Simpan atau perbarui data maklumat.
     */
    public function store(Request $request): JsonResponse
    {
        // Validasi manual untuk menghindari redirect otomatis
        $validator = Validator::make($request->all(), [
            'nm_profil' => 'required|string|max:100',
            'deskripsi' => 'required',
            'file_banner' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = [
            'nm_profil' => $request->nm_profil,
            'slug' => 'maklumat-pelayanan',
            'deskripsi' => $request->deskripsi,
            'tipe' => 'maklumat',
        ];

        // Proses unggah file banner
        if ($request->hasFile('file_banner')) {
            $profil = Profil::where('tipe', 'maklumat')->first();
            
            // Hapus file lama jika ada
            if ($profil && $profil->file_banner && Storage::disk('public')->exists($profil->file_banner)) {
                Storage::disk('public')->delete($profil->file_banner);
            }
            
            $file = $request->file('file_banner');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('profil/maklumat', $filename, 'public');
            $data['file_banner'] = $path;
        }

        // Update atau create data berdasarkan tipe
        $result = Profil::updateOrCreate(
            ['tipe' => 'maklumat'],
            $data
        );

        return response()->json([
            'success' => true,
            'message' => 'Maklumat pelayanan berhasil diperbarui.',
            'data' => $result
        ], 200);
    }
}