<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS URL generation only when explicitly enabled (config-cache safe).
        // Enable via FORCE_HTTPS=true once TLS is live on the domain.
        if (config('app.force_https')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
