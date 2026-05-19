<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StrukturOrganisasiController extends Controller
{
    /**
     * Menampilkan path file struktur organisasi yang tersimpan di setting.
     */
    public function index(): JsonResponse
    {
        $path = Setting::where('key', 'struktur_organisasi_path')->value('value');

        return response()->json([
            'success' => true,
            'data'    => [
                'struktur_organisasi_path' => $path
            ]
        ], 200);
    }

    /**
     * Mengunggah dan memperbarui file struktur organisasi (PDF).
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'struktur_organisasi' => 'required|file|mimes:pdf|max:5120', // Max 5MB
        ], [
            'struktur_organisasi.required' => 'File struktur organisasi wajib diunggah.',
            'struktur_organisasi.file'     => 'Input harus berupa file yang valid.',
            'struktur_organisasi.mimes'    => 'Format file harus PDF.',
            'struktur_organisasi.max'      => 'Ukuran file maksimal 5MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('struktur_organisasi')) {
            // Hapus file lama jika ada
            $oldPathValue = Setting::where('key', 'struktur_organisasi_path')->value('value');
            if ($oldPathValue) {
                $relativeOldPath = str_replace('storage/', '', $oldPathValue);
                if (Storage::disk('public')->exists($relativeOldPath)) {
                    Storage::disk('public')->delete($relativeOldPath);
                }
            }

            $file = $request->file('struktur_organisasi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('struktur_organisasi', $filename, 'public');

            $setting = Setting::updateOrCreate(
                ['key' => 'struktur_organisasi_path'],
                ['value' => 'storage/' . $path]
            );

            return response()->json([
                'success' => true,
                'message' => 'Struktur Organisasi berhasil diperbarui.',
                'data'    => $setting
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tidak ada file yang diunggah atau ukuran file melebihi limit PHP.'
        ], 400);
    }
}