<?php

use Illuminate\Support\Facades\Route;
use Modules\IPE\Http\Controllers\IPEController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ipes', IPEController::class)->names('ipe');
});
