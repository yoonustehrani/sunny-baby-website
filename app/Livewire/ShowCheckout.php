<?php

namespace App\Livewire;

use App\Facades\Cart;
use App\Livewire\Forms\CheckoutForm;
use App\Livewire\Pages\ShowCart;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('cart-updated')]
class ShowCheckout extends Component
{
    public CheckoutForm $form;

    public function mount()
    {
        if (Cart::count() == 0) {
            $this->redirect(ShowCart::class);
        }
        if ($this->form->note == '') {
            $this->form->note = Cart::toArray()['meta']['note'] ?? '';
        }
    }

    #[On('select.option.province')]
    public function provinceSelected(int $id)
    {
        $this->form->provinceId = $id;
    }

    #[On('unselect.option.province')]
    public function provinceUnselected()
    {
        $this->form->provinceId = null;
        $this->cityUnselected();
    }

    #[On('select.option.city')]
    public function citySelected(int $id)
    {
        $this->form->cityId = $id;
    }

    #[On('unselect.option.city')]
    public function cityUnselected()
    {
        $this->form->cityId = null;
    }

    public function setCarrierClass(?string $class = null)
    {
        $this->form->carrier_class = $class;
    }

    public function render()
    {
        $total = Cart::sums()['total'];
        return view('livewire.show-checkout', compact('total'))->title(__('Check out'));
    }
}
