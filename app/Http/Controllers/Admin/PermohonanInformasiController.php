<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermohonanInformasi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PermohonanInformasiController extends Controller
{
    /**
     * Menampilkan daftar permohonan informasi publik.
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $query = PermohonanInformasi::with(['skpd', 'disposisi.skpd']);

        if ($user->hasRole('opd') && $user->id_skpd) {
            $query->whereHas('disposisi', fn($q) => $q->where('id_skpd', $user->id_skpd));
        }

        if ($request->filled('search')) {
            $search = '%' . $request->search . '%';
            $query->where(fn($q) => $q->where('nama', 'like', $search)->orWhere('email', 'like', $search));
        }

        return response()->json([
            'success' => true,
            'data'    => $query->latest()->paginate(10)
        ], 200);
    }

    /**
     * Mengubah status permohonan informasi.
     */
    public function updateStatus(Request $request, string $id): JsonResponse
    {
        $permohonan = PermohonanInformasi::find($id);

        if (!$permohonan) {
            return response()->json(['success' => false, 'message' => 'Permohonan tidak ditemukan.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:p,v,d,s,t,b',
            'pesan' => 'nullable|string',
            'file' => 'nullable|file|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $data = $request->only(['status', 'pesan']);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('permohonan/hasil', 'public');
        }

        $permohonan->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Status permohonan berhasil diperbarui.'
        ], 200);
    }

    /**
     * Menghapus permohonan informasi (hanya status tertentu).
     */
    public function destroy(string $id): JsonResponse
    {
        $permohonan = PermohonanInformasi::find($id);

        if (!$permohonan) {
            return response()->json(['success' => false, 'message' => 'Permohonan tidak ditemukan.'], 404);
        }

        // Hapus file fisik
        if ($permohonan->file) Storage::disk('public')->delete($permohonan->file);
        if ($permohonan->foto_ktp) Storage::disk('public')->delete($permohonan->foto_ktp);

        $permohonan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Permohonan berhasil dihapus.'
        ], 200);
    }
}