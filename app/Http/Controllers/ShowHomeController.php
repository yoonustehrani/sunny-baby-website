<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowHomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('home', [
            'categories' => \App\Models\Category::limit(3)->whereNull('parent_id')->get(),
            'title' => "سانی بی بی"
        ]);
    }
}
