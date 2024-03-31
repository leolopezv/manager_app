<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create 200 events and assign them to random users
        $users = User::all();
        for ($i = 0; $i < 200; $i++) {
            $user = $users->random();
            \App\Models\Event::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
