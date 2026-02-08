<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BentukInformasi;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class BentukInformasiController extends Controller
{
    /**
     * Menyimpan data bentuk informasi baru ke dalam database.
     * * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // Validasi input dari request
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
        ]);

        // Jika validasi gagal, kembalikan pesan error dalam format JSON
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Membuat data baru berdasarkan input yang telah divalidasi
        $bentukInformasi = BentukInformasi::create($validator->validated());
  
        return response()->json([
            'success' => true,
            'message' => 'Bentuk Informasi berhasil ditambahkan.',
            'data' => $bentukInformasi
        ], 201);
    }

    /**
     * Memperbarui data bentuk informasi yang sudah ada di database.
     * * @param Request $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(Request $request, string $id): JsonResponse
    {
        // Mencari data berdasarkan ID
        $bentukInformasi = BentukInformasi::find($id);

        // Jika data tidak ditemukan, kembalikan error 404
        if (!$bentukInformasi) {
            return response()->json([
                'success' => false,
                'message' => 'Bentuk informasi tidak ditemukan.'
            ], 404);
        }

        // Validasi input pembaruan
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Memperbarui data di database
        $bentukInformasi->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Bentuk Informasi berhasil diperbarui.',
            'data' => $bentukInformasi
        ], 200);
    }

    /**
     * Menghapus data bentuk informasi dari database.
     * * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        // Mencari data berdasarkan ID
        $bentukInformasi = BentukInformasi::find($id);

        // Jika data tidak ditemukan
        if (!$bentukInformasi) {
            return response()->json([
                'success' => false,
                'message' => 'Bentuk informasi tidak ditemukan.'
            ], 404);
        }

        // Melakukan penghapusan data
        $bentukInformasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bentuk Informasi berhasil dihapus.',
        ], 200);
    }
}