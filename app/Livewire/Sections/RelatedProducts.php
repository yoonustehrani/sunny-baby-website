<?php

namespace App\Livewire\Sections;

use App\Models\Product;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class RelatedProducts extends Component
{
    public Product $product;
    public string $title;

    protected function getCategoryIds()
    {
        $categories = $this->product->categories;
        if ($categories->count() < 2) {
            return $categories;
        }
        return $categories->filter(fn($c) => ! is_null($c->parent_id));
    }

    public function render()
    {
        $products = $this->getCategoryIds()->first()->products()->where('id', '<>', $this->product->id)->notVariants()->limit(10)->get();
        return view('livewire.sections.products-carousel', ['products' => $products]);
    }
}
