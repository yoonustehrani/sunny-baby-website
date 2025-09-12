<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $slug)
    {
        return $slug;
    }
}
