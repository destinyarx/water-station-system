<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    protected $model = Address::class;

    protected static $customerCounter = 11;

    public function definition(): array
    {

        return [
            'customer_id' => self::$customerCounter++,
            'description' => $this->faker->text(50),
            'unit_number' => $this->faker->numerify('Unit ###'),
            'street' => $this->faker->streetName(),
            'barangay' => $this->faker->word(),
            'municipality' => $this->faker->city(),
            'province' => $this->faker->state(),
            'created_at' => now(),
            'updated_at' => null,
        ];
    }
}
