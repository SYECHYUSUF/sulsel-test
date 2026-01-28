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
            RoleSeeder::class,
            FaqSeeder::class,
            SurveySeeder::class,
            SurveyResponseSeeder::class,
        ]);

        // --- Konfigurasi User Admin 2 ---
        $admin2Data = [
            'name' => 'Admin 2',
            'username' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('admin123'),
            'id_skpd' => null, // Admin pusat biasanya tidak terikat ID SKPD tertentu
        ];

        // Hapus jika user admin2 sudah ada sebelumnya
        User::where('email', $admin2Data['email'])
            ->orWhere('username', $admin2Data['username'])
            ->delete();

        // Buat user admin2 dan berikan role 'admin'
        $userAdmin2 = User::create($admin2Data);
        $userAdmin2->addRole('admin');

        // --- Konfigurasi User Dbmk 2 ---
        $dbmkData = [
            'name' => 'Dbmk 2',
            'username' => 'dbmk2',
            'email' => 'dbmk2@gmail.com',
            'password' => Hash::make('dbmk123'),
            'id_skpd' => 'SKPD008',
        ];

        // Hapus user jika sudah ada (berdasarkan email atau username)
        User::where('email', $dbmkData['email'])
            ->orWhere('username', $dbmkData['username'])
            ->delete();

        // Buat user baru
        $userDbmk = User::create($dbmkData);

        // Tambahkan role 'opd' (Relasi Laratrust)
        $userDbmk->addRole('opd');


        // --- Konfigurasi User Esdm 2 ---
        $esdmData = [
            'name' => 'Esdm 2',
            'username' => 'esdm2',
            'email' => 'esdm2@gmail.com',
            'password' => Hash::make('esdm123'),
            'id_skpd' => 'SKPD007',
        ];

        User::where('email', $esdmData['email'])->orWhere('username', $esdmData['username'])->delete();
        $userEsdm = User::create($esdmData);
        $userEsdm->addRole('opd');
    }
}