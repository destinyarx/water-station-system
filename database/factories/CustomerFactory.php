<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'cellphone_number' => fake()->numerify('###########'), // 13 digits
            'email' => fake()->unique()->safeEmail(),
            'messenger_name' => fake()->userName(),
            'status' => fake()->randomElement(['0', '1']),
            'created_at' => now(),
            'updated_at' => null,
            'deleted_at' => null,
        ];
    }
}
