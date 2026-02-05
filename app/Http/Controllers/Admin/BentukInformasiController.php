<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BentukInformasiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        \App\Models\BentukInformasi::create($validated);

        return redirect()->route('admin.master-data.index', ['tab' => 'bentuk_informasi'])
            ->with('success', 'Bentuk Informasi berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\Illuminate\Http\Request $request, string $id)
    {
        $bentukInformasi = \App\Models\BentukInformasi::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        $bentukInformasi->update($validated);

        return redirect()->route('admin.master-data.index', ['tab' => 'bentuk_informasi'])
            ->with('success', 'Bentuk Informasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bentukInformasi = \App\Models\BentukInformasi::findOrFail($id);
        $bentukInformasi->delete();

        return redirect()->route('admin.master-data.index', ['tab' => 'bentuk_informasi'])
            ->with('success', 'Bentuk Informasi berhasil dihapus.');
    }
}
