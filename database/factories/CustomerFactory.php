<?php

namespace Database\Factories;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;
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
            'customer_no' => 'K' . str_pad($customer_no++, 3, '0', STR_PAD_LEFT),
            'name' => $this->faker->name,
            'sex' => $this->faker->randomElement(['男', '女']),
            'birthdate' => $this->faker->date('Ymd'),
            'telephone' => $this->faker->phoneNumber,
            'address' => $this->faker->optional()->address,
            'ward_code' => $this->faker->optional()->regexify('[A-Z0-9]{10}'),
            'room_code' => $this->faker->optional()->regexify('[A-Z]{1}[0-9]{3}'),
            'bed_no' => $this->faker->optional()->regexify('[A-Z0-9]{5}'),
            'blood_type' => $this->faker->randomElement([
                'A型', 
                'B型', 
                'AB型', 
                'O型',
                'A-型', 
                'B-型', 
                'AB-型', 
                'O-型',
            ]),
            'severity' => $this->faker->optional()->randomElement(['低', '中', '高']),
            'fall' => $this->faker->randomElement(['Yes', 'No']),
            'hospitalized_date' => $this->faker->dateTime,
            'remarks' => $this->faker->optional()->sentence,
            'old_ward_code' => $this->faker->optional()->regexify('[A-Z0-9]{10}'),
            'old_room_code' => $this->faker->optional()->regexify('[A-Z0-9]{10}'),
            'old_bed_no' => $this->faker->optional()->regexify('[A-Z0-9]{5}'),
            'status' => $this->faker->randomElement(['01', '03']),
            'device_seq' => $this->faker->optional()->randomNumber,
            'device_name' => $this->faker->optional()->word,
            'creator_id' => $this->faker->optional()->randomNumber,
            'updater_id' => $this->faker->optional()->randomNumber,
        ];
    }
}
