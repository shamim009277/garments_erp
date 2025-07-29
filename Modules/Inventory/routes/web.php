<?php

use Illuminate\Support\Facades\Route;
use Modules\Inventory\Http\Controllers\InventoryController;
use App\Http\Middleware\ModuleActive;
use Modules\Inventory\Http\Controllers\Setup\BuyerController;
use Modules\Inventory\Http\Controllers\Setup\StoreTypeController;
use Modules\Inventory\Http\Controllers\Setup\StoreLineController;
use Modules\Inventory\Http\Controllers\Setup\RackLocationController;
use Modules\Inventory\Http\Controllers\Setup\StoreLocationController;
use Modules\Inventory\Http\Controllers\Setup\SupplierTypeController;
use Modules\Inventory\Http\Controllers\Setup\SupplierController;

Route::middleware(['auth', 'verified', ModuleActive::class . ':inventory'])->group(function () {
    Route::resource('inventory', InventoryController::class)->names('inventory');

    Route::prefix('inventory')->name('inventory.')->group(function () {
        //Setup
        Route::prefix('setup')->name('setup.')->group(function () {
            //Party
            Route::post('/parties/toggle', [InventoryController::class, 'toggleStatus'])->name('parties.toggle');
            Route::post('/parties/delete', [InventoryController::class, 'destroy'])->name('parties.delete');
            Route::resource('parties', InventoryController::class)->names('parties');

            //Buyer
            Route::post('/buyers/toggle', [BuyerController::class, 'toggleStatus'])->name('buyers.toggle');
            Route::post('/buyers/delete', [BuyerController::class, 'destroy'])->name('buyers.delete');
            Route::resource('buyers', BuyerController::class)->names('buyers');

            //StoreTypeController
            Route::post('/storetypes/toggle', [StoreTypeController::class, 'toggleStatus'])->name('storetypes.toggle');
            Route::post('/storetypes/delete', [StoreTypeController::class, 'destroy'])->name('storetypes.delete');
            Route::resource('storetypes', StoreTypeController::class)->names('storetypes');

            //StoreLineController
            Route::post('/storelines/toggle', [StoreLineController::class, 'toggleStatus'])->name('storelines.toggle');
            Route::post('/storelines/delete', [StoreLineController::class, 'destroy'])->name('storelines.delete');
            Route::resource('storelines', StoreLineController::class)->names('storelines');

            //RackLocationController
            Route::post('/racklocations/toggle', [RackLocationController::class, 'toggleStatus'])->name('racklocations.toggle');
            Route::post('/racklocations/delete', [RackLocationController::class, 'destroy'])->name('racklocations.delete');
            Route::resource('racklocations', RackLocationController::class)->names('racklocations');

            //StoreLocationController
            Route::post('/storelocations/toggle', [StoreLocationController::class, 'toggleStatus'])->name('storelocations.toggle');
            Route::post('/storelocations/delete', [StoreLocationController::class, 'destroy'])->name('storelocations.delete');
            Route::resource('storelocations', StoreLocationController::class)->names('storelocations');

            //SupplierTypeController
            Route::post('/suppliertypes/toggle', [SupplierTypeController::class, 'toggleStatus'])->name('suppliertypes.toggle');
            Route::post('/suppliertypes/delete', [SupplierTypeController::class, 'destroy'])->name('suppliertypes.delete');
            Route::resource('suppliertypes', SupplierTypeController::class)->names('suppliertypes');

            //SupplierController
            Route::post('/suppliers/toggle', [SupplierController::class, 'toggleStatus'])->name('suppliers.toggle');
            Route::post('/suppliers/delete', [SupplierController::class, 'destroy'])->name('suppliers.delete');
            Route::resource('suppliers', SupplierController::class)->names('suppliers');
        });
    });
});
