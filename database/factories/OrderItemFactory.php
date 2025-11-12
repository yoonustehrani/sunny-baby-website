<?php

namespace Database\Factories;

use App\Enums\ProductType;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $p = Product::where('type', '<>', ProductType::VARIABLE)->with('discount')->inRandomOrder()->first();
        return [
            'product_id' => $p,
            'unit_price' => $p->price,
            'unit_discount' => $p->is_discounted ? $p->discount_amount : 0,
            'quantity' => fake()->randomElement([1,1,1,2,2,3,4,1,1])
        ];
    }

    public function withAffiliatePrice()
    {
        return $this->state(fn(array $state) => [
            'unit_price' => $state['product_id']->affiliate_price,
            'unit_discount' => 0
        ]);
    }
}
