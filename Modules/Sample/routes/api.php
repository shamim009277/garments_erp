<?php

use Illuminate\Support\Facades\Route;
use Modules\Sample\Http\Controllers\SampleController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('samples', SampleController::class)->names('sample');
});
