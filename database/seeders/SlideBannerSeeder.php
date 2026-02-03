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
            'banner/welcome1.png',
            'banner/bannertest.png',
            'banner/20230807143405_Tata Cara Pengajuan Informasi Publik Bagi Penyandang Disabilitas.png',
            'banner/20230915142948_Tata Cara Memperoleh Informasi Publik Revisi.png',
            'banner/20230917024457_Tata Cara Pengaduan.png',
            'banner/20230918134717_Maklumat pelayanan informasi publik.png',
            'banner/20240920113831_Banner Web Keberatan.png'
        ];

        foreach ($slides as $index => $image) {
            SlideBanner::firstOrCreate(
                ['image_path' => $image],
                ['order' => $index, 'is_active' => true]
            );
        }
    }
}
