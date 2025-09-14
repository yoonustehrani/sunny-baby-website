<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;

class LoginModal extends Component
{
    #[Validate('required|numeric|regex:/09[0-9]{9}/')]
    public string $phone_number = '';
    public function render()
    {
        return view('livewire.login-modal');
    }
}
