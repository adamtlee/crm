<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Member;
use App\Models\Membership;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 50, 500);
        $taxRate = 0.08; // 8% tax rate
        $taxAmount = $subtotal * $taxRate;
        $discountAmount = $this->faker->randomFloat(2, 0, 50);
        $totalAmount = $subtotal + $taxAmount - $discountAmount;
        
        $invoiceDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $dueDate = $this->faker->dateTimeBetween($invoiceDate, '+30 days');
        
        $statuses = ['pending', 'paid', 'overdue', 'cancelled'];
        
        return [
            'invoice_number' => 'INV-' . $this->faker->unique()->numberBetween(1000, 9999),
            'member_id' => null, // Will be set in the seeder
            'membership_id' => null, // Will be set in the seeder
            'event_id' => null, // Will be set in the seeder
            'invoice_date' => $invoiceDate,
            'due_date' => $dueDate,
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
            'status' => $this->faker->randomElement($statuses),
            'notes' => $this->faker->optional(0.7)->sentence(),
            'payment_terms' => $this->faker->randomElement(['Net 15', 'Net 30', 'Due on receipt']),
        ];
    }
} 