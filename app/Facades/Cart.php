<?php

namespace App\Facades;

use App\Services\CartService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection all()
 * @method static \App\Services\CartService update(int|string $productId, int $quantity)
 * @method static \App\Services\CartService remove(int|string $productId)
 * @method static bool has(int|string $productId)
 * @method static int getProductQuantity(int|string $productId)
 * @method static int getTotalWeight()
 * @method static void clear()
 * @method static array sums()
 * @method static int count()
 * @method static array toArray()
 * @method static void setMeta(string $key, mixed $value)
 */
class Cart extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CartService::class;
    }
}

