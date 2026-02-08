<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skpd;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SkpdController extends Controller
{
    /**
     * Menampilkan daftar seluruh SKPD.
     */
    public function index(): JsonResponse
    {
        $skpd = Skpd::all();

        return response()->json([
            'success' => true,
            'data'    => $skpd
        ], 200);
    }

    /**
     * Menyimpan data SKPD baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nm_skpd'   => 'required|string|max:255',
            'alamat'    => 'nullable|string',
            'email'     => 'nullable|email|max:150',
            'no_tlp'    => 'nullable|string|max:20',
            'website'   => 'nullable|url|max:255',
            'kadis'     => 'nullable|string|max:200',
            'sek'       => 'nullable|string|max:200',
            'visimisi'  => 'nullable|string',
            'tupoksi'   => 'nullable|string',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jenis'     => 'nullable|in:opd,kab',
            'is_active' => 'required|in:1,0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logo-skpd', 'public');
        }

        $skpd = Skpd::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data SKPD berhasil ditambahkan',
            'data'    => $skpd
        ], 201);
    }

    /**
     * Memperbarui data SKPD yang ada.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $skpd = Skpd::find($id);

        if (!$skpd) {
            return response()->json([
                'success' => false,
                'message' => 'SKPD tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nm_skpd'   => 'required|string|max:255',
            'alamat'    => 'nullable|string',
            'email'     => 'nullable|email|max:150',
            'no_tlp'    => 'nullable|string|max:20',
            'website'   => 'nullable|url|max:255',
            'kadis'     => 'nullable|string|max:200',
            'sek'       => 'nullable|string|max:200',
            'visimisi'  => 'nullable|string',
            'tupoksi'   => 'nullable|string',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jenis'     => 'nullable|in:opd,kab',
            'is_active' => 'required|in:1,0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        if ($request->hasFile('logo')) {
            if ($skpd->logo && Storage::disk('public')->exists($skpd->logo)) {
                Storage::disk('public')->delete($skpd->logo);
            }
            $data['logo'] = $request->file('logo')->store('logo-skpd', 'public');
        }

        $skpd->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data SKPD berhasil diperbarui',
            'data'    => $skpd
        ], 200);
    }

    /**
     * Menghapus data SKPD secara permanen.
     */
    public function destroy(string $id): JsonResponse
    {
        $skpd = Skpd::find($id);

        if (!$skpd) {
            return response()->json([
                'success' => false,
                'message' => 'SKPD tidak ditemukan'
            ], 404);
        }

        if ($skpd->logo && Storage::disk('public')->exists($skpd->logo)) {
            Storage::disk('public')->delete($skpd->logo);
        }

        $skpd->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data SKPD berhasil dihapus'
        ], 200);
    }
}