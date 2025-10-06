<?php

namespace App\Livewire\Pages;

use App\Models\Attribute as ModelsAttribute;
use App\Models\Product;
use Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;

    // #[Url]
    public $selectedFilters = [];
    protected $queryString = ['selectedFilters'];

    #[Url]
    public ?string $orderBy;

    public function mount()
    {
        // Make sure query string filters are arrays
        foreach ($this->selectedFilters as $key => $val) {
            if (!is_array($val)) {
                $this->selectedFilters[$key] = explode(',', $val);
            }
        }
    }
    
    public function updatedSelectedFilters()
    {
        $this->resetPage(); // reset to page 1 when filters change
    }

    public function setOrderBy(string $key)
    {
        $this->orderBy = $key;
    }

    public function toggleFilter($attributeId, $optionId)
    {
        $options = $this->selectedFilters[$attributeId] ?? [];

        if (in_array($optionId, $options)) {
            $this->selectedFilters[$attributeId] = array_diff($options, [$optionId]);
        } else {
            $this->selectedFilters[$attributeId][] = $optionId;
        }

        // cleanup empty attributes
        if (empty($this->selectedFilters[$attributeId])) {
            unset($this->selectedFilters[$attributeId]);
        }
    }

    protected function baseProductQuery(): Builder
    {
        $query = Product::query()
            ->notVariants();
        if (! empty($this->selectedFilters)) {
            $query->when($this->selectedFilters, function ($query) {
                foreach ($this->selectedFilters as $options) {
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
        }
        return $query;
    }

    protected function getProducts(): LengthAwarePaginator
    {
        /**
         * @var Builder $query
         */
        $query = Product::query()
            ->notVariants()
            ->when($this->selectedFilters, function ($query) {
                foreach ($this->selectedFilters as $options) {
                    $query->where(function ($q) use ($options) {
                        $q->whereHas('attribute_options', fn($sub) => $sub->whereIn('attribute_options.id', $options))
                        ->orWhereHas('variants.attribute_options', fn($sub) => $sub->whereIn('attribute_options.id', $options));
                    });
                }
            });
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
        return $query->with('discount', 'variants', 'images')->paginate(8);
    }

    public function render()
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
        $products = $this->getProducts();

        $optionCounts = DB::table('attribute_option_product as aop')
            ->select('aop.attribute_option_id', DB::raw('COUNT(DISTINCT COALESCE(p.parent_id, p.id)) as product_count'))
            ->join('products as p', 'aop.product_id', '=', 'p.id')
            ->joinSub($this->baseProductQuery(), 'filtered_products', function ($join) {
                $join->on(DB::raw('COALESCE(p.parent_id, p.id)'), '=', 'filtered_products.id');
            })
            ->groupBy('aop.attribute_option_id')
            ->pluck('product_count', 'attribute_option_id');
        
        $availableOptionIds = array_keys($optionCounts->toArray());

        $attributes = ModelsAttribute::where('can_be_filtered', true)->with(['options' => function ($q) use ($availableOptionIds) {
            $q->whereIn('id', $availableOptionIds);
        }])->get();

        return view('livewire.pages.shop', compact('orderList', 'products', 'attributes', 'optionCounts'))->title(__('Shop'));
    }
}
