<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermohonanInformasi;
use App\Models\PermohonanDisposisi;
use App\Models\PermohonanRespon;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PermohonanInformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $query = PermohonanInformasi::query();

        if ($user->hasRole('opd') && $user->id_skpd) {
            $query->whereHas('disposisi', function ($q) use ($user) {
                $q->where('id_skpd', $user->id_skpd);
            });
        }

        $query->with(['skpd', 'disposisi.skpd']);

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm)
                    ->orWhere('no_hp', 'like', $searchTerm);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $permohonan = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $permohonan
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $permohonan = PermohonanInformasi::with(['skpd', 'disposisi.skpd', 'disposisi.respon'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $permohonan
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
            
            if ($exists) {
                continue;
            }

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
                'url' => route('admin.permohonan-informasi.show', $id),
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
            'message' => 'Permohonan berhasil didisposisikan ke SKPD yang dipilih.'
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

        PermohonanRespon::create([
            'id_disposisi' => $disposisi->id_disposisi,
            'respon' => $validated['respon'],
            'file' => $filePath,
            'responded_by' => Auth::id(),
            'responded_at' => now(),
        ]);

        $disposisi->update([
            'status' => $validated['status'],
        ]);

        $permohonan = $disposisi->permohonan;
        $allCompleted = $permohonan->disposisi()->whereIn('status', ['selesai', 'ditolak'])->count() === $permohonan->disposisi()->count();
        
        if ($allCompleted) {
            $permohonan->update(['status' => PermohonanInformasi::STATUS_SELESAI]);
        }

        Notification::send([
            'to_user_id' => $disposisi->disposisi_by,
            'type' => 'success',
            'title' => 'Respon Disposisi Diterima',
            'message' => 'SKPD ' . $disposisi->skpd->nm_skpd . ' telah memberikan respon untuk permohonan dari ' . $permohonan->nama,
            'url' => route('admin.permohonan-informasi.show', $permohonan->id_permohonan),
            'notifiable_type' => 'App\\Models\\PermohonanInformasi',
            'notifiable_id' => $permohonan->id_permohonan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Respon berhasil dikirim!'
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
            $path = $request->file('file')->store('permohonan/hasil/' . date('Y/m'), 'public');
            $data['file'] = $path;
        }

        $permohonan->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Status permohonan berhasil diperbarui.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $permohonan = PermohonanInformasi::findOrFail($id);
        
        if (in_array($permohonan->status, [
            PermohonanInformasi::STATUS_SELESAI,
            PermohonanInformasi::STATUS_TOLAK,
            PermohonanInformasi::STATUS_BATAL
        ])) {
            if ($permohonan->file) {
                Storage::disk('public')->delete($permohonan->file);
            }
            if ($permohonan->foto_ktp) {
                Storage::disk('public')->delete($permohonan->foto_ktp);
            }
            
            $permohonan->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Permohonan berhasil dihapus.'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Menghapus permohonan yang sedang berjalan tidak diizinkan.'
        ], 403);
    }
}