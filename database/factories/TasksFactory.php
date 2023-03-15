<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tasks>
 */
class TasksFactory extends Factory
{
    private $status = ['completed', 'pending'];


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_id = range(1, 10);

        return [
            'user_id' => Arr::random($user_id),
            'description' => fake()->text(),
            'deadline' => fake()->dateTimeBetween('-3 months'),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            'status' => Arr::random($this->status)
        ];
    }
}
