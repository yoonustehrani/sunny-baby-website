<?php

namespace App\Services\Shipping;

use App\Models\Address;

class PeykCarrier implements CarrierContract
{
    use CarrierHelpers;

    public function __construct()
    {
        $this->name = 'پیک موتوری';
        $this->description = 'مخصوص مشهد';
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