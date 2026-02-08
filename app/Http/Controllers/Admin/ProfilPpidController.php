<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ProfilPpidController extends Controller
{
    /**
     * Menampilkan data profil PPID.
     */
    public function index(): JsonResponse
    {
        $profil = Profil::where('tipe', 'profil-ppid')->first();
        
        return response()->json([
            'success' => true,
            'data'    => $profil
        ], 200);
    }

    /**
     * Menyimpan atau memperbarui konten profil PPID.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nm_profil' => 'required|string|max:100',
            'deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $profil = Profil::updateOrCreate(
            ['tipe' => 'profil-ppid'],
            [
                'nm_profil' => $request->nm_profil,
                'slug' => 'profil-ppid',
                'deskripsi' => $request->deskripsi,
                'tipe' => 'profil-ppid',
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Profil PPID berhasil diperbarui',
            'data'    => $profil
        ], 200);
    }
}