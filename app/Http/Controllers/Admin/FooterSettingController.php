<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterSettingController extends Controller
{
    public function index()
    {
        // Load all settings needed for the footer
        $settings = [
            'footer_logo' => Setting::getValue('footer_logo'),
            'footer_description' => Setting::getValue('footer_description', 'Portal Resmi Pejabat Pengelola Informasi dan Dokumentasi (PPID) Utama Pemerintah Provinsi Sulawesi Selatan.'),
            'footer_address' => Setting::getValue('footer_address', 'Jl. Urip Sumoharjo No. 269, Makassar, Sulawesi Selatan, 90231'),
            'footer_phone' => Setting::getValue('footer_phone', '(0411) 453192'),
            'footer_email' => Setting::getValue('footer_email', 'ppid@sulawesiprov.go.id'),
            
            // Social Media
            'social_facebook' => Setting::getValue('social_facebook', 'https://www.facebook.com/ppidsulsel'),
            'social_twitter' => Setting::getValue('social_twitter', 'https://twitter.com/ppidsulsel'),
            'social_instagram' => Setting::getValue('social_instagram', 'https://www.instagram.com/ppidsulsel'),
            'social_youtube' => Setting::getValue('social_youtube', 'https://www.youtube.com/@ppidsulsel'),
            
            // Legal
            'privacy_policy' => Setting::getValue('privacy_policy', 'Isi Kebijakan Privasi disini...'),
            'terms_conditions' => Setting::getValue('terms_conditions', 'Isi Syarat dan Ketentuan disini...'),
        ];

        return view('admin.footer-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_description' => 'nullable|string',
            'footer_address' => 'nullable|string',
            'footer_phone' => 'nullable|string',
            'footer_email' => 'nullable|email',
            'social_facebook' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_youtube' => 'nullable|url',
            'privacy_policy' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
        ]);

        // Handle File Upload
        if ($request->hasFile('footer_logo')) {
            $path = $request->file('footer_logo')->store('images', 'public');
            Setting::updateOrCreate(
                ['key' => 'footer_logo'],
                ['value' => $path]
            );
        }

        // Handle other fields
        $fields = [
            'footer_description', 'footer_address', 'footer_phone', 'footer_email',
            'social_facebook', 'social_twitter', 'social_instagram', 'social_youtube',
            'privacy_policy', 'terms_conditions'
        ];

        foreach ($fields as $field) {
            Setting::updateOrCreate(
                ['key' => $field],
                ['value' => $request->input($field)]
            );
        }

        return redirect()->route('admin.footer-settings.index')
            ->with('success', 'Pengaturan Footer berhasil diperbarui.');
    }
}
