<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan seed basis data aplikasi.
     */
    public function run(): void
    {
        // 1. Tentukan jalur ke file SQL
        // Pastikan file 'database.sql' sudah diletakkan di dalam folder 'database/seeders/'
        $path = database_path('seeders/database.sql');

        // 2. Periksa apakah file tersebut ada
        if (File::exists($path)) {
            $this->command->info('Memulai impor data dari database.sql...');

            // 3. Baca konten file SQL
            $sql = File::get($path);

            // 4. Jalankan SQL menggunakan unprepared statement
            // Ini diperlukan karena file SQL berisi banyak pernyataan (DROP, CREATE, INSERT)
            try {
                DB::unprepared($sql);
                $this->command->info('Database sukses diimpor!');
            } catch (\Exception $e) {
                $this->command->error('Terjadi kesalahan saat mengimpor: ' . $e->getMessage());
            }
        } else {
            $this->command->error("File SQL tidak ditemukan di: {$path}");
        }

        /* // Anda dapat mengaktifkan kembali pembuatan user manual jika diperlukan, 
        // namun pastikan tidak bentrok dengan data dari SQL.
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); 
        */
    }
}