<?php

use Illuminate\Support\Facades\Route;
use Modules\Sample\Http\Controllers\SampleController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('samples', SampleController::class)->names('sample');
});
