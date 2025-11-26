<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Traits\ShopProductList;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\Cursor;
use Illuminate\Support\Collection;
// use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Shop extends Component
{
    use ShopProductList;

    public EloquentCollection $products;
    public ?string $nextCursor = null;
    public ?bool $hasMorePages = null;
    public int $perPage = 16;
    
    public function mount()
    {
        $this->loadMore();
    }

    public function loadMore()
    {
        if ($this->hasMorePages === false) {
            return;
        }
        $products = $this->getProducts(with: [], cursor: Cursor::fromEncoded($this->nextCursor));
        $this->products = isset($this->products) ? $this->products->push(...$products->items()) : $products->getCollection();
        $this->nextCursor = $products->nextCursor()?->encode();
        $this->hasMorePages = $products->hasMorePages();
        $this->products->load(['discount', 'variants', 'images']);
    }

    public function render()
    {
        $topCategories = Category::with('image')->whereNull('parent_id')->get();
        return view('livewire.pages.shop', array_merge(
            ['brands' => $this->getBrands()],
            $this->getMetaData()
            ))
            ->with('topCategories', $topCategories)
            ->title(__('Shop'));
    }
}
