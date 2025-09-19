<?php

namespace App\Livewire\UserAccount;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.user-account')]
class Orders extends Component
{
    use WithPagination;

    public function render()
    {
        
        return view('livewire.user-account.orders')
            ->with('orders', Auth::user()->orders()->withCount('items')->paginate(10))
            ->title(__('My Orders'));
    }
}
