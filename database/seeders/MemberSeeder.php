<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create a basic membership
        $membership = Membership::firstOrCreate(
            ['name' => 'Basic'],
            [
                'description' => 'Basic membership plan',
                'price' => 0.00,
                'currency' => 'USD',
            ]
        );

        // Create 20 members
        for ($i = 0; $i < 20; $i++) {
            $firstName = fake()->firstName();
            $lastName = fake()->lastName();
            $lastInitial = strtolower(substr($lastName, 0, 1));
            $email = strtolower($firstName) . $lastInitial . '@doxtera.com';
            
            // Create user
            $user = User::create([
                'name' => $firstName . ' ' . $lastName,
                'email' => $email,
                'password' => Hash::make('Password1'),
            ]);

            // Create member profile
            Member::create([
                'user_id' => $user->id,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'birth_date' => fake()->dateTimeBetween('1995-01-01', '2000-12-31')->format('Y-m-d'),
                'email_address' => $email,
                'phone_number' => '000-000-0000',
                'emergency_contact_name' => fake()->firstName() . ' ' . fake()->lastName(),
                'emergency_contact_phone_number' => '111-111-1111',
                'membership_id' => $membership->id,
            ]);
        }
        
        $this->command->info('20 members created successfully!');
    }
}
