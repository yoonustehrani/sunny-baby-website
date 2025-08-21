<?php

namespace App\Facades;

use App\Services\ShippingService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array carriers()
 * @method static \App\Services\Shipping\Carrier carrier(string $carrier)
 */
class Shipping extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ShippingService::class;
    }
}

