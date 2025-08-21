<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\On;
use Livewire\Attributes\Session;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CheckoutForm extends Form
{
    #[Session]
    public string $fullname = '';

    #[Session]
    public string $email = '';

    #[Session]
    public string $phone = '';

    #[Session]
    public string $note = '';

    #[Session]
    public ?int $provinceId = null;

    #[Session]
    public ?int $cityId = null;
}
