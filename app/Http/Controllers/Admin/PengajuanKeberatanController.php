<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanKeberatan;
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
        $query = PengajuanKeberatan::with(['skpd']);

        // Filter Berdasarkan Role
        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }

        // Filter Pencarian
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_pemohon', 'like', $searchTerm)
                ->orWhere('kode_permohonan', 'like', $searchTerm)
                ->orWhere('alasan_keberatan', 'like', $searchTerm);
            });
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
            'status' => 'a' // Set status to 'Approved'/'Answered' 
        ]);

        return back()->with('success', 'Feedback berhasil dikirim.');
    }
    
    public function loadFeedback($id)
    {
        $pengajuan = PengajuanKeberatan::with(['feedbackBy', 'alasanPengajuan'])->findOrFail($id);
        
        return response()->json([
            'no_pendaftaran' => $pengajuan->no_pendaftaran,
            'nama_pemohon' => $pengajuan->nama_pemohon,
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
