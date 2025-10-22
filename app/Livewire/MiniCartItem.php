<?php

namespace App\Livewire;

use App\Facades\Cart;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class MiniCartItem extends Component
{
    public Product $product;
    public int $quantity;

    protected function dispatchEvents()
    {
        $this->dispatch('cart-updated');
        $this->dispatch('cart-updated-product.' . $this->product->id);
    }

    public function add()
    {
        try {
            ++$this->quantity;
            Cart::update($this->product->id, $this->quantity);
            $this->dispatchEvents();
            $this->dispatch('alert', type: 'success', message: __("Added to cart"));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function sub()
    {
        try {
            --$this->quantity;
            Cart::update($this->product->id, $this->quantity);
            $this->dispatchEvents();
            $this->dispatch('alert', type: 'success', message: __("Subtracted from cart"));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function remove()
    {
        try {
            Cart::remove($this->product->id);
            $this->dispatchEvents();
            $this->dispatch('alert', type: 'info', message: __("Removed from cart"));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function render()
    {
        return view('livewire.mini-cart-item');
    }
}
