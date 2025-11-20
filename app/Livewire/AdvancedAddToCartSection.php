<?php

namespace App\Livewire;

use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AdvancedAddToCartSection extends Component
{
    public Product $product;
    public ?Product $variant = null;
    public SupportCollection $variableAttributes;
    public array $selectedOptions;

    // #[Validate('required|integer|min:1')]
    public int $n = 1;

    public function mount()
    {
        if ($this->product->isVariable()) {
            $this->variableAttributes = $this->getVariableAttributes();
            $keys = [];
            $this->variableAttributes->pluck('id')->values()->each(function($id) use(&$keys) {
                $keys[$id] = null;
            });
            $this->selectedOptions = $keys;
        }
    }

    public function updatedVariant()
    {
        $this->n = 1;
    }

    public function updatedSelectedOptions()
    {
        $variant = $this->product->variants->first(function ($variant) {
            $variantOptions = $variant->attribute_options->pluck('id', 'attribute_id')->toArray();

            foreach ($this->selectedOptions as $attrId => $optionId) {
                if (!isset($variantOptions[$attrId]) || $variantOptions[$attrId] != $optionId) {
                    return false;
                }
            }
            return true;
        });
        if ($variant) {
            $variant->refresh();
        }
        $this->variant = $variant;
    }

    public function decrement()
    {
        if ($this->n < 1) return;
        $this->n--;
    }

    public function increment()
    {
        if ($this->n == $this->product->available_stock) return;
        $this->n++;
    }

    public function render()
    {
        return view('livewire.advanced-add-to-cart-section', [
            'features' => $this->product->isVariable() ? $this->getVariableAttributesAndOptions() : collect([])
        ]);
    }

    public function setOptionAsNull($attr_id)
    {
        $this->selectedOptions[$attr_id] = null;
        $this->updatedSelectedOptions();
    }

    protected function getVariableAttributes()
    {
        return $this->product->variants->map(fn(Product $p) => $p->attribute_options->pluck('attribute'))
            ->flatten()
            ->unique('id');
    }

    protected function getVariableAttributesAndOptions()
    {
        $possibleVariants = $this->product->variants;
        $selectedOptions = collect($this->selectedOptions)->filter();
        if (! $selectedOptions->isEmpty()) {
            $possibleVariants = $possibleVariants->filter(function ($variant) use($selectedOptions) {
                $variantOptions = collect($variant['attribute_options'])
                    ->pluck('id', 'attribute_id');
                foreach ($variantOptions as $attrId => $optionId) {
                    if (isset($selectedOptions[$attrId]) && !is_null($selectedOptions[$attrId]) && $selectedOptions[$attrId] != $optionId) {
                        return false; // not compatible
                    }
                }
                return true;
            });
        }
        
        $enabledOptions = $possibleVariants
            ->pluck('attribute_options')
            ->flatten()
            ->pluck('id')
            ->unique();
        return $this->variableAttributes->each(function($attribute) use (&$enabledOptions) {
            $attribute->available_options = $this->product->variants
                ->pluck('attribute_options')
                ->flatten()
                ->where('attribute_id', $attribute->id)
                ->each(function ($option) use (&$enabledOptions) {
                    if ($this->variableAttributes->count() > 1) {
                        $option->disabled = !$enabledOptions->contains($option['id']);
                    }
                });
        });
    }

    public function addToCart(string|int $productId)
    {
        try {
            Cart::add($productId, $this->n);
            $this->dispatch('cart-updated');
            $this->dispatch('cart-updated-product.'. $productId);
            $this->dispatch('alert', type: 'success', message: __("Added to cart"));
            $this->n = 1;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
