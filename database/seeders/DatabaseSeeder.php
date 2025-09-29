<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call admin user seeder
        $this->call(AdminUserSeeder::class);
        
        // Call default categories seeder
        $this->call(DefaultCategoriesSeeder::class);
    }
}
