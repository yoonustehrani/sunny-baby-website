<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShowHomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // $pds = Product::whereType('C')->with(['variants.attribute_options.attribute', 'attribute_options.attribute'])->get();
        return view('home', [
            'categories' => Cache::remember('home-categories', 60 * 60, fn() => \App\Models\Category::limit(3)->whereNull('parent_id')->get()),
            'brands' => Cache::remember('home-brands', 60 * 60, fn() => \App\Models\Brand::limit(20)->with('image')->get()),
            'attributes' => [
                'sex' => Cache::remember('home-sex-attribute', 60 * 60, fn() => \App\Models\Attribute::where('can_be_filtered', true)->whereLabel('جنسیت')->with('options')->first()),
                'color' => Cache::remember('home-color-attribute', 60 * 60, fn() => \App\Models\Attribute::where('can_be_filtered', true)->whereLabel('رنگ')->with('options')->first()),
            ],
            'title' => "سانی بی بی"
        ]);
    }
}
