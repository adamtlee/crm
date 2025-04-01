<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Membership;

class MembershipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Membership::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $membershipNames = ['Muay Thai', 'Boxing', 'Kickboxing', 'MMA', 'Brazilian Jiu Jitsu'];

        return [
            'name' => $this->faker->randomElement($membershipNames),
            'description' => $this->faker->paragraph,
        ];
    }
}
