<?php

use App\Http\Middleware\ModuleActive;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administration\MenuController;
use App\Http\Controllers\Administration\RoleController;
use App\Http\Controllers\Administration\UserController;
use App\Http\Controllers\Administration\ModuleController;
use App\Http\Controllers\Administration\PermissionController;
use App\Http\Controllers\Administration\AdministrationController;

Route::middleware(['auth', 'verified',ModuleActive::class.':administration'])->prefix('administration')->name('administration.')->group(function () {
    Route::get('/', [AdministrationController::class, 'index'])->name('index');

    //Module
    Route::post('/module/toggle', [ModuleController::class, 'toggleStatus'])->name('module.toggle');
    Route::post('/module/delete', [ModuleController::class, 'destroy'])->name('module.delete');
    Route::resource('modules', ModuleController::class)->names('module');

    //Menu
    Route::get('/menu/{id}/parents', [MenuController::class, 'getMenuParents'])->name('menu.parents');
    Route::get('/menu/{id}/childs', [MenuController::class, 'getMenuChilds'])->name('menu.childs');
    Route::post('/menu/toggle', [MenuController::class, 'toggleStatus'])->name('menu.toggle');
    Route::post('/menu/delete', [MenuController::class, 'destroy'])->name('menu.delete');
    Route::resource('menus', MenuController::class)->names('menu');

    //Authorization
    Route::prefix('authorization')->name('authorization.')->group(function () {
        //Permission
        Route::post('/permission/delete', [PermissionController::class, 'destroy'])->name('permission.delete');
        Route::post('/permission/toggle', [PermissionController::class, 'toggleStatus'])->name('permission.toggle');
        Route::resource('permissions', PermissionController::class)->names('permission');

        //Role
        Route::post('/role/delete', [RoleController::class, 'destroy'])->name('role.delete');
        Route::post('/role/toggle', [RoleController::class, 'toggleStatus'])->name('role.toggle');
        Route::resource('roles', RoleController::class)->names('role');

        //User
        Route::post('/user/delete', [UserController::class, 'destroy'])->name('user.delete');
        Route::post('/user/toggle', [UserController::class, 'toggleStatus'])->name('user.toggle');
        Route::resource('users', UserController::class)->names('user');
    });


});
