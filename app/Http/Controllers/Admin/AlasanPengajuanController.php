<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlasanPengajuan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class AlasanPengajuanController extends Controller
{
    /**
     * Tampilkan semua alasan pengajuan.
     */
    public function index(): JsonResponse
    {
        $alasanPengajuans = AlasanPengajuan::orderBy('alasan')->get();

        return response()->json([
            'success' => true,
            'message' => 'Alasan pengajuan berhasil dimuat',
            'data' => $alasanPengajuans
        ], 200);
    }

    /**
     * Simpan alasan pengajuan baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'alasan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $alasan = AlasanPengajuan::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Alasan pengajuan berhasil ditambahkan.',
            'data' => $alasan
        ], 201); // 201 Created
    }

    /**
     * Perbarui alasan pengajuan.
     */
    public function update(Request $request, $id): JsonResponse
    {
        /** @var AlasanPengajuan $alasan */ // Menambahkan type hinting
        $alasan = AlasanPengajuan::find($id);

        if (!$alasan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'alasan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $alasan->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Alasan pengajuan berhasil diperbarui.',
            'data' => $alasan
        ], 200);
    }

    /**
     * Hapus alasan pengajuan.
     */
    public function destroy($id): JsonResponse
    {
        /** @var AlasanPengajuan $alasan */ // Menambahkan type hinting
        $alasan = AlasanPengajuan::find($id);

        if (!$alasan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        $alasan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Alasan pengajuan berhasil dihapus.'
        ], 200);
    }
}