<?php

namespace App\Livewire\Affiliate;

use Livewire\Component;

class Cart extends Component
{
    protected $listeners = [
        'cart-updated' => '$refresh'
    ];
    public function render()
    {
        return view('livewire.affiliate.cart', [
            'cart' => affiliate_cart()
        ]);
    }
}
