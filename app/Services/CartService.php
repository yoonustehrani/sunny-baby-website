<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Livewire;

class CartService
{
    protected string $session_key;
    protected bool $is_affiliate;
    public Collection $items;
    public array $meta;
    /**
     * Create a new class instance.
     */
    public function __construct(
        array $cart,
        bool $is_affiliate = false
    )
    {
        $this->is_affiliate = $is_affiliate;
        $this->items = collect($cart['items']);
        $this->meta = $cart['meta'];
    }

    public static function getInstance(bool $is_affiliate = false): static
    {
        $key = $is_affiliate ? 'affiliate-cart' : 'user-cart';
        return new self(
            cart: Session::get($key, [
                'items' => [],
                'meta' => []
            ]),
            is_affiliate: false
        );
    }

    public function all()
    {
        if ($this->items->isEmpty()) {
            return $this->items;
        }
        static $products;
        if (! $products) {
            $products = Product::with('discount', 'attribute_options.attribute', 'images', 'parent')->whereIn('id', $this->items->keys())->get()->keyBy('id');
        }
        
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

    public function getProductQuantity(string|int $productId)
    {
        return $this->items->get($productId) ?? 0;
    }

    public function has(string $productId): bool
    {
        return $this->items->has($productId);
    }

    public function update(int|string $productId, int $quantity): self
    {
        if ($quantity == 0) {
            $this->remove($productId);
        } else $this->items->put($productId, $quantity);
        return $this->saveCartToSession();
    }

    public function add(int|string $productId, int $quantity = 1)
    {
        if ($this->getProductQuantity($productId) == 0) {
            $this->update($productId, 1);
        } else {
            $this->update($productId, $this->getProductQuantity($productId) + $quantity);
        }
    }

    public function sub(int|string $productId)
    {
        if ($this->getProductQuantity($productId) == 1) {
            $this->remove($productId);
        } else {
            $this->update($productId, $this->getProductQuantity($productId) - 1);
        }
    }

    public function remove(int|string $productId): self
    {
        $this->items->pull($productId);
        return $this->saveCartToSession();
    }

    public function clear(): void
    {
        Session::remove($this->session_key);
    }

    protected function saveCartToSession(): self
    {
        Session::put($this->session_key, $this->toArray());
        return $this;
    }

    public function getTotalWeight()
    {
        return $this->all()->sum(fn($item) => $item['quantity'] * $item['product']->weight);
    }

    public function sums()
    {
        $all = $this->all();
        $price_key = $this->is_affiliate ? 'affiliate_price' : 'price';
        $subtotal = $all->sum(fn($item) => $item['quantity'] * $item['product']->{$price_key});
        $total_discount = 0;
        if (! $this->is_affiliate) {
            $total_discount = $all->filter(fn($item) => !is_null($item['product']->discount))->sum(fn($item) => $item['quantity'] * $item['product']->discount_amount);
        }
        $total = $subtotal - $total_discount;
        return compact(
            'subtotal',
            'total_discount',
            'total'
        );
    }

    public function count(): int
    {
        return $this->items->sum();
    }

    public function setMeta(string $key, mixed $value): void
    {
        $this->meta[$key] = $value;
        $this->saveCartToSession();
    }

    public function toArray(): array
    {
        return [
            'items' => $this->items->toArray(),
            'meta' => $this->meta
        ];
    }
}
