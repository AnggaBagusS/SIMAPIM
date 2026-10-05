<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'firstname' => 'Admin',
                'lastname' => 'SIMAPIM',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'type' => 1, // 1 = Admin
                'avatar' => 'no-image-available.png',
                'date_created' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'Budi',
                'lastname' => 'Santoso',
                'email' => 'budi@staff.com',
                'password' => Hash::make('password123'),
                'type' => 2, // 2 = Staff / Petugas
                'avatar' => 'no-image-available.png',
                'date_created' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'Siti',
                'lastname' => 'Rahma',
                'email' => 'siti@staff.com',
                'password' => Hash::make('password123'),
                'type' => 2, // 2 = Staff / Petugas
                'avatar' => 'no-image-available.png',
                'date_created' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'Ahmad',
                'lastname' => 'Fauzi',
                'email' => 'ahmad@staff.com',
                'password' => Hash::make('password123'),
                'type' => 2, // 2 = Staff / Petugas
                'avatar' => 'no-image-available.png',
                'date_created' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
