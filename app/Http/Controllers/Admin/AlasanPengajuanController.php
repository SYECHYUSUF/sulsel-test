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

        return response()->json([
            'success' => true,
            'message' => 'Alasan pengajuan berhasil dimuat',
            'data' => $alasanPengajuans
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alasan' => 'required|string|max:255',
        ]);

        AlasanPengajuan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Alasan pengajuan berhasil ditambahkan.',
            'data' => $validated
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $alasan = AlasanPengajuan::findOrFail($id);

        $validated = $request->validate([
            'alasan' => 'required|string|max:255',
        ]);

        $alasan->update($validated);

        return redirect()->route('admin.master-data.index', ['tab' => 'alasan'])
            ->with('success', 'Alasan pengajuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $alasan = AlasanPengajuan::findOrFail($id);
        $alasan->delete();

        return redirect()->route('admin.master-data.index', ['tab' => 'alasan'])
            ->with('success', 'Alasan pengajuan berhasil dihapus.');
    }
}
