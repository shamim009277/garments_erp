<?php

use App\Http\Middleware\ModuleActive;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administration\MenuController;
use App\Http\Controllers\Administration\ModuleController;
use App\Http\Controllers\Administration\AdministrationController;


Route::middleware(['auth', 'verified',ModuleActive::class.':administration'])->prefix('administration')->name('administration.')->group(function () {
    Route::get('/', [AdministrationController::class, 'index'])->name('index');

    Route::post('/module/toggle', [ModuleController::class, 'toggleStatus'])->name('module.toggle');
    Route::post('/module/delete', [ModuleController::class, 'destroy'])->name('module.delete');
    Route::resource('modules', ModuleController::class)->names('module');

    Route::get('/menu/{id}/parents', [MenuController::class, 'getMenuParents'])->name('menu.parents');
    Route::post('/menu/toggle', [MenuController::class, 'toggleStatus'])->name('menu.toggle');
    Route::post('/menu/delete', [MenuController::class, 'destroy'])->name('menu.delete');
    Route::resource('menus', MenuController::class)->names('menu');
});
