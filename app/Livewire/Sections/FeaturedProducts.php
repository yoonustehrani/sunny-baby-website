<?php

namespace App\Livewire\Sections;

use App\Models\Product;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class FeaturedProducts extends Component
{
    public Product $product;
    public string $title;

    public function render()
    {
        $products = $this->product->featured_products()->with(['variants', 'images'])->get();
        return view('livewire.sections.products-carousel', ['products' => $products]);
    }
}
