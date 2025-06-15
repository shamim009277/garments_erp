<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckModuleActive;
use App\Http\Controllers\Administration\ModuleController;
use App\Http\Controllers\Administration\AdministrationController;


Route::middleware(['auth', 'verified',CheckModuleActive::class.':administration'])->prefix('administration')->name('administration.')->group(function () {
    Route::get('/', [AdministrationController::class, 'index'])->name('index');

    Route::resource('modules', ModuleController::class)->names('module');
});
