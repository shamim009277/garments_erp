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
            Route::post('/payment_terms/toggle', [PaymentTermController::class, 'toggleStatus'])->name('payment_terms.toggle');
            Route::post('/payment_terms/delete', [PaymentTermController::class, 'destroy'])->name('payment_terms.delete');
            Route::resource('payment_terms', PaymentTermController::class)->names('payment_terms');

            Route::post('/shipment_modes/toggle', [ShipmentModeController::class, 'toggleStatus'])->name('shipment_modes.toggle');
            Route::post('/shipment_modes/delete', [ShipmentModeController::class, 'destroy'])->name('shipment_modes.delete');
            Route::resource('shipment_modes', ShipmentModeController::class)->names('shipment_modes');

            Route::post('/payment_methods/toggle', [PaymentMethodController::class, 'toggleStatus'])->name('payment_methods.toggle');
            Route::post('/payment_methods/delete', [PaymentMethodController::class, 'destroy'])->name('payment_methods.delete');
            Route::resource('payment_methods', PaymentMethodController::class)->names('payment_methods');

            Route::post('/delivery_terms/toggle', [DeliveryTermController::class, 'toggleStatus'])->name('delivery_terms.toggle');
            Route::post('/delivery_terms/delete', [DeliveryTermController::class, 'destroy'])->name('delivery_terms.delete');
            Route::resource('delivery_terms', DeliveryTermController::class)->names('delivery_terms');
        });

        //Database
        Route::prefix('database')->name('database.')->group(function () {
            Route::post('/sales-contacts/search', [SalesContactController::class, 'getSearch'])->name('sales-contacts.search');
            Route::resource('sales-contacts', SalesContactController::class)->names('sales-contacts');
        });

    });
});
