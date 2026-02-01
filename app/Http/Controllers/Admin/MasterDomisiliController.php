<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterDomisili;
use Illuminate\Http\Request;

class MasterDomisiliController extends Controller
{
    public function index()
    {
        $data = MasterDomisili::orderBy('nama_daerah')->get();
        return view('admin.master-domisili.index', compact('data'));
    }

    public function create()
    {
        return view('admin.master-domisili.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_daerah' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        MasterDomisili::create($validated);

        return redirect()->route('master-domisili.index')
            ->with('success', 'Data domisili berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = MasterDomisili::findOrFail($id);
        return view('admin.master-domisili.form', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = MasterDomisili::findOrFail($id);

        $validated = $request->validate([
            'nama_daerah' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $item->update($validated);

        return redirect()->route('master-domisili.index')
            ->with('success', 'Data domisili berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = MasterDomisili::findOrFail($id);
        $item->delete();

        return redirect()->route('master-domisili.index')
            ->with('success', 'Data domisili berhasil dihapus.');
    }
}
