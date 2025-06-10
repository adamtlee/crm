<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Event;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(4),
            'duration' => $this->faker->numberBetween(30, 120),
            'date_time' => $this->faker->dateTimeBetween('now', '+1 month'),
            'location' => $this->faker->address,
            'type' => $this->faker->word,
        ];
    }
}
