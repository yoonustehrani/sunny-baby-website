<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class UserAccountMenuItem extends Component
{
    public string $url;
    public bool $active = false;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $text,
        string $subroute
    )
    {
        $this->url = route("user-account.$subroute");
        $this->active = Route::currentRouteName() == "user-account.$subroute";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-account-menu-item');
    }
}
