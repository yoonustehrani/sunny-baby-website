<?php

namespace App\Models;

use App\Enums\ProductType;
use App\Traits\DiscountMethods;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Laravel\Scout\Searchable;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, DiscountMethods;
    // Searchable

    public $appends = ['price_label'];

    public function casts(): array
    {
        return [
            'type' => ProductType::class
        ];
    }

    public function getRealPriceAttribute(): int
    {
        return $this->is_discounted ? $this->discounted_price : $this->price;
    }

    public function getPriceLabelAttribute()
    {
        $price = $this->price;
        if ($this->type === ProductType::VARIABLE) {
            $prices = $this->variants->pluck('price')->unique()->sort();
            if ($prices->count() > 1) {
                return number_format($prices->first()) . " - " . format_price($prices->last());
            }
            $price = $prices->first();
        }
        return format_price($price);
    }

    public function parent()
    {
        return $this->belongsTo(Product::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class)->forProduct()->active()->unexpired();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'product_image')->withPivot('is_main');
    }

    public function getMainImageAttribute()
    {
        return $this->images->firstWhere('pivot.is_main', true);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Product, $this>
     */
    public function variants(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class, 'parent_id')->whereType(ProductType::VARIANT);
    }

    // public function variables()
    // {
    //     return $this->belongsToMany(Variable::class, 'product_variant_attribute')->withPivot(['variable_value_id']);
    // }

    public function attribute_options()
    {
        return $this->belongsToMany(AttributeOption::class)
            ->using(AttributeOptionProduct::class)
            ->withPivot(['product_id', 'attribute_id', 'attribute_option_id']);
    }

    // public function attributes()
    // {
    //     return $this->belongsToMany(Attribute::class, table: 'attribute_option_product')->using(AttributeOptionProduct::class)->withPivot(['product_id', 'attribute_id', 'attribute_option_id']);
    // }

    // public function 

    #[Scope]
    protected function onlyVariable(Builder $query): void
    {
        $query->where('type', ProductType::VARIABLE);
    }

    #[Scope]
    protected function notVariants(Builder $query): void
    {
        $query->where('type', '<>', ProductType::VARIANT);
    }

    public function isVariable(): bool
    {
        return $this->type == ProductType::VARIABLE;
    }

    public function isVariant(): bool
    {
        return $this->type == ProductType::VARIANT;
    }

    public function getVariantTitleAttribute(): string
    {
        return $this->title ?: $this->attribute_options->map(fn(AttributeOption $ap) => $ap->label)->implode(' / ');
    }

    public function getAvailableStockAttribute(): int
    {
        return $this->stock - $this->reserved;
    }
}
