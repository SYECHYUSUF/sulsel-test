<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTahun;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MasterTahunController extends Controller
{
    public function index(): JsonResponse
    {
        $data = MasterTahun::orderBy('waktu')->get();

        return response()->json([
            'success' => true,
            'data'    => $data
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'waktu' => 'required|string|max:255',
        ]);

        MasterTahun::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data tahun berhasil ditambahkan.',
            'data'    => $validated
        ], 200);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $item = MasterTahun::findOrFail($id);

        $validated = $request->validate([
            'waktu' => 'required|string|max:255',
        ]);

        $item->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data tahun berhasil diperbarui.',
            'data'    => $validated
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        $item = MasterTahun::findOrFail($id);
        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data tahun berhasil dihapus.',
        ], 200);
    }
}