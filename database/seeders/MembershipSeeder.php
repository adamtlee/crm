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
            ],
            [
                'name' => 'Muay Thai class - daily pass',
                'description' => 'All Levels Muay Thai class',
                'price' => 600.00,
            ],
            [
                'name' => 'Private Training Session',
                'description' => 'Individual Private Training Session',
                'price' => 1200.00,
            ],
        ];

        foreach ($memberships as $membership) {
            DB::table('memberships')->insert([
                'name' => $membership['name'],
                'description' => $membership['description'],
                'price' => $membership['price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
