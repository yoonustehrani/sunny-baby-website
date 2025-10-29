<?php

namespace App\Livewire;

use App\Models\Product;
use App\Traits\SearchProducts;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SearchAmongProducts extends Component
{
    use SearchProducts;

    public function render()
    {
        $products = $this->getSearchResults();
        return view('livewire.search-among-products', compact('products'));
    }
}
