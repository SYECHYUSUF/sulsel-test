<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanKeberatan;
use App\Models\PengajuanDisposisi;
use App\Models\PengajuanRespon;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanKeberatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = PengajuanKeberatan::with(['skpd', 'disposisi.skpd']);

        // Filter Berdasarkan Role
        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }

        // Filter Pencarian - Enhanced to search multiple fields
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_pemohon', 'like', $searchTerm)
                ->orWhere('kode_permohonan', 'like', $searchTerm)
                ->orWhere('no_pendaftaran', 'like', $searchTerm)
                ->orWhere('email_pemohon', 'like', $searchTerm)
                ->orWhere('no_telp_pemohon', 'like', $searchTerm)
                ->orWhere('kasus', 'like', $searchTerm)
                ->orWhereHas('alasanPengajuan', function($subQuery) use ($searchTerm) {
                    $subQuery->where('alasan', 'like', $searchTerm);
                });
            });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengajuan = $query->latest()->paginate(10);

        // Handle JSON Request 
        if ($request->expectsJson()) {
            return response()->json($pengajuan);
        }

        return view('admin.pengajuan-keberatan.index', compact('pengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeFeedback(Request $request, $id)
    {
        $validated = $request->validate([
            'feedback' => 'required|string',
        ]);

        $pengajuan = PengajuanKeberatan::findOrFail($id);
        
        $pengajuan->update([
            'feedback' => $validated['feedback'],
            'tgl_feedback' => now(),
            'feedback_by' => Auth::id(),
            'status' => 'a', // Set status to 'Answered'
            'notified_at' => now(),
            'notification_method' => $pengajuan->metode_respon ?? 'website'
        ]);

        // Send notification to pemohon
        \App\Models\Notification::send([
            'type' => 'success',
            'title' => 'Pengajuan Keberatan Dijawab',
            'message' => 'Pengajuan keberatan Anda (#' . $pengajuan->no_pendaftaran . ') telah dijawab oleh admin.',
            'url' => route('layanan.detail-status-keberatan', ['no_pendaftaran' => $pengajuan->no_pendaftaran]),
            'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
            'notifiable_id' => $pengajuan->id_pengajuan,
        ]);

        // Send notification based on preferred method
        if ($pengajuan->metode_respon === 'whatsapp' && $pengajuan->no_telp_pemohon) {
            // Note: WhatsApp notification would be handled separately via WhatsApp API
            // For now, we just mark that notification should be sent via WhatsApp
        }

        return back()->with('success', 'Balasan berhasil dikirim dan notifikasi telah dikirim ke pemohon.');
    }
    
    public function loadFeedback($id)
    {
        $pengajuan = PengajuanKeberatan::with(['feedbackBy', 'alasanPengajuan'])->findOrFail($id);
        
        return response()->json([
            'no_pendaftaran' => $pengajuan->no_pendaftaran,
            'nama_pemohon' => $pengajuan->nama_pemohon,
            'no_telp_pemohon' => $pengajuan->no_telp_pemohon,
            'metode_respon' => $pengajuan->metode_respon, // Add this
            'alasan' => $pengajuan->alasanPengajuan->pluck('alasan'),
            'kasus' => $pengajuan->kasus,
            'feedback' => $pengajuan->feedback,
            'tgl_feedback' => $pengajuan->tgl_feedback,
            'feedback_by' => $pengajuan->feedbackBy ? $pengajuan->feedbackBy->name : '-'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengajuan = PengajuanKeberatan::with(['skpd', 'alasanPengajuan', 'feedbackBy', 'disposisi.skpd', 'disposisi.respon'])->findOrFail($id);
        $allSkpd = \App\Models\Skpd::all();
        $existingSkpdIds = $pengajuan->disposisi()->pluck('id_skpd')->toArray();
        
        return view('admin.pengajuan-keberatan.show', compact('pengajuan', 'allSkpd', 'existingSkpdIds'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        // Send notification if status is rejected (t)
        if ($validated['status'] === 't') {
            \App\Models\Notification::send([
                'type' => 'error',
                'title' => 'Pengajuan Keberatan Ditolak',
                'message' => 'Pengajuan keberatan Anda (#' . $pengajuan->no_pendaftaran . ') telah ditolak. Alasan: ' . ($validated['alasan_penolakan'] ?? 'Tidak disebutkan'),
                'url' => route('layanan.detail-status-keberatan', ['no_pendaftaran' => $pengajuan->no_pendaftaran]),
                'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
                'notifiable_id' => $pengajuan->id_pengajuan,
            ]);
        }

        return redirect()->route('admin.pengajuan-keberatan.show', $id)
            ->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengajuan = PengajuanKeberatan::findOrFail($id);
        
        // Only allow deletion if status is 'a' (answered), 'y' (approved), or 't' (rejected)
        if (!in_array($pengajuan->status, ['a', 'y', 't'])) {
            return back()->with('error', 'Pengajuan yang masih dalam proses tidak dapat dihapus sesuai standar pemerintah.');
        }
        
        // Delete related alasan_pengajuan records first
        $pengajuan->alasanPengajuan()->delete();
        
        // Delete the pengajuan
        $pengajuan->delete();
        
        return redirect()->route('admin.pengajuan-keberatan.index')
            ->with('success', 'Pengajuan keberatan berhasil dihapus.');
    }

    /**
     * Show disposisi form to select multiple SKPDs.
     */
    public function disposisiForm(string $id)
    {
        $pengajuan = PengajuanKeberatan::with('skpd')->findOrFail($id);
        $allSkpd = \App\Models\Skpd::all();
        
        // Get existing disposition SKPD IDs
        $existingSkpdIds = $pengajuan->disposisi()->pluck('id_skpd')->toArray();

        return view('admin.pengajuan-keberatan.disposisi', compact('pengajuan', 'allSkpd', 'existingSkpdIds'));
    }

    /**
     * Process disposisi to multiple SKPDs.
     */
    public function disposisiStore(Request $request, string $id)
    {
        $pengajuan = PengajuanKeberatan::findOrFail($id);
        
        $validated = $request->validate([
            'skpd_ids' => 'required|array|min:1',
            'skpd_ids.*' => 'exists:tbl_skpd,id_skpd',
            'catatan' => 'nullable|string',
        ]);

        // Create disposisi record for each SKPD
        foreach ($validated['skpd_ids'] as $skpdId) {
            // Prevent duplicate disposition
            $exists = \App\Models\PengajuanDisposisi::where('id_pengajuan', $pengajuan->id_pengajuan)
                        ->where('id_skpd', $skpdId)
                        ->exists();
            
            if ($exists) {
                continue;
            }

            \App\Models\PengajuanDisposisi::create([
                'id_pengajuan' => $pengajuan->id_pengajuan,
                'id_skpd' => $skpdId,
                'catatan_disposisi' => $validated['catatan'] ?? null,
                'status' => \App\Models\PengajuanDisposisi::STATUS_PENDING,
                'disposisi_by' => Auth::id(),
            ]);

            // Send notification to SKPD
            \App\Models\Notification::send([
                'to_skpd_id' => $skpdId,
                'type' => 'info',
                'title' => 'Disposisi Pengajuan Keberatan Baru',
                'message' => 'Anda menerima disposisi pengajuan keberatan dari ' . $pengajuan->nama_pemohon,
                'url' => route('admin.pengajuan-keberatan.show', $id),
                'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
                'notifiable_id' => $pengajuan->id_pengajuan,
            ]);
        }

        // Merge new SKPD IDs with existing ones for 'id_skpd' column
        $currentSkpdIds = [];
        if ($pengajuan->id_skpd) {
            $decoded = json_decode($pengajuan->id_skpd, true);
            if (is_array($decoded)) {
                $currentSkpdIds = $decoded;
            } elseif (is_string($pengajuan->id_skpd)) {
                // Handle case where it might be a single string ID (legacy)
                $currentSkpdIds = [$pengajuan->id_skpd];
            }
        }
        
        $mergedSkpdIds = array_values(array_unique(array_merge($currentSkpdIds, $validated['skpd_ids'])));

        // Update pengajuan status
        $pengajuan->update([
            'status' => 'd', // d = disposisi
            'id_skpd' => json_encode($mergedSkpdIds), 
        ]);

        return redirect()->route('admin.pengajuan-keberatan.show', $id)
            ->with('success', 'Pengajuan keberatan berhasil didisposisikan ke SKPD yang dipilih.');
    }

    /**
     * Store SKPD response to disposition
     */
    public function responStore(Request $request, string $disposisiId)
    {
        $disposisi = PengajuanDisposisi::findOrFail($disposisiId);
        
        // Security check: only SKPD that owns this disposition can respond
        $user = Auth::user();
        if (!$user->hasRole('admin') && $user->id_skpd !== $disposisi->id_skpd) {
            abort(403, 'Anda tidak memiliki akses untuk merespon disposisi ini.');
        }

        $validated = $request->validate([
            'respon' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120', // 5MB max
            'status' => 'required|in:diproses,selesai,ditolak',
        ]);

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('respon-disposisi', 'public');
        }

        // Create response record
        PengajuanRespon::create([
            'id_disposisi' => $disposisi->id_disposisi,
            'isi_respon' => $validated['respon'],
            'file' => $filePath,
            'respon_by' => Auth::id(),
        ]);

        // Update disposition status
        $disposisi->update([
            'status' => $validated['status'],
        ]);

        // Update main pengajuan status if all dispositions are completed
        $pengajuan = $disposisi->pengajuan;
        $allCompleted = $pengajuan->disposisi()->whereIn('status', ['selesai', 'ditolak'])->count() === $pengajuan->disposisi()->count();
        
        if ($allCompleted) {
            $pengajuan->update(['status' => 'a']); // Set to 'answered'
        }

        // Send notification to admin
        Notification::send([
            'to_user_id' => $disposisi->disposisi_by, // Admin who created disposition
            'type' => 'success',
            'title' => 'Respon Disposisi Diterima',
            'message' => 'OPD ' . $disposisi->skpd->nm_skpd . ' telah memberikan respon untuk pengajuan keberatan dari ' . $pengajuan->nama_pemohon,
            'url' => route('admin.pengajuan-keberatan.show', $pengajuan->id_pengajuan),
            'notifiable_type' => 'App\\Models\\PengajuanKeberatan',
            'notifiable_id' => $pengajuan->id_pengajuan,
        ]);

        return redirect()->route('admin.pengajuan-keberatan.show', $pengajuan->id_pengajuan)
            ->with('success', 'Respon berhasil dikirim!');
    }
}
