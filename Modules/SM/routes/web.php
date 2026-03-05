<?php

use Illuminate\Support\Facades\Route;
use Modules\SM\Http\Controllers\SMController;
use Modules\SM\Http\Controllers\Setup\LineController;
use Modules\SM\Http\Controllers\Setup\GroupController;
use Modules\SM\Http\Controllers\Setup\SewingGroupController;
use Modules\SM\Http\Controllers\Setup\SewingLineController;
use Modules\SM\Http\Controllers\Database\SampleOrderProgrammeController;
use Modules\SM\Http\Controllers\Database\SampleOrderProductionController;
use Modules\SM\Http\Controllers\Database\SampleDeliveryController;

use Modules\SM\Http\Controllers\Report\SampleProductionReportController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sms', SMController::class)->names('sms');
    
    // Reports
    Route::prefix('sms/report')->name('sms.report.')->group(function () {
        Route::get('sample-production', [SampleProductionReportController::class, 'index'])->name('sample_production');
        Route::post('sample-production', [SampleProductionReportController::class, 'preview'])->name('production.preview');
    });

    // Setup Routes
    Route::prefix('sms/setup')->name('sms.setup.')->group(function () {
        Route::resource('lines', LineController::class);
        Route::post('lines/toggle', [LineController::class, 'toggleStatus'])->name('lines.toggle');

        Route::resource('groups', GroupController::class);
        Route::post('groups/toggle', [GroupController::class, 'toggleStatus'])->name('groups.toggle');

        Route::resource('sewing_groups', SewingGroupController::class);
        Route::post('sewing_groups/toggle', [SewingGroupController::class, 'toggleStatus'])->name('sewing_groups.toggle');

        Route::resource('sewing_lines', SewingLineController::class);
        Route::post('sewing_lines/toggle', [SewingLineController::class, 'toggleStatus'])->name('sewing_lines.toggle');
    });
    //Database
    Route::prefix('sms/database')->name('sms.database.')->group(function () {

        Route::resource('sampleorderprogramme', SampleOrderProgrammeController::class)->names('sampleorderprogramme');
        Route::get('sampleorderproduction/get-orders/{buyer_id}', [SampleOrderProductionController::class, 'getOrders'])->name('sampleorderproduction.get-orders');
        Route::get('sampleorderproduction/get-programmes/{order_id}', [SampleOrderProductionController::class, 'getProgrammes'])->name('sampleorderproduction.get-programmes');
        Route::get('sampleorderproduction/get-samples/{order_id}', [SampleOrderProductionController::class, 'getColors'])->name('sampleorderproduction.get-samples');
        Route::resource('sampleorderproduction', SampleOrderProductionController::class)->names('sampleorderproduction');
        Route::resource('sampledelivery', SampleDeliveryController::class)->names('sampledelivery');

        
    });

   
});
