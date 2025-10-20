<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Main extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title = 'Sunnybaby'
    )
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.main', [
            'menu_categories' => Cache::rememberForever('all-categories-r', function() {
                return \App\Models\Category::with('childrenRecursive', 'image')->whereNull('parent_id')->get();
            })
        ]);
    }
}
