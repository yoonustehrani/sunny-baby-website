<?php

namespace App\Services\Shipping;

use App\Models\Address;
use App\Traits\ServiceGeneralMethods;

abstract class Carrier
{
    use ServiceGeneralMethods;
    
    public Address $address;
    abstract public function isActive(): bool;
    abstract public function calculate(): int;
    abstract public function getPriceLabel(): string;

    public function setAddress(Address $address): static
    {
        $this->address = $address;
        return $this;
    }
}