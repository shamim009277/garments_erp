<?php

use App\Http\Middleware\ModuleActive;
use Illuminate\Support\Facades\Route;
use Modules\IPE\Http\Controllers\IPEController;
use Modules\IPE\Http\Controllers\Setting\AssessmentAccessController;
use Modules\IPE\Http\Controllers\Setup\HelperQuestionsController;



// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('ipes', IPEController::class)->names('ipe');
// });

Route::middleware(['auth', 'verified',ModuleActive::class.':ipe'])->group(function () {
    Route::resource('ipe', IPEController::class)->names('ipe');

    Route::prefix('ipe')->name('ipe.')->group(function () {
        //Setup
        Route::prefix('setup')->name('setup.')->group(function () {
            Route::post('/helperquestions/toggle', [HelperQuestionsController::class, 'toggleStatus'])->name('helperquestions.toggle');
            Route::post('/helperquestions/delete', [HelperQuestionsController::class, 'destroy'])->name('helperquestions.delete');
            Route::resource('helperquestions', HelperQuestionsController::class)->names('helperquestions');
        });


        
        //Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::post('/assessment-access/delete', [AssessmentAccessController::class, 'destroy'])->name('assessment-access.delete');
            Route::post('/assessment-access/replace', [AssessmentAccessController::class, 'replace'])->name('assessment-access.replace');
            Route::resource('assessment-access', AssessmentAccessController::class)->names('assessment-access');
        });
    });
});
