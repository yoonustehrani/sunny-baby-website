<?php

namespace App\Services;

use App\Services\Shipping\PeykCarrier;

class ShippingService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected array $carriers
    )
    {
        
    }

    public function carriers()
    {
        return $this->carriers;
    }

    public function carrier($carrier)
    {
        return new $carrier;
    }
}
