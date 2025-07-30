<?php

namespace App\Services\Shipping;

use App\Models\Address;

class PishtazCarrier implements CarrierContract
{
    use CarrierHelpers;

    public function __construct()
    {
        $this->name = 'پست پیشتاز';
        $this->description = 'تحویل ۲ الی ۷ روز کاری';
        $this->logo_url = '/';
    }

    public function calculate(array $cart, Address $address): ?int
    {
        return null;
    }
    public function isActive(): bool
    {
        return true;
    }
}