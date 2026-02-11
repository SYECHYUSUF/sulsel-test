<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class FooterSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'footer_logo',
                'value' => null, // Biarkan null jika belum ada file, atau isi path jika ada di storage
            ],
            [
                'key' => 'footer_description',
                'value' => 'Portal Resmi Pejabat Pengelola Informasi dan Dokumentasi (PPID) Utama Pemerintah Provinsi Sulawesi Selatan.',
            ],
            [
                'key' => 'footer_address',
                'value' => 'Jl. Urip Sumoharjo No. 269, Makassar, Sulawesi Selatan, 90231',
            ],
            [
                'key' => 'footer_phone',
                'value' => '(0411) 453192',
            ],
            [
                'key' => 'footer_email',
                'value' => 'ppid@sulawesiprov.go.id',
            ],
            [
                'key' => 'privacy_policy',
                'value' => '<p>Isi Kebijakan Privasi disini...</p>',
            ],
            [
                'key' => 'terms_conditions',
                'value' => '<p>Isi Syarat dan Ketentuan disini...</p>',
            ],
            [
                'key' => 'is_stats_visible',
                'value' => '1', // Set ke 1 agar aktif secara default
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}