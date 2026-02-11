<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FooterSettingController extends Controller
{
    /**
     * Mengambil semua pengaturan footer.
     */
    public function index(): JsonResponse
    {
        $settings = [
            'footer_logo' => Setting::getValue('footer_logo') 
                ? asset('storage/' . Setting::getValue('footer_logo')) 
                : null,
            'footer_description' => Setting::getValue('footer_description', 'Portal Resmi Pejabat Pengelola Informasi dan Dokumentasi (PPID) Utama Pemerintah Provinsi Sulawesi Selatan.'),
            'footer_address' => Setting::getValue('footer_address', 'Jl. Urip Sumoharjo No. 269, Makassar, Sulawesi Selatan, 90231'),
            'footer_phone' => Setting::getValue('footer_phone', '(0411) 453192'),
            'footer_email' => Setting::getValue('footer_email', 'ppid@sulawesiprov.go.id'),
            
            // Hukum dan Statistik
            'privacy_policy' => Setting::getValue('privacy_policy', 'Isi Kebijakan Privasi disini...'),
            'terms_conditions' => Setting::getValue('terms_conditions', 'Isi Syarat dan Ketentuan disini...'),
            'is_stats_visible' => Setting::getValue('is_stats_visible', '0'),
        ];

        return response()->json([
            'success' => true,
            'message' => 'Data pengaturan footer berhasil diambil.',
            'data' => $settings
        ], 200);
    }

    /**
     * Memperbarui pengaturan footer.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_description' => 'nullable|string',
            'footer_address' => 'nullable|string',
            'footer_phone' => 'nullable|string',
            'footer_email' => 'nullable|email',
            'privacy_policy' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
            'is_stats_visible' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Proses unggah file logo jika ada
        if ($request->hasFile('footer_logo')) {
            $path = $request->file('footer_logo')->store('images', 'public');
            Setting::updateOrCreate(
                ['key' => 'footer_logo'],
                ['value' => $path]
            );
        }

        $fields = [
            'footer_description', 'footer_address', 'footer_phone', 'footer_email',
            'privacy_policy', 'terms_conditions', 'is_stats_visible'
        ];

        // Iterasi field untuk pembaruan massal pada tabel settings
        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::updateOrCreate(
                    ['key' => $field],
                    ['value' => $request->input($field)]
                );
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan footer berhasil diperbarui.'
        ], 200);
    }
}