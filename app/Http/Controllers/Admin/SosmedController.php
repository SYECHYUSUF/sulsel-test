<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sosmed;
use Illuminate\Http\Request;

class SosmedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sosmeds = Sosmed::orderBy('urutan')->get();
        return view('admin.sosmed.index', compact('sosmeds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $predefinedIcons = Sosmed::getPredefinedIcons();
        return view('admin.sosmed.create', compact('predefinedIcons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sosmed' => 'required|string|max:100|unique:tbl_sosmed,sosmed',
            'link_sosmed' => 'required|url',
            'icon_sosmed' => 'required|string',
            'urutan' => 'nullable|integer',
            'judul' => 'nullable|string|max:100',
        ]);

        // Auto-increment logic for id_sosmed if not handled by DB
        $id = Sosmed::max('id_sosmed') + 1;

        Sosmed::create([
            'id_sosmed' => $id,
            'sosmed' => $request->sosmed,
            'link_sosmed' => $request->link_sosmed,
            'icon_sosmed' => $request->icon_sosmed,
            'urutan' => $request->urutan ?? $id,
            'judul' => $request->judul ?? $request->sosmed,
        ]);

        return redirect()->route('admin.social-links.index')->with('success', 'Media Sosial berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sosmed = Sosmed::findOrFail($id);
        $predefinedIcons = Sosmed::getPredefinedIcons();
        return view('admin.sosmed.edit', compact('sosmed', 'predefinedIcons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'sosmed' => 'required|string|max:100|unique:tbl_sosmed,sosmed,' . $id . ',id_sosmed',
            'link_sosmed' => 'required|url',
            'icon_sosmed' => 'required|string',
            'urutan' => 'nullable|integer',
            'judul' => 'nullable|string|max:100',
        ]);

        $sosmed = Sosmed::findOrFail($id);
        $sosmed->update([
            'sosmed' => $request->sosmed,
            'link_sosmed' => $request->link_sosmed,
            'icon_sosmed' => $request->icon_sosmed,
            'urutan' => $request->urutan ?? $sosmed->urutan,
            'judul' => $request->judul ?? $request->sosmed,
        ]);

        return redirect()->route('admin.social-links.index')->with('success', 'Media Sosial berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sosmed = Sosmed::findOrFail($id);
        $sosmed->delete();

        return redirect()->route('admin.social-links.index')->with('success', 'Media Sosial berhasil dihapus.');
    }
}
