<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\Setup\UnitsController;
use App\Http\Controllers\Master\MasterController;
use App\Http\Controllers\Master\SystemSetting\GeneralSettingController;

Route::middleware(['auth', 'verified'])->prefix('master')->name('master.')->group(function () {
    Route::get('/', [MasterController::class, 'index'])->name('index');

    Route::prefix('system-settings')->name('system-settings.')->group(function () {
        Route::get('/general-settings', [GeneralSettingController::class, 'generalSettings'])->name('general-settings');
        Route::post('/general-settings', [GeneralSettingController::class, 'generalSettingsStore'])->name('general-settings.store');
    });

    Route::prefix('setup')->name('setup.')->group(function () {
        //User
        Route::post('/units/delete', [UnitsController::class, 'destroy'])->name('units.delete');
        Route::post('/units/toggle', [UnitsController::class, 'toggleStatus'])->name('units.toggle');
        Route::resource('units', UnitsController::class)->names('unit');
    });
});
