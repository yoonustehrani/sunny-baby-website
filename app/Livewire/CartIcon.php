<?php

namespace App\Livewire;

use App\Facades\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component
{
    public int $count;
    public bool $mobile = false;

    public function mount()
    {
        $this->updateCount();
    }

    #[On('cart-updated')]
    public function updateCount()
    {
        $this->count = Cart::count();
    }

    public function render()
    {
        if ($this->mobile) {
            return view('livewire.cart-icon-mobile');
        }
        return view('livewire.cart-icon');
    }
}
