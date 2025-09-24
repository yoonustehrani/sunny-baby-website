<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class NewArrivalsSection extends Component
{
    public Collection $products;

    public function mount()
    {
        $this->products = Cache::remember('new-arrivals', 60 * 60, function() {
            return \App\Models\Product::notVariants()->with('discount', 'variants', 'images')->take(12)->latest()->get();
        });
    }

    public function render()
    {
        return view('livewire.new-arrivals-section');
    }
}
