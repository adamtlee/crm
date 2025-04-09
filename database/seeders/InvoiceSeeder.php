<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all members, memberships, and events
        $members = Member::all();
        $memberships = Membership::all();
        $events = Event::all();
        
        // Create a Faker instance
        $faker = Faker::create();
        
        // Create 100 invoices
        for ($i = 0; $i < 100; $i++) {
            // Randomly decide if this is a membership invoice or event invoice
            $isMembershipInvoice = $faker->boolean(70); // 70% chance of being a membership invoice
            
            $member = $members->random();
            
            if ($isMembershipInvoice) {
                // Create a membership invoice
                Invoice::factory()->create([
                    'member_id' => $member->id,
                    'membership_id' => $member->membership_id, // Use the member's current membership
                    'event_id' => null,
                    'subtotal' => $faker->randomFloat(2, 100, 300), // Membership fees
                    'notes' => 'Monthly membership fee for ' . $memberships->find($member->membership_id)->name,
                ]);
            } else {
                // Create an event invoice
                $event = $events->random();
                Invoice::factory()->create([
                    'member_id' => $member->id,
                    'membership_id' => null,
                    'event_id' => $event->id,
                    'subtotal' => $faker->randomFloat(2, 50, 150), // Event fees
                    'notes' => 'Registration fee for ' . $event->name,
                ]);
            }
        }
    }
} 