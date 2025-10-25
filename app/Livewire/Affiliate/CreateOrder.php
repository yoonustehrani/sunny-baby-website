<?php

namespace App\Livewire\Affiliate;

use App\Traits\ProductList;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.affiliate')]
class CreateOrder extends Component
{
    use ProductList;

    public int $perPage = 10;

    public function render()
    {
        return view('livewire.affiliate.create-order', $this->getData(productsWith: ['variants' => function($q) {
            $q->with('images', 'attribute_options');
        }, 'images']));
    }
}
