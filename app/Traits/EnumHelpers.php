<?php

namespace App\Traits;

use App\Attributes\BadgeColor;
use App\Attributes\TitleFa;
use BackedEnum;
use ReflectionEnumUnitCase;

trait EnumHelpers
{
    public static function values()
    {
        return array_map(fn(BackedEnum $backedEnum) => $backedEnum->value, self::cases());
    }

    public static function names()
    {
        return array_map(fn(BackedEnum $backedEnum) => $backedEnum->name, self::cases());
    }

    public static function cases_array()
    {
        return array_combine(self::names(), self::values());
    }

    public function getAttribute(string $attribute): mixed
    {
        return new ReflectionEnumUnitCase($this::class, $this->name)->getAttributes($attribute)[0]?->getArguments()[0] ?? null;
    }

    public function getTitleFa(): string|null
    {
        return $this->getAttribute(TitleFa::class);
    }

    public function getLabel(): ?string
    {
        return $this->getTitleFa();
    }

    public function getColor(): ?string
    {
        return $this->getAttribute(BadgeColor::class);
    }
}
