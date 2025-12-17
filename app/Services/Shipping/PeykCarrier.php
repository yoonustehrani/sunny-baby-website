<?php

namespace App\Services\Shipping;

use App\Models\City;

class PeykCarrier extends Carrier
{
    public function __construct()
    {
        $this->name = 'پیک موتوری';
        $this->description = 'مخصوص مشهد | تحویل ۲ روز کاری';
        $this->logo_url = asset('images/logo/snappbox-logo.svg');
    }

    public function calculate(): int
    {
        return 0;
    }

    public function getPriceLabel(): string
    {
        return 'پس کرایه';
    }

    public function isActive(): bool
    {
        $mashhadId = City::whereName('مشهد')->firstOrFail()->getKey();
        return $this->address->city_id == $mashhadId;
    }
}