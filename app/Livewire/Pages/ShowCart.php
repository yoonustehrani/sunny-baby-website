<?php

namespace App\Livewire\Pages;

use App\Facades\Cart;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowCart extends Component
{
    public Collection $items;

    public function mount()
    {
        $this->updateItems();
    }

    #[On('cart-updated')]
    public function updateItems()
    {
        $this->items = Cart::all();
    }

    public function render()
    {
        return view('livewire.pages.cart')->title(__('Cart'));
    }
}
