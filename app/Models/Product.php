<?php

namespace App\Models;

use App\Enums\DiscountMethod;
use App\Enums\DiscountTargetType;
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

    public function variants()
    {
        return $this->belongsToMany(Variable::class, 'product_variant_attribute')->withPivot(['variable_value_id']);
    }
}
