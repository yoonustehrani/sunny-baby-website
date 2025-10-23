<?php

namespace App\Exceptions;

use App\Models\Product;
use Exception;

class ProductStockUnavailable extends Exception
{
    public function __construct(Product $product)
    {
        $title = $product->title ?: $product->parent->title;

        parent::__construct(__("The product :title has not enough stock", ['title' => $title]));
    }
}
