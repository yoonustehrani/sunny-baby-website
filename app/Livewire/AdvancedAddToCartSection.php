<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AdvancedAddToCartSection extends Component
{
    public Product $product;

    #[Validate('required|integer|min:1')]
    public int $n = 1;

    public function decrement()
    {
        if ($this->n < 1) return;
        $this->n--;
    }

    public function increment()
    {
        if ($this->n == $this->product->quantity) return;
        $this->n++;
    }

    public function render()
    {
        return view('livewire.advanced-add-to-cart-section');
    }
}
