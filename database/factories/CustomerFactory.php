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
            'internet_plans_id' => null,
            'customer_code' => 'CUS-' . str_pad(fake()->unique()->numberBetween(1, 99999), 5, '0', STR_PAD_LEFT),
            'nik' => fake()->numerify('################'),
            'address' => fake()->address(),
            'postal_code' => fake()->postcode(),
            'longitude' => fake()->longitude(),
            'latitude' => fake()->latitude(),
            'status' => fake()->randomElement([
                'active',
                'pending',
                'suspended',
                'terminated'
            ]),
        ];
    }
}
