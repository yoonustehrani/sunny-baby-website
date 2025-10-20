<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShowHomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // $pds = Product::whereType('C')->with(['variants.attribute_options.attribute', 'attribute_options.attribute'])->get();
        return view('home', [
            'categories' => \App\Models\Category::limit(3)->whereNull('parent_id')->get(),
            'title' => "سانی بی بی"
        ]);
    }
}
