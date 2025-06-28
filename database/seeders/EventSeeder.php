<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Location;
use App\Models\Instructor;
use App\Models\Member;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create the Superbon Training Camp location
        $location = Location::firstOrCreate(
            ['name' => 'Superbon Training Camp'],
            [
                'address' => '123 Muay Thai Street, Bangkok, Thailand',
                'description' => 'Premier Muay Thai training facility',
            ]
        );

        // Get all instructors
        $instructors = Instructor::all();
        
        // Get all members
        $members = Member::all();
        
        if ($instructors->count() < 3) {
            $this->command->error('Need at least 3 instructors to create events. Please run InstructorSeeder first.');
            return;
        }
        
        if ($members->count() < 4) {
            $this->command->error('Need at least 4 members to create events. Please run MemberSeeder first.');
            return;
        }

        // Create 20 events
        $eventCount = 0;
        $currentDate = Carbon::now()->subDays(1); // Start from yesterday
        
        while ($eventCount < 20) {
            // Skip Sundays (0 = Sunday)
            if ($currentDate->dayOfWeek === 0) {
                $currentDate->addDay();
                continue;
            }
            
            // Create morning event (8:00 AM)
            if ($eventCount < 20) {
                $morningEvent = Event::create([
                    'name' => 'Muay Thai Class',
                    'duration' => 2,
                    'date_time' => $currentDate->copy()->setTime(8, 0, 0),
                    'location_id' => $location->id,
                    'type' => 'public',
                ]);
                
                // Attach 3-4 random instructors
                $randomInstructors = $instructors->random(rand(3, 4));
                $morningEvent->instructors()->attach($randomInstructors);
                
                // Attach 4-15 random members
                $randomMembers = $members->random(rand(4, 15));
                $morningEvent->members()->attach($randomMembers);
                
                $eventCount++;
            }
            
            // Create afternoon event (4:00 PM)
            if ($eventCount < 20) {
                $afternoonEvent = Event::create([
                    'name' => 'Muay Thai Class',
                    'duration' => 2,
                    'date_time' => $currentDate->copy()->setTime(16, 0, 0),
                    'location_id' => $location->id,
                    'type' => 'public',
                ]);
                
                // Attach 3-4 random instructors
                $randomInstructors = $instructors->random(rand(3, 4));
                $afternoonEvent->instructors()->attach($randomInstructors);
                
                // Attach 4-15 random members
                $randomMembers = $members->random(rand(4, 15));
                $afternoonEvent->members()->attach($randomMembers);
                
                $eventCount++;
            }
            
            $currentDate->subDay(); // Go back one day
        }
        
        $this->command->info('20 Muay Thai events created successfully!');
    }
}
