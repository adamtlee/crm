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
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birth_date' => $this->faker->date(),
            'email_address' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'emergency_contact_name' => $this->faker->name,
            'emergency_contact_phone_number' => $this->faker->phoneNumber,
            'membership_id' => null, // We'll set this in the seeder
        ];
    }
}
