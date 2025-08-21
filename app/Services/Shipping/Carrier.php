<?php

namespace App\Services\Shipping;

use App\Models\Address;

abstract class Carrier
{
    protected string $name;
    protected string $description;
    protected string $logo_url;
    public Address $address;
    abstract public function isActive(): bool;
    abstract public function calculate(): int;
    abstract public function getPriceLabel(): string;
    
    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLogoUrl(): string
    {
        return $this->logo_url;
    }

    public function setAddress(Address $address): static
    {
        $this->address = $address;
        return $this;
    }
}