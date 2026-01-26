<?php

namespace App\Providers;

use App\Models\LogLogin;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Event;

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

        Event::listen(function (Login $event) {
            LogLogin::create([
                'id_user'   => $event->user->id,
                'tipe'      => 'login',
                'createdAt' => now(),
                'ip'        => request()->ip(),
            ]);
        });
    }
}
