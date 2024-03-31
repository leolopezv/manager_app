<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Make the users attend a random amount of events
        $users = \App\Models\User::all();
        $events = \App\Models\Event::all();
        foreach ($users as $user) {
            $eventsToAttend = $events->random(random_int(1, 3)); //Randomly select 1 to 3 events this user will attend

            //Make the user attend the selected events
            foreach ($eventsToAttend as $event) {
                \App\Models\Attendee::create([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                ]);
            }
        }
    }
}
