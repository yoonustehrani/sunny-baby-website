<?php

namespace App\Livewire\Affiliate;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.affiliate')]
class ListOrders extends Component
{
    use WithPagination;

    public int $perPage = 10;

    public function render()
    {
        $orders = Auth::user()->orders()->paginate($this->perPage);
        return view('livewire.affiliate.list-orders', compact('orders'));
    }
}
