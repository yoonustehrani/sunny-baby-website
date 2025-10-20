<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class ToolbarItem extends Component
{
    public bool $active;
    /**
     * Create a new component instance.
     */
    public function __construct(string $route)
    {
        $this->active = Route::currentRouteName() == $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.toolbar-item');
    }
}
