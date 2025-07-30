<?php

namespace App\Providers;

use App\Services\Shipping\PeykCarrier;
use App\Services\Shipping\PishtazCarrier;
use App\Services\ShippingService;
use Illuminate\Support\ServiceProvider;

class ShippingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ShippingService::class, function() {
            return new ShippingService([
                PeykCarrier::class,
                PishtazCarrier::class
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
