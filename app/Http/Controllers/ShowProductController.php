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
        // $product->load('attributes');
        $filter = [1 => 5, 2 => 12];
        // ->filter(function(Product $variant) {
        //     return $variant->attribute_options;
        // })->first();
        // dd(
        //     $product->variants->pluck('attribute_options')
        // );
        // attribute_options
        // $this->product->variants->pluck('attribute_options.attribute');
        // return $product->variants->map(fn(Product $p) => $p->attribute_options->pluck('attribute'))->flatten()->unique('id');
        return view('pages.product-detail', compact('product'));
    }
}
