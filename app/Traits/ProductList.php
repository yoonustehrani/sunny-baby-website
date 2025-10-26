<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Attribute as ModelsAttribute;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

trait ProductList
{
    use WithPagination;

    public $filters = [];
    protected $queryString = ['filters'];

    #[Url(except: [])]
    public $cats = [];

    #[Url(except: false)]
    public bool $onlyInStock = false;

    #[Url(except: 'featured')]
    public ?string $orderBy = 'featured';

    public function mount()
    {
        // Make sure query string filters are arrays
        foreach ($this->filters as $key => $val) {
            if (!is_array($val)) {
                $this->filters[$key] = explode(',', $val);
            }
        }
    }

    // public function perPage

    public function updatedFilters(): void
    {
        $this->resetPage(); // reset to page 1 when filters change
    }

    public function updatedBrand(): void
    {
        $this->resetPage(); // reset to page 1 when filters change
    }

    public function updatedOrderBy(): void
    {
        $this->resetPage(); // reset to page 1 when filters change
    }

    public function updatedInStock(): void
    {
        $this->resetPage(); // reset to page 1 when filters change
    }

    public function setOrderBy(string $key): void
    {
        $this->orderBy = $key;
    }

    public function toggleFilter($attributeId, $optionId): void
    {
        $options = $this->filters[$attributeId] ?? [];

        if (in_array($optionId, $options)) {
            $this->filters[$attributeId] = array_diff($options, [$optionId]);
        } else {
            $this->filters[$attributeId][] = $optionId;
        }

        // cleanup empty attributes
        if (empty($this->filters[$attributeId])) {
            unset($this->filters[$attributeId]);
        }
    }

    public function isFilterSelected($attributeId, $optionId): bool
    {
        return isset($this->filters[$attributeId]) && in_array($optionId, $this->filters[$attributeId]);
    }

    public function isCategorySelected($categoryId): bool
    {
        return isset($this->cats) && in_array($categoryId, $this->cats);
    }

    protected function baseProductQuery(): Builder
    {
        $query = Product::query()
            ->notVariants();
        $query->when($this->onlyInStock, function ($query) {
            $query->where(function ($q) {
                // parent itself is in stock
                $q->where('products.stock', '>', 0)
                  // or has any in-stock variant
                  ->orWhereHas('variants', fn($v) => $v->where('stock', '>', 0));
            });
        })
        ->when($this->cats, function ($query) {
            $query->whereHas('categories', function ($cat) {
                $cat->whereIn('categories.id', $this->cats);
            });
        })
        ->when($this->filters, function ($query) {
            foreach ($this->filters as $options) {
                $query->where(function ($q) use ($options) {
                    // parent attributes
                    $q->whereHas('attribute_options', function ($sub) use ($options) {
                        $sub->whereIn('attribute_options.id', $options);
                    })
                    // OR variant attributes
                    ->orWhereHas('variants.attribute_options', function ($sub) use ($options) {
                        $sub->whereIn('attribute_options.id', $options);
                    });
                });
            }
        });

        if (isset($this->brand)) {
            $query->when($this->brand != '', function($query) {
                $query->where('brand_id', $this->brand);
            });
        }
        return $query;
    }

    protected function getProducts($with = []): LengthAwarePaginator
    {
        /**
         * @var Builder $query
         */
        $query = $this->baseProductQuery();
        // $query = Product::query()
        //     ->notVariants()
        //     ->when($this->onlyInStock, function ($query) {
        //         $query->where(function ($q) {
        //             $q->where('products.stock', '>', 0)
        //             ->orWhereHas('variants', fn($v) => $v->where('stock', '>', 0));
        //         });
        //     })
        //     ->when($this->brand != '', function($query) {
        //         $query->where('brand_id', $this->brand);
        //     })
        //     ->when($this->cats, function ($query) {
        //         $query->whereHas('categories', function ($cat) {
        //             $cat->whereIn('categories.id', $this->cats);
        //         });
        //     })
        //     ->when($this->filters, function ($query) {
        //         foreach ($this->filters as $options) {
        //             $query->where(function ($q) use ($options) {
        //                 $q->whereHas('attribute_options', fn($sub) => $sub->whereIn('attribute_options.id', $options))
        //                 ->orWhereHas('variants.attribute_options', fn($sub) => $sub->whereIn('attribute_options.id', $options));
        //             });
        //         }
        //     });
        if (isset($this->orderBy)) {
            switch ($this->orderBy) {
                case 'alpha-asc':
                    $query->orderBy('title', 'asc');
                    break;
                case 'alpha-desc':
                    $query->orderBy('title', 'desc');
                    break;
                case 'date-asc':
                    $query->orderBy('updated_at', 'asc');
                    break;
                case 'date-desc':
                    $query->orderBy('updated_at', 'desc');
                    break;
                default:
                    # code...
                    break;
            }
        }

        if (! empty($with)) {
            $query->with($with);
        }

        return $query->paginate($this->perPage ?? 8);
    }

    protected function buildCategoryTree($categories, $parentId = null)
    {
        return $categories
            ->where('parent_id', $parentId)
            ->map(function ($cat) use ($categories) {
                $children = $this->buildCategoryTree($categories, $cat->id);
                $cat->children = $children;
                if ($children->isNotEmpty()) {
                    $cat->products_count += $children->sum('products_count');
                }
                return $cat;
            })
            ->values();
    }

    protected function getData($productsWith = ['discount', 'variants', 'images'])
    {
        $comma = '، ';
        $orderList = [
            'featured' => __('Featured'),
            'best-selling' => __('Best selling'),
            'alpha-asc' => __('Alphabetically') . $comma . __('A-Z'),
            'alpha-desc' => __('Alphabetically') . $comma . __('Z-A'),
            'price-asc' => __('Price') . $comma . __('low to high'),
            'price-desc' => __('Price') . $comma . __('high to low'),
            'date-asc' => __('Date') . $comma . __('old to new'),
            'date-desc' => __('Date') . $comma . __('new to old'),
        ];
        $products = $this->getProducts($productsWith);

        $optionCounts = DB::table('attribute_option_product as aop')
            ->select('aop.attribute_option_id', DB::raw('COUNT(DISTINCT COALESCE(p.parent_id, p.id)) as product_count'))
            ->join('products as p', 'aop.product_id', '=', 'p.id')
            ->joinSub($this->baseProductQuery(), 'filtered_products', function ($join) {
                $join->on(DB::raw('COALESCE(p.parent_id, p.id)'), '=', 'filtered_products.id');
            })
            ->groupBy('aop.attribute_option_id')
            ->pluck('product_count', 'attribute_option_id');

        $categories = Category::query()
            ->join('category_product as cp', 'cp.category_id', '=', 'categories.id')
            ->join('products', 'cp.product_id', '=', 'products.id')
            ->joinSub($this->baseProductQuery()->select('products.id', DB::raw('COALESCE(products.parent_id, products.id) as base_id')), 'base_products', function ($join) {
                $join->on(DB::raw('COALESCE(products.parent_id, products.id)'), '=', 'base_products.base_id');
            })
            ->select(
                'categories.id',
                'categories.name',
                'categories.parent_id',
                DB::raw('COUNT(DISTINCT base_products.base_id) as results_count')
            )
            ->groupBy('categories.id', 'categories.name', 'categories.parent_id')
            ->get();

        $availableOptionIds = array_keys($optionCounts->toArray());

        $attributes = ModelsAttribute::where('can_be_filtered', true)->with(['options' => function ($q) use ($availableOptionIds) {
            $q->whereIn('id', $availableOptionIds);
        }])->get();
        $categories = $this->buildCategoryTree($categories);
        return compact('orderList', 'products', 'attributes', 'optionCounts', 'categories');
    }
}
