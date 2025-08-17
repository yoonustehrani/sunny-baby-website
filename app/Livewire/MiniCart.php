<?php

namespace App\Livewire;

use App\Facades\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class MiniCart extends Component
{
    public $cart_items = [];
    public array $sums;

    public function mount()
    {
        $this->fresh();
    }

    #[On('add-to-cart')]
    public function addToCart(string $productId)
    {
        Cart::update($productId, 1);
        $this->dispatch('cart-updated');
        $this->dispatch('cart-updated-product.' . $productId);
    }

    #[On('cart-updated')]
    public function fresh()
    {
        $this->cart_items = Cart::all();
        $this->sums = Cart::sums();
    }

    public function clear()
    {
        Cart::clear();
    }

    public function render()
    {
        return view('livewire.mini-cart');
    }
}
