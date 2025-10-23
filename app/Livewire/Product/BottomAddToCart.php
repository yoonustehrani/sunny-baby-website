<?php

namespace App\Livewire\Product;

use App\Enums\ProductType;
use App\Facades\Cart;
use App\Models\Product;
use Livewire\Component;

class BottomAddToCart extends Component
{
    public Product $product;
    public string $selectedVariant = '';
    public int $n = 1;

    public function updatedSelectedVariant()
    {
        $this->n = 1;
        // $this->n = Cart::getProductQuantity($this->selectedVariant);
    }

    public function decrement()
    {
        if ($this->n < 1) return;
        $this->n--;
    }

    public function increment()
    {
        // if ($this->n == $this->product->quantity) return;
        $this->n++;
    }

    public function addToCart()
    {
        $productId = $this->product->type == ProductType::VARIABLE ? $this->selectedVariant : $this->product->id;
        if (! $productId) {
            return;
        }
        try {
            Cart::add($productId, $this->n);
            $this->dispatch('cart-updated');
            $this->dispatch('cart-updated-product.'. $productId);
            $this->n = 1;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function render()
    {
        return view('livewire.product.bottom-add-to-cart');
    }
}
