<?php

namespace App\Livewire;

use App\Facades\Cart;
use Livewire\Component;

class MiniCart extends Component
{
    public function clear()
    {
        Cart::clear();
    }

    public function render()
    {
        $cart_items = Cart::all();
        $sums = Cart::sums();
        return view('livewire.mini-cart', compact('cart_items', 'sums'));
    }
}
