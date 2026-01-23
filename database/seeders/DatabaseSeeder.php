<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
 
    public function run(): void
    {
        // namun pastikan tidak bentrok dengan data dari SQL.
        User::factory()->create([
            'name' => 'Test User',
            'username' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('test123'),
        ]); 
    }
}