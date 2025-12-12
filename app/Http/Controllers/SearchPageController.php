<?php

namespace App\Http\Controllers;

use App\Traits\SearchProducts;
use Illuminate\Http\Request;

class SearchPageController extends Controller
{
    use SearchProducts;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'term' => 'required|string|min:3'
        ]);
        $this->search = $request->query('term');
        return view('pages.search', ['products' => $this->getSearchResults(limit: 12)]);
    }
}
