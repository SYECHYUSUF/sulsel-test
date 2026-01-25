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

        // 1. Guard Berdasarkan Role
        // Jika user adalah OPD, hanya tampilkan permohonan yang ditujukan ke SKPD mereka
        if ($user->hasRole('opd')) {
            $query->where('id_skpd', $user->id_skpd);
        }

        // 2. Filter Pencarian
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', $searchTerm)
                ->orWhere('email', 'like', $searchTerm)
                ->orWhere('no_hp', 'like', $searchTerm);
            });
        }

        // 3. Pagination & Sorting
        $permohonan = $query->latest()->paginate(10);

        // 4. Handle JSON Request (Untuk Alpine.js)
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
