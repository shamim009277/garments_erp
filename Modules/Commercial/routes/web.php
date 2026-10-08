<?php

use App\Http\Middleware\ModuleActive;
use Illuminate\Support\Facades\Route;
use Modules\Commercial\Http\Controllers\CommercialController;
use Modules\Commercial\Http\Controllers\Database\SalesContactController;
use Modules\Commercial\Http\Controllers\Setup\DeliveryTermController;
use Modules\Commercial\Http\Controllers\Setup\PaymentMethodController;
use Modules\Commercial\Http\Controllers\Setup\PaymentTermController;
use Modules\Commercial\Http\Controllers\Setup\ShipmentModeController;





Route::middleware(['auth', 'verified',ModuleActive::class.':commercial'])->group(function () {
    Route::resource('commercial', CommercialController::class)->names('commercial');

    Route::prefix('commercial')->name('commercial.')->group(function () {
        //Setup
        Route::prefix('setup')->name('setup.')->group(function () {
            Route::post('/payment-terms/toggle', [PaymentTermController::class, 'toggleStatus'])->name('payment-terms.toggle');
            Route::post('/payment-terms/delete', [PaymentTermController::class, 'destroy'])->name('payment-terms.delete');
            Route::resource('payment-terms', PaymentTermController::class)->names('payment-terms');

            Route::post('/shipment-modes/toggle', [ShipmentModeController::class, 'toggleStatus'])->name('shipment-modes.toggle');
            Route::post('/shipment-modes/delete', [ShipmentModeController::class, 'destroy'])->name('shipment-modes.delete');
            Route::resource('shipment-modes', ShipmentModeController::class)->names('shipment-modes');

            Route::post('/payment-methods/toggle', [PaymentMethodController::class, 'toggleStatus'])->name('payment-methods.toggle');
            Route::post('/payment-methods/delete', [PaymentMethodController::class, 'destroy'])->name('payment-methods.delete');
            Route::resource('payment-methods', PaymentMethodController::class)->names('payment-methods');

            Route::post('/delivery-terms/toggle', [DeliveryTermController::class, 'toggleStatus'])->name('delivery-terms.toggle');
            Route::post('/delivery-terms/delete', [DeliveryTermController::class, 'destroy'])->name('delivery-terms.delete');
            Route::resource('delivery-terms', DeliveryTermController::class)->names('delivery-terms');
        });

        //Database
        Route::prefix('database')->name('database.')->group(function () {
            Route::post('/sales-contact/search', [SalesContactController::class, 'getSearch'])->name('sales-contact.search');
            Route::resource('sales-contact', SalesContactController::class)->names('sales-contact');
        });

    });
});
