<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberships = [
            [
                'name' => 'Fighter class - daily pass',
                'description' => 'Professional Fighters Only',
                'price' => 700.00,
                'currency' => 'THB',
            ],
            [
                'name' => 'Muay Thai class - daily pass',
                'description' => 'All Levels Muay Thai class',
                'price' => 600.00,
                'currency' => 'THB',
            ],
            [
                'name' => 'Private Training Session',
                'description' => 'Individual Private Training Session',
                'price' => 1200.00,
                'currency' => 'THB',
            ],
            [
                'name' => 'Private Training Session - Kru Gae',
                'description' => 'Private Training Session with Kru Gae',
                'price' => 2400.00,
                'currency' => 'THB',
            ],
        ];

        foreach ($memberships as $membership) {
            DB::table('memberships')->insert([
                'name' => $membership['name'],
                'description' => $membership['description'],
                'price' => $membership['price'],
                'currency' => $membership['currency'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
