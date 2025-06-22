<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instructor;
use Illuminate\Support\Carbon;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $firstNames = [
            'Gae', 'Armin', 'Jeng', 'King', 'Zen', 'Aot', 'Chama', 'Khunsuek', 'Golf', 'Chang', 'Phanlite', 'Puri'
        ];

        foreach ($firstNames as $firstName) {
            Instructor::create([
                'first_name' => $firstName,
                'last_name' => 'superbontrainingcamp',
                'birth_date' => now()->subYears(rand(20, 40))->subDays(rand(0, 365)),
                'email_address' => strtolower($firstName) . '@superbontrainingcamp.com',
                'phone_number' => '000-000-0000',
                'specialization' => 'Muay Thai',
            ]);
        }
    }
} 