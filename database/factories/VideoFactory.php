<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $durations = [60, 120, 180, 240, 300, 600, 900, 1200]; // 1min, 2min, 3min, 4min, 5min, 10min, 15min, 20min
        $duration = $this->faker->randomElement($durations);
        
        $martialArts = [
            'MMA', 'Boxing', 'Kickboxing', 'Muay Thai', 
            'Brazilian Jiu-Jitsu', 'Wrestling'
        ];
        
        $martialArt = $this->faker->randomElement($martialArts);
        $technique = $this->faker->randomElement([
            'Basic', 'Advanced', 'Defense', 'Offense', 
            'Counter', 'Combo', 'Drill', 'Sparring'
        ]);
        
        $title = "$martialArt $technique: " . $this->faker->words(3, true);
        
        return [
            'title' => $title,
            'description' => $this->faker->paragraph(3),
            'url' => 'https://example.com/videos/' . $this->faker->uuid,
            'thumbnail_url' => 'https://example.com/thumbnails/' . $this->faker->uuid . '.jpg',
            'duration' => $duration,
            'views' => $this->faker->numberBetween(10, 10000),
        ];
    }
} 