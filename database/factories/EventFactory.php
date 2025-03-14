<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Models\Instructor;
use App\Models\Member;

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
            'name' => fake()->name(),
            'duration' => fake()->numberBetween(-10000, 10000),
            'date_time' => fake()->dateTime(),
            'location' => fake()->word(),
            'type' => fake()->word(),
            'instructor_id' => Instructor::factory(),
            'member_id' => Member::factory(),
        ];
    }
}
