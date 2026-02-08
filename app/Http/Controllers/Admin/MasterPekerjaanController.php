<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterPekerjaan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MasterPekerjaanController extends Controller
{
    /**
     * Menampilkan seluruh daftar master data pekerjaan.
     */
    public function index(): JsonResponse
    {
        $data = MasterPekerjaan::orderBy('nama_pekerjaan')->get();

        return response()->json([
            'success' => true,
            'data'    => $data
        ], 200);
    }

    /**
     * Menambahkan jenis pekerjaan baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama_pekerjaan' => 'required|string|max:255|unique:master_pekerjaan,nama_pekerjaan',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        MasterPekerjaan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pekerjaan berhasil ditambahkan.',
            'data'    => $validated
        ], 200);
    }

    /**
     * Memperbarui nama atau status aktif data pekerjaan.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $item = MasterPekerjaan::findOrFail($id);

        $validated = $request->validate([
            'nama_pekerjaan' => 'required|string|max:255|unique:master_pekerjaan,nama_pekerjaan,' . $id,
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $item->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pekerjaan berhasil diperbarui.',
            'data'    => $validated
        ], 200);
    }

    /**
     * Menghapus data pekerjaan secara permanen.
     */
    public function destroy($id): JsonResponse
    {
        $item = MasterPekerjaan::findOrFail($id);
        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pekerjaan berhasil dihapus.',
        ], 200);
    }
}