<?php

namespace Database\Factories;

use App\Enums\DiscountMethod;
use App\Enums\ProductType;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected function random_price()
    {
        return random_int(10, 200) * 10_000;
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(
                random_int(1, 5), true
            ),
            'type' => ProductType::SIMPLE,
            'slug' => fake()->unique()->slug(),
            'description' => fake()->paragraph(),
            'price' => $this->random_price(),
            'stock' => random_int(0, 20),
            'reserved' => 0,
            'weight' => random_int(1, 20) * 100,
            'is_active' => true
        ];
    }
    public function variable(): Factory
    {
        return $this->state(fn(array $state) => [
            'type' => ProductType::VARIABLE,
            'price' => null,
            'reserved' => null,
            'weight' => null,
        ]);
    }
    public function variation()
    {
        return $this->state(fn(array $state) => [
            'type' => ProductType::VARIATION,
            'title' => null,
            'description' => null,
            'slug' => null
        ]);
    }
    public function withDiscount()
    {
        return $this->state(fn () => [
            'discount_id' => Discount::factory()->byMethod(DiscountMethod::PERCENTAGE)
        ]);
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $product->categories()->attach(
                Category::whereNull('parent_id')->inRandomOrder()->first()->id
            );
            // main image
            $product->images()->attach(
                Image::factory()->create()->id,
                ['is_main' => true]
            );

            // non-main image
            $product->images()->attach(
                Image::factory()->create()->id,
                ['is_main' => false]
            );
        });
    }
}
