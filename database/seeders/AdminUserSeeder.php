<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user if not exists
        User::firstOrCreate(
            ['email' => 'admin@iitm-display.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@iitm-display.com',
                'password' => Hash::make('admin@123'),
            ]
        );
    }
}
