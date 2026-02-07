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

class PengajuanKeberatanController extends Controller
{
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
                    ->orWhere('no_pendaftaran', 'like', $searchTerm)
                    ->orWhere('email_pemohon', 'like', $searchTerm)
                    ->orWhere('no_telp_pemohon', 'like', $searchTerm)
                    ->orWhere('kasus', 'like', $searchTerm)
                    ->orWhereHas('alasanPengajuan', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('alasan', 'like', $searchTerm);
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengajuan = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $pengajuan
        ], 200);
    }

    public function storeFeedback(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'feedback' => 'required|string',
        ]);

        $pengajuan = PengajuanKeberatan::findOrFail($id);

        $pengajuan->update([
            'feedback' => $validated['feedback'],
            'tgl_feedback' => now(),
            'feedback_by' => Auth::id(),
            'status' => 'a',
            'notified_at' => now(),
            'notification_method' => $pengajuan->metode_respon ?? 'website'
        ]);

        Notification::send([
            'type' => 'success',
            'title' => 'Pengajuan Keberatan Dijawab',
            'message' => 'Pengajuan keberatan Anda (#' . $pengajuan->no_pendaftaran . ') telah dijawab oleh admin.',
            'url' => route('layanan.detail-status-keberatan', ['no_pendaftaran' => $pengajuan->no_pendaftaran]),
            'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
            'notifiable_id' => $pengajuan->id_pengajuan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Balasan berhasil dikirim dan notifikasi telah dikirim ke pemohon.'
        ], 200);
    }

    public function loadFeedback($id): JsonResponse
    {
        $pengajuan = PengajuanKeberatan::with(['feedbackBy', 'alasanPengajuan'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'no_pendaftaran' => $pengajuan->no_pendaftaran,
                'nama_pemohon' => $pengajuan->nama_pemohon,
                'no_telp_pemohon' => $pengajuan->no_telp_pemohon,
                'metode_respon' => $pengajuan->metode_respon,
                'alasan' => $pengajuan->alasanPengajuan->pluck('alasan'),
                'kasus' => $pengajuan->kasus,
                'feedback' => $pengajuan->feedback,
                'tgl_feedback' => $pengajuan->tgl_feedback,
                'feedback_by' => $pengajuan->feedbackBy ? $pengajuan->feedbackBy->name : '-'
            ]
        ], 200);
    }

    public function show(string $id): JsonResponse
    {
        $pengajuan = PengajuanKeberatan::with(['skpd', 'alasanPengajuan', 'feedbackBy', 'disposisi.skpd', 'disposisi.respon'])->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data'    => $pengajuan
        ], 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $pengajuan = PengajuanKeberatan::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|string|in:p,a,y,t,d',
            'alasan_penolakan' => 'nullable|string',
        ]);

        $pengajuan->update([
            'status' => $validated['status'],
            'alasan_penolakan' => $validated['alasan_penolakan'] ?? null,
        ]);

        if ($validated['status'] === 't') {
            Notification::send([
                'type' => 'error',
                'title' => 'Pengajuan Keberatan Ditolak',
                'message' => 'Pengajuan keberatan Anda (#' . $pengajuan->no_pendaftaran . ') telah ditolak. Alasan: ' . ($validated['alasan_penolakan'] ?? 'Tidak disebutkan'),
                'url' => route('layanan.detail-status-keberatan', ['no_pendaftaran' => $pengajuan->no_pendaftaran]),
                'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
                'notifiable_id' => $pengajuan->id_pengajuan,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status pengajuan berhasil diperbarui.'
        ], 200);
    }

    public function destroy(string $id): JsonResponse
    {
        $pengajuan = PengajuanKeberatan::findOrFail($id);

        if (!in_array($pengajuan->status, ['a', 'y', 't'])) {
            return response()->json([
                'success' => false,
                'message' => 'Pengajuan yang masih dalam proses tidak dapat dihapus sesuai standar pemerintah.'
            ], 422);
        }

        $pengajuan->alasanPengajuan()->delete();
        $pengajuan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan keberatan berhasil dihapus.'
        ], 200);
    }

    public function disposisiStore(Request $request, string $id): JsonResponse
    {
        $pengajuan = PengajuanKeberatan::findOrFail($id);

        $validated = $request->validate([
            'skpd_ids' => 'required|array|min:1',
            'skpd_ids.*' => 'exists:tbl_skpd,id_skpd',
            'catatan' => 'nullable|string',
        ]);

        foreach ($validated['skpd_ids'] as $skpdId) {
            $exists = PengajuanDisposisi::where('id_pengajuan', $pengajuan->id_pengajuan)
                ->where('id_skpd', $skpdId)
                ->exists();

            if ($exists) {
                continue;
            }

            PengajuanDisposisi::create([
                'id_pengajuan' => $pengajuan->id_pengajuan,
                'id_skpd' => $skpdId,
                'catatan_disposisi' => $validated['catatan'] ?? null,
                'status' => PengajuanDisposisi::STATUS_PENDING,
                'disposisi_by' => Auth::id(),
            ]);

            Notification::send([
                'to_skpd_id' => $skpdId,
                'type' => 'info',
                'title' => 'Disposisi Pengajuan Keberatan Baru',
                'message' => 'Anda menerima disposisi pengajuan keberatan dari ' . $pengajuan->nama_pemohon,
                'url' => route('admin.pengajuan-keberatan.show', $id),
                'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
                'notifiable_id' => $pengajuan->id_pengajuan,
            ]);
        }

        $currentSkpdIds = [];
        if ($pengajuan->id_skpd) {
            $decoded = json_decode($pengajuan->id_skpd, true);
            $currentSkpdIds = is_array($decoded) ? $decoded : [$pengajuan->id_skpd];
        }

        $mergedSkpdIds = array_values(array_unique(array_merge($currentSkpdIds, $validated['skpd_ids'])));

        $pengajuan->update([
            'status' => 'd',
            'id_skpd' => json_encode($mergedSkpdIds),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan keberatan berhasil didisposisikan ke SKPD yang dipilih.'
        ], 200);
    }

    public function responStore(Request $request, string $disposisiId): JsonResponse
    {
        $disposisi = PengajuanDisposisi::findOrFail($disposisiId);
        $user = Auth::user();

        if (!$user->hasRole('admin') && $user->id_skpd !== $disposisi->id_skpd) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk merespon disposisi ini.'
            ], 403);
        }

        $validated = $request->validate([
            'respon' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120',
            'status' => 'required|in:diproses,selesai,ditolak',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('respon-disposisi', 'public');
        }

        PengajuanRespon::create([
            'id_disposisi' => $disposisi->id_disposisi,
            'isi_respon' => $validated['respon'],
            'file' => $filePath,
            'respon_by' => Auth::id(),
        ]);

        $disposisi->update([
            'status' => $validated['status'],
        ]);

        $pengajuan = $disposisi->pengajuan;
        $allCompleted = $pengajuan->disposisi()->whereIn('status', ['selesai', 'ditolak'])->count() === $pengajuan->disposisi()->count();

        if ($allCompleted) {
            $pengajuan->update(['status' => 'a']);
        }

        Notification::send([
            'to_user_id' => $disposisi->disposisi_by,
            'type' => 'success',
            'title' => 'Respon Disposisi Diterima',
            'message' => 'OPD ' . $disposisi->skpd->nm_skpd . ' telah memberikan respon untuk pengajuan keberatan dari ' . $pengajuan->nama_pemohon,
            'url' => route('admin.pengajuan-keberatan.show', $pengajuan->id_pengajuan),
            'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
            'notifiable_id' => $pengajuan->id_pengajuan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Respon berhasil dikirim!'
        ], 200);
    }
}