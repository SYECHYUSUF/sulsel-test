<?php

namespace App\Http\Controllers;

use App\Models\Sop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SopController extends Controller
{
    /**
     * Menampilkan daftar SOP.
     */
    public function index(Request $request)
    {
        $query = Sop::query();

        // 1. Logika Pencarian
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // 2. Pagination & Sorting
        $sop = $query->latest()->paginate(10);

        // 3. Respon JSON untuk Alpine.js (Jika diminta)
        if ($request->expectsJson()) {
            return response()->json($sop);
        }

        return view('admin.data-sop.index', compact('sop'));
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
    public function show(Sop $sop)
    {
        return view('admin.data-sop.show', compact('sop'));
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
