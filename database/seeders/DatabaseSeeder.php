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
        // Create only the specified memberships
        $this->call(MembershipSeeder::class);

        // Create Instructors
        Instructor::factory()->count(10)->create();

        // Get all memberships to use for member creation
        $memberships = Membership::all();

        // Create Members with random membership assignments from existing memberships
        $members = collect();
        for ($i = 0; $i < 50; $i++) {
            $member = Member::factory()->create([
                'membership_id' => $memberships->random()->id,
            ]);
            $members->push($member);
        }

        // Create Prospects
        Prospect::factory()->count(30)->create();

        // Create Events with proper member assignment
        foreach ($members->random(20) as $member) {
            $event = Event::factory()->create([
                'member_id' => $member->id,
            ]);
            
            // Attach 3 random members to the event
            $eventMembers = $members->random(3);
            $event->members()->attach($eventMembers);
        }

        // Create Videos
        $this->call(VideoSeeder::class);

        // Create Invoices
        $this->call(InvoiceSeeder::class);

        // Create a test user for development only
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('Password1'),
        ]);
    }
}
