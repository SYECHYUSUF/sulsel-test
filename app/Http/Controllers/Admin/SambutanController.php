<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SambutanController extends Controller
{
    /**
     * Menampilkan data sambutan pimpinan.
     */
    public function index(): JsonResponse
    {
        $profil = Profil::where('tipe', 'sambutan')->first();
        
        return response()->json([
            'success' => true,
            'data'    => $profil
        ], 200);
    }

    /**
     * Memperbarui konten sambutan dan foto pimpinan.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nm_profil' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'foto_kepala' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
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
            'slug' => 'sambutan',
            'deskripsi' => $request->deskripsi,
            'tipe' => 'sambutan',
        ];

        if ($request->hasFile('foto_kepala')) {
            $profil = Profil::where('tipe', 'sambutan')->first();
            
            if ($profil && $profil->foto_kepala && Storage::disk('public')->exists($profil->foto_kepala)) {
                Storage::disk('public')->delete($profil->foto_kepala);
            }
            
            $data['foto_kepala'] = $request->file('foto_kepala')->store('profil/sambutan', 'public');
        }

        $item = Profil::updateOrCreate(['tipe' => 'sambutan'], $data);

        return response()->json([
            'success' => true,
            'message' => 'Sambutan berhasil diperbarui',
            'data'    => $item
        ], 200);
    }
}