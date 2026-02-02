<?php

namespace Database\Seeders;

use App\Models\MasterTahun;
use Illuminate\Database\Seeder;

class TahunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterTahun::insert([
            ["waktu" => "2025"],
            ["waktu" => "2024"],
            ["waktu" => "2023"],
        ]);
    }
}
