<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Traits\ShopProductList;
use Livewire\Component;

class Shop extends Component
{
    use ShopProductList;

    public function render()
    {
        $topCategories = Category::with('image')->whereNull('parent_id')->get();
        return view('livewire.pages.shop', array_merge(['brands' => $this->getBrands()], $this->getData()))
            ->with('topCategories', $topCategories)
            ->title(__('Shop'));
    }
}
