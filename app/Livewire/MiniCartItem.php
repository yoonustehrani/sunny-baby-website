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
        ++$this->quantity;
        Cart::update($this->product->id, $this->quantity);
        $this->dispatchEvents();
    }

    public function sub()
    {
        --$this->quantity;
        Cart::update($this->product->id, $this->quantity);
        $this->dispatchEvents();
    }

    public function remove()
    {
        Cart::remove($this->product->id);
        $this->dispatchEvents();
    }

    public function render()
    {
        return view('livewire.mini-cart-item');
    }
}
