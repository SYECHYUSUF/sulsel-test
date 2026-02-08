<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sosmed;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class SosmedController extends Controller
{
    /**
     * Menampilkan daftar media sosial berdasarkan urutan.
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
     * Menambahkan akun media sosial baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'sosmed' => 'required|string|max:100|unique:tbl_sosmed,sosmed',
            'link_sosmed' => 'required|url',
            'icon_sosmed' => 'required|string',
            'urutan' => 'nullable|integer',
            'judul' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $id = Sosmed::max('id_sosmed') + 1;

        $sosmed = Sosmed::create([
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
            'data'    => $sosmed
        ], 201);
    }

    /**
     * Memperbarui informasi akun media sosial.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $sosmed = Sosmed::find($id);

        if (!$sosmed) {
            return response()->json([
                'success' => false,
                'message' => 'Media sosial tidak ditemukan.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'sosmed' => 'required|string|max:100|unique:tbl_sosmed,sosmed,' . $id . ',id_sosmed',
            'link_sosmed' => 'required|url',
            'icon_sosmed' => 'required|string',
            'urutan' => 'nullable|integer',
            'judul' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

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
     * Menghapus media sosial.
     */
    public function destroy(string $id): JsonResponse
    {
        $sosmed = Sosmed::find($id);

        if (!$sosmed) {
            return response()->json([
                'success' => false,
                'message' => 'Media sosial tidak ditemukan.'
            ], 404);
        }

        $sosmed->delete();

        return response()->json([
            'success' => true,
            'message' => 'Media Sosial berhasil dihapus.'
        ], 200);
    }
}