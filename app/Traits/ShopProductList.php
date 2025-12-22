<?php

namespace App\Traits;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Cursor;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;

trait ShopProductList
{
    use ProductList;

    #[Url(except: '')]
    public string $brand = '';

    public Collection $products;
    public ?string $nextCursor = null;
    public ?bool $hasMorePages = null;
    public int $perPage = 16;
    
    public function updated($propertyName, $value)
    {
        $this->nextCursor = null;
        $this->hasMorePages = null;
        $this->products = $this->products->empty();
        $this->loadMore();
    }


    public function mount()
    {
        $this->loadMore();
    }

    public function loadMore()
    {
        if ($this->hasMorePages === false) {
            return;
        }
        $products = $this->getProducts(with: [], paginator: CursorPaginator::class, cursor: Cursor::fromEncoded($this->nextCursor));
        $this->products = isset($this->products) ? $this->products->push(...$products->items()) : $products->getCollection();
        $this->nextCursor = $products->nextCursor()?->encode();
        $this->hasMorePages = $products->hasMorePages();
        $this->products->load(['variants', 'images']);
    }

    public function unsetBrand()
    {
        $this->brand = '';
        $this->updated('brand', $this->brand);
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
