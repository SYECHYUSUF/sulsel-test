<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanKeberatan;
use App\Models\PengajuanDisposisi;
use App\Models\PengajuanRespon;
use App\Models\Notification;
use App\Models\Skpd;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengajuanKeberatanController extends Controller
{
    /**
     * Menampilkan daftar pengajuan keberatan dengan fitur pencarian dan filter.
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $query = PengajuanKeberatan::with(['skpd', 'disposisi.skpd']);

        // Filter Berdasarkan Role (User Data Integration)
        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }

        // Filter Pencarian
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_pemohon', 'like', $searchTerm)
                    ->orWhere('kode_permohonan', 'like', $searchTerm)
                    ->orWhere('no_pendaftaran', 'like', $searchTerm)
                    ->orWhere('email_pemohon', 'like', $searchTerm)
                    ->orWhere('no_telp_pemohon', 'like', $searchTerm)
                    ->orWhere('kasus', 'like', $searchTerm)
                    ->orWhereHas('alasanPengajuan', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('alasan', 'like', $searchTerm);
                    });
            });
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
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
        $pengajuan = PengajuanKeberatan::with([
            'skpd', 
            'alasanPengajuan', 
            'feedbackBy', 
            'disposisi.skpd', 
            'disposisi.respon.user'
        ])->find($id);

        if (!$pengajuan) {
            return response()->json(['success' => false, 'message' => 'Pengajuan tidak ditemukan.'], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $pengajuan,
            'extra'   => [
                'all_skpd' => Skpd::all(),
                'existing_skpd_ids' => $pengajuan->disposisi()->pluck('id_skpd')->toArray()
            ]
        ], 200);
    }

    /**
     * Memperbarui status pengajuan (Update dari Resource).
     */
    public function update(Request $request, string $id): JsonResponse
    {
        /** @var PengajuanKeberatan $pengajuan */ // Menambahkan type hinting
        $pengajuan = PengajuanKeberatan::find($id);
        if (!$pengajuan) return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);

        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:p,a,y,t,d',
            'alasan_penolakan' => 'nullable|string',
        ]);

        if ($validator->fails()) return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

        $pengajuan->update([
            'status' => $request->status,
            'alasan_penolakan' => $request->alasan_penolakan ?? null,
        ]);

        if ($request->status === 't') {
            Notification::send([
                'type' => 'error',
                'title' => 'Pengajuan Keberatan Ditolak',
                'message' => "Pengajuan (#{$pengajuan->no_pendaftaran}) ditolak. Alasan: " . ($request->alasan_penolakan ?? 'Tidak disebutkan'),
                'url' => env('FRONTEND_URL') . '/admin/pengajuan-keberatan/' . $pengajuan->id_pengajuan,
                'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
                'notifiable_id' => $pengajuan->id_pengajuan,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
    }

    /**
     * Menghapus pengajuan keberatan.
     */
    public function destroy(string $id): JsonResponse
    {
        /** @var PengajuanKeberatan $pengajuan */ // Menambahkan type hinting
        $pengajuan = PengajuanKeberatan::find($id);
        if (!$pengajuan) return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);

        if (!in_array($pengajuan->status, ['a', 'y', 't'])) {
            return response()->json(['success' => false, 'message' => 'Pengajuan dalam proses tidak dapat dihapus.'], 400);
        }

        $pengajuan->alasanPengajuan()->delete();
        $pengajuan->delete();

        return response()->json(['success' => true, 'message' => 'Pengajuan berhasil dihapus.']);
    }

    /**
     * Menyimpan feedback untuk pemohon.
     */
    public function storeFeedback(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), ['feedback' => 'required|string']);
        if ($validator->fails()) return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

        /** @var PengajuanKeberatan $pengajuan */ // Menambahkan type hinting
        $pengajuan = PengajuanKeberatan::find($id);
        if (!$pengajuan) return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);

        $pengajuan->update([
            'feedback' => $request->feedback,
            'tgl_feedback' => now(),
            'feedback_by' => Auth::id(),
            'status' => 'a',
            'notified_at' => now(),
            'notification_method' => $pengajuan->metode_respon ?? 'website'
        ]);

        Notification::send([
            'type' => 'success',
            'title' => 'Pengajuan Keberatan Dijawab',
            'message' => "Pengajuan (#{$pengajuan->no_pendaftaran}) telah dijawab.",
            'url' => env('FRONTEND_URL') . '/admin/pengajuan-keberatan/' . $pengajuan->id_pengajuan,
            'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
            'notifiable_id' => $pengajuan->id_pengajuan,
        ]);

        return response()->json(['success' => true, 'message' => 'Feedback berhasil dikirim.']);
    }

    /**
     * Memuat data feedback untuk ditampilkan di modal/form.
     */
    public function loadFeedback($id): JsonResponse
    {
        $pengajuan = PengajuanKeberatan::with(['feedbackBy', 'alasanPengajuan'])->find($id);
        if (!$pengajuan) return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);

        return response()->json([
            'success' => true,
            'data' => [
                'no_pendaftaran' => $pengajuan->no_pendaftaran,
                'nama_pemohon' => $pengajuan->nama_pemohon,
                'metode_respon' => $pengajuan->metode_respon,
                'alasan' => $pengajuan->alasanPengajuan->pluck('alasan'),
                'kasus' => $pengajuan->kasus,
                'feedback' => $pengajuan->feedback,
                'tgl_feedback' => $pengajuan->tgl_feedback,
                'feedback_by' => $pengajuan->feedbackBy->name ?? '-'
            ]
        ]);
    }

    /**
     * Memproses disposisi ke banyak SKPD.
     */
    public function disposisiStore(Request $request, string $id): JsonResponse
    {
        /** @var PengajuanKeberatan $pengajuan */ // Menambahkan type hinting
        $pengajuan = PengajuanKeberatan::find($id);
        if (!$pengajuan) return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);

        $validator = Validator::make($request->all(), [
            'skpd_ids' => 'required|array|min:1',
            'skpd_ids.*' => 'exists:tbl_skpd,id_skpd',
            'catatan' => 'nullable|string',
        ]);

        if ($validator->fails()) return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

        foreach ($request->skpd_ids as $skpdId) {
            $exists = PengajuanDisposisi::where('id_pengajuan', $pengajuan->id_pengajuan)
                ->where('id_skpd', $skpdId)
                ->exists();

            if ($exists) continue;

            PengajuanDisposisi::create([
                'id_pengajuan' => $pengajuan->id_pengajuan,
                'id_skpd' => $skpdId,
                'catatan_disposisi' => $request->catatan,
                'status' => 'pending',
                'disposisi_by' => Auth::id(),
            ]);

            Notification::send([
                'to_skpd_id' => $skpdId,
                'type' => 'info',
                'title' => 'Disposisi Baru',
                'message' => 'Anda menerima disposisi pengajuan keberatan dari ' . $pengajuan->nama_pemohon,
                'url' => env('FRONTEND_URL') . '/opd/pengajuan-keberatan/' . $pengajuan->id_pengajuan,
                'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
                'notifiable_id' => $pengajuan->id_pengajuan,
            ]);
        }

        // Sinkronisasi kolom id_skpd (JSON) di tabel utama
        $currentIds = json_decode($pengajuan->id_skpd, true) ?: [];
        if (is_string($pengajuan->id_skpd) && !empty($pengajuan->id_skpd) && !str_starts_with($pengajuan->id_skpd, '[')) {
            $currentIds = [$pengajuan->id_skpd];
        }
        
        $mergedIds = array_values(array_unique(array_merge($currentIds, $request->skpd_ids)));

        $pengajuan->update([
            'status' => 'd',
            'id_skpd' => json_encode($mergedIds),
        ]);

        return response()->json(['success' => true, 'message' => 'Disposisi berhasil diproses.']);
    }

    /**
     * Menyimpan respon dari SKPD terhadap disposisi.
     */
    public function responStore(Request $request, string $disposisiId): JsonResponse
    {
        $disposisi = PengajuanDisposisi::with('skpd', 'pengajuan')->find($disposisiId);
        if (!$disposisi) return response()->json(['success' => false, 'message' => 'Disposisi tidak ditemukan.'], 404);

        $user = Auth::user();
        if (!$user->hasRole('admin') && $user->id_skpd !== $disposisi->id_skpd) {
            return response()->json(['success' => false, 'message' => 'Unauthorized SKPD access.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'respon' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120',
            'status' => 'required|in:diproses,selesai,ditolak',
        ]);

        if ($validator->fails()) return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

        $filePath = $request->hasFile('file') ? $request->file('file')->store('respon-disposisi', 'public') : null;

        PengajuanRespon::create([
            'id_disposisi' => $disposisi->id_disposisi,
            'isi_respon' => $request->respon,
            'file' => $filePath,
            'respon_by' => Auth::id(),
        ]);

        $disposisi->update(['status' => $request->status]);

        // Cek jika semua disposisi selesai
        $pengajuan = $disposisi->pengajuan;
        $totalDisposisi = $pengajuan->disposisi()->count();
        $completedCount = $pengajuan->disposisi()->whereIn('status', ['selesai', 'ditolak'])->count();

        if ($totalDisposisi > 0 && $totalDisposisi === $completedCount) {
            $pengajuan->update(['status' => 'a']);
        }

        Notification::send([
            'to_user_id' => $disposisi->disposisi_by,
            'type' => 'success',
            'title' => 'Respon Disposisi Diterima',
            'message' => "OPD {$disposisi->skpd->nm_skpd} telah merespon pengajuan {$pengajuan->nama_pemohon}",
            'url' => env('FRONTEND_URL') . '/admin/pengajuan-keberatan/' . $pengajuan->id_pengajuan,
            'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
            'notifiable_id' => $pengajuan->id_pengajuan,
        ]);

        return response()->json(['success' => true, 'message' => 'Respon berhasil disimpan.']);
    }
}