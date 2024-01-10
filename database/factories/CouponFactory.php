<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //12 letter capital letter coupon code
            'code' => fake()->unique()->regexify('[A-Z]{12}'),
            'value' => fake()->numberBetween(1, 10)*10,
            'used' => 0,
            'active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
