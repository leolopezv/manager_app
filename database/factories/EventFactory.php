<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //Generate fake data for the event model
            'name' => fake()->unique()->sentence(3), //Generate a unique sentence with 3 words
            'description' => fake()->text, //Generate a random text
            'start_time' => fake()->dateTimeBetween('now', '+1 month'), //Generate a date between now and 1 month from now
            'end_time' => fake()->dateTimeBetween('+1 month', '+2 months'), //Generate a date between 1 month from now and 2 months from now

        ];
    }
}
