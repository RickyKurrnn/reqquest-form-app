<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@dev.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'is_approved' => 'approved'
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@dev.com'],
            [
                'name' => 'User',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'is_approved' => 'approved'
            ]
        );
    }
}
