<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Setting;
use App\Models\Visitor;
use App\Models\DownloadLog;
use Illuminate\Support\Facades\Cache;

class Footer extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $stats = null;

        // Check if stats should be visible
        if (Setting::getValue('is_stats_visible')) {
            // Cache for 15 minutes to improve performance
            $stats = Cache::remember('footer_stats', 15 * 60, function () {
                return [
                    'visitors_total' => Visitor::sum('count'),
                    'visitors_today' => Visitor::whereDate('created_at', now())->value('count') ?? 0,
                    'downloads_total' => DownloadLog::count(),
                ];
            });
        }

        return view('components.footer', compact('stats'));
    }
}
