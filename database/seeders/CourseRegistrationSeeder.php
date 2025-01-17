<?php

namespace Database\Seeders;

use App\Enums\RegistrationStatus;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $courses = Course::all();
        $users = User::all();

        foreach ($courses as $course) {
            foreach ($users as $user) {
                DB::table('course_registrations')->insert([
                    'course_id' => $course->id,
                    'user_id' => $user->id,
                    'status' => RegistrationStatus::PENDING->value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
