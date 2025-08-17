<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Master\GeneralSetting;
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
        View::share('general', cache()->remember('general_settings', 3600, function () {
            return GeneralSetting::first();
        }));
    }
}

