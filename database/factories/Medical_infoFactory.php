<?php

namespace Database\Factories;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medical_info>
 */
class Medical_infoFactory extends Factory
{

    protected $model = \App\Models\Medical_info::class;
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
            'department' => $this->faker->randomElement([
                '内科', '消化器内科', '循環器内科', '呼吸器内科', '内分泌内科', '血液内科', '腫瘍内科', 
                '腎臓内科', '心臓内科', '感染内科', 'アレルギー内科', 'リウマチ内科'
            ]),
            'doctor_name' => $this->faker->name,
            'department_code' => $this->faker->bothify('DEPT####'),
            'severity' => $this->faker->randomElement(['1群', '2群', '3群']),
            'fall' => $this->faker->randomElement(['低危険', '中危険', '高危険']),
            'blood_warn' => $this->faker->boolean,
            'contact_warn' => $this->faker->boolean,
            'air_warn' => $this->faker->boolean,
            'current_flag' => true,
            'remarks' => $this->faker->optional()->sentence,
            'creator_id' => $this->faker->optional()->randomNumber,
            'updater_id' => $this->faker->optional()->randomNumber,
        ];
    }
}
