<?php

namespace Database\Factories;

use App\Enums\DiscountMethod;
use App\Enums\DiscountTargetType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $method = fake()->randomElement(DiscountMethod::cases());
        $amount = match ($method) {
            DiscountMethod::PERCENTAGE => fake()->numberBetween(1, 10) * 10,
            DiscountMethod::FIXED_AMOUNT => fake()->numberBetween(1, 50) * 100 * 100,
        };
        return [
            'name' => fake()->colorName(),
            'method' => $method,
            'target' => DiscountTargetType::PRODUCT,
            'value' => $amount,
            'expires_at' => fake()->randomElement([null, now()->addDays(random_int(1, 7))]),
            // 'max_usage' => fake()->numberBetween(1, 3),
            // 'max_user_usage' => 1
        ];
    }

    public function withCode(): static
    {
        return $this->state(function() {
            return [
                'code' => 'OFF-' . fake()->unique()->randomNumber(3),
                'target' => DiscountTargetType::ORDER
            ];
        });
    }

    public function forShipping(): static
    {
        return $this->state(function() {
            return [
                'target' => DiscountTargetType::SHIPPING
            ];
        });
    }
}
