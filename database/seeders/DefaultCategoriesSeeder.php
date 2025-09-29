<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class DefaultCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default categories
        Category::firstOrCreate(
            ['name' => 'News'],
            ['sort_order' => 1]
        );
        
        Category::firstOrCreate(
            ['name' => 'Temperature'],
            ['sort_order' => 2]
        );
    }
}
