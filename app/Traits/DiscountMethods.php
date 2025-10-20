<?php

namespace App\Traits;

use App\Enums\DiscountMethod;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;

trait DiscountMethods
{
    protected function getDiscountAmount(): int
    {
        $price = $this->price;
        $value = $this->discount->value;
        if (DiscountMethod::PERCENTAGE === $this->discount->method) {
            return intval(($price / 100) * $value);
        }
        return $value;
    }

    public function discountAmount(): CastsAttribute
    {
        return CastsAttribute::make(get: fn() => $this->getDiscountAmount());
    }

    public function discountInPercent(): CastsAttribute
    {
        return CastsAttribute::make(get: function() {
            $value = $this->discount->value;
            if (DiscountMethod::PERCENTAGE === $this->discount->method) {
                return $value;
            }
            return intval(($value / $this->price) * 100);
        });
    }

    public function isDiscounted(): CastsAttribute
    {
        return CastsAttribute::make(get: fn() => ! is_null($this->discount_id) && ! is_null($this->discount));
    }

    public function getDiscountedPriceAttribute(): int|null
    {
        if (is_null($this->discount)) {
            return null;
        }
        $discount = $this->getDiscountAmount();
        return round_price($this->price - $discount);
    }
}
