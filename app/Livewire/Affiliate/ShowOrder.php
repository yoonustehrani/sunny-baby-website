<?php

namespace App\Livewire\Affiliate;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.affiliate')]
class ShowOrder extends Component
{
    public Order $order;
    
    public function mount(Order $order)
    {
        $order->load(['items' => function($q) {
            $q->with(['product' => function($qx) {
                $qx->with('parent', 'attribute_options');
            }]);
        }]);
    }

    public function render()
    {
        return view('livewire.affiliate.show-order');
    }
}
