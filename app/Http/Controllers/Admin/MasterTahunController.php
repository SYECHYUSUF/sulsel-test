<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterTahun;
use Illuminate\Http\Request;

class MasterTahunController extends Controller
{
    public function index()
    {
        $data = MasterTahun::orderBy('waktu')->get();
        return view('admin.master-tahun.index', compact('data'));
    }

    public function create()
    {
        return view('admin.master-tahun.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'waktu' => 'required|string|max:255',
        ]);

        MasterTahun::create($validated);

        return back()->with('success', 'Data tahun berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = MasterTahun::findOrFail($id);
        return view('admin.master-tahun.form', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = MasterTahun::findOrFail($id);

        $validated = $request->validate([
            'waktu' => 'required|string|max:255',
        ]);

        $item->update($validated);

        return back()->with('success', 'Data tahun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = MasterTahun::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Data tahun berhasil dihapus.');
    }
}
