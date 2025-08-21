<?php

namespace App\Services\Shipping;

class PishtazCarrier extends Carrier
{
    public function __construct()
    {
        $this->name = 'پست پیشتاز';
        $this->description = 'تحویل ۲ الی ۷ روز کاری';
        $this->logo_url = asset('images/logo/ips-logo.png');
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
        return true;
    }
}