<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanKeberatan;
use App\Models\PengajuanDisposisi;
use App\Models\PengajuanRespon;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengajuanKeberatanController extends Controller
{
    /**
     * Menampilkan daftar pengajuan keberatan dengan fitur pencarian.
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $query = PengajuanKeberatan::with(['skpd', 'disposisi.skpd']);

        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_pemohon', 'like', $searchTerm)
                    ->orWhere('kode_permohonan', 'like', $searchTerm)
                    ->orWhere('no_pendaftaran', 'like', $searchTerm);
            });
        }

        return response()->json([
            'success' => true,
            'data'    => $query->latest()->paginate(10)
        ], 200);
    }

    /**
     * Menampilkan detail lengkap pengajuan keberatan.
     */
    public function show(string $id): JsonResponse
    {
        $pengajuan = PengajuanKeberatan::with(['skpd', 'alasanPengajuan', 'disposisi.skpd', 'disposisi.respon.user'])->find($id);

        if (!$pengajuan) {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $pengajuan
        ], 200);
    }

    /**
     * Menyimpan respon disposisi untuk pengajuan keberatan.
     */
    public function storeRespon(Request $request, string $disposisiId): JsonResponse
    {
        $disposisi = PengajuanDisposisi::find($disposisiId);

        if (!$disposisi) {
            return response()->json(['success' => false, 'message' => 'Disposisi tidak ditemukan.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'respon' => 'required|string',
            'file' => 'nullable|file|max:5120',
            'status' => 'required|in:diproses,selesai,ditolak',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $filePath = $request->hasFile('file') ? $request->file('file')->store('respon-disposisi', 'public') : null;

        PengajuanRespon::create([
            'id_disposisi' => $disposisi->id_disposisi,
            'isi_respon' => $request->respon,
            'file' => $filePath,
            'respon_by' => Auth::id(),
        ]);

        $disposisi->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Respon berhasil disimpan.'
        ], 201);
    }
}