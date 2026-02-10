<?php

namespace Database\Seeders;

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

        // --- Konfigurasi User Esdm 2 ---
        // $esdmData = [
        //     'id' => 6000,
        //     'name' => 'Esdm 2',
        //     'username' => 'esdm2',
        //     'email' => 'esdm2@gmail.com',
        //     'password' => Hash::make('esdm123'),
        //     'id_skpd' => 'SKPD007',
        // ];

        // User::where('email', $esdmData['email'])->orWhere('username', $esdmData['username'])->delete();
        // $userEsdm = User::create($esdmData);
        // $userEsdm->addRole('opd');
    }
}