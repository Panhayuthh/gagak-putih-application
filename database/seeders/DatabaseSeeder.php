<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\MemberData;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'isAccepted' => true,
            'isAdmin' => true,
        ]);

        User::factory(8)->create();

        Event::factory(10)->create();

        MemberData::factory(10)->create();
    }
}
