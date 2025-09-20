<?php

namespace App\Services;

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

    public function carrier(string $carrier)
    {
        return app($carrier);
    }
}
