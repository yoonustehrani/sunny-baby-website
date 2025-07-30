<?php

namespace App\Services\Shipping;

use App\Models\Address;

interface CarrierContract
{
    public function getName(): string;
    public function getDescription(): string;
    public function getLogoUrl(): string;
    public function isActive(): bool;
    public function calculate(array $cart, Address $address): int|null;
}