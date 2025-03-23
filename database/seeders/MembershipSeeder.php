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
        DB::table('memberships')->insert([
            'name' => 'Mixed Martial Arts',
            'description' => 'Dedicate MMA Program - Coaches approval needed',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('memberships')->insert([
            'name' => 'Brazilian Jiu-Jitsu',
            'description' => 'Submission Grappling, Offering both Gi and No Gi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('memberships')->insert([
            'name' => 'Muay Thai',
            'description' => 'The are to 8 limbs',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
