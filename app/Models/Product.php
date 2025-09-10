<?php

namespace App\Models;

use App\Enums\DiscountMethod;
use App\Enums\DiscountTargetType;
use App\Enums\ProductType;
use App\Traits\DiscountMethods;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\returnSelf;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, DiscountMethods;

    public function discount()
    {
        return $this->belongsTo(Discount::class)->where('target', DiscountTargetType::PRODUCT)->where(function(Builder $q) {
            $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
        });
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function main_image()
    {
        return $this->hasOne(ProductImage ::class)->whereIsMain(true);
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
