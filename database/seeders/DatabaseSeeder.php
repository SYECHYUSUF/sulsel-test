<?php

namespace Database\Seeders;

use App\Models\MasterTahun;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed roles first
        $this->call([
            SqlFileSeeder::class,

            RoleSeeder::class,
            FaqSeeder::class,
            SurveySeeder::class,
            SurveyResponseSeeder::class,
            TahunSeeder::class,
            SlideBannerSeeder::class,
            MasterPekerjaanSeeder::class,
            MasterDomisiliSeeder::class,
            SosmedSeeder::class,
            ProfilSeeder::class,
            InformationSeeder::class,
            InformasiPublikSeeder::class,
            FaqSeeder::class,
        ]);
    }
}