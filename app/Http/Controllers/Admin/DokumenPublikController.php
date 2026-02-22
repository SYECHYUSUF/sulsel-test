<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenPublik;
use App\Models\Informasi;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DokumenPublikController extends Controller
{
    /**
     * Menampilkan daftar dokumen publik dengan filter role dan pencarian.
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $query = DokumenPublik::with(['kategori', 'skpd']);

        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }   

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori_slug')) {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('slug', $request->kategori_slug);
            });
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

        $sortBy = $request->get('sort', 'newest');
        $orderMap = [
            'oldest' => ['tgl_upload', 'asc'],
            'title_asc' => ['judul', 'asc'],
            'title_desc' => ['judul', 'desc'],
            'newest' => ['tgl_upload', 'desc'],
        ];

        $order = $orderMap[$sortBy] ?? $orderMap['newest'];
        $query->orderBy($order[0], $order[1]);

        $informasi = $query->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $informasi
        ], 200);
    }

    /**
     * Membuat dokumen publik baru dan mengirim notifikasi ke admin.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'id_kat_info' => 'required',
            'id_skpd' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
            'ket' => 'required',
            'verify' => 'nullable|in:y,n,t',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['verify'] = $request->input('verify', 'n');

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('informasi/' . date('Y/m'), 'public');
        }

        $informasi = Informasi::create($data);

        // Notifikasi untuk Admin jika diunggah oleh OPD
        if (Auth::user()->hasRole('opd')) {
            $admins = User::whereHasRole('admin')->get();
            foreach ($admins as $admin) {
                Notification::send([
                    'to_user_id' => $admin->id,
                    'type' => 'info',
                    'title' => 'Dokumen Publik Baru',
                    'message' => 'OPD ' . Auth::user()->skpd->nm_skpd . ' telah mengunggah dokumen baru.',
                    'url' => route('admin.dokumen-publik.show', $informasi->id_informasi),
                    'notifiable_id' => $informasi->id_informasi,
                    'notifiable_type' => get_class($informasi),
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Dokumen informasi berhasil ditambahkan.',
            'data' => $informasi
        ], 201);
    }

    /**
     * Menampilkan detail dokumen dengan proteksi akses antar OPD.
     */
    public function show(string $id): JsonResponse
    {
        $informasi = DokumenPublik::with(['kategori', 'skpd'])->find($id);

        if (!$informasi) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }

        if (Auth::user()->hasRole('opd') && $informasi->id_skpd !== Auth::user()->id_skpd) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak.'], 403);
        }

        return response()->json(['success' => true, 'data' => $informasi], 200);
    }

    /**
     * Memperbarui dokumen dan mengelola penggantian file fisik.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $informasi = Informasi::find($id);

        if (!$informasi) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
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
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
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
     * Menghapus dokumen beserta file fisiknya.
     */
    public function destroy(string $id): JsonResponse
    {
        $informasi = DokumenPublik::find($id);

        if (!$informasi) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }

        if ($informasi->file && Storage::disk('public')->exists($informasi->file)) {
            Storage::disk('public')->delete($informasi->file);
        }

        $informasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dokumen informasi berhasil dihapus.',
        ], 200);
    }
}