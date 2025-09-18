<?php

namespace App\Livewire\UserAccount;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user-account')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.user-account.dashboard')->title(__('Dashboard'));
    }
}
