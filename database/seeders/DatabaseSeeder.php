<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Prospect;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Instructor;
use App\Models\Event;
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

        Membership::factory(10)->create();
        Prospect::factory(10)->create();
        Member::factory(10)->create();
        Instructor::factory(10)->create();
        Event::factory(10)->create();


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
