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
        $query = $this->category->products()->notVariants()->latest()->take(10);
        $this->hasProducts = $query->count() > 0;
        if ($this->hasProducts) {
            $this->products = $query->with('discount', 'variants', 'images')->get();
        }
    }

    public function render()
    {
        return view('livewire.category-products-row');
    }
}
