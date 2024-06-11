<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MasterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'master_key' => $this->faker->regexify('[A-Z]{3}'),
            'master_name' => $this->faker->randomElement(['Doctor', 'Nurse', 'Patient']),
            'item_code' => $this->faker->regexify('[0-9]{5}'),
            'item_name' => $this->faker->words(2, true),
            'item_nm_short' => $this->faker->optional()->words(1, true),
            'item_nm_eng' => $this->faker->optional()->words(3, true),
            'order' => $this->faker->optional()->numberBetween(1, 100),
            'use_flag' => $this->faker->boolean,
            'remarks' => $this->faker->optional()->sentence,
            //
        ];
    }
}
