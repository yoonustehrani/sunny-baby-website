<?php

namespace App\Livewire\Pages;

use App\Models\Brand;
use App\Traits\ProductList;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;

class Shop extends Component
{
    use ProductList;

    #[Url(except: '')]
    public string $brand = '';

    public function unsetBrand()
    {
        $this->brand = '';
    }

    public function render()
    {
        $brands = Brand::with('image')->select('brands.*', DB::raw('COUNT(p.id) as results_count'))
            ->joinSub($this->baseProductQuery(), 'p', function($join) {
                $join->on('brands.id', '=', 'p.brand_id');
            })
            ->groupBy('brands.id')
            ->get();

        return view('livewire.pages.shop', array_merge(compact('brands'), $this->getData()))
            ->title(__('Shop'));
    }
}
