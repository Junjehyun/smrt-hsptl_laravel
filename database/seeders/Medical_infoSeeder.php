<?php

namespace Database\Seeders;

use App\Models\Medical_info;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class Medical_infoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Medical_info::factory()->count(14)->create();
    }
}
