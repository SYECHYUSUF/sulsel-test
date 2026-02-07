<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sosmed;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SosmedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $sosmeds = Sosmed::orderBy('urutan')->get();

        return response()->json([
            'success' => true,
            'data'    => $sosmeds
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'sosmed' => 'required|string|max:100|unique:tbl_sosmed,sosmed',
            'link_sosmed' => 'required|url',
            'icon_sosmed' => 'required|string',
            'urutan' => 'nullable|integer',
            'judul' => 'nullable|string|max:100',
        ]);

        $id = Sosmed::max('id_sosmed') + 1;

        $data = Sosmed::create([
            'id_sosmed' => $id,
            'sosmed' => $request->sosmed,
            'link_sosmed' => $request->link_sosmed,
            'icon_sosmed' => $request->icon_sosmed,
            'urutan' => $request->urutan ?? $id,
            'judul' => $request->judul ?? $request->sosmed,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Media Sosial berhasil ditambahkan.',
            'data'    => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $sosmed = Sosmed::findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $sosmed
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $validated = $request->validate([
            'sosmed' => 'required|string|max:100|unique:tbl_sosmed,sosmed,' . $id . ',id_sosmed',
            'link_sosmed' => 'required|url',
            'icon_sosmed' => 'required|string',
            'urutan' => 'nullable|integer',
            'judul' => 'nullable|string|max:100',
        ]);

        $sosmed = Sosmed::findOrFail($id);
        $sosmed->update([
            'sosmed' => $request->sosmed,
            'link_sosmed' => $request->link_sosmed,
            'icon_sosmed' => $request->icon_sosmed,
            'urutan' => $request->urutan ?? $sosmed->urutan,
            'judul' => $request->judul ?? $request->sosmed,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Media Sosial berhasil diperbarui.',
            'data'    => $sosmed
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $sosmed = Sosmed::findOrFail($id);
        $sosmed->delete();

        return response()->json([
            'success' => true,
            'message' => 'Media Sosial berhasil dihapus.',
            'data'    => null
        ], 200);
    }
}