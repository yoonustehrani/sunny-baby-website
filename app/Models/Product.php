<?php

namespace App\Models;

use App\Enums\ProductType;
use App\Traits\DiscountMethods;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, DiscountMethods;

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

    public function main_image()
    {
        return $this->hasOne(Image::class, 'id', 'id')
            ->join('product_image', 'images.id', '=', 'product_image.image_id')
            ->where('product_image.is_main', true)
            ->select('images.*', 'product_image.product_id');
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
