<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skpd;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SkpdVisiMisiController extends Controller
{
    /**
     * Mengambil data Visi Misi saja.
     */
    public function show(string $id): JsonResponse
    {
        $skpd = Skpd::select('id_skpd', 'nm_skpd', 'visimisi')->find($id);

        if (!$skpd) {
            return response()->json([
                'success' => false,
                'message' => 'Data SKPD tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Visi Misi berhasil dimuat',
            'data' => $skpd
        ], 200);
    }

    /**
     * Memperbarui data Visi Misi saja.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        /** @var Skpd $skpd */ // Menambahkan type hinting
        $skpd = Skpd::find($id);

        if (!$skpd) {
            return response()->json([
                'success' => false,
                'message' => 'Data SKPD tidak ditemukan'
            ], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'visimisi' => $request->hasFile('visimisi') ? 'file|mimes:pdf|max:5120' : 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = [];

        if ($request->hasFile('visimisi')) {
            $fileVisimisi = $request->file('visimisi');

            // Hapus file lama jika ada (hanya jika sebelumnya juga berupa file)
            if ($skpd->visimisi && str_ends_with(strtolower($skpd->visimisi), '.pdf')) {
                if (Storage::disk('public')->exists('visimisi-skpd/' . $skpd->visimisi)) {
                    Storage::disk('public')->delete('visimisi-skpd/' . $skpd->visimisi);
                }
            }

            $fileVisimisi->store('visimisi-skpd', 'public');
            $data['visimisi'] = $fileVisimisi->hashName();
        } else if ($request->has('visimisi')) {
            // Hapus file fisik lama jika user beralih dari PDF ke Teks
            if ($skpd->visimisi && str_ends_with(strtolower($skpd->visimisi), '.pdf')) {
                if (Storage::disk('public')->exists('visimisi-skpd/' . $skpd->visimisi)) {
                    Storage::disk('public')->delete('visimisi-skpd/' . $skpd->visimisi);
                }
            }

            $data['visimisi'] = $request->visimisi;
        }

        if (count($data) > 0) {
            $skpd->update($data);
        }

        return response()->json([
            'success' => true,
            'message' => 'Visi Misi berhasil diperbarui',
            'data' => $skpd->only(['id_skpd', 'nm_skpd', 'visimisi'])
        ], 200);
    }
}