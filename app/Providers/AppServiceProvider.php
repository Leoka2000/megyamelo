<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Whitecube\LaravelCookieConsent\Consent;
use Whitecube\LaravelCookieConsent\Facades\Cookies;
use Illuminate\Pagination\Paginator;

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

        Paginator::useBootstrap();

        Cookies::essentials()
        ->session()
        ->csrf();

        Cookies::optional()
        ->name('darkmode_enabled')
        ->description("This cookie reminds you to see your preferences with its management")
        ->duration(120)
        ->accepted(fn(Consent $consent, MyDarkmode $darkmode)=>$consent->cookie(value: $darkmode->getDefaultValue()));
    }
}
