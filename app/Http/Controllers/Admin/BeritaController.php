<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita dengan filter pencarian dan verifikasi.
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $query = Berita::with('skpd');

        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }

        if ($request->filled('search')) {
            $query->where('judul', 'ilike', '%' . $request->search . '%');
        }

        if ($request->filled('verify')) {
            $query->where('verify', $request->verify);
        }

        $berita = $query->latest('tgl_upload')->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Daftar berita berhasil diambil',
            'data' => $berita
        ], 200);
    }

    /**
     * Menyimpan berita baru dan mengirim notifikasi jika dibuat oleh OPD.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'id_skpd' => 'required',
            'img_berita' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
        $data['slug'] = Str::slug($request->judul) . '-' . rand(100, 999);
        $data['viewers'] = 0;

        if ($request->hasFile('img_berita')) {
            $file = $request->file('img_berita');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('berita', $filename, 'public');
            $data['img_berita'] = $filename;
        }

        $berita = Berita::create($data);

        // Notifikasi ke Admin jika berita ditambahkan oleh akun OPD
        if (Auth::user()->hasRole('opd')) {
            $admins = User::whereHasRole('admin')->get();
            foreach ($admins as $admin) {
                Notification::send([
                    'to_user_id' => $admin->id,
                    'type' => 'info',
                    'title' => 'Berita Baru',
                    'message' => 'OPD ' . Auth::user()->skpd->nm_skpd . ' telah menambahkan berita baru: ' . $berita->judul,
                    'url' => route('admin.berita.edit', $berita->id_berita),
                    'notifiable_id' => $berita->id_berita,
                    'notifiable_type' => get_class($berita),
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil ditambahkan',
            'data' => $berita
        ], 201);
    }

    /**
     * Menampilkan detail satu berita.
     */
    public function show(Berita $berita): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $berita
        ]);
    }

    /**
     * Memperbarui data berita dan mengirim notifikasi status verifikasi.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json(['success' => false, 'message' => 'Berita tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'img_berita' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_skpd' => 'required|exists:tbl_skpd,id_skpd',
            'verify' => 'required|in:y,n,t',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except('img_berita');
        $data['slug'] = Str::slug($request->judul) . '-' . rand(100, 999);

        if ($request->hasFile('img_berita')) {
            if ($berita->img_berita && Storage::disk('public')->exists('img_berita/' . $berita->img_berita)) {
                Storage::disk('public')->delete('img_berita/' . $berita->img_berita);
            }

            $file = $request->file('img_berita');
            $filename = $file->hashName();
            $file->storeAs('img_berita', $filename, 'public');
            $data['img_berita'] = $filename;
        }

        $berita->update($data);

        // Kirim notifikasi ke OPD jika status verifikasi diubah oleh Admin
        if (Auth::user()->hasRole('admin') && $berita->wasChanged('verify')) {
            $statusMapping = [
                'y' => ['Terverifikasi', 'success'],
                'n' => ['Pending', 'info'],
                't' => ['Ditolak', 'error'],
            ];

            $statusText = $statusMapping[$berita->verify][0] ?? 'Berubah';
            $type = $statusMapping[$berita->verify][1] ?? 'info';

            Notification::send([
                'to_skpd_id' => $berita->id_skpd,
                'type' => $type,
                'title' => 'Status Berita: ' . $statusText,
                'message' => 'Berita "' . $berita->judul . '" telah ' . strtolower($statusText) . ' oleh admin.',
                'url' => route('admin.berita.edit', $berita->id_berita),
                'notifiable_id' => $berita->id_berita,
                'notifiable_type' => get_class($berita),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil diperbarui',
            'data' => $berita
        ], 200);
    }

    /**
     * Menghapus berita dan file gambarnya dari penyimpanan.
     */
    public function destroy(string $id): JsonResponse
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json(['success' => false, 'message' => 'Berita tidak ditemukan'], 404);
        }

        if ($berita->img_berita && Storage::disk('public')->exists('img_berita/' . $berita->img_berita)) {
            Storage::disk('public')->delete('img_berita/' . $berita->img_berita);
        }

        $berita->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dihapus'
        ], 200);
    }
}