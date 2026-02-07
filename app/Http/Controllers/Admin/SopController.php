<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sop;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class SopController extends Controller
{
    /**
     * Menampilkan daftar SOP.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Sop::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $sop = $query->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $sop
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $file->storeAs('sop', $filename, 'public');
            $validated['file'] = $filename;
        }

        $sop = Sop::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'SOP berhasil ditambahkan.',
            'data'    => $sop
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sop $sop): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $sop
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sop $sop): JsonResponse
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('file')) {
            if ($sop->file && Storage::disk('public')->exists('sop/' . $sop->file)) {
                Storage::disk('public')->delete('sop/' . $sop->file);
            }

            $file = $request->file('file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
            $file->storeAs('sop', $filename, 'public');
            $validated['file'] = $filename;
        }

        $sop->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'SOP berhasil diperbarui.',
            'data'    => $sop
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sop $sop): JsonResponse
    {
        if ($sop->file && Storage::disk('public')->exists('sop/' . $sop->file)) {
            Storage::disk('public')->delete('sop/' . $sop->file);
        }

        $sop->delete();

        return response()->json([
            'success' => true,
            'message' => 'SOP berhasil dihapus.',
            'data'    => null
        ], 200);
    }
}