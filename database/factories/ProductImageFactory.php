<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $n = random_int(1, 15);
        return [
            'url' => 'images/products/photo-' . $n . '.jpg',
            'thumbnail_url' => 'images/products/photo-' . $n . '.jpg'
        ];
    }

    public function main()
    {
        return $this->state([
            'is_main' => true
        ]);
    }
}
