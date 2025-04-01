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
        // Create Memberships
        Membership::factory()->count(5)->create();

        // Create Instructors
        Instructor::factory()->count(10)->create();

        // Create Members
        Member::factory()->count(50)->create();

        // Create Prospects
        Prospect::factory()->count(30)->create();

        // Create Events
        Event::factory()->count(20)->create()->each(function ($event) {
            $members = Member::factory()->count(3)->create(['membership_id' => Membership::inRandomOrder()->first()->id]);
            $event->members()->attach($members);

            //Populate the member_id column with one of the created members
            $event->member_id = $members->random()->id;
            $event->save();
        });

        


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
