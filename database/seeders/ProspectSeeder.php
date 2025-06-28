<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prospect;

class ProspectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 prospects with the specified data format
        Prospect::factory(20)->create();
        
        $this->command->info('20 prospects created successfully!');
    }
}
