<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sop;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SopController extends Controller
{
    /**
     * Menampilkan daftar SOP dengan fitur pencarian.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Sop::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $sop = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $sop
        ], 200);
    }

    /**
     * Menyimpan data SOP baru beserta unggahan file.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only('judul');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('sop', $filename, 'public');
            $data['file'] = $filename;
        }

        $sop = Sop::create($data);

        return response()->json([
            'success' => true,
            'message' => 'SOP berhasil ditambahkan.',
            'data'    => $sop
        ], 201);
    }

    /**
     * Memperbarui data SOP dan mengganti file jika ada unggahan baru.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $sop = Sop::find($id);

        if (!$sop) {
            return response()->json([
                'success' => false,
                'message' => 'SOP tidak ditemukan.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only('judul');

        if ($request->hasFile('file')) {
            if ($sop->file && Storage::disk('public')->exists('sop/' . $sop->file)) {
                Storage::disk('public')->delete('sop/' . $sop->file);
            }

            $file = $request->file('file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $file->storeAs('sop', $filename, 'public');
            $data['file'] = $filename;
        }

        $sop->update($data);

        return response()->json([
            'success' => true,
            'message' => 'SOP berhasil diperbarui.',
            'data'    => $sop
        ], 200);
    }

    /**
     * Menghapus data SOP dan file fisiknya dari storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $sop = Sop::find($id);

        if (!$sop) {
            return response()->json([
                'success' => false,
                'message' => 'SOP tidak ditemukan.'
            ], 404);
        }

        if ($sop->file && Storage::disk('public')->exists('sop/' . $sop->file)) {
            Storage::disk('public')->delete('sop/' . $sop->file);
        }

        $sop->delete();

        return response()->json([
            'success' => true,
            'message' => 'SOP berhasil dihapus.'
        ], 200);
    }
}