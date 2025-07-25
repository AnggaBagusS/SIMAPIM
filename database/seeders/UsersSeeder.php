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
            'firstname' => 'Administrator',
            'lastname' => '',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'), // Ganti dengan password yang diinginkan
            'type' => 1, // 1 = Admin
            'avatar' => 'no-image-available.png',
            'date_created' => now(),
        ]);
    }
}
