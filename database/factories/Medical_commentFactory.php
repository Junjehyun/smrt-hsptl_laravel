<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medical_comment>
 */
class Medical_commentFactory extends Factory
{
    protected $model = \App\Models\Medical_comment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $customer_no = 1;

        return [
            //
            //'customer_no' => $this->faker->unique()->numerify('CUST####'),
            'customer_no' => 'K' . str_pad($customer_no++, 3, '0', STR_PAD_LEFT),
            'department_code' => $this->faker->optional()->regexify('[A-Z0-9]{8}'),
            'employ_id' => $this->faker->optional()->numerify('管理者####'),
            'comments' => $this->faker->optional()->sentence,
            'create_date' => $this->faker->dateTime,
        ];
    }
}
