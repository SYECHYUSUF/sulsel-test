<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterPekerjaan;
use Illuminate\Http\Request;

class MasterPekerjaanController extends Controller
{
    public function index()
    {
        $data = MasterPekerjaan::orderBy('nama_pekerjaan')->get();
        return view('admin.master-pekerjaan.index', compact('data'));
    }

    public function create()
    {
        return view('admin.master-pekerjaan.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pekerjaan' => 'required|string|max:255|unique:master_pekerjaan,nama_pekerjaan',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        MasterPekerjaan::create($validated);

        return redirect()->route('admin.master-pekerjaan.index')
            ->with('success', 'Data pekerjaan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = MasterPekerjaan::findOrFail($id);
        return view('admin.master-pekerjaan.form', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = MasterPekerjaan::findOrFail($id);

        $validated = $request->validate([
            'nama_pekerjaan' => 'required|string|max:255|unique:master_pekerjaan,nama_pekerjaan,' . $id,
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $item->update($validated);

        return redirect()->route('admin.master-pekerjaan.index')
            ->with('success', 'Data pekerjaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = MasterPekerjaan::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.master-pekerjaan.index')
            ->with('success', 'Data pekerjaan berhasil dihapus.');
    }
}
