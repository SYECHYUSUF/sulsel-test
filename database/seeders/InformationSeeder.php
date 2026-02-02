<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterDaftarInformasiPublik;
use App\Models\KategoriInformasi;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed ms_daftar_informasi_publik
        $daftarInformasi = [
            [
                'id' => 1,
                'nama' => 'Setiap Saat',
                'slug' => 'setiap-saat',
                'is_active' => 0
            ],
            [
                'id' => 2,
                'nama' => 'Serta Merta',
                'slug' => 'serta-merta',
                'is_active' => 0
            ],
            [
                'id' => 3,
                'nama' => 'Secara Berkala',
                'slug' => 'secara-berkala',
                'is_active' => 0
            ],
        ];

        foreach ($daftarInformasi as $info) {
            MasterDaftarInformasiPublik::firstOrCreate(
                ['id' => $info['id']], // Check by ID
                [
                    'nama' => $info['nama'],
                    'slug' => $info['slug'],
                    'is_active' => $info['is_active'],
                ]
            );
        }

        // 2. Seed tbl_kat_informasi
        $kategoriInformasi = [
            [
                'id_kat_info' => 22,
                'nm_kat_info' => 'Serta Merta',
                'icon' => '',
                'is_active' => 1
            ],
            [
                'id_kat_info' => 33,
                'nm_kat_info' => 'Setiap Saat',
                'icon' => '',
                'is_active' => 1
            ],
            [
                'id_kat_info' => 100,
                'nm_kat_info' => 'Daftar Informasi Dikecualikan',
                'icon' => '',
                'is_active' => 1
            ],
            [
                'id_kat_info' => 101,
                'nm_kat_info' => 'Daftar Informasi Publik',
                'icon' => '',
                'is_active' => 0
            ],
            [
                'id_kat_info' => 103,
                'nm_kat_info' => 'Berkala',
                'icon' => '',
                'is_active' => 1
            ],
        ];

        foreach ($kategoriInformasi as $kat) {
            KategoriInformasi::firstOrCreate(
                ['id_kat_info' => $kat['id_kat_info']], // Check by custom Primary Key
                [
                    'nm_kat_info' => $kat['nm_kat_info'],
                    'icon' => $kat['icon'],
                    'is_active' => $kat['is_active'],
                ]
            );
        }
    }
}
