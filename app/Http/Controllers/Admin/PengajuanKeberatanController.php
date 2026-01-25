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
    public function store(Request $request)
    {
        //
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
