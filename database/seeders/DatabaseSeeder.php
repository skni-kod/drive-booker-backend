<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseRegistration;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategorySeeder::class);
        Course::factory(5)->create();
        CourseRegistration::factory()->count(5)->create();
        //        User::factory()->create([
        //            'name' => 'Test User',
        //            'email' => 'test@example.com',
        //        ]);
    }
}
