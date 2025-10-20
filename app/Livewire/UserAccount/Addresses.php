<?php

namespace App\Livewire\UserAccount;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user-account')]
class Addresses extends Component
{
    public function render()
    {
        return view('livewire.user-account.addresses')
            ->title(__('Addresses'));
    }
}
