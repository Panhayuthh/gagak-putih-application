<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MemberData>
 */
class MemberDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->unique()->numberBetween(1, 10),
            'role' => fake()->randomElement(['althlete', 'coach']),
            'gender' => fake()->randomElement(['male', 'female']),
            'school' => fake()->sentence(),
            'belt' => fake()->randomElement(['white', 'yellow', 'orange', 'green', 'blue', 'purple', 'brown', 'black']),
            'medal' => fake()->randomElement(['gold', 'silver', 'bronze']),
            'photo' => null,
        ];
    }
}
