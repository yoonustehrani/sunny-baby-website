<?php

namespace App\Traits;

trait TranslatableFilamentModelLabels
{
    public static function getModelLabel(): string
    {
        return trans_choice('filament.' . self::getModel(), 1);
    }

    public static function getPluralModelLabel(): string
    {
        return trans_choice('filament.' . self::getModel(), 10);
    }
}
