<?php

namespace App\Attributes;

#[\Attribute]
class BadgeColor {
    public function __construct(public string $value) { }
} 