<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfilPemprovController extends Controller
{
    /**
     * Menampilkan profil Pemerintah Provinsi Sulawesi Selatan.
     */
    public function index(): JsonResponse
    {
        $profil = Profil::where('tipe', 'pemerintah')->first();

        return response()->json([
            'success' => true,
            'data'    => $profil
        ], 200);
    }

    /**
     * Memperbarui informasi profil pemerintah termasuk foto pimpinan.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nm_profil' => 'required|string|max:100',
            'deskripsi' => 'required',
            'foto_gubernur' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'foto_wakil' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $profil = Profil::where('tipe', 'pemerintah')->first();
        $data = $request->except(['foto_gubernur', 'foto_wakil']);

        // Handle Foto Gubernur
        if ($request->hasFile('foto_gubernur')) {
            if ($profil && $profil->foto_gubernur) Storage::disk('public')->delete($profil->foto_gubernur);
            $data['foto_gubernur'] = $request->file('foto_gubernur')->store('profil/pemerintah', 'public');
        }

        // Handle Foto Wakil
        if ($request->hasFile('foto_wakil')) {
            if ($profil && $profil->foto_wakil) Storage::disk('public')->delete($profil->foto_wakil);
            $data['foto_wakil'] = $request->file('foto_wakil')->store('profil/pemerintah', 'public');
        }

        $result = Profil::updateOrCreate(['tipe' => 'pemerintah'], $data);

        return response()->json([
            'success' => true,
            'message' => 'Profil Pemerintah berhasil diperbarui.',
            'data' => $result
        ], 200);
    }
}