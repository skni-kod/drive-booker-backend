<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'title' => 'Driving Lesson 1',
                'start' => date('Y-m-d H:i:s', strtotime('+1 day')),
                'end' => date('Y-m-d H:i:s', strtotime('+1 day +2 hours')),
                'driver_id' => 2, // Replace with an existing user ID
                'instructor_id' => 1, // Replace with an existing instructor ID
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Driving Test',
                'start' => date('Y-m-d H:i:s', strtotime('+3 days')),
                'end' => date('Y-m-d H:i:s', strtotime('+3 days +1 hour')),
                'driver_id' => 2, // Replace with an existing user ID
                'instructor_id' => 1, // Replace with an existing instructor ID
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
