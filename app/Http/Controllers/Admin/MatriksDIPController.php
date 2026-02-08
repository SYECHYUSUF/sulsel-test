<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MatriksDip;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class MatriksDIPController extends Controller
{
    /**
     * Menampilkan daftar Matriks DIP dengan fitur pencarian.
     */
    public function index(Request $request): JsonResponse
    {
        $query = MatriksDip::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('a', 'like', "%{$search}%")
                    ->orWhere('b', 'like', "%{$search}%");
            });
        }

        return response()->json([
            'success' => true,
            'data'    => $query->paginate(10)
        ], 200);
    }

    /**
     * Menyimpan data Matriks DIP baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'a' => 'nullable|string|max:255',
            'b' => 'nullable|string|max:255',
            'c' => 'nullable|string|max:255',
            'd' => 'nullable|string|max:255',
            'e' => 'nullable|string|max:255',
            'f' => 'nullable|string|max:255',
            'g' => 'nullable|string|max:255',
            'h' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = MatriksDip::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Informasi Daftar Publik berhasil ditambahkan.',
            'data'    => $data
        ], 201);
    }

    /**
     * Menampilkan detail Matriks DIP.
     */
    public function show(string $id): JsonResponse
    {
        $item = MatriksDip::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $item
        ], 200);
    }

    /**
     * Memperbarui data Matriks DIP.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $item = MatriksDip::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'a' => 'nullable|string|max:255',
            'b' => 'nullable|string|max:255',
            'c' => 'nullable|string|max:255',
            'd' => 'nullable|string|max:255',
            'e' => 'nullable|string|max:255',
            'f' => 'nullable|string|max:255',
            'g' => 'nullable|string|max:255',
            'h' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $item->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Informasi Daftar Publik berhasil diperbarui.',
            'data'    => $item
        ], 200);
    }

    /**
     * Menghapus data Matriks DIP secara permanen.
     */
    public function destroy(string $id): JsonResponse
    {
        $item = MatriksDip::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ], 200);
    }
}