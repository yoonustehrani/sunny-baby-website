<?php

namespace App\Services;

use App\Services\Payment\PaymentGateway;

class PaymentService
{
    protected PaymentGateway $gateway;
    /**
     * Create a new class instance.
     */
    public function __construct(string $gatewayClass)
    {
        $this->gateway = app($gatewayClass);
    }

    public function getGateway(): PaymentGateway
    {
        return $this->gateway;
    }
}
