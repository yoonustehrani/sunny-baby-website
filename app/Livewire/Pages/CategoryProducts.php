<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Traits\ShopProductList;
use Livewire\Component;

class CategoryProducts extends Component
{
    use ShopProductList;

    public Category $category;

    public function mount($slug)
    {
        $this->category = Category::whereSlug($slug)->firstOrFail();
    }

    public function render()
    {
        $topCategories = Category::with('image')->where('parent_id', $this->category->getKey())->get();
        return view('livewire.pages.shop', array_merge(['brands' => $this->getBrands()], $this->getData()))
            ->with('topCategories', $topCategories)
            ->title($this->category->name);
    }
}
