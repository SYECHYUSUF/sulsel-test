<?php

namespace Database\Seeders;

use App\Models\BentukInformasi;
use App\Models\KategoriInformasi; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class InformasiSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Bentuk Informasi
        $bentukData = [
            ['judul' => 'Softcopy (File PDF/Doc/dll)'],
            ['judul' => 'Hardcopy (Fotocopy/Print)'],
            ['judul' => 'Melihat Langsung'],
            ['judul' => 'Mendengarkan'],
            ['judul' => 'Mencatat'],
        ];

        foreach ($bentukData as $item) {
            BentukInformasi::updateOrCreate(
                ['judul' => $item['judul']],
                $item
            );
        }

        // Seed Kategori Informasi (Berdasarkan Query Anda)
        $kategoriData = [
            [
                'id_kat_info' => 22,
                'nm_kat_info' => 'Serta Merta',
                'slug'        => 'serta-merta',
                'icon'        => '',
                'is_active'   => 1
            ],
            [
                'id_kat_info' => 33,
                'nm_kat_info' => 'Setiap Saat',
                'slug'        => 'setiap-saat',
                'icon'        => '',
                'is_active'   => 1
            ],
            [
                'id_kat_info' => 100,
                'nm_kat_info' => 'Daftar Informasi Dikecualikan',
                'slug'        => 'daftar-informasi-dikecualikan',
                'icon'        => '',
                'is_active'   => 1
            ],
            [
                'id_kat_info' => 101,
                'nm_kat_info' => 'Daftar Informasi Publik',
                'slug'        => 'daftar-informasi-publik',
                'icon'        => '',
                'is_active'   => 0
            ],
            [
                'id_kat_info' => 103,
                'nm_kat_info' => 'Berkala',
                'slug'        => 'berkala',
                'icon'        => '',
                'is_active'   => 1
            ],
        ];

        foreach ($kategoriData as $kat) {
            KategoriInformasi::updateOrCreate(
                ['id_kat_info' => $kat['id_kat_info']],
                $kat
            );
        }

        // Import File SQL (Jika ada data mentah tambahan)
        $files = [
            'informasi.sql',
        ];

        // Nonaktifkan pemeriksaan foreign key (Syntax PostgreSQL)
        DB::statement("SET session_replication_role = 'replica';");

        foreach ($files as $fileName) {
            $path = database_path("seeders/file/{$fileName}");

            if (File::exists($path)) {
                $this->command->info("Menjalankan seeder SQL: {$fileName}");
                $sql = File::get($path);
                DB::unprepared($sql);
            } else {
                // Jangan error jika file tidak ada, cukup info
                $this->command->warn("File SQL skip (tidak ditemukan): {$path}");
            }
        }

        // Aktifkan kembali pemeriksaan foreign key
        DB::statement("SET session_replication_role = 'origin';");

        $this->command->info('Semua data kategori dan file SQL berhasil diproses!');
    }
}