<?php

namespace Database\Seeders;

use App\Models\WardManager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WardManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        WardManager::factory()->count(10)->create();
    }
}
