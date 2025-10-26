<?php

namespace App\Livewire\Affiliate;

use App\Models\Product;
use App\Traits\ProductCartMethods;
use Livewire\Component;

class OrderRow extends Component
{
    use ProductCartMethods;
    
    public Product $product;
    public int $index;

    public function render()
    {
        return view('livewire.affiliate.order-row');
    }
}
