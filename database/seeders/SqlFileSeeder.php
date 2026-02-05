<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SqlFileSeeder extends Seeder
{
    public function run(): void
    {
        // Daftar file yang ingin dijalankan (sesuaikan nama filenya)
        $files = [
            'users.sql',
            'daftar-informasi-publik.sql',
            'ikphns.sql',
            'informasi.sql',
            'permohonan-informasi.sql',
            'skpd.sql',
            'sops.sql',
        ];

        // Nonaktifkan pemeriksaan foreign key agar tidak error saat insert data yang berelasi
        DB::statement("SET session_replication_role = 'replica';");

        foreach ($files as $fileName) {
            $path = database_path("seeders/file/{$fileName}");

            if (File::exists($path)) {
                $this->command->info("Menjalankan seeder: {$fileName}");

                $sql = File::get($path);

                // Gunakan unprepared untuk menjalankan query mentah dalam jumlah besar
                DB::unprepared($sql);
            } else {
                $this->command->error("File tidak ditemukan: {$path}");
            }
        }

        // Aktifkan kembali pemeriksaan foreign key
        DB::statement("SET session_replication_role = 'origin';");

        $this->command->info('Semua file SQL berhasil diproses!');
    }
}