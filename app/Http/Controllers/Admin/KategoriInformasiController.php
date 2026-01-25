<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriInformasi;
use Illuminate\Http\Request;

class KategoriInformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = KategoriInformasi::query();

        if ($request->filled('search')) {
            $query->where('nm_kat_info', 'like', '%' . $request->search . '%');
        }

        $kategoris = $query->paginate(10);

        return view('admin.kategori-informasi.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori-informasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nm_kat_info' => 'required|string|max:255',
            'icon' => 'required|string|max:10',
            'is_active' => 'required|boolean',
        ]);

        KategoriInformasi::create($validated);

        return redirect()->route('admin.kategori-informasi.index')
            ->with('success', 'Kategori Informasi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = KategoriInformasi::findOrFail($id);
        return view('admin.kategori-informasi.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = KategoriInformasi::findOrFail($id);

        $validated = $request->validate([
            'nm_kat_info' => 'required|string|max:255',
            'icon' => 'required|string|max:10',
            'is_active' => 'required|boolean',
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.kategori-informasi.index')
            ->with('success', 'Kategori Informasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = KategoriInformasi::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategori-informasi.index')
            ->with('success', 'Kategori Informasi berhasil dihapus.');
    }
}
