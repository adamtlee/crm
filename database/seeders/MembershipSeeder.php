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
                'price' => 100.00,
            ],
            [
                'name' => 'Boxing',
                'description' => 'Traditional boxing program focusing on footwork, punching combinations, and defensive techniques.',
                'price' => 90.00,
            ],
            [
                'name' => 'Kickboxing',
                'description' => 'Combines boxing with kicking techniques. Perfect for developing striking skills with both hands and feet.',
                'price' => 95.00,
            ],
            [
                'name' => 'Muay Thai',
                'description' => 'The art of eight limbs. Learn traditional Thai boxing including punches, kicks, elbows, and knee strikes.',
                'price' => 110.00,
            ],
            [
                'name' => 'Brazilian Jiu-Jitsu',
                'description' => 'Ground fighting and submission grappling. Master the art of controlling and submitting opponents on the ground.',
                'price' => 105.00,
            ],
            [
                'name' => 'Wrestling',
                'description' => 'Focus on takedowns, throws, and controlling opponents. Develop strength and explosive power through wrestling techniques.',
                'price' => 85.00,
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
