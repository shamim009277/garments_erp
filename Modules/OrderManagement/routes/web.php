<?php

use Illuminate\Support\Facades\Route;
use Modules\OrderManagement\Http\Controllers\OrderManagementController;
use Modules\OrderManagement\Http\Controllers\Setup\BuyerController;
use Modules\OrderManagement\Http\Controllers\Setup\OrderTypeController;
use Modules\OrderManagement\Http\Controllers\Setup\TeamController;
use Modules\OrderManagement\Http\Controllers\Setup\PartNameController;
use Modules\OrderManagement\Http\Controllers\Setup\ColorGroupController;
use Modules\OrderManagement\Http\Controllers\Setup\ColorController;
use Modules\OrderManagement\Http\Controllers\Setup\CompositionController;
use Modules\OrderManagement\Http\Controllers\Setup\CountryController;
use Modules\OrderManagement\Http\Controllers\Setup\SizeGroupController;
use Modules\OrderManagement\Http\Controllers\Setup\SizeController;
use Modules\OrderManagement\Http\Controllers\Setup\ItemController;
use Modules\OrderManagement\Http\Controllers\Setup\YarnCountController;
use Modules\OrderManagement\Http\Controllers\Setup\FabricTypeController;
use Modules\OrderManagement\Http\Controllers\Setup\FabricSourceController;
use Modules\OrderManagement\Http\Controllers\Setup\FabricTreatmentsController;
use Modules\OrderManagement\Http\Controllers\Setup\ProductCategoryController;
use Modules\OrderManagement\Http\Controllers\Setup\TeamMemberController;
use Modules\OrderManagement\Http\Controllers\Setup\BuyerMerchantController;
use Modules\OrderManagement\Http\Controllers\Setup\AccessoriesController;
use Modules\OrderManagement\Http\Controllers\Setup\BrandCategoryController;
use Modules\OrderManagement\Http\Controllers\Setup\CostingHeadController;
use Modules\OrderManagement\Http\Controllers\Setup\SampleTypeController;
use Modules\OrderManagement\Http\Controllers\Setup\WashTypeController;
use Modules\OrderManagement\Http\Controllers\Setup\BomSetupController;



use Modules\OrderManagement\Http\Controllers\Database\InitialOrderController;
use Modules\OrderManagement\Http\Controllers\Database\OrderPricingController;

use Modules\OrderManagement\Http\Controllers\Database\BasicOrderController;
use Modules\OrderManagement\Http\Controllers\Database\SampleOrderProgrammeController;
use Modules\OrderManagement\Http\Controllers\Database\BomController;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('ordermanagement', OrderManagementController::class)->names('ordermanagement');
    Route::prefix('ordermanagement')->name('ordermanagement.')->group(function () {
        //Setup
        Route::prefix('setup')->name('setup.')->group(function () {
            Route::post('/buyers/toggle', [BuyerController::class, 'toggleStatus'])->name('buyers.toggle');
            Route::resource('buyers', BuyerController::class)->names('buyers');
            
            Route::post('/ordertypes/toggle', [OrderTypeController::class, 'toggleStatus'])->name('ordertypes.toggle');
            Route::post('/ordertypes/delete', [OrderTypeController::class, 'destroy'])->name('ordertypes.delete');
            Route::resource('ordertypes', OrderTypeController::class)->names('ordertypes');

            Route::post('/teams/toggle', [TeamController::class, 'toggleStatus'])->name('teams.toggle');
            Route::post('/teams/delete', [TeamController::class, 'destroy'])->name('teams.delete');
            Route::resource('teams', TeamController::class)->names('teams');
            
            Route::post('/teammembers/toggle', [TeamMemberController::class, 'toggleStatus'])->name('teammembers.toggle');
            Route::post('/teammembers/delete', [TeamMemberController::class, 'destroy'])->name('teammembers.delete');
            Route::resource('teammembers', TeamMemberController::class)->names('teammembers');
            Route::resource('buyermerchants', BuyerMerchantController::class)->names('buyermerchants');
            Route::resource('accessories', AccessoriesController::class)->names('accessories');
            Route::resource('brandcategories', BrandCategoryController::class)->names('brandcategories');
            Route::resource('costingheads', CostingHeadController::class)->names('costingheads');
            Route::resource('partnames', PartNameController::class)->names('partnames');

            Route::post('/colorgroups/toggle', [ColorGroupController::class, 'toggleStatus'])->name('colorgroups.toggle');
            Route::post('/colorgroups/delete', [ColorGroupController::class, 'destroy'])->name('colorgroups.delete');
            Route::resource('colorgroups', ColorGroupController::class)->names('colorgroups');

            //ColorController
            Route::post('/colors/toggle', [ColorController::class, 'toggleStatus'])->name('colors.toggle');
            Route::post('/colors/delete', [ColorController::class, 'destroy'])->name('colors.delete');
            Route::resource('colors', ColorController::class)->names('colors');

            //CompositionController
            Route::post('/compositions/toggle', [CompositionController::class, 'toggleStatus'])->name('compositions.toggle');
            Route::post('/compositions/delete', [CompositionController::class, 'destroy'])->name('compositions.delete');
            Route::resource('compositions', CompositionController::class)->names('compositions');

            //CountryController
            Route::post('/countries/toggle', [CountryController::class, 'toggleStatus'])->name('countries.toggle');
            Route::post('/countries/delete', [CountryController::class, 'destroy'])->name('countries.delete');
            Route::resource('countries', CountryController::class)->names('countries');

            //SizeGroupController
            Route::post('/sizegroups/toggle', [SizeGroupController::class, 'toggleStatus'])->name('sizegroups.toggle');
            Route::post('/sizegroups/delete', [SizeGroupController::class, 'destroy'])->name('sizegroups.delete');
            Route::resource('sizegroups', SizeGroupController::class)->names('sizegroups');

            //SizeController
            Route::post('/sizes/toggle', [SizeController::class, 'toggleStatus'])->name('sizes.toggle');
            Route::post('/sizes/delete', [SizeController::class, 'destroy'])->name('sizes.delete');
            Route::resource('sizes', SizeController::class)->names('sizes');
            //ItemController
            Route::post('/items/toggle', [ItemController::class, 'toggleStatus'])->name('items.toggle');
            Route::post('/items/delete', [ItemController::class, 'destroy'])->name('items.delete');
            Route::resource('items', ItemController::class)->names('items');
            //for ajax call
            Route::get('/ordermanagements/setup/items/get-subcategories', [ItemController::class, 'getSubcategories'])->name('items.getSubcategories');

            //YarnCountController
            Route::post('/yarncounts/toggle', [YarnCountController::class, 'toggleStatus'])->name('yarncounts.toggle');
            Route::post('/yarncounts/delete', [YarnCountController::class, 'destroy'])->name('yarncounts.delete');
            Route::resource('yarncounts', YarnCountController::class)->names('yarncounts');

            //FabricTypeController
            Route::post('/fabictypes/toggle', [FabricTypeController::class, 'toggleStatus'])->name('fabictypes.toggle');
            Route::post('/fabictypes/delete', [FabricTypeController::class, 'destroy'])->name('fabictypes.delete');
            Route::resource('fabictypes', FabricTypeController::class)->names('fabictypes');

            //FabricSourceController
            Route::post('/fabricsources/toggle', [FabricSourceController::class, 'toggleStatus'])->name('fabricsources.toggle');
            Route::post('/fabricsources/delete', [FabricSourceController::class, 'destroy'])->name('fabricsources.delete');
            Route::resource('fabricsources', FabricSourceController::class)->names('fabricsources');

            //FabricTreatmentsController
            Route::post('/fabictreatments/toggle', [FabricTreatmentsController::class, 'toggleStatus'])->name('fabictreatments.toggle');
            Route::post('/fabictreatments/delete', [FabricTreatmentsController::class, 'destroy'])->name('fabictreatments.delete');
            Route::resource('fabictreatments', FabricTreatmentsController::class)->names('fabictreatments');

            //ProductCategoryController
            Route::post('/productcategories/toggle', [ProductCategoryController::class, 'toggleStatus'])->name('productcategories.toggle');
            Route::post('/productcategories/delete', [ProductCategoryController::class, 'destroy'])->name('productcategories.delete');
            Route::resource('productcategories', ProductCategoryController::class)->names('productcategories');

            //SampleTypeController
            Route::post('/sampletypes/toggle', [SampleTypeController::class, 'toggleStatus'])->name('sampletypes.toggle');
            Route::post('/sampletypes/delete', [SampleTypeController::class, 'destroy'])->name('sampletypes.delete');
            Route::resource('sampletypes', SampleTypeController::class)->names('sampletypes');

            //WashTypeController
            Route::post('/washtypes/toggle', [WashTypeController::class, 'toggleStatus'])->name('washtypes.toggle');
            Route::post('/washtypes/delete', [WashTypeController::class, 'destroy'])->name('washtypes.delete');
            Route::resource('washtypes', WashTypeController::class)->names('washtypes');

            //BomSetupController
          

            // Route::post('/bomsetups/toggle', [BomSetupController::class, 'toggleStatus'])->name('bomsetups.toggle');
            // Route::post('/bomsetups/delete', [BomSetupController::class, 'destroy'])->name('bomsetups.delete');
            Route::resource('bomsetups', BomSetupController::class)->names('bomsetups');
        });

        //Database
        Route::prefix('database')->name('database.')->group(function () {
            Route::get('initialorders/pdf/{id}', [InitialOrderController::class, 'pdfData'])->name('intitialorders.pdf');
            Route::resource('initialorders', InitialOrderController::class)->names('initialorders');

            Route::post('orderpricing/measurement/store', [OrderPricingController::class, 'storeMeasurement'])->name('orderpricing.measurement.store');
            Route::delete('orderpricing/measurement/delete/{id}', [OrderPricingController::class, 'deleteMeasurement'])->name('orderpricing.measurement.delete');
            Route::post('orderpricing/fabrics-cost/store', [OrderPricingController::class, 'storeFabricsCost'])->name('orderpricing.fabrics-cost.store');
            Route::delete('orderpricing/fabrics-cost/delete/{id}', [OrderPricingController::class, 'deleteFabricsCost'])->name('orderpricing.fabrics-cost.delete');

            Route::post('orderpricing/accessory/store', [OrderPricingController::class, 'storeAccessory'])->name('orderpricing.accessory.store');
            Route::delete('orderpricing/accessory/delete/{id}', [OrderPricingController::class, 'deleteAccessory'])->name('orderpricing.accessory.delete');
            Route::resource('orderpricing', OrderPricingController::class)->names('orderpricing');
            Route::resource('sampleorderprogramme', SampleOrderProgrammeController::class)->names('sampleorderprogramme');


             //BasicOrderController
            Route::post('/basicorders/toggle', [BasicOrderController::class, 'toggleStatus'])->name('basicorders.toggle');
            Route::post('/basicorders/delete', [BasicOrderController::class, 'destroy'])->name('basicorders.delete');
            Route::resource('basicorders', BasicOrderController::class)->names('basicorders');
            // inventory.database.basicorders.lots-colors-sizes.store
            Route::post('/basicorders/lots-colors-sizes/store/{id}', [BasicOrderController::class, 'storeLotsColorsSizes'])->name('basicorders.lots-colors-sizes.store');
            Route::post('/basicorders/lotcolorsizes/update/{id}', [BasicOrderController::class, 'updateLotsColorsSizes'])->name('basicorders.lots-colors-sizes.update');

            // inventory.database.basicorders.lots
            Route::post('/basicorders/lots/store/{id}', [BasicOrderController::class, 'storeLots'])->name('basicorders.lots.store');
            // inventory.database.basicorders.colors_sizes.store
            Route::post('/basicorders/colors_sizes/store/{id}', [BasicOrderController::class, 'storeLotsColorsSizes'])->name('basicorders.colors_sizes.store');

            Route::post('/basicorders/update_lots/{id}', [BasicOrderController::class, 'updateLots'])->name('basicorders.update_lots');
            //swift Url Calling
            Route::get('basicorders/lot/{lot}/colors', [BasicOrderController::class, 'getColors'])->name('basicorders.lot.colors');
            Route::get('basicorders/color/{color}/sizes', [BasicOrderController::class, 'getSizes'])->name('basicorders.color.sizes');
            Route::get('basicorders/size_group/{size_group}/sizes', [BasicOrderController::class, 'getSizesBySizeGroup'])->name('basicorders.size_group.sizes');
            Route::resource('boms', BomController::class)->names('boms');

        });
    });
});
