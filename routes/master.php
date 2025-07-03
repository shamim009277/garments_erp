<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\MasterController;
use App\Http\Controllers\Master\SystemSetting\GeneralSettingController;

Route::middleware(['auth', 'verified'])->prefix('master')->name('master.')->group(function () {
    Route::get('/', [MasterController::class, 'index'])->name('index');

    Route::prefix('system-settings')->name('system-settings.')->group(function () {
        Route::get('/general-settings', [GeneralSettingController::class, 'generalSettings'])->name('general-settings');
        Route::post('/general-settings', [GeneralSettingController::class, 'generalSettingsStore'])->name('general-settings.store');
    });
});
