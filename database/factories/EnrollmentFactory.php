<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\MemberData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'class_id' => Classes::factory(),
            'user_id' => function () {
                return MemberData::where('role', 'althlete')->inRandomOrder()->value('user_id');
            }
        ];
    }
}
