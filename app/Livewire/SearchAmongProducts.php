<?php

namespace App\Livewire;

use Livewire\Component;

class SearchAmongProducts extends Component
{
    public string $search = '';

    public function render()
    {
        return view('livewire.search-among-products');
    }
}
