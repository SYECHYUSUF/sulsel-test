<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ikphn;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IkphnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Ikphn::query();

        // Search
        if ($request->filled('search')) {
            $query->where('nama_jabatan', 'like', '%' . $request->search . '%');
        }

        // Filter Date
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Sort
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->oldest();
                    break;
                case 'title_asc':
                    $query->orderBy('nama_jabatan', 'asc');
                    break;
                case 'title_desc':
                    $query->orderBy('nama_jabatan', 'desc');
                    break;
                case 'newest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $ikphns = $query->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $ikphns
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
        ]);

        $data = $request->all();
        $data['jumlah_download'] = 0;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('ikphn', 'public');
            $data['file'] = $path;
        }

        Ikphn::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data Informasi Pengadaan berhasil ditambahkan.',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ikphn = Ikphn::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $ikphn
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Ikphn::findOrFail($id);

        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
        ]);

        $data = $request->except('file');

        if ($request->hasFile('file')) {
            if ($item->file && Storage::disk('public')->exists($item->file)) {
                Storage::disk('public')->delete($item->file);
            }

            $file = $request->file('file');
            $path = $file->store('ikphn', 'public');
            $data['file'] = $path;
        }

        $item->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data Informasi Pengadaan berhasil diperbarui.',
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Ikphn::findOrFail($id);

        if ($item->file && Storage::disk('public')->exists($item->file)) {
            Storage::disk('public')->delete($item->file);
        }

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.',
        ], 200);
    }
}
