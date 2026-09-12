<?php

use Illuminate\Support\Facades\Route;
use Modules\Commercial\Http\Controllers\CommercialController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('commercials', CommercialController::class)->names('commercial');
});
