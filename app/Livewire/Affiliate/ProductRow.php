<?php

namespace App\Livewire\Affiliate;

use App\Models\Product;
use Livewire\Component;

class ProductRow extends Component
{
    public Product $product;
    
    public function render()
    {
        return view('livewire.affiliate.product-row');
    }
}
