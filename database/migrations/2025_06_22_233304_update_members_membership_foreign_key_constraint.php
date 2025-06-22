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
        Schema::table('members', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['membership_id']);
            
            // Make the column nullable
            $table->unsignedBigInteger('membership_id')->nullable()->change();
            
            // Recreate the foreign key constraint with onDelete('set null')
            $table->foreign('membership_id')->references('id')->on('memberships')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['membership_id']);
            
            // Make the column not nullable again
            $table->unsignedBigInteger('membership_id')->nullable(false)->change();
            
            // Recreate the original foreign key constraint
            $table->foreign('membership_id')->references('id')->on('memberships');
        });
    }
};
