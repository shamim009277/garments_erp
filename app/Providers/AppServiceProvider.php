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
        // General Settings
        $general = null;
        try {
            $general = cache()->remember('general_settings', 3600, function () {
                return GeneralSetting::first();
            });
        } catch (\Throwable $e) {
            // Log::error('GeneralSetting fetch failed: ' . $e->getMessage());
        }
        View::share('general', $general);

        // Organizations
        $organizations = [];
        try {
            $organizations = cache()->remember('ornizations_data', 3600, function () {
                return Organization::active()->select('id','name','bn_name','short_name','address_bangla','email','phone','icon_name','path')->get();
            });
        } catch (\Throwable $e) {
            // Log::error('Organization fetch failed: ' . $e->getMessage());
        }
        View::share('ornizations_data', $organizations);

        // Holidays
        $holidays = [];
        try {
            $holidays = cache()->remember('holidays', 3600, function () {
                return Calender::where('holiday', 'Y')->where('year', Carbon::now()->year)->pluck('date')
                        ->map(function($date) {
                            return $date->format('Y-m-d');
                        })
                        ->toArray();
            });
        } catch (\Throwable $e) {
            // Log::error('Holidays fetch failed: ' . $e->getMessage());
        }
        View::share('holidays', $holidays);
    }
}

