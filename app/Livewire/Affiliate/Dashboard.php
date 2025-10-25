<?php

namespace App\Livewire\Affiliate;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.affiliate')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.affiliate.dashboard', [
            'user' => Auth::user()
        ])->title(__('Dashboard'));
    }
}
