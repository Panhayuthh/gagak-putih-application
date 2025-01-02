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
            'name' => fake()->name(),
            'role' => fake()->randomElement(['athlete', 'coach']),
            'gender' => fake()->randomElement(['male', 'female']),
            'school' => fake()->sentence(),
            'belt' => fake()->randomElement(['white', 'yellow', 'orange', 'green', 'blue', 'purple', 'brown', 'black']),
            'medal' => fake()->randomElement(['gold', 'silver', 'bronze']),
            'photo' => null,
        ];
    }
}
