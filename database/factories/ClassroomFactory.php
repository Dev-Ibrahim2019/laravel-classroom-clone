<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(2),
            'section' => fake()->optional()->word(),
            'subject' => fake()->optional()->word(),
            'room' => fake()->optional()->bothify('Room ###'),
            'code' => strtoupper(Str::random(10)),
            'theme' => fake()->optional()->safeColorName(),
            'status' => fake()->randomElement(['active', 'archived']),
            'user_id' => User::factory(),
        ];
    }
}
