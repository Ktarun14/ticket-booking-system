<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'name' => 'Music Fest 2025',
            'date' => '2025-06-15',
            'venue' => 'City Hall',
            'available_seats' => 50,
        ]);

        Event::create([
            'name' => 'Tech Conference 2025',
            'date' => '2025-07-20',
            'venue' => 'Tech Park Auditorium',
            'available_seats' => 100,
        ]);

        Event::create([
            'name' => 'Startup Pitch Night',
            'date' => '2025-08-10',
            'venue' => 'Innovation Hub',
            'available_seats' => 30,
        ]);

        Event::create([
            'name' => 'Art & Culture Expo',
            'date' => '2025-09-05',
            'venue' => 'Downtown Exhibition Center',
            'available_seats' => 70,
        ]);

        Event::create([
            'name' => 'Health & Wellness Camp',
            'date' => '2025-10-12',
            'venue' => 'Community Hall',
            'available_seats' => 40,
        ]);
    }
}
