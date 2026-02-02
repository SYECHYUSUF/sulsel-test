<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlasanPengajuan;
use Illuminate\Http\Request;

class AlasanPengajuanController extends Controller
{
    public function index()
    {
        $alasanPengajuans = AlasanPengajuan::orderBy('alasan')->get();
        return view('admin.alasan-pengajuan.index', compact('alasanPengajuans'));
    }

    public function create()
    {
        return view('admin.alasan-pengajuan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alasan' => 'required|string|max:255',
        ]);

        AlasanPengajuan::create($validated);

        return back()->with('success', 'Alasan pengajuan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $alasan = AlasanPengajuan::findOrFail($id);
        return view('admin.alasan-pengajuan.edit', compact('alasan'));
    }

    public function update(Request $request, $id)
    {
        $alasan = AlasanPengajuan::findOrFail($id);

        $validated = $request->validate([
            'alasan' => 'required|string|max:255',
        ]);

        $alasan->update($validated);

        return back()->with('success', 'Alasan pengajuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $alasan = AlasanPengajuan::findOrFail($id);
        $alasan->delete();

        return back()->with('success', 'Alasan pengajuan berhasil dihapus.');
    }
}
