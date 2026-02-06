<?php

namespace App\View\Components;

use App\Models\SlideBanner;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hero extends Component
{
    /**
     * Create a new component instance.
     */
    public $banners;

    /**
     * Create a new component instance.
     */
    public function __construct($banners = [])
    {
        $banners = SlideBanner::active()->orderBy('order')->get();
        $this->banners = $banners;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hero');
    }
}
