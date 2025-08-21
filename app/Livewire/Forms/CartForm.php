<?php

namespace App\Livewire\Forms;

use App\Facades\Cart;
use Livewire\Attributes\Session;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CartForm extends Form
{
    #[Session()]
    public string $note = '';

    public function save()
    {
        Cart::setMeta('note', $this->note ?: '');
    }
}
