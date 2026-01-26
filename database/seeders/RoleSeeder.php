<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin role
        Role::firstOrCreate(
            ['name' => 'admin'],
            [
                'display_name' => 'Administrator',
                'description' => 'User with full administrative access'
            ]
        );

        // Create opd role
        Role::firstOrCreate(
            ['name' => 'opd'],
            [
                'display_name' => 'OPD User',
                'description' => 'User from Organisasi Perangkat Daerah'
            ]
        );
    }
}
