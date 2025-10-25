<?php

namespace App\View\Components\Affiliate;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    public $current = false;
    public string $url;
    /**
     * Create a new component instance.
     */
    public function __construct(public string $route, public string $title, public array $subitems = [])
    {
        $this->url = $this->subitems ? "#$route" : route("affiliate.$route");
        $this->current = routeIs("affiliate.$route");
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.affiliate.menu-item');
    }
}
