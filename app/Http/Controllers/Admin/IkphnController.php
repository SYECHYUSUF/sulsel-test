<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ikphn;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class IkphnController extends Controller
{
    /**
     * Menampilkan daftar data IKPHN dengan fitur pencarian dan filter.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Ikphn::query();

        if ($request->filled('search')) {
            $query->where('nama_jabatan', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'oldest': $query->oldest(); break;
                case 'title_asc': $query->orderBy('nama_jabatan', 'asc'); break;
                case 'title_desc': $query->orderBy('nama_jabatan', 'desc'); break;
                default: $query->latest(); break;
            }
        } else {
            $query->latest();
        }

        return response()->json([
            'success' => true,
            'data' => $query->paginate(10)
        ], 200);
    }

    /**
     * Menyimpan data IKPHN baru ke dalam sistem.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['jumlah_download'] = 0;

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('ikphn', 'public');
        }

        $ikphn = Ikphn::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data Informasi Pengadaan berhasil ditambahkan.',
            'data' => $ikphn
        ], 201);
    }

    /**
     * Mengambil detail data IKPHN untuk disunting.
     */
    public function edit(string $id): JsonResponse
    {
        $ikphn = Ikphn::find($id);

        if (!$ikphn) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $ikphn
        ], 200);
    }

    /**
     * Memperbarui data IKPHN yang sudah ada.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $item = Ikphn::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada unggahan baru
            if ($item->file && Storage::disk('public')->exists($item->file)) {
                Storage::disk('public')->delete($item->file);
            }
            $data['file'] = $request->file('file')->store('ikphn', 'public');
        }

        $item->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data Informasi Pengadaan berhasil diperbarui.',
            'data' => $item
        ], 200);
    }

    /**
     * Menghapus data IKPHN secara permanen.
     */
    public function destroy(string $id): JsonResponse
    {
        $item = Ikphn::find($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        if ($item->file && Storage::disk('public')->exists($item->file)) {
            Storage::disk('public')->delete($item->file);
        }

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.',
        ], 200);
    }
}