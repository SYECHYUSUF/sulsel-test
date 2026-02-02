<?php

namespace App\Providers;

use App\Models\LogLogin;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot()
    {
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        // Configure rate limiters for public forms
        $this->configureRateLimiting();

        Event::listen(function (Login $event) {
            LogLogin::create([
                'id_user'   => $event->user->id,
                'tipe'      => 'login',
                'createdAt' => now(),
                'ip'        => request()->ip(),
            ]);
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        // Rate limiter for public form submissions (5 per minute per IP)
        RateLimiter::for('public-form', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip())->response(function () {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Terlalu banyak percobaan. Silakan tunggu beberapa saat sebelum mencoba lagi.');
            });
        });

        // Rate limiter for status check (10 per minute - slightly higher limit)
        RateLimiter::for('check-status', function (Request $request) {
            return Limit::perMinute(10)->by($request->ip())->response(function () {
                return response()->json([
                    'success' => false,
                    'message' => 'Terlalu banyak percobaan. Silakan tunggu beberapa saat.'
                ], 429);
            });
        });
    }
}
