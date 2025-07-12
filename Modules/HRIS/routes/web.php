<?php

use App\Http\Middleware\ModuleActive;
use Illuminate\Support\Facades\Route;
use Modules\HRIS\Http\Controllers\HRISController;
use Modules\HRIS\Http\Controllers\Setup\SexController;
use Modules\HRIS\Http\Controllers\Setup\ThanaController;
use Modules\HRIS\Http\Controllers\Setup\UnionController;
use Modules\HRIS\Http\Controllers\Setup\DistrictController;
use Modules\HRIS\Http\Controllers\Setup\DivisionController;
use Modules\HRIS\Http\Controllers\Setup\ReligionController;
use Modules\HRIS\Http\Controllers\Setup\MaritalStatusController;
use Modules\HRIS\Http\Controllers\Setup\NationalitiesController;
use Modules\HRIS\Http\Controllers\Setup\EducationBoardController;

Route::middleware(['auth', 'verified', ModuleActive::class . ':hris'])->group(function () {
    Route::resource('hris', HRISController::class)->names('hris');


    Route::prefix('hris')->name('hris.')->group(function () {
        //Setup
        Route::prefix('setup')->name('setup.')->group(function () {
            //Nationalities
            Route::post('/nationalities/toggle', [NationalitiesController::class, 'toggleStatus'])->name('nationalities.toggle');
            Route::post('/nationalities/delete', [NationalitiesController::class, 'destroy'])->name('nationalities.delete');
            Route::resource('nationalities', NationalitiesController::class)->names('nationalities');

            //Marital Status
            Route::post('/maritalstatus/toggle', [MaritalStatusController::class, 'toggleStatus'])->name('maritalstatus.toggle');
            Route::post('/maritalstatus/delete', [MaritalStatusController::class, 'destroy'])->name('maritalstatus.delete');
            Route::resource('maritalstatus', MaritalStatusController::class)->names('maritalstatus');

            //Sex
            Route::post('/sex/toggle', [SexController::class, 'toggleStatus'])->name('sex.toggle');
            Route::post('/sex/delete', [SexController::class, 'destroy'])->name('sex.delete');
            Route::resource('sex', SexController::class)->names('sex');

            //Religion
            Route::post('/religions/toggle', [ReligionController::class, 'toggleStatus'])->name('religions.toggle');
            Route::post('/religions/delete', [ReligionController::class, 'destroy'])->name('religions.delete');
            Route::resource('religions', ReligionController::class)->names('religions');

            //Division
            Route::post('/divisions/toggle', [DivisionController::class, 'toggleStatus'])->name('divisions.toggle');
            Route::post('/divisions/delete', [DivisionController::class, 'destroy'])->name('divisions.delete');
            Route::resource('divisions', DivisionController::class)->names('divisions');

            //District
            Route::post('/districts/toggle', [DistrictController::class, 'toggleStatus'])->name('districts.toggle');
            Route::post('/districts/delete', [DistrictController::class, 'destroy'])->name('districts.delete');
            Route::resource('districts', DistrictController::class)->names('districts');

            //Thana
            Route::post('/thanas/toggle', [ThanaController::class, 'toggleStatus'])->name('thanas.toggle');
            Route::post('/thanas/delete', [ThanaController::class, 'destroy'])->name('thanas.delete');
            Route::resource('thanas', ThanaController::class)->names('thanas');

            //Union
            Route::post('/unions/toggle', [UnionController::class, 'toggleStatus'])->name('unions.toggle');
            Route::post('/unions/delete', [UnionController::class, 'destroy'])->name('unions.delete');
            Route::resource('unions', UnionController::class)->names('unions');

            //Education Board
            Route::post('/educationboards/toggle', [EducationBoardController::class, 'toggleStatus'])->name('educationboards.toggle');
            Route::post('/educationboards/delete', [EducationBoardController::class, 'destroy'])->name('educationboards.delete');
            Route::resource('educationboards', EducationBoardController::class)->names('educationboards');
        });



    });
});
