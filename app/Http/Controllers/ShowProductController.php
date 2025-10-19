<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShowProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $slug)
    {
        $product = Product::whereSlug($slug)->firstOrFail();
        $product->load('discount', 'images', 'categories')->append('main_image');
        $product->load(['variants.attribute_options.attribute']);
        $product->load('attribute_options.attribute');
        return view('pages.product-detail', compact('product'));
    }
}
