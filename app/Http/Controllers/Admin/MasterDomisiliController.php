<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterDomisili;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MasterDomisiliController extends Controller
{
    /**
     * Menampilkan daftar semua daerah domisili.
     */
    public function index(): JsonResponse
    {
        $data = MasterDomisili::orderBy('nama_daerah')->get();
        return response()->json([
            'success' => true,
            'data'    => $data
        ], 200);
    }

    /**
     * Menyimpan data domisili baru ke database.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama_daerah' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        MasterDomisili::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data domisili berhasil ditambahkan.',
            'data'    => $validated
        ], 200);
    }

    /**
     * Menampilkan detail informasi satu daerah domisili.
     */
    public function show($id): JsonResponse
    {
        $data = MasterDomisili::findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $data
        ], 200);
    }

    /**
     * Memperbarui informasi data domisili yang sudah ada.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $item = MasterDomisili::findOrFail($id);

        $validated = $request->validate([
            'nama_daerah' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $item->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data domisili berhasil diperbarui.',
            'data'    => $validated
        ], 200);
    }

    /**
     * Menghapus data domisili dari sistem.
     */
    public function destroy($id)
    {
        $item = MasterDomisili::findOrFail($id);
        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data domisili berhasil dihapus.',
        ], 200);
    }
}