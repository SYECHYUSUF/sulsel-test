<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BentukInformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['judul' => 'Softcopy (File PDF/Doc/dll)'],
            ['judul' => 'Hardcopy (Fotocopy/Print)'],
            ['judul' => 'Melihat Langsung'],
            ['judul' => 'Mendengarkan'],
            ['judul' => 'Mencatat'],
        ];

        foreach ($data as $item) {
            \App\Models\BentukInformasi::updateOrCreate(
                ['judul' => $item['judul']],
                $item
            );
        }
    }
}
