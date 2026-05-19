<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{

    protected static int $customerCode = 1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => 1,
            'user_id' => User::factory(),
            'customer_code' => 'CUS-' . str_pad(static::$customerCode++, 5, '0', STR_PAD_LEFT),
            'nik' => fake()->numerify('################'),
            'address' => fake()->address(),
            'postal_code' => fake()->postcode(),
            'longitude' => fake()->longitude(95.0, 141.0),
            'latitude' => fake()->latitude(-11.0, 6.0),
            'status' => fake()->randomElement([
                'active',
                'inactive'
            ]),
        ];
    }
}
