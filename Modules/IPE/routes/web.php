<?php

use App\Http\Middleware\ModuleActive;
use Illuminate\Support\Facades\Route;
use Modules\IPE\Http\Controllers\Database\AssessmentController;
use Modules\IPE\Http\Controllers\IPEController;
use Modules\IPE\Http\Controllers\Setting\AssessmentAccessController;
use Modules\IPE\Http\Controllers\Setup\AssessmentGroupController;
use Modules\IPE\Http\Controllers\Setup\HelperQuestionsController;
use Modules\IPE\Http\Controllers\Setup\MachineProcessController;
use Modules\IPE\Http\Controllers\Setup\MachineTypeController;
use Modules\IPE\Http\Controllers\Setup\PackingQuestionsController;
use Modules\IPE\Http\Controllers\Setup\ProcessController;
use Modules\IPE\Http\Controllers\Setup\QualityQuestionsController;



Route::middleware(['auth', 'verified',ModuleActive::class.':ipe'])->group(function () {
    Route::get('/ipe/dashboard-data', [IPEController::class, 'getDashboardAjax'])->name('ipe.dashboard-data');
    Route::resource('ipe', IPEController::class)->names('ipe');

    Route::prefix('ipe')->name('ipe.')->group(function () {
        //Setup
        Route::prefix('setup')->name('setup.')->group(function () {
            Route::post('/helperquestions/toggle', [HelperQuestionsController::class, 'toggleStatus'])->name('helperquestions.toggle');
            Route::post('/helperquestions/delete', [HelperQuestionsController::class, 'destroy'])->name('helperquestions.delete');
            Route::resource('helperquestions', HelperQuestionsController::class)->names('helperquestions');

            Route::post('/packingquestions/toggle', [PackingQuestionsController::class, 'toggleStatus'])->name('packingquestions.toggle');
            Route::post('/packingquestions/delete', [PackingQuestionsController::class, 'destroy'])->name('packingquestions.delete');
            Route::resource('packingquestions', PackingQuestionsController::class)->names('packingquestions');

            Route::post('/qualityquestions/toggle', [QualityQuestionsController::class, 'toggleStatus'])->name('qualityquestions.toggle');
            Route::post('/qualityquestions/delete', [QualityQuestionsController::class, 'destroy'])->name('qualityquestions.delete');
            Route::resource('qualityquestions', QualityQuestionsController::class)->names('qualityquestions');

            Route::post('/assessment-groups/toggle', [AssessmentGroupController::class, 'toggleStatus'])->name('assessment-groups.toggle');
            Route::post('/assessment-groups/delete', [AssessmentGroupController::class, 'destroy'])->name('assessment-groups.delete');
            Route::resource('assessment-groups', AssessmentGroupController::class)->names('assessment-groups');

            Route::post('/processes/toggle', [ProcessController::class, 'toggleStatus'])->name('processes.toggle');
            Route::post('/processes/delete', [ProcessController::class, 'destroy'])->name('processes.delete');
            Route::resource('processes', ProcessController::class)->names('processes');

            Route::post('/machineprocesses/toggle', [MachineProcessController::class, 'toggleStatus'])->name('machineprocesses.toggle');
            Route::post('/machineprocesses/delete', [MachineProcessController::class, 'destroy'])->name('machineprocesses.delete');
            Route::resource('machineprocesses', MachineProcessController::class)->names('machineprocesses');

            Route::post('/machine-types/toggle', [MachineTypeController::class, 'toggleStatus'])->name('machine-types.toggle');
            Route::post('/machine-types/delete', [MachineTypeController::class, 'destroy'])->name('machine-types.delete');
            Route::resource('machine-types', MachineTypeController::class)->names('machine-types');
        });

        //Database
        Route::prefix('database')->name('database.')->group(function () {
            Route::get('/assessments/pdf/{id}', [AssessmentController::class, 'pdf'])->name('assessments.pdf');
            Route::post('/assessments/search', [AssessmentController::class, 'getSearch'])->name('assessments.search');
            Route::post('/assessments/complete', [AssessmentController::class, 'completeAssessment'])->name('assessments.complete');
            Route::post('/assessment/question/store', [AssessmentController::class, 'storeQuestion'])->name('assessment.question.store');
            Route::post('/assessment/qualityquestion/store', [AssessmentController::class, 'storeQualityQuestion'])->name('assessment.qualityquestion.store');
            Route::post('/assessment/process/store', [AssessmentController::class, 'storeProcess'])->name('assessment.process.store');
            Route::post('/assessment/machineprocesses/store', [AssessmentController::class, 'storeMachineProcess'])->name('assessment.machineprocesses.store');
            Route::post('/assessment/process/delete', [AssessmentController::class, 'destroyProcess'])->name('assessment.process.delete');
            Route::post('/assessment/machineprocesses/delete', [AssessmentController::class, 'destroyMachineProcess'])->name('assessment.machineprocesses.delete');
            Route::post('/assessment/delete', [AssessmentController::class, 'destroy'])->name('assessment.delete');
            Route::get('/assessment/machine-wise-process/{machine_id}', [AssessmentController::class, 'getMachineProcess'])->name('assessment.machine-wise-process.search');
            Route::resource('assessments', AssessmentController::class)->names('assessments');
        });


        //Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::post('/assessment-access/delete', [AssessmentAccessController::class, 'destroy'])->name('assessment-access.delete');
            Route::post('/assessment-access/replace', [AssessmentAccessController::class, 'replace'])->name('assessment-access.replace');
            Route::resource('assessment-access', AssessmentAccessController::class)->names('assessment-access');
        });
    });
});
