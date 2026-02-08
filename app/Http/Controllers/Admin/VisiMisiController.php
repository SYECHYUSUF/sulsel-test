<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class VisiMisiController extends Controller
{
    /**
     * Menampilkan data Visi dan Misi.
     */
    public function index(): JsonResponse
    {
        $profil = Profil::where('tipe', 'visi-misi')->first();
        
        return response()->json([
            'success' => true,
            'data'    => $profil
        ], 200);
    }

    /**
     * Memperbarui konten Visi dan Misi.
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
                'errors'  => $validator->errors()
            ], 422);
        }

        $profil = Profil::updateOrCreate(
            ['tipe' => 'visi-misi'],
            [
                'nm_profil' => $request->nm_profil,
                'slug'      => 'visi-misi',
                'deskripsi' => $request->deskripsi,
                'tipe'      => 'visi-misi',
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Visi & Misi berhasil diperbarui.',
            'data'    => $profil
        ], 200);
    }
}