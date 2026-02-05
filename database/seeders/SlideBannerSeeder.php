<?php

namespace Database\Seeders;

use App\Models\SlideBanner;
use Illuminate\Database\Seeder;

class SlideBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            '20230807143338_Welcome Banner.png',
            '20230807143353_Alur Umum Permohonan Informasi (1).png',
            '20230807143405_Tata Cara Pengajuan Informasi Publik Bagi Penyandang Disabilitas.png',
            '20230915142948_Tata Cara Memperoleh Informasi Publik Revisi.png',
            '20230917024457_Tata Cara Pengaduan.png',
            '20230918134717_Maklumat pelayanan informasi publik.png',
            '20240920113831_Banner Web Keberatan.png'
        ];

        foreach ($slides as $index => $image) {
            SlideBanner::firstOrCreate(
                ['nm_slide' => $image],
                ['order' => $index, 'is_active' => true]
            );
        }
    }
}
