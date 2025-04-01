<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Instructor;

class InstructorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Instructor::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $specializationNames = ['Muay Thai', 'Boxing', 'Kickboxing', 'MMA', 'Brazilian Jiu Jitsu'];

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birth_date' => $this->faker->date(),
            'email_address' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'specialization' => $this->faker->randomElement($specializationNames),
        ];
    }
}
