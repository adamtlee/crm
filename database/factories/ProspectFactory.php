<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Prospect;

class ProspectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prospect::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $lastInitial = strtolower(substr($lastName, 0, 1));
        $email = strtolower($firstName) . $lastInitial . '@doxtera.com';
        
        // Generate a contact date between 2024-01-01 and 2025-06-28
        $contactDate = $this->faker->dateTimeBetween('2024-01-01', '2025-06-28');
        
        return [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email_address' => $email,
            'phone_number' => '000-000-0000',
            'description' => 'Contact date: ' . $contactDate->format('Y-m-d'),
        ];
    }
}
