<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CartService
{
    public const SESSION_KEY = 'user-cart';
    public Collection $items;
    // public Collection $options;
    /**
     * Create a new class instance.
     */
    public function __construct(
        array $cart,
    )
    {
        $this->items = collect($cart['items']);
        // $this->options = collect($cart['options']);
    }

    public static function getInstance(): static
    {
        return new self(
            Session::get(self::SESSION_KEY, [
                'items' => collect(),
                'options' => collect()
            ])
        );
    }

    public function all()
    {
        $products = Product::with('discount', 'variables.value')->whereIn('id', $this->items->keys())->get()->keyBy('id');
        return $this->items->map(function(int $quantity, $productId) use(&$products) {
            /**
             * @var \App\Models\Product
             */
            $p = $products->get($productId);
            return [
                'product' => $p,
                'quantity' => $quantity
            ];
        });
    }

    public function update(int|string $productId, int $quantity): self
    {
        if ($quantity == 0) {
            $this->items->pull($productId);
        } else $this->items->put($productId, $quantity);
        return $this->saveCartToSession();
    }

    public function remove(int|string $productId): self
    {
        $this->items->pull($productId);
        return $this->saveCartToSession();
    }

    public function clear(): void
    {
        Session::remove(self::SESSION_KEY);
    }

    protected function saveCartToSession(): self
    {
        Session::put(self::SESSION_KEY, $this->toArray());
        return $this;
    }

    public function sums()
    {
        $all = $this->all();
        $subtotal = $all->sum(fn($item) => $item['quantity'] * $item['product']->price);
        $total_discount = $all->sum(fn($item) => $item['quantity'] * $item['product']->getDiscountedPrice());
        $total = $subtotal - $total_discount;
        return compact('subtotal', 'total_discount', 'total');
    }

    public function count(): int
    {
        return $this->items->sum();
    }

    public function toArray(): array
    {
        return [
            'items' => $this->items->toArray(),
            // 'options' => $this->options->toArray()
        ];
    }
}
