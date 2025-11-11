<?php

namespace App\Livewire\Pages;

use App\Traits\ShopProductList;
use Livewire\Component;

class Shop extends Component
{
    use ShopProductList;

    public function render()
    {
        return view('livewire.pages.shop', array_merge(['brands' => $this->getBrands()], $this->getData()))
            ->title(__('Shop'));
    }
}
