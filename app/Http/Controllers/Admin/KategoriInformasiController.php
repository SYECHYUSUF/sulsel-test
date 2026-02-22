<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriInformasi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriInformasiController extends Controller
{
    /**
     * Menampilkan daftar kategori informasi dengan fitur pencarian.
     */
    public function index(Request $request): JsonResponse
    {
        $query = KategoriInformasi::query();

        if ($request->filled('search')) {
            $query->where('nm_kat_info', 'like', '%' . $request->search . '%');
        }

        $kategoris = $query->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $kategoris
        ], 200);
    }

    /**
     * Menyimpan kategori informasi baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nm_kat_info' => 'required|string|max:255',
            'icon' => 'required|string|max:10',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $kategori = KategoriInformasi::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kategori Informasi berhasil ditambahkan',
            'data' => $kategori
        ], 201);
    }

    /**
     * Mengambil detail kategori informasi untuk disunting.
     */
    public function edit(string $id): JsonResponse
    {
        $kategori = KategoriInformasi::find($id);

        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $kategori
        ], 200);
    }

    /**
     * Memperbarui data kategori informasi.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $kategori = KategoriInformasi::find($id);

        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nm_kat_info' => 'required|string|max:255',
            'icon' => 'required|string|max:10',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $kategori->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kategori Informasi berhasil diperbarui',
            'data' => $kategori
        ], 200);
    }

    /**
     * Menghapus kategori informasi secara permanen.
     */
    public function destroy(string $id): JsonResponse
    {
        $kategori = KategoriInformasi::find($id);

        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan'
            ], 404);
        }

        $kategori->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori Informasi berhasil dihapus'
        ], 200);
    }
}