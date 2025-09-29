<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class BottomAddToCart extends Component
{
    public Product $product;
    public ?int $selectedVariant;

    public function render()
    {
        return view('livewire.product.bottom-add-to-cart');
    }
}
