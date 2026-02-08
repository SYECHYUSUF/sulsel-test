<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\KategoriInformasi;
use App\Models\Skpd;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InformasiController extends Controller
{
    /**
     * Menampilkan daftar informasi publik dengan filter akses OPD.
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $query = Informasi::with(['kategori', 'skpd']);

        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('id_kat_info')) {
            $query->where('id_kat_info', $request->id_kat_info);
        }

        if ($request->filled('id_skpd') && !$user->hasRole('opd')) {
            $query->where('id_skpd', $request->id_skpd);
        }

        if ($request->filled('verify')) {
            $query->where('verify', $request->verify);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('tgl_upload', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('tgl_upload', '<=', $request->end_date);
        }

        $sortBy = $request->get('sort', 'newest');
        switch ($sortBy) {
            case 'oldest': $query->oldest('tgl_upload'); break;
            case 'title_asc': $query->orderBy('judul', 'asc'); break;
            case 'title_desc': $query->orderBy('judul', 'desc'); break;
            default: $query->latest('tgl_upload'); break;
        }

        $informasi = $query->paginate(10);
        
        $kategoriList = KategoriInformasi::where('is_active', 1)->get();
        $skpdList = $user->hasRole('opd')
            ? Skpd::where('id_skpd', $user->id_skpd)->get()
            : Skpd::orderBy('nm_skpd')->get();

        return response()->json([
            'success' => true,
            'data' => $informasi,
            'meta' => [
                'kategori' => $kategoriList,
                'skpd' => $skpdList
            ]
        ], 200);
    }

    /**
     * Menyimpan dokumen informasi publik baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'id_kat_info' => 'required',
            'id_skpd' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
            'ket' => 'required',
            'verify' => 'required|in:y,n,t',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('informasi/' . date('Y/m'), 'public');
            $data['file'] = $path;
        }

        $informasi = Informasi::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Dokumen informasi berhasil ditambahkan.',
            'data' => $informasi
        ], 201);
    }

    /**
     * Mengambil detail informasi untuk proses penyuntingan.
     */
    public function edit(string $id): JsonResponse
    {
        $informasi = Informasi::find($id);

        if (!$informasi) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        $user = Auth::user();
        if ($user->hasRole('opd') && $informasi->id_skpd !== $user->id_skpd) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses ke data ini.'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $informasi
        ], 200);
    }

    /**
     * Memperbarui dokumen informasi publik yang sudah ada.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $informasi = Informasi::find($id);

        if (!$informasi) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'id_kat_info' => 'required',
            'id_skpd' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
            'ket' => 'required',
            'verify' => 'required|in:y,n,t',
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
            if ($informasi->file && Storage::disk('public')->exists($informasi->file)) {
                Storage::disk('public')->delete($informasi->file);
            }
            $data['file'] = $request->file('file')->store('informasi/' . date('Y/m'), 'public');
        }

        $informasi->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Dokumen informasi berhasil diperbarui.',
            'data' => $informasi
        ], 200);
    }

    /**
     * Menghapus dokumen informasi publik.
     */
    public function destroy(string $id): JsonResponse
    {
        $informasi = Informasi::find($id);

        if (!$informasi) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        if ($informasi->file && Storage::disk('public')->exists($informasi->file)) {
            Storage::disk('public')->delete($informasi->file);
        }

        $informasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dokumen informasi berhasil dihapus.'
        ], 200);
    }

    /**
     * Menghapus beberapa dokumen informasi sekaligus.
     */
    public function bulkDelete(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'ids' => 'required|array',
            'ids.*' => 'exists:tbl_informasi,id_informasi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        $query = Informasi::whereIn('id_informasi', $request->ids);

        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }

        $informasiList = $query->get();

        if ($informasiList->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data yang dapat dihapus atau akses ditolak.'
            ], 400);
        }

        foreach ($informasiList as $informasi) {
            if ($informasi->file && Storage::disk('public')->exists($informasi->file)) {
                Storage::disk('public')->delete($informasi->file);
            }
            $informasi->delete();
        }

        return response()->json([
            'success' => true,
            'message' => count($informasiList) . ' dokumen berhasil dihapus.'
        ], 200);
    }

    /**
     * Memperbarui status verifikasi beberapa dokumen sekaligus.
     */
    public function bulkUpdateStatus(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'ids' => 'required|array',
            'ids.*' => 'exists:tbl_informasi,id_informasi',
            'verify' => 'required|in:y,n,t',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        $query = Informasi::whereIn('id_informasi', $request->ids);

        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }

        $count = $query->update(['verify' => $request->verify]);

        return response()->json([
            'success' => true,
            'message' => $count . ' dokumen berhasil diperbarui statusnya.'
        ], 200);
    }
}