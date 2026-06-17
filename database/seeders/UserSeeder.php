<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Tambang',
            'email' => 'admin@tambang.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'PT Bumi Resources',
            'email' => 'vendor@tambang.com',
            'password' => Hash::make('password'),
            'role' => 'vendor',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => Hash::make('password'),
            'role' => 'lender',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Siti Rahmawati',
            'email' => 'siti@example.com',
            'password' => Hash::make('password'),
            'role' => 'lender',
            'is_active' => true,
        ]);
    }
}
