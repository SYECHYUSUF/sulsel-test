<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed roles first
        $this->call([
            SqlFileSeeder::class,
            InformasiSeeder::class,

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