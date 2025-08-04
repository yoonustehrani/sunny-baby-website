<?php

namespace App\Models;

use App\Enums\DiscountMethod;
use App\Enums\DiscountTargetType;
use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public function discount()
    {
        return $this->belongsTo(Discount::class)->where('target', DiscountTargetType::PRODUCT);
    }

    public function getDiscountedPrice(): int|null
    {
        if (is_null($this->discount)) {
            return null;
        }
        $price = $this->price;
        $value = $this->discount->value;
        switch ($this->discount->method) {
            case DiscountMethod::FIXED_AMOUNT:
                $price = $price - $value;
                break;
            case DiscountMethod::PERCENTAGE:
                $price = intval(($price / 100) * $value);
                break;
        }
        return round_price($price);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Product, $this>
     */
    public function variations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class, 'parent_id')->whereType(ProductType::VARIATION);
    }

    public function variables()
    {
        return $this->belongsToMany(Variable::class, 'product_variant_attribute')->withPivot(['variable_value_id']);
    }

    #[Scope]
    protected function onlyVariable(Builder $query): void
    {
        $query->where('type', ProductType::VARIABLE);
    }

    #[Scope]
    protected function notVariations(Builder $query): void
    {
        $query->where('type', '<>', ProductType::VARIATION);
    }
}
