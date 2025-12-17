<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

trait SearchProducts
{
    public string $search = '';


    public function getSearchResults(bool $onlyId = false, int $limit = 4)
    {
        $query = strlen($this->search) > 2 
            ? Product::search($this->search)->take($limit) // ->orderBy('created_at', 'desc')
            : Product::query()->notVariants()->orderBy('created_at', 'desc')->take(3);

        if ($onlyId) {
            return collect($query->raw()['hits'])->pluck('id');
        }
        return Cache::remember("search-products-limit-{$limit}" . md5($this->search) ?: 'default-search-results-products', 60, function() use(&$query) {
            $results = $query->get();
            $results->load('images', 'variants', 'discount');
            return $results;
        });
    }
}
