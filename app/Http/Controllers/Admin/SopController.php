<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sop;
use Illuminate\Http\Request;

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
        return view('admin.data-sop.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only('judul');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('sop', $filename, 'public');
            $data['file'] = $filename;
        }

        Sop::create($data);

        return redirect()->route('admin.data-sop.index')->with('success', 'SOP berhasil ditambahkan.');
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
    public function edit(Sop $data_sop)
    {
        $sop = $data_sop;
        return view('admin.data-sop.edit', compact('sop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sop $data_sop)
    {
        $sop = $data_sop;
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only('judul');

        if ($request->hasFile('file')) {
            // Delete old file
            if ($sop->file && \Storage::disk('public')->exists('sop/' . $sop->file)) {
                \Storage::disk('public')->delete('sop/' . $sop->file);
            }

            $file = $request->file('file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('sop', $filename, 'public');
            $data['file'] = $filename;
        }

        $sop->update($data);

        return redirect()->route('admin.data-sop.index')->with('success', 'SOP berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sop $data_sop)
    {
        $sop = $data_sop;
        // Delete file
        if ($sop->file && \Storage::disk('public')->exists('sop/' . $sop->file)) {
            \Storage::disk('public')->delete('sop/' . $sop->file);
        }

        $sop->delete();

        return redirect()->route('admin.data-sop.index')->with('success', 'SOP berhasil dihapus.');
    }
}
