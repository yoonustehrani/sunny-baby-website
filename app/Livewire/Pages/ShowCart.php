<?php

namespace App\Livewire\Pages;

use App\Facades\Cart;
use App\Livewire\Forms\CartForm;
use App\Livewire\ShowCheckout;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowCart extends Component
{
    public Collection $items;
    public bool $isEmpty;
    public array $sums;
    public CartForm $form;

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


    public function checkout()
    {
        $this->form->save();
        $this->redirect(ShowCheckout::class);
    }

    public function render()
    {
        return view('livewire.pages.cart')->title(__('Cart'));
    }
}
