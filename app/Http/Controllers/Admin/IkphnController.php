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
            $file = $request->file('file');
            
            // 1. Generate nama file yang unik (agar tidak menimpa file dengan nama sama)
            // Jika ingin nama asli: $fileName = $file->getClientOriginalName();
            $fileName = $file->getClientOriginalName();

            // 2. Simpan file ke storage/app/public/ikphn tetap menggunakan folder,
            // tapi kita hanya mengambil nama filenya saja.
            $file->storeAs('ikphn', $fileName, 'public');

            // 3. Masukkan HANYA nama file ke array data untuk disimpan di DB
            $data['file'] = $fileName;
        }

        $ikphn = Ikphn::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data Informasi Pengadaan berhasil ditambahkan.',
            'data' => $ikphn
        ], 201);
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
            $oldFilePath = 'ikphn/' . $item->file;
            
            if ($item->file && Storage::disk('public')->exists($oldFilePath)) {
                Storage::disk('public')->delete($oldFilePath);
            }

            $file = $request->file('file');

            $fileName = $file->getClientOriginalName();

            $file->storeAs('ikphn', $fileName, 'public');

            // 3. Masukkan HANYA nama file ke array data untuk disimpan di DB
            $data['file'] = $fileName;
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

        $oldFilePath = 'ikphn/' . $item->file;
            
        if ($item->file && Storage::disk('public')->exists($oldFilePath)) {
            Storage::disk('public')->delete($oldFilePath);
        }

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.',
        ], 200);
    }
}