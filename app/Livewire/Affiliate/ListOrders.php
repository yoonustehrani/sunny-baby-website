<?php

namespace App\Livewire\Affiliate;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.affiliate')]
class ListOrders extends Component
{
    public function render()
    {
        return view('livewire.affiliate.list-orders');
    }
}
