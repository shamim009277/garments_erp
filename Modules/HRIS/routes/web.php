<?php

use App\Http\Middleware\ModuleActive;
use Illuminate\Support\Facades\Route;
use Modules\HRIS\Http\Controllers\HRISController;

Route::middleware(['auth', 'verified',ModuleActive::class.':hris'])->group(function () {
    Route::resource('hris', HRISController::class)->names('hris');
});
