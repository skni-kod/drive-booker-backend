<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Category::CATEGORIES as $category) {
            Category::updateOrCreate(['name' => $category]);
        }
    }
}
