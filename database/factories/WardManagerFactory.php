<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WardManager>
 */
class WardManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $wardCodes = ['1000', '2000', '3000', '4000', '5000'];

        return [
            //
            'user_id' => $this->faker->numberBetween(10,99),
            'ward_code' => $this->faker->randomElement($wardCodes),
            'creator_id' => $this->faker->numberBetween(10,99),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
