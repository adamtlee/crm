<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Models\Membership;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all memberships
        $memberships = Membership::all();
        
        // Create a Faker instance
        $faker = Faker::create();
        
        // Create videos for each membership
        foreach ($memberships as $membership) {
            // Create 5-10 videos for each martial art
            $videoCount = $faker->numberBetween(5, 10);
            
            for ($i = 0; $i < $videoCount; $i++) {
                $technique = $faker->randomElement([
                    'Basic', 'Advanced', 'Defense', 'Offense', 
                    'Counter', 'Combo', 'Drill', 'Sparring'
                ]);
                
                $title = "{$membership->name} $technique: " . $faker->words(3, true);
                
                Video::factory()->create([
                    'title' => $title,
                    'description' => "Learn {$technique} techniques for {$membership->name}. " . $faker->paragraph(2),
                ]);
            }
        }
        
        // Create some additional videos not tied to specific memberships
        $additionalVideos = $faker->numberBetween(10, 20);
        
        for ($i = 0; $i < $additionalVideos; $i++) {
            Video::factory()->create();
        }
    }
} 