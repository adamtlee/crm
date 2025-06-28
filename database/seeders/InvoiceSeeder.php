<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear the invoices table before seeding
        \DB::table('invoices')->truncate();

        // Get all members with their memberships
        $members = Member::with('membership')->get();
        
        // Create a Faker instance
        $faker = Faker::create();
        
        foreach ($members as $member) {
            // Skip if member doesn't have a membership
            if (!$member->membership) {
                continue;
            }
            
            $membership = $member->membership;
            
            // Create 3-6 months of invoices for each member
            $numberOfInvoices = $faker->numberBetween(3, 6);
            
            for ($i = 0; $i < $numberOfInvoices; $i++) {
                // Calculate invoice date (going back from current date)
                $invoiceDate = Carbon::now()->subMonths($numberOfInvoices - $i - 1);
                $dueDate = $invoiceDate->copy()->addDays(30);
                
                // Base subtotal from membership price
                $subtotal = $membership->price;
                
                // Add some variation to make it realistic
                $subtotal += $faker->randomFloat(2, -10, 20);
                
                // Calculate tax (8.5% tax rate)
                $taxAmount = $subtotal * 0.085;
                
                // Random discount (0-15% chance of having a discount)
                $discountAmount = 0;
                if ($faker->boolean(15)) {
                    $discountAmount = $subtotal * $faker->randomFloat(2, 0.05, 0.15);
                }
                
                // Calculate total
                $totalAmount = $subtotal + $taxAmount - $discountAmount;
                
                // Determine status based on due date
                $status = 'paid';
                if ($dueDate->isPast()) {
                    $status = $faker->randomElement(['paid', 'overdue', 'overdue']);
                } elseif ($dueDate->isFuture()) {
                    $status = $faker->randomElement(['paid', 'pending', 'pending']);
                }
                
                // Generate invoice number
                $invoiceNumber = 'INV-' . str_pad($member->id, 4, '0', STR_PAD_LEFT) . '-' . 
                                str_pad($i + 1, 3, '0', STR_PAD_LEFT) . '-' . 
                                $invoiceDate->format('Y');
                
                Invoice::create([
                    'invoice_number' => $invoiceNumber,
                    'member_id' => $member->id,
                    'membership_id' => $membership->id,
                    'event_id' => null,
                    'invoice_date' => $invoiceDate,
                    'due_date' => $dueDate,
                    'subtotal' => $subtotal,
                    'tax_amount' => $taxAmount,
                    'discount_amount' => $discountAmount,
                    'total_amount' => $totalAmount,
                    'status' => $status,
                    'notes' => $faker->randomElement([
                        'Monthly membership fee',
                        'Membership renewal',
                        'Monthly subscription',
                        'Membership payment',
                        'Monthly dues'
                    ]),
                    'payment_terms' => 'Net 30',
                ]);
            }
            
            // Create some event invoices for members who attended events
            $memberEvents = $member->events;
            if ($memberEvents->count() > 0) {
                // Create invoices for 1-3 random events the member attended
                $eventsToInvoice = $memberEvents->random(min(3, $memberEvents->count()));
                
                foreach ($eventsToInvoice as $event) {
                    $eventInvoiceDate = $event->date_time->subDays($faker->numberBetween(7, 30));
                    $eventDueDate = $eventInvoiceDate->copy()->addDays(15);
                    
                    // Event fees are typically lower than membership fees
                    $eventSubtotal = $faker->randomFloat(2, 25, 75);
                    $eventTaxAmount = $eventSubtotal * 0.085;
                    $eventTotalAmount = $eventSubtotal + $eventTaxAmount;
                    
                    $eventInvoiceNumber = 'EVT-' . str_pad($member->id, 4, '0', STR_PAD_LEFT) . '-' . 
                                         str_pad($event->id, 4, '0', STR_PAD_LEFT) . '-' . 
                                         $eventInvoiceDate->format('Y');
                    
                    Invoice::create([
                        'invoice_number' => $eventInvoiceNumber,
                        'member_id' => $member->id,
                        'membership_id' => null,
                        'event_id' => $event->id,
                        'invoice_date' => $eventInvoiceDate,
                        'due_date' => $eventDueDate,
                        'subtotal' => $eventSubtotal,
                        'tax_amount' => $eventTaxAmount,
                        'discount_amount' => 0,
                        'total_amount' => $eventTotalAmount,
                        'status' => $faker->randomElement(['paid', 'paid', 'pending']),
                        'notes' => 'Registration fee for ' . $event->name,
                        'payment_terms' => 'Net 15',
                    ]);
                }
            }
        }
        
        $this->command->info('Created invoices for ' . $members->count() . ' members based on their membership plans.');
    }
} 