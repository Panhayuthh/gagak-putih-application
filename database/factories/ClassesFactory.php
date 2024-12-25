<?php

namespace Database\Factories;

use App\Models\MemberData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classes>
 */
class ClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'instructor_id' => function () {
                $coach = MemberData::where('role', 'coach')->inRandomOrder()->value('user_id');
                return $coach ?? MemberData::factory()->create(['role' => 'coach'])->user_id;
            },
            'name' => fake()->sentence(3),
            'description' => fake()->sentence(10),
            'level' => fake()->randomElement(['beginner', 'intermediate', 'advanced']),
            'location' => fake()->sentence(3),
            'date' => fake()->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
        ];
    }
}
