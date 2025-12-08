<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Models\Master\GeneralSetting;
use Illuminate\Support\ServiceProvider;
use Modules\HRIS\Models\Tools\Calender;
use Modules\HRIS\Models\Setup\Organization;

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

        View::share('ornizations_data', cache()->remember('ornizations_data', 3600, function () {
            return Organization::active()->select('name','bn_name','short_name','address','email','phone','icon_name','path')->get();
        }));

        // Holidays
        View::share('holidays', cache()->remember('holidays', 3600, function () {
            return Calender::where('holiday', 'Y')->where('year', Carbon::now()->year)->pluck('date')
                    ->map(function($date) {
                        return $date->format('Y-m-d');
                    })
                    ->toArray();
            }));
    }
}

