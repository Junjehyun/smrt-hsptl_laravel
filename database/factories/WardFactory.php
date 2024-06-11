<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ward>
 */
class WardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $wardCodes = ['1000', '2000', '3000', '4000', '5000'];
        static $index = 0;

        return [
            //
        'ward_type' => $this->faker->randomElement(['01', '02', '03']),
        'ward_code' => $wardCodes[$index++ % count($wardCodes)],
        'ward_name' => $this->faker->words(3, true),
        'ward_description' => $this->faker->sentence(),
        'coordinator_code' => $this->faker->regexify('[A-Z0-9]{5}'),
        'bgcolor' => $this->faker->hexcolor,
        'image_name' => $this->faker->image('public/images', 640, 480, null, false),
        'remarks' => $this->faker->sentence(),
        'created_at' => now(),
        'updated_at' => now(),
        ];
    }
}
