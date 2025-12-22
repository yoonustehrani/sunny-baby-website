<?php

namespace App\Traits;

use App\Enums\DiscountMethod;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;

trait DiscountMethods
{
    protected function getDiscountAmount(): int
    {
        return $this->price - $this->discounted_price;
    }

    public function discountAmount(): CastsAttribute
    {
        return CastsAttribute::make(get: fn() => $this->getDiscountAmount());
    }

    public function discountInPercent(): CastsAttribute
    {
        return CastsAttribute::make(get: function() {
            return intval(($this->getDiscountAmount() / $this->price) * 100);
        });
    }

    public function isDiscounted(): CastsAttribute
    {
        return CastsAttribute::make(get: fn() => ! is_null($this->discounted_price));
    }
}
