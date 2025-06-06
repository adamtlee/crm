<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create or update the test user
        $user = User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        // Get or create a basic membership (without price and duration_days)
        $membership = Membership::firstOrCreate(
            ['name' => 'Basic'],
            [
                'description' => 'Basic membership plan',
            ]
        );

        // Create or update member profile
        Member::updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'birth_date' => '1990-01-01',
                'email_address' => 'test@example.com',
                'phone_number' => '1234567890',
                'emergency_contact_name' => 'Emergency Contact',
                'emergency_contact_phone_number' => '0987654321',
                'membership_id' => $membership->id,
            ]
        );
    }
} 