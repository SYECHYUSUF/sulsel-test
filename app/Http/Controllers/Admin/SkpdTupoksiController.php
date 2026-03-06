<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skpd;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SkpdTupoksiController extends Controller
{
    /**
     * Mengambil data Tupoksi saja.
     */
    public function show(string $id): JsonResponse
    {
        $skpd = Skpd::select('id_skpd', 'nm_skpd', 'tupoksi')->find($id);

        if (!$skpd) {
            return response()->json([
                'success' => false,
                'message' => 'Data SKPD tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Tupoksi berhasil dimuat',
            'data' => $skpd
        ], 200);
    }

    /**
     * Memperbarui data Tupoksi saja.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        /** @var Skpd $skpd */
        $skpd = Skpd::find($id);

        if (!$skpd) {
            return response()->json([
                'success' => false,
                'message' => 'Data SKPD tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'tupoksi' => $request->hasFile('tupoksi') ? 'file|mimes:pdf|max:5120' : 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = [];

        if ($request->hasFile('tupoksi')) {
            $fileTupoksi = $request->file('tupoksi');

            // Hapus file lama jika ada
            if ($skpd->tupoksi && str_ends_with(strtolower($skpd->tupoksi), '.pdf')) {
                if (Storage::disk('public')->exists('tupoksi-skpd/' . $skpd->tupoksi)) {
                    Storage::disk('public')->delete('tupoksi-skpd/' . $skpd->tupoksi);
                }
            }

            $fileTupoksi->store('tupoksi-skpd', 'public');
            $data['tupoksi'] = $fileTupoksi->hashName();
        } else if ($request->has('tupoksi')) {
            // Hapus file lama jika user beralih ke Teks
            if ($skpd->tupoksi && str_ends_with(strtolower($skpd->tupoksi), '.pdf')) {
                if (Storage::disk('public')->exists('tupoksi-skpd/' . $skpd->tupoksi)) {
                    Storage::disk('public')->delete('tupoksi-skpd/' . $skpd->tupoksi);
                }
            }

            $data['tupoksi'] = $request->tupoksi;
        }

        if (count($data) > 0) {
            $skpd->update($data);
        }

        return response()->json([
            'success' => true,
            'message' => 'Tupoksi berhasil diperbarui',
            'data' => $skpd->only(['id_skpd', 'nm_skpd', 'tupoksi'])
        ], 200);
    }
}
