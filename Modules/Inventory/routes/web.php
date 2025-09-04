<?php

use Illuminate\Support\Facades\Route;
use Modules\Inventory\Http\Controllers\InventoryController;
use App\Http\Middleware\ModuleActive;

use Modules\Inventory\Http\Controllers\Setup\StoreTypeController;
use Modules\Inventory\Http\Controllers\Setup\StoreLineController;
use Modules\Inventory\Http\Controllers\Setup\RackLocationController;
use Modules\Inventory\Http\Controllers\Setup\StoreLocationController;
use Modules\Inventory\Http\Controllers\Setup\SupplierTypeController;
use Modules\Inventory\Http\Controllers\Setup\SupplierController;
use Modules\Inventory\Http\Controllers\Setup\ChallanPurposeController;
use Modules\Inventory\Http\Controllers\Setup\GoodsCategoryController;
use Modules\Inventory\Http\Controllers\Setup\GoodsSubCategoryController;
use Modules\Inventory\Http\Controllers\Setup\CountryController;
use Modules\Inventory\Http\Controllers\Setup\ColorGroupController;
use Modules\Inventory\Http\Controllers\Setup\ColorController;
use Modules\Inventory\Http\Controllers\Setup\SizeController;
use Modules\Inventory\Http\Controllers\Setup\SizeGroupController;
use Modules\Inventory\Http\Controllers\Setup\BuyerController;
use Modules\Inventory\Http\Controllers\Setup\ItemController;
use Modules\Inventory\Http\Controllers\Setup\CompositionController;
use Modules\Inventory\Http\Controllers\Setup\YarnCountController;
use Modules\Inventory\Http\Controllers\Setup\FabricTypeController;
use Modules\Inventory\Http\Controllers\Setup\FabricTreatmentsController;
use Modules\Inventory\Http\Controllers\Setup\ProductCategoryController;
use Modules\Inventory\Http\Controllers\Setup\ForwardApprovePannelController;


use Modules\Inventory\Http\Controllers\Database\BasicOrderController;




use Modules\Inventory\Http\Controllers\Database\PurchaseRequisitionController;
use Modules\Inventory\Http\Controllers\Database\PurRequisitionMainController;
use Modules\Inventory\Http\Controllers\Database\PurRequisitionDetailController;

use Modules\Inventory\Http\Controllers\Database\ReqForwardingController;
use Modules\Inventory\Http\Controllers\Database\ReqPricingController;
use Modules\Inventory\Http\Controllers\Database\ReqFinalApprovalController;
use Modules\Inventory\Http\Controllers\Database\ReqAccClearanceController;
use Modules\Inventory\Http\Controllers\Database\ReqApprovalController;





Route::middleware(['auth', 'verified', ModuleActive::class . ':inventory'])->group(function () {
    Route::resource('inventory', InventoryController::class)->names('inventory');

    Route::prefix('inventory')->name('inventory.')->group(function () {
        //Setup
        Route::prefix('setup')->name('setup.')->group(function () {
            //Party
            Route::post('/parties/toggle', [InventoryController::class, 'toggleStatus'])->name('parties.toggle');
            Route::post('/parties/delete', [InventoryController::class, 'destroy'])->name('parties.delete');
            Route::resource('parties', InventoryController::class)->names('parties');

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

            //ChallanPurposeController
            Route::post('/challanpurposes/toggle', [ChallanPurposeController::class, 'toggleStatus'])->name('challanpurposes.toggle');
            Route::post('/challanpurposes/delete', [ChallanPurposeController::class, 'destroy'])->name('challanpurposes.delete');
            Route::resource('challanpurposes', ChallanPurposeController::class)->names('challanpurposes');

            //GoodsCategoryController
            Route::post('/goodscategories/toggle', [GoodsCategoryController::class, 'toggleStatus'])->name('goodscategories.toggle');
            Route::post('/goodscategories/delete', [GoodsCategoryController::class, 'destroy'])->name('goodscategories.delete');
            Route::resource('goodscategories', GoodsCategoryController::class)->names('goodscategories');

            //GoodsSubCategoryController
            Route::post('/goodsSubCategories/toggle', [GoodsSubCategoryController::class, 'toggleStatus'])->name('goodsSubCategories.toggle');
            Route::post('/goodsSubCategories/delete', [GoodsSubCategoryController::class, 'destroy'])->name('goodsSubCategories.delete');
            Route::resource('goodsSubCategories', GoodsSubCategoryController::class)->names('goodsSubCategories');

            //CountryController
            Route::post('/countries/toggle', [CountryController::class, 'toggleStatus'])->name('countries.toggle');
            Route::post('/countries/delete', [CountryController::class, 'destroy'])->name('countries.delete');
            Route::resource('countries', CountryController::class)->names('countries');

            //ColorGroupController
            Route::post('/colorgroups/toggle', [ColorGroupController::class, 'toggleStatus'])->name('colorgroups.toggle');
            Route::post('/colorgroups/delete', [ColorGroupController::class, 'destroy'])->name('colorgroups.delete');
            Route::resource('colorgroups', ColorGroupController::class)->names('colorgroups');

            //ColorController
            Route::post('/colors/toggle', [ColorController::class, 'toggleStatus'])->name('colors.toggle');
            Route::post('/colors/delete', [ColorController::class, 'destroy'])->name('colors.delete');
            Route::resource('colors', ColorController::class)->names('colors');

            //SizeGroupController
            Route::post('/sizegroups/toggle', [SizeGroupController::class, 'toggleStatus'])->name('sizegroups.toggle');
            Route::post('/sizegroups/delete', [SizeGroupController::class, 'destroy'])->name('sizegroups.delete');
            Route::resource('sizegroups', SizeGroupController::class)->names('sizegroups');

            //SizeController
            Route::post('/sizes/toggle', [SizeController::class, 'toggleStatus'])->name('sizes.toggle');
            Route::post('/sizes/delete', [SizeController::class, 'destroy'])->name('sizes.delete');
            Route::resource('sizes', SizeController::class)->names('sizes');

            //BuyerController
            Route::post('/buyers/toggle', [BuyerController::class, 'toggleStatus'])->name('buyers.toggle');
            Route::post('/buyers/delete', [BuyerController::class, 'destroy'])->name('buyers.delete');
            Route::resource('buyers', BuyerController::class)->names('buyers');

            //ItemController
            Route::post('/items/toggle', [ItemController::class, 'toggleStatus'])->name('items.toggle');
            Route::post('/items/delete', [ItemController::class, 'destroy'])->name('items.delete');
            Route::resource('items', ItemController::class)->names('items');
            //for ajax call
            Route::get('/inventory/setup/items/get-subcategories', [ItemController::class, 'getSubcategories'])->name('items.getSubcategories');

            //CompositionController
            Route::post('/compositions/toggle', [CompositionController::class, 'toggleStatus'])->name('compositions.toggle');
            Route::post('/compositions/delete', [CompositionController::class, 'destroy'])->name('compositions.delete');
            Route::resource('compositions', CompositionController::class)->names('compositions');

            //YarnCountController
            Route::post('/yarncounts/toggle', [YarnCountController::class, 'toggleStatus'])->name('yarncounts.toggle');
            Route::post('/yarncounts/delete', [YarnCountController::class, 'destroy'])->name('yarncounts.delete');
            Route::resource('yarncounts', YarnCountController::class)->names('yarncounts');

            //FabricTypeController
            Route::post('/fabictypes/toggle', [FabricTypeController::class, 'toggleStatus'])->name('fabictypes.toggle');
            Route::post('/fabictypes/delete', [FabricTypeController::class, 'destroy'])->name('fabictypes.delete');
            Route::resource('fabictypes', FabricTypeController::class)->names('fabictypes');

            //FabricTreatmentsController
            Route::post('/fabictreatments/toggle', [FabricTreatmentsController::class, 'toggleStatus'])->name('fabictreatments.toggle');
            Route::post('/fabictreatments/delete', [FabricTreatmentsController::class, 'destroy'])->name('fabictreatments.delete');
            Route::resource('fabictreatments', FabricTreatmentsController::class)->names('fabictreatments');

            //ProductCategoryController
            Route::post('/productcategories/toggle', [ProductCategoryController::class, 'toggleStatus'])->name('productcategories.toggle');
            Route::post('/productcategories/delete', [ProductCategoryController::class, 'destroy'])->name('productcategories.delete');
            Route::resource('productcategories', ProductCategoryController::class)->names('productcategories');

            //ForwardApprovePannelController
            Route::post('/forapppannel/toggle', [ForwardApprovePannelController::class, 'toggleStatus'])->name('forapppannel.toggle');
            Route::post('/forapppannel/delete', [ForwardApprovePannelController::class, 'destroy'])->name('forapppannel.delete');
            Route::resource('forapppannel', ForwardApprovePannelController::class)->names('forapppannel');
        });

        //Database
        Route::prefix('database')->name('database.')->group(function () {

            //BasicOrderController
            Route::post('/basicorders/toggle', [BasicOrderController::class, 'toggleStatus'])->name('basicorders.toggle');
            Route::post('/basicorders/delete', [BasicOrderController::class, 'destroy'])->name('basicorders.delete');
            Route::resource('basicorders', BasicOrderController::class)->names('basicorders');
            // inventory.database.basicorders.lots-colors-sizes.store
            Route::post('/basicorders/lots-colors-sizes/store/{id}', [BasicOrderController::class, 'storeLotsColorsSizes'])->name('basicorders.lots-colors-sizes.store');
            // inventory.database.basicorders.lots
            Route::post('/basicorders/lots/store/{id}', [BasicOrderController::class, 'storeLots'])->name('basicorders.lots.store');
            // inventory.database.basicorders.colors_sizes.store
            Route::post('/basicorders/colors_sizes/store/{id}', [BasicOrderController::class, 'storeColorsSizes'])->name('basicorders.colors_sizes.store');

            Route::post('/basicorders/update_lots/{id}', [BasicOrderController::class, 'updateLots'])->name('basicorders.update_lots');
            //swift Url Calling
            Route::get('basicorders/lot/{lot}/colors', [BasicOrderController::class, 'getColors'])->name('basicorders.lot.colors');
            Route::get('basicorders/color/{color}/sizes', [BasicOrderController::class, 'getSizes'])->name('basicorders.color.sizes');
            Route::get('basicorders/size_group/{size_group}/sizes', [BasicOrderController::class, 'getSizesBySizeGroup'])->name('basicorders.size_group.sizes');

            //protoy
            Route::put('purrequisitions/search', [PurchaseRequisitionController::class, 'search'])->name('purrequisitions.search');
            Route::resource('purrequisitions', PurchaseRequisitionController::class)->names('purrequisitions');
            Route::put('purrequisitionmains/search', [PurRequisitionMainController::class, 'search'])->name('purrequisitionmains.search');
            Route::put('purrequisitionmains/multiplestatus/{id}', [PurRequisitionMainController::class, 'multipleStatus'])->name('purrequisitionmains.multiplestatus');
            Route::resource('purrequisitionmains', PurRequisitionMainController::class)->names('purrequisitionmains');
            Route::resource('purrequisitiondetails', PurRequisitionDetailController::class)->names('purrequisitiondetails');

            Route::put('reqforwarding/search', [ReqForwardingController::class, 'search'])->name('reqforwarding.search');
            Route::put('reqforwarding/multiplestatus/{id}', [ReqForwardingController::class, 'multipleStatus'])->name('reqforwarding.multiplestatus');
            Route::resource('reqforwarding', ReqForwardingController::class)->names('reqforwarding');

            Route::put('reqpricing/search', [ReqPricingController::class, 'search'])->name('reqpricing.search');
            Route::put('reqpricing/multiplestatus/{id}', [ReqPricingController::class, 'multipleStatus'])->name('reqpricing.multiplestatus');
            Route::resource('reqpricing', ReqPricingController::class)->names('reqpricing');

            Route::put('reqapproval/search', [ReqApprovalController::class, 'search'])->name('reqapproval.search');
            Route::put('reqapproval/multiplestatus/{id}', [ReqApprovalController::class, 'multipleStatus'])->name('reqapproval.multiplestatus');
            Route::resource('reqapproval', ReqApprovalController::class)->names('reqapproval');

            Route::put('reqaccclearance/search', [ReqAccClearanceController::class, 'search'])->name('reqaccclearance.search');
            Route::put('reqaccclearance/multiplestatus/{id}', [ReqAccClearanceController::class, 'multipleStatus'])->name('reqaccclearance.multiplestatus');
            Route::resource('reqaccclearance', ReqAccClearanceController::class)->names('reqaccclearance');

            Route::put('reqfinalapproval/search', [ReqFinalApprovalController::class, 'search'])->name('reqfinalapproval.search');
            Route::put('reqfinalapproval/multiplestatus/{id}', [ReqFinalApprovalController::class, 'multipleStatus'])->name('reqfinalapproval.multiplestatus');
            Route::resource('reqfinalapproval', ReqFinalApprovalController::class)->names('reqfinalapproval');
        });
    });
});
