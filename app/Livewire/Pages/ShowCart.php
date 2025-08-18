<?php

namespace App\Livewire\Pages;

use App\Facades\Cart;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowCart extends Component
{
    public Collection $items;
    public bool $isEmpty;
    public array $sums;

    public function mount()
    {
        $this->updateItems();
    }

    #[On('cart-updated')]
    public function updateItems()
    {
        $this->items = Cart::all();
        $this->isEmpty = Cart::count() == 0;
        $this->sums = Cart::sums();
    }

    // #[On('removeItem')]
    // public function removeItem($id)
    // {
    //     \Log::alert($id);
    //     // Cart::remove($id);
    // }

    public function render()
    {
        \Log::alert($this->sums);
        return view('livewire.pages.cart')->title(__('Cart'));
    }
}
