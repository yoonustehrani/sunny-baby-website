<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CategoryProductsRow extends Component
{
    public Category $category;
    public bool $hasProducts;
    public ?Collection $products;

    public function mount()
    {
        $this->hasProducts = $this->category->products()->count() > 0;
        if ($this->hasProducts) {
            $this->products = $this->category->products()->with('discount')->latest()->take(10)->get();
        }
    }

    public function render()
    {
        return view('livewire.category-products-row');
    }
}
