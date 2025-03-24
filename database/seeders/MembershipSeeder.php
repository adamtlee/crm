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
            'name' => 'MMA',
            'description' => 'Professional Mix Martial Arts Program',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('memberships')->insert([
            'name' => 'Grappling',
            'description' => 'Brazilian Jiu Jitsu, and Wrestling',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('memberships')->insert([
            'name' => 'Striking',
            'description' => 'Boxing, Kickboxing, Muay Thai',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
