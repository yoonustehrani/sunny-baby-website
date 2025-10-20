<?php

namespace App\Livewire\Pages;

use App\Traits\LoginMethods;
use Livewire\Component;

class ShowLogin extends Component
{
    use LoginMethods;

    public function render()
    {
        return view('livewire.pages.show-login')->title(__('Login') . '/' . __('Register'));
    }
}
