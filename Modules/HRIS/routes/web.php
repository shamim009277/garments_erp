<?php

use Illuminate\Support\Facades\Route;
use Modules\HRIS\Http\Controllers\HRISController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('hris', HRISController::class)->names('hris');
});
