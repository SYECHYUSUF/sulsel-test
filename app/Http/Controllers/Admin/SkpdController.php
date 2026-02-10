<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skpd;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SkpdController extends Controller
{
    /**
     * Menampilkan daftar seluruh SKPD.
     */
    public function index(): JsonResponse
    {
        $skpd = Skpd::all();

        return response()->json([
            'success' => true,
            'data'    => $skpd
        ], 200);
    }

    /**
     * Menampilkan detail satu data SKPD berdasarkan ID.
     */
    public function show(string $id): JsonResponse
    {
        $skpd = Skpd::find($id);

        if (!$skpd) {
            return response()->json([
                'success' => false,
                'message' => 'SKPD tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Data SKPD',
            'data'    => $skpd
        ], 200);
    }

    /**
     * Menyimpan data SKPD baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nm_skpd'   => 'required|string|max:255',
            'alamat'    => 'nullable|string',
            'email'     => 'nullable|email|max:150',
            'no_tlp'    => 'nullable|string|max:20',
            'website'   => 'nullable|url|max:255',
            'kadis'     => 'nullable|string|max:200',
            'sek'       => 'nullable|string|max:200',
            'visimisi'  => 'nullable|string',
            'tupoksi'   => 'nullable|string',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jenis'     => 'nullable|in:opd,kab',
            'is_active' => 'required|in:1,0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logo-skpd', 'public');
        }

        $skpd = Skpd::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data SKPD berhasil ditambahkan',
            'data'    => $skpd
        ], 201);
    }

    /**
     * Memperbarui data SKPD yang ada.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        /** @var Skpd $skpd */ // Menambahkan type hinting
        $skpd = Skpd::find($id);

        if (!$skpd) {
            return response()->json(['success' => false, 'message' => 'SKPD tidak ditemukan'], 404);
        }

        // Modifikasi Validasi: tupoksi bisa berupa File ATAU String
        $validator = Validator::make($request->all(), [
            'nm_skpd'   => 'required|string|max:255',
            'alamat'    => 'nullable|string',
            'email'     => 'nullable|email|max:150',
            'no_tlp'    => 'nullable|string|max:20',
            'website'   => 'nullable|string|max:255',
            'kadis'     => 'nullable|string|max:200',
            'sek'       => 'nullable|string|max:200',
            'visimisi'  => 'nullable|string',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jenis'     => 'nullable|in:opd,kab',
            'is_active' => 'required|in:1,0',
            // Jika tupoksi dikirim sebagai file, validasi mimes. Jika string, abaikan mimes.
            'tupoksi'   => $request->hasFile('tupoksi') ? 'file|mimes:pdf|max:5120' : 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except(['logo', 'tupoksi']);

        // 1. Handle Logo (Tetap seperti sebelumnya)
        if ($request->hasFile('logo')) {
            $fileLogo = $request->file('logo');
            if ($skpd->logo && Storage::disk('public')->exists('logo-skpd/' . $skpd->logo)) {
                Storage::disk('public')->delete('logo-skpd/' . $skpd->logo);
            }
            $fileLogo->store('logo-skpd', 'public');
            $data['logo'] = $fileLogo->hashName();
        }

        // 2. Handle Tupoksi
        if ($request->hasFile('tupoksi')) {
            // JIKA INPUT ADALAH FILE PDF
            $fileTupoksi = $request->file('tupoksi');
            
            // Hapus file lama jika ada (hanya jika sebelumnya juga berupa file)
            if ($skpd->tupoksi && str_ends_with(strtolower($skpd->tupoksi), '.pdf')) {
                if (Storage::disk('public')->exists('tupoksi-skpd/' . $skpd->tupoksi)) {
                    Storage::disk('public')->delete('tupoksi-skpd/' . $skpd->tupoksi);
                }
            }
            
            $fileTupoksi->store('tupoksi-skpd', 'public');
            $data['tupoksi'] = $fileTupoksi->hashName();
        } else if ($request->has('tupoksi')) {
            // JIKA INPUT ADALAH TEKS HTML DARI TINYMCE
            
            // Hapus file fisik lama jika user beralih dari PDF ke Teks
            if ($skpd->tupoksi && str_ends_with(strtolower($skpd->tupoksi), '.pdf')) {
                if (Storage::disk('public')->exists('tupoksi-skpd/' . $skpd->tupoksi)) {
                    Storage::disk('public')->delete('tupoksi-skpd/' . $skpd->tupoksi);
                }
            }
            
            $data['tupoksi'] = $request->tupoksi;
        }

        $skpd->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data SKPD berhasil diperbarui',
            'data'    => $skpd
        ], 200);
    }

    /**
     * Menghapus data SKPD secara permanen.
     */
    // public function destroy(string $id): JsonResponse
    // {
    //     /** @var Skpd $skpd */ // Menambahkan type hinting
    //     $skpd = Skpd::find($id);

    //     if (!$skpd) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'SKPD tidak ditemukan'
    //         ], 404);
    //     }

    //     if ($skpd->logo && Storage::disk('public')->exists('logo-skpd/' . $skpd->logo)) {
    //         Storage::disk('public')->delete('logo-skpd/' . $skpd->logo);
    //     }

    //     if ($skpd->tupoksi && Storage::disk('public')->exists('tupoksi-skpd/' . $skpd->tupoksi)) {
    //         Storage::disk('public')->delete('tupoksi-skpd/' . $skpd->tupoksi);
    //     }

    //     $skpd->delete();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Data SKPD berhasil dihapus'
    //     ], 200);
    // }
}