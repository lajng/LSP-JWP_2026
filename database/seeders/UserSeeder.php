<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin Utama (Aktif)
        User::create([
            'name' => 'Agil Admin Gudang',
            'email' => 'admin@gudang.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_active' => 1,
        ]);

        // Akun Staff (Aktif)
        User::create([
            'name' => 'Staff Gudang',
            'email' => 'staff@gudang.com',
            'password' => Hash::make('password123'),
            'role' => 'petugas',
            'is_active' => 1,
        ]);
    }
}
