<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\PermohonanDisposisi;
use App\Models\PermohonanInformasi;
use App\Models\PermohonanRespon;
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
     * Menampilkan detail permohonan informasi.
     */
    public function show(string $id): JsonResponse
    {
        // Cari permohonan informasi beserta relasi skpd-nya
        $permohonan = PermohonanInformasi::with('skpd')->find($id);

        // Jika permohonan informasi tidak ditemukan
        if (!$permohonan) {
            return response()->json([
                'success' => false,
                'message' => 'Permohonan informasi tidak ditemukan'
            ], 404);
        }

        // Return response konsisten dengan method index/store
        return response()->json([
            'data' => $permohonan
        ], 200);
    }

    /**
     * Process disposisi to multiple SKPDs.
     */
    public function disposisiStore(Request $request, string $id): JsonResponse
    {
        $permohonan = PermohonanInformasi::findOrFail($id);
        
        $validated = $request->validate([
            'skpd_ids' => 'required|array|min:1',
            'skpd_ids.*' => 'exists:tbl_skpd,id_skpd',
            'catatan' => 'nullable|string',
        ]);

        foreach ($validated['skpd_ids'] as $skpdId) {
            $exists = PermohonanDisposisi::where('id_permohonan', $permohonan->id_permohonan)
                        ->where('id_skpd', $skpdId)
                        ->exists();
            
            if ($exists) continue;

            PermohonanDisposisi::create([
                'id_permohonan' => $permohonan->id_permohonan,
                'id_skpd' => $skpdId,
                'catatan_disposisi' => $validated['catatan'] ?? null,
                'status' => PermohonanDisposisi::STATUS_PENDING,
                'disposisi_by' => Auth::id(),
            ]);

            Notification::send([
                'to_skpd_id' => $skpdId,
                'type' => 'info',
                'title' => 'Disposisi Permohonan Informasi Baru',
                'message' => 'Anda menerima disposisi permohonan informasi dari ' . $permohonan->nama,
                'url' => env('FRONTEND_URL') . '/opd/permohonan-informasi/' . $permohonan->id_permohonan,
                'notifiable_type' => 'App\\Models\\PermohonanInformasi',
                'notifiable_id' => $permohonan->id_permohonan,
            ]);
        }

        $currentSkpdIds = [];
        if ($permohonan->id_skpd) {
            $decoded = json_decode($permohonan->id_skpd, true);
            $currentSkpdIds = is_array($decoded) ? $decoded : [$permohonan->id_skpd];
        }
        
        $mergedSkpdIds = array_values(array_unique(array_merge($currentSkpdIds, $validated['skpd_ids'])));

        $permohonan->update([
            'status' => PermohonanInformasi::STATUS_DISPOSISI,
            'id_skpd' => json_encode($mergedSkpdIds), 
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permohonan berhasil didisposisikan ke SKPD yang dipilih.',
            'data' => $permohonan->load('disposisi.skpd')
        ], 200);
    }

    /**
     * Store SKPD response to disposition
     */
    public function responStore(Request $request, string $disposisiId): JsonResponse
    {
        $disposisi = PermohonanDisposisi::findOrFail($disposisiId);
        $user = Auth::user();

        if (!$user->hasRole('admin') && $user->id_skpd !== $disposisi->id_skpd) {
            return response()->json(['success' => false, 'message' => 'Forbidden access.'], 403);
        }

        $validated = $request->validate([
            'respon' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120',
            'status' => 'required|in:diproses,selesai,ditolak',
        ]);

        $filePath = $request->hasFile('file') ? $request->file('file')->store('respon-disposisi', 'public') : null;

        PermohonanRespon::create([
            'id_disposisi' => $disposisi->id_disposisi,
            'respon' => $validated['respon'],
            'file' => $filePath,
            'responded_by' => Auth::id(),
            'responded_at' => now(),
        ]);

        $disposisi->update(['status' => $validated['status']]);

        $permohonan = $disposisi->permohonan;
        $allCompleted = $permohonan->disposisi()->whereIn('status', ['selesai', 'ditolak'])->count() === $permohonan->disposisi()->count();
        
        if ($allCompleted) {
            $permohonan->update(['status' => PermohonanInformasi::STATUS_SELESAI]);
        }

        Notification::send([
            'to_user_id' => $disposisi->disposisi_by,
            'type' => 'success',
            'title' => 'Respon Disposisi Diterima',
            'message' => 'SKPD ' . $disposisi->skpd->nm_skpd . ' telah memberikan respon.',
            'url' => env('FRONTEND_URL') . '/admin/permohonan-informasi/' . $permohonan->id_permohonan,
            'notifiable_type' => 'App\\Models\\PermohonanInformasi',
            'notifiable_id' => $permohonan->id_permohonan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Respon berhasil dikirim!',
            'data' => $permohonan->load('disposisi.respon')
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $permohonan = PermohonanInformasi::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|integer',
            'alasan' => 'nullable|string|required_if:status,' . PermohonanInformasi::STATUS_TOLAK,
            'jawaban' => 'nullable|string',
            'id_skpd' => 'nullable|exists:ms_skpd,id_skpd',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
        ]);

        $data = ['status' => $validated['status']];

        if ($validated['status'] == PermohonanInformasi::STATUS_PROSES && $request->has('jawaban')) {
            $data['jawaban'] = $validated['jawaban'];
            $data['responded_by'] = 'Admin';
        }

        if ($validated['status'] == PermohonanInformasi::STATUS_DISPOSISI) {
            $data['id_skpd'] = $validated['id_skpd'];
            $data['responded_by'] = 'OPD';
        }

        if ($validated['status'] == PermohonanInformasi::STATUS_TOLAK) {
            $data['alasan'] = $validated['alasan'];
        }

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('permohonan/hasil/' . date('Y/m'), 'public');
        }

        $permohonan->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Status permohonan berhasil diperbarui.',
            'data' => $permohonan
        ], 200);
    }

    /**
     * Menghapus permohonan informasi (hanya status tertentu).
     */
    public function destroy(string $id): JsonResponse
    {
        /** @var PermohonanInformasi $permohonan */ // Menambahkan type hinting
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