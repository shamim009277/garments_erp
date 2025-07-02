<?php

use App\Http\Middleware\ModuleActive;
use Illuminate\Support\Facades\Route;
use Modules\Payroll\Http\Controllers\PayrollController;

Route::middleware(['auth', 'verified',ModuleActive::class.':payroll'])->group(function () {
    Route::resource('payroll', PayrollController::class)->names('payroll');
});
