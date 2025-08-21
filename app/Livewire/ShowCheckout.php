<?php

namespace App\Livewire;

use App\Facades\Cart;
use App\Livewire\Forms\CheckoutForm;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowCheckout extends Component
{
    public CheckoutForm $form;

    public function mount()
    {
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

    public function render()
    {
        return view('livewire.show-checkout')->title(__('Check out'));
    }
}
