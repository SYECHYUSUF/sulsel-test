<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermohonanInformasi;
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
        $query = PermohonanInformasi::with('skpd');

        // Guard Berdasarkan Role (Dihapus karena sekarang khusus Admin)
        // if ($user->hasRole('opd')) {
        //     $query->where('id_skpd', $user->id_skpd);
        // }

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
        $permohonan = PermohonanInformasi::with('skpd')->findOrFail($id);
        $user = Auth::user();

        // Security Check (Removed for Admin)
        // if ($user->hasRole('opd') && $permohonan->id_skpd !== $user->id_skpd) {
        //     abort(403);
        // }

        return view('admin.permohonan-informasi.show', compact('permohonan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Not used, using show for actions
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
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240', // 10MB
        ]);

        $data = [
            'status' => $validated['status']
        ];

        // Handle Rejection
        if ($validated['status'] == PermohonanInformasi::STATUS_TOLAK) {
            $data['alasan'] = $validated['alasan'];
        }

        // Handle File Upload for Completion
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('permohonan/hasil/' . date('Y/m'), 'public');
            $data['file'] = $path;
        }

        // Handle "Verifikasi" (Admin only) - 0 -> 1
        // Usually verified means it's accepted by admin and ready for OPD
        if ($permohonan->status == PermohonanInformasi::STATUS_PENDING && $validated['status'] == PermohonanInformasi::STATUS_PROSES) {
            // Logic if needed (e.g. notify OPD)
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
