<?php

namespace App\Livewire\Affiliate;

use App\Models\Product;
use App\Traits\ProductCartMethods;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductRow extends Component
{
    use ProductCartMethods;
    
    public Product $product;

    public function render()
    {
        return view('livewire.affiliate.product-row');
    }
}
