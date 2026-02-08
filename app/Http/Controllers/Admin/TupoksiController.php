<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TupoksiController extends Controller
{
    /**
     * Menampilkan data Tugas Pokok dan Fungsi (Tupoksi).
     */
    public function index(): JsonResponse
    {
        $profil = Profil::where('tipe', 'tupoksi')->first();
        
        return response()->json([
            'success' => true,
            'data'    => $profil
        ], 200);
    }

    /**
     * Memperbarui konten Tupoksi.
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
            ['tipe' => 'tupoksi'],
            [
                'nm_profil' => $request->nm_profil,
                'slug'      => 'tupoksi',
                'deskripsi' => $request->deskripsi,
                'tipe'      => 'tupoksi',
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Tupoksi berhasil diperbarui.',
            'data'    => $profil
        ], 200);
    }
}