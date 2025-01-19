<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        // Fetch all users
        $users = User::all();

        // Sample events
        $events = [
            [
                'title' => 'Morning Meeting',
                'start' => '2025-02-07 09:00:00',
                'end' => '2025-02-07 10:00:00',
            ],
            [
                'title' => 'Lunch Break',
                'start' => '2025-03-13 12:00:00',
                'end' => '2025-03-13 13:00:00',
            ],
            [
                'title' => 'Afternoon Workshop',
                'start' => '2025-04-06 14:00:00',
                'end' => '2025-04-06 16:00:00',
            ],
            [
                'title' => 'All-Day Event',
                'start' => '2025-03-09 00:00:00',
                'end' => '2025-03-09 23:59:59',
            ],
            [
                'title' => 'Evening Networking',
                'start' => '2025-04-11 18:30:00',
                'end' => '2025-04-11 20:00:00',
            ],
        ];

        // Loop through each user and assign the events
        foreach ($users as $user) {
            foreach ($events as $event) {
                Event::create(array_merge($event, ['user_id' => $user->id]));
            }
        }
    }
}
