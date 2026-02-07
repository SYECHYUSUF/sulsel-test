<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return response()->json([
            'success' => true,
            'data'    => $settings
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'struktur_organisasi' => 'nullable|mimes:pdf|max:5120', // Max 5MB
        ]);

        $data = null;

        if ($request->hasFile('struktur_organisasi')) {
            // Hapus file lama jika ada untuk menghemat ruang
            $oldPath = Setting::where('key', 'struktur_organisasi_path')->value('value');
            if ($oldPath) {
                $relativeOldPath = str_replace('storage/', '', $oldPath);
                if (Storage::disk('public')->exists($relativeOldPath)) {
                    Storage::disk('public')->delete($relativeOldPath);
                }
            }

            $file = $request->file('struktur_organisasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('struktur_organisasi', $filename, 'public');

            $data = Setting::updateOrCreate(
                ['key' => 'struktur_organisasi_path'],
                ['value' => 'storage/' . $path]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Struktur Organisasi berhasil diperbarui.',
            'data'    => $data
        ], 200);
    }
}