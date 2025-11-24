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

    public bool $minimal = false;

    public function render()
    {
        $view = 'livewire.search-among-products';
        if ($this->minimal) {
            $view .= '-minimal';
        }
        $products = $this->getSearchResults();
        return view($view, compact('products'));
    }
}
