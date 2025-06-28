<?php

use Illuminate\Support\Facades\Route;
use Modules\HRIS\Http\Controllers\HRISController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('hris', HRISController::class)->names('hris');
});
