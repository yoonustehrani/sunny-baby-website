<?php

namespace App\Services\Shipping;

use App\Facades\Cart;

class PishtazCarrier extends Carrier
{
    public function __construct()
    {
        $this->name = 'پست پیشتاز';
        $this->description = 'تحویل ۲ الی ۷ روز کاری';
        if (Cart::getTotalWeight() > 2000) {
            $this->description = 'هزینه ارسال درب منزل دریافت می شود.';
        }
        $this->logo_url = asset('images/logo/ips-logo.png');
    }

    public function calculate(): int
    {
        $weight = Cart::getTotalWeight();
        $cost = 0;
		$weight /= 1000;
		switch (true) {
			case $weight <= 0.4:
				$cost = 40;
				break;
			case $weight <= 0.8:
				$cost = 50;
				break;
			case $weight <= 1.2:
				$cost = 60;
				break;
			case $weight <= 1.6:
				$cost = 70;
				break;
			case $weight <= 2:
				$cost = 80;
				break;
			case $weight > 2:
				$cost = 0;
				break;
		}
		return $cost * 1000;
        return 0;
    }

    public function getPriceLabel(): string
    {
        $total = $this->calculate();
        return $total > 0 ? format_price($total) : 'پس کرایه';
    }
    
    public function isActive(): bool
    {
        return true;
    }
}