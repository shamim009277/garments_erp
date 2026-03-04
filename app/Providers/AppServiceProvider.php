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
            return Organization::active()->select('id','name','bn_name','short_name','address','address_bangla','email','phone','icon_name','path')->get();
        }));

        // Holidays
        View::share('holidays', cache()->remember('holidays', 3600, function () {
            return Calender::where('holiday', 'Y')->where('year', Carbon::now()->year)->pluck('date')
                    ->map(function($date) {
                        return $date->format('Y-m-d');
                    })
                    ->toArray();
            }));
        
        // $allowedIp = env('ALLOW_SERVER_IP');
        // $serverIp = getHostByName(getHostName());
        // if ($serverIp !== $allowedIp) {
        //     abort(403, "Application is locked to specific server.");
        // }
        // $host = gethostname();
        // if ($host !== env('ALLOW_HOST')) {
        //     abort(403, "This server is not allowed.");
        // }
            
    }
}

