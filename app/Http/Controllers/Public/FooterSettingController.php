<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class FooterSettingController extends Controller
{
    /**
     * Mengambil semua pengaturan footer.
     */
    public function index(): JsonResponse
    {
        $settings = [
            'footer_logo' => Setting::getValue('footer_logo'),
            'footer_description' => Setting::getValue('footer_description', 'Portal Resmi Pejabat Pengelola Informasi dan Dokumentasi (PPID) Utama Pemerintah Provinsi Sulawesi Selatan.'),
            'footer_address' => Setting::getValue('footer_address', 'Jl. Urip Sumoharjo No. 269, Makassar, Sulawesi Selatan, 90231'),
            'footer_phone' => Setting::getValue('footer_phone', '(0411) 453192'),
            'footer_email' => Setting::getValue('footer_email', 'ppid@sulawesiprov.go.id'),
            'privacy_policy' => Setting::getValue('privacy_policy', 'Isi Kebijakan Privasi disini...'),
            'terms_conditions' => Setting::getValue('terms_conditions', 'Isi Syarat dan Ketentuan disini...'),
            'is_stats_visible' => Setting::getValue('is_stats_visible', '0'),
        ];

        return response()->json([
            'data' => $settings
        ], 200);
    }
}