<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Models\Membership;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'birth_date' => fake()->date(),
            'email_address' => fake()->word(),
            'phone_number' => fake()->phoneNumber(),
            'emergency_contact_name' => fake()->word(),
            'emergency_contact_phone_number' => fake()->word(),
            'membership_id' => Membership::factory(),
        ];
    }
}
