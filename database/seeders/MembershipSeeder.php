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
                'name' => 'MMA',
                'description' => 'Mixed Martial Arts program combining striking and grappling techniques. Learn the complete skillset needed for cage fighting.',
            ],
            [
                'name' => 'Boxing',
                'description' => 'Traditional boxing program focusing on footwork, punching combinations, and defensive techniques.',
            ],
            [
                'name' => 'Kickboxing',
                'description' => 'Combines boxing with kicking techniques. Perfect for developing striking skills with both hands and feet.',
            ],
            [
                'name' => 'Muay Thai',
                'description' => 'The art of eight limbs. Learn traditional Thai boxing including punches, kicks, elbows, and knee strikes.',
            ],
            [
                'name' => 'Brazilian Jiu-Jitsu',
                'description' => 'Ground fighting and submission grappling. Master the art of controlling and submitting opponents on the ground.',
            ],
            [
                'name' => 'Wrestling',
                'description' => 'Focus on takedowns, throws, and controlling opponents. Develop strength and explosive power through wrestling techniques.',
            ],
        ];

        foreach ($memberships as $membership) {
            DB::table('memberships')->insert([
                'name' => $membership['name'],
                'description' => $membership['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
