<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermohonanInformasi;
use App\Models\PermohonanDisposisi;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermohonanInformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = PermohonanInformasi::query();

        // Filter for OPD users: only show requests dispositioned to their SKPD
        if ($user->hasRole('opd') && $user->id_skpd) {
            $query->whereHas('disposisi', function ($q) use ($user) {
                $q->where('id_skpd', $user->id_skpd);
            });
        }

        // Always load relationships
        $query->with(['skpd', 'disposisi.skpd']);

        // Filter Pencarian
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm)
                    ->orWhere('no_hp', 'like', $searchTerm);
            });
        }

        // Pagination & Sorting
        $permohonan = $query->latest()->paginate(10);

        // Handle JSON Request (Untuk Alpine.js)
        if ($request->expectsJson()) {
            return response()->json($permohonan);
        }

        return view('admin.permohonan-informasi.index', compact('permohonan'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permohonan = PermohonanInformasi::with(['skpd', 'disposisi.skpd', 'disposisi.respon'])->findOrFail($id);
        $user = Auth::user();

        // Security Check (Removed for Admin)
        // if ($user->hasRole('opd') && $permohonan->id_skpd !== $user->id_skpd) {
        //     abort(403);
        // }

        $allSkpd = \App\Models\Skpd::all(); // Fetch all SKPDs for Disposisi

        return view('admin.permohonan-informasi.show', compact('permohonan', 'allSkpd'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Not used, using show for actions
    }

    /**
     * Show disposisi form to select multiple SKPDs.
     */
    public function disposisiForm(string $id)
    {
        $permohonan = PermohonanInformasi::with('skpd')->findOrFail($id);
        $allSkpd = \App\Models\Skpd::all();
        
        // Get existing disposition SKPD IDs
        $existingSkpdIds = $permohonan->disposisi()->pluck('id_skpd')->toArray();

        return view('admin.permohonan-informasi.disposisi', compact('permohonan', 'allSkpd', 'existingSkpdIds'));
    }

    /**
     * Process disposisi to multiple SKPDs.
     */
    public function disposisiStore(Request $request, string $id)
    {
        $permohonan = PermohonanInformasi::findOrFail($id);
        
        $validated = $request->validate([
            'skpd_ids' => 'required|array|min:1',
            'skpd_ids.*' => 'exists:tbl_skpd,id_skpd',
            'catatan' => 'nullable|string',
        ]);

        // Create disposisi record for each SKPD
        foreach ($validated['skpd_ids'] as $skpdId) {
            // Prevent duplicate disposition
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

            // Send notification to SKPD
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

        // Merge new SKPD IDs with existing ones for 'id_skpd' column
        $currentSkpdIds = [];
        if ($permohonan->id_skpd) {
            $decoded = json_decode($permohonan->id_skpd, true);
            if (is_array($decoded)) {
                $currentSkpdIds = $decoded;
            } elseif (is_string($permohonan->id_skpd)) {
                // Handle case where it might be a single string ID (legacy)
                $currentSkpdIds = [$permohonan->id_skpd];
            }
        }
        
        $mergedSkpdIds = array_values(array_unique(array_merge($currentSkpdIds, $validated['skpd_ids'])));

        // Update permohonan status
        $permohonan->update([
            'status' => PermohonanInformasi::STATUS_DISPOSISI,
            'id_skpd' => json_encode($mergedSkpdIds), 
        ]);

        return redirect()->route('admin.permohonan-informasi.show', $id)
            ->with('success', 'Permohonan berhasil didisposisikan ke SKPD yang dipilih.');
    }

    /**
     * Store SKPD response to disposition
     */
    public function responStore(Request $request, string $disposisiId)
    {
        $disposisi = PermohonanDisposisi::findOrFail($disposisiId);
        
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
        \App\Models\PermohonanRespon::create([
            'id_disposisi' => $disposisi->id_disposisi,
            'respon' => $validated['respon'],
            'file' => $filePath,
            'responded_by' => Auth::id(),
            'responded_at' => now(),
        ]);

        // Update disposition status
        $disposisi->update([
            'status' => $validated['status'],
        ]);

        // Update main permohonan status if all dispositions are completed
        $permohonan = $disposisi->permohonan;
        $allCompleted = $permohonan->disposisi()->whereIn('status', ['selesai', 'ditolak'])->count() === $permohonan->disposisi()->count();
        
        if ($allCompleted) {
            $permohonan->update(['status' => PermohonanInformasi::STATUS_SELESAI]);
        }

        // Send notification to admin
        Notification::send([
            'to_user_id' => $disposisi->disposisi_by, // Admin who created disposition
            'type' => 'success',
            'title' => 'Respon Disposisi Diterima',
            'message' => 'SKPD ' . $disposisi->skpd->nm_skpd . ' telah memberikan respon untuk permohonan dari ' . $permohonan->nama,
            'url' => route('admin.permohonan-informasi.show', $permohonan->id_permohonan),
            'notifiable_type' => 'App\\Models\\PermohonanInformasi',
            'notifiable_id' => $permohonan->id_permohonan,
        ]);

        return redirect()->route('admin.permohonan-informasi.show', $permohonan->id_permohonan)
            ->with('success', 'Respon berhasil dikirim!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permohonan = PermohonanInformasi::findOrFail($id);
        $user = Auth::user();

        // Security Check (Removed for Admin)
        // if ($user->hasRole('opd') && $permohonan->id_skpd !== $user->id_skpd) {
        //     abort(403);
        // }

        $validated = $request->validate([
            'status' => 'required|integer',
            'alasan' => 'nullable|string|required_if:status,' . PermohonanInformasi::STATUS_TOLAK,
            'jawaban' => 'nullable|string', // For Admin Answer
            'id_skpd' => 'nullable|exists:ms_skpd,id_skpd', // For Disposisi
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240', // 10MB
        ]);

        $data = [
            'status' => $validated['status']
        ];

        // 1. Handle "Jawab" (Admin Menjawab) -> Status PROSES
        if ($validated['status'] == PermohonanInformasi::STATUS_PROSES && $request->has('jawaban')) {
            $data['jawaban'] = $validated['jawaban'];
            $data['responded_by'] = 'Admin';
        }

        // 2. Handle "Disposisi" -> Status DISPOSISI
        if ($validated['status'] == PermohonanInformasi::STATUS_DISPOSISI) {
            $data['id_skpd'] = $validated['id_skpd'];
            $data['responded_by'] = 'OPD';
        }

        // 3. Handle "Tolak"
        if ($validated['status'] == PermohonanInformasi::STATUS_TOLAK) {
            $data['alasan'] = $validated['alasan'];
        }

        // 4. Handle File Upload (Completion)
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('permohonan/hasil/' . date('Y/m'), 'public');
            $data['file'] = $path;
        }

        $permohonan->update($data);

        return redirect()->route('admin.permohonan-informasi.show', $id)
            ->with('success', 'Status permohonan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permohonan = PermohonanInformasi::findOrFail($id);
        
        // Allowed statuses to delete: SELESAI (2), TOLAK (3), BATAL (4)
        if (in_array($permohonan->status, [
            PermohonanInformasi::STATUS_SELESAI,
            PermohonanInformasi::STATUS_TOLAK,
            PermohonanInformasi::STATUS_BATAL
        ])) {
            // Delete file if exists
            if ($permohonan->file) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($permohonan->file);
            }
            if ($permohonan->foto_ktp) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($permohonan->foto_ktp);
            }
            
            $permohonan->delete();
            
            return redirect()->route('admin.permohonan-informasi.index')
                ->with('success', 'Permohonan berhasil dihapus.');
        }

        abort(403, 'Menghapus permohonan yang sedang berjalan tidak diizinkan.');
    }
}
