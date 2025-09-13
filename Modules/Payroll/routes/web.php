<?php

use App\Http\Middleware\ModuleActive;
use Illuminate\Support\Facades\Route;
use Modules\Payroll\Http\Controllers\PayrollController;
use Modules\Payroll\Http\Controllers\Database\AdvanceController;
use Modules\Payroll\Http\Controllers\Tools\AdvanceProcessController;

Route::middleware(['auth', 'verified',ModuleActive::class.':payroll'])->group(function () {
    Route::resource('payroll', PayrollController::class)->names('payroll');

    Route::prefix('payroll')->name('payroll.')->group(function () {
        //Setup
        Route::prefix('setup')->name('setup.')->group(function () {

        });

        //Database
        Route::prefix('database')->name('database.')->group(function () {
            Route::post('/employee/info', [AdvanceController::class, 'employeeInfo'])->name('advance.employee.info');
            Route::resource('advance', AdvanceController::class)->names('advance');
        });

        //Tools
        Route::prefix('tools')->name('tools.')->group(function () {
             Route::resource('advance-process', AdvanceProcessController::class)->names('advance-process');
        });

        //Report
        Route::prefix('report')->name('report.')->group(function () {

        });
    });
});
