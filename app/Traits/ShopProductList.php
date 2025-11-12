<?php

namespace App\Traits;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;

trait ShopProductList
{
    use ProductList;

    #[Url(except: '')]
    public string $brand = '';

    public function unsetBrand()
    {
        $this->brand = '';
    }

    public function getBrands()
    {
        return Brand::with('image')->select('brands.*', DB::raw('COUNT(p.id) as results_count'))
            ->joinSub($this->baseProductQuery(), 'p', function($join) {
                $join->on('brands.id', '=', 'p.brand_id');
            })
            ->groupBy('brands.id')
            ->get();
    }
}
