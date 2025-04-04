<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->foreignId('membership_id')->nullable()->constrained()->onDelete('set null'); 
            $table->foreignId('event_id')->nullable()->constrained()->onDelete('set null'); 
            $table->date('invoice_date');
            $table->date('due_date');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax_amount', 10, 2);
            $table->decimal('discount_amount', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->string('status'); 
            $table->text('notes')->nullable();
            $table->text('payment_terms')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
