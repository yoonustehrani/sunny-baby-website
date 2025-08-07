<?php

namespace App\Livewire;

use App\Facades\Cart;
use App\Models\Product;
use Livewire\Component;

class MiniCartItem extends Component
{
    public Product $product;
    public int $quantity;

    public function add()
    {
        Cart::update($this->product->id, $this->quantity + 1);
    }

    public function sub()
    {
        Cart::update($this->product->id, $this->quantity - 1);
    }

    public function remove()
    {
        Cart::remove($this->product->id);
    }

    public function render()
    {
        return view('livewire.mini-cart-item');
    }
}
