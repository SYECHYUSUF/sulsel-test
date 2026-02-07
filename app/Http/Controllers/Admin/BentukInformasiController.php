<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BentukInformasi;
use Illuminate\Http\Request;

class BentukInformasiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        BentukInformasi::create($validated);
  
        return response()->json([
            'success' => true,
            'message' => 'Bentuk Informasi berhasil ditambahkan.',
            'data' => $validated
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bentukInformasi = BentukInformasi::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
        ]);

        $bentukInformasi->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Bentuk Informasi berhasil diperbarui.',
            'data' => $validated
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bentukInformasi = BentukInformasi::findOrFail($id);
        $bentukInformasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bentuk Informasi berhasil dihapus.',
        ], 200);
    }
}
