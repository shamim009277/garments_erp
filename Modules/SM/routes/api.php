<?php

use Illuminate\Support\Facades\Route;
use Modules\SM\Http\Controllers\SMController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sms', SMController::class)->names('sm');
});
