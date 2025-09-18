<?php

namespace App\Livewire\UserAccount;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.user-account')]
class Orders extends Component
{
    public Collection $orders;

    public function mount()
    {
        $this->orders = Auth::user()->orders()->withCount('items')->paginate(10);
    }

    public function render()
    {
        return view('livewire.user-account.orders')
            ->title(__('My Orders'));
    }
}
