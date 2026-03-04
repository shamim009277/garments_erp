<?php $__env->startSection('title', 'INVENTORY'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Basic Orders',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Database', 'url' => route('inventory.index')],
                    ['label' => 'Basic Orders', 'url' => route('inventory.database.basicorders.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Basic Orders
                </h4>

                <!-- Search Input + Button in One Line -->
                <form action="#" method="POST" class="d-flex order-0 order-md-1 mb-2 mb-md-0 me-md-2"
                    style="max-width: 400px;" role="search">
                    <?php echo csrf_field(); ?>
                    <input class="form-control form-control-sm me-2" type="search" name="search"
                        placeholder="Basic Order No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"><i data-feather="search"
                            width="14" height="14" class="me-1"></i> Search</button>
                </form>
                <?php if(1): ?>
                    <!-- Back Button -->
                    <a href="<?php echo e(route('inventory.database.basicorders.index')); ?>"
                        class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2">
                        <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-3 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Basic Order
                        List</h6>
                </div>
                <div class="card-body" style="min-height: 457px;max-height: 457px; overflow-y: auto;">
                    <ul class="nav-custom">
                        <?php $__currentLoopData = $buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $buyerOrders = collect($ListOfOrders)->where('buyer_id', $buyer->id);

                            ?>
                            <li class="nav-custom-item">
                                <input type="checkbox" id="buyer<?php echo e($buyer->id); ?>">
                                <label class="nav-custom-link" for="buyer<?php echo e($buyer->id); ?>"><span
                                        class="nav-custom-caret"></span> <?php echo e($buyer->buyer_name); ?>

                                    (<?php echo e($buyerOrders->count()); ?>)</label>
                                <div class="nav-custom-content">
                                    <ul class="nav-custom">
                                        <?php $__currentLoopData = $buyerOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="nav-custom-item">
                                                <a href="<?php echo e(route('inventory.database.basicorders.show', $order->id)); ?>?tab=1">
                                                    <label class="nav-custom-link" for="order<?php echo e($order->id); ?>"><span
                                                            class="nav-custom-caret"></span> <?php echo $order->order_no; ?>: <?php echo $order->style_no; ?></label>
                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="card alert-info alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Input
                        Parameters For New Basic Order ...</h6>
                </div>

                <div class="card-body">
                    <form action="<?php echo e(route('inventory.database.basicorders.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Order Type</label>
                                    <select name="order_type" class="form-control form-control-sm" required>
                                        <option value="Confirmed">Confirmed</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Compile Type</label>
                                    <select name="compile_type" class="form-control form-control-sm" required>
                                        <option value="Always Barcode">Always Barcode</option>
                                        <option value="Manual">Manual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Organization <span
                                            class="text-danger">*</span></label>
                                    <select name="organization_id" class="form-control form-control-sm" required>
                                        <?php $__currentLoopData = $organizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $organization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($organization->id); ?>"><?php echo e($organization->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Buyer <span
                                            class="text-danger">*</span></label>
                                    <select name="buyer_id" class="form-control form-control-sm" required>
                                        <?php $__currentLoopData = $buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($buyer->id); ?>"><?php echo e($buyer->buyer_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Style No</label>
                                    <input class="form-control form-control-sm" name="style_no" type="text" id="example-text-input">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Style Description</label>
                                    <input class="form-control form-control-sm" name="style_description" type="text"
                                        id="example-text-input">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Actual Order No </label>
                                    <input class="form-control form-control-sm" name="order_no" type="text" id="order_no">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Season</label>
                                    <input class="form-control form-control-sm" name="season" type="text" id="season">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fitting Type</label>
                                    <select name="fitting_type" class="form-control form-control-sm" required>
                                        <option>Select Fitting Type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Product Category <span
                                            class="text-danger">*</span></label>
                                    <select name="product_category_id" class="form-control form-control-sm" required>
                                        <?php $__currentLoopData = $product_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($product_category->id); ?>">
                                                <?php echo e($product_category->product_category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Merchandiser <span
                                            class="text-danger">*</span></label>
                                    <select name="merchandiser_id" class="form-control form-control-sm" required>
                                        <?php $__currentLoopData = $merchandisers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchandiser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($merchandiser->id); ?>"><?php echo e($merchandiser->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fabric Type <span
                                            class="text-danger">*</span></label>
                                    <select name="fabric_type_id" class="form-control form-control-sm" required>
                                        <?php $__currentLoopData = $fabric_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fabric_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($fabric_type->id); ?>"><?php echo e($fabric_type->fabric_type_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Composition <span
                                            class="text-danger">*</span></label>
                                    <select name="composition_id" class="form-control form-control-sm" required>
                                        <?php $__currentLoopData = $compositions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $composition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($composition->id); ?>"><?php echo e($composition->composition_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fabric Treatment</label>
                                    <select name="fabric_treatment_id" class="form-control form-control-sm" required>
                                        <?php $__currentLoopData = $fabric_treatments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fabric_treatment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($fabric_treatment->id); ?>">
                                                <?php echo e($fabric_treatment->fabric_treatment_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Yarn Count </label>
                                    <select name="yarn_count_id" class="form-control form-control-sm" required>
                                        <?php $__currentLoopData = $yarn_counts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yarn_count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($yarn_count->id); ?>"><?php echo e($yarn_count->yarn_count_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Yarn Category</label>
                                    <select name="yarn_category_id" class="form-control form-control-sm" required>
                                        <?php $__currentLoopData = $yarn_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yarn_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($yarn_category->id); ?>">
                                                <?php echo e($yarn_category->yarn_category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">GSM <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="gsm" id="gsm">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">BW GSM <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="bw_gsm" id="bw_gsm">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Finish Diameter <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" type="number" name="finished_dia" id="finished_dia">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Finish Type</label>
                                    <select name="finish_type" class="form-control form-control-sm" required>
                                        <option>Select Finish Type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Print Type</label>
                                    <select name="print_type" class="form-control form-control-sm" required>
                                        <option>Select Print Type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Print Price Per Dzn <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" type="number" name="print_price_per_dzn"
                                        id="print_price_per_dzn">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">embroidery type</label>
                                    <select name="embroidery_type" class="form-control form-control-sm" required>
                                        <option>Select embroidery type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">embroidery price per dzn</label>
                                    <input class="form-control form-control-sm" type="number" name="embroidery_price_per_dzn"
                                        id="embroidery_price_per_dzn">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">wash type</label>
                                    <select name="wash_type" class="form-control form-control-sm" required>
                                        <option>Select wash type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">garment dye price per dzn</label>
                                    <input class="form-control form-control-sm" type="number" name="garment_dye_price_per_dzn"
                                        id="garment_dye_price_per_dzn">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">order date</label>
                                    <input class="form-control form-control-sm" type="date" name="order_date"
                                        value="<?php echo e(date('Y-m-d')); ?>" id="order_date">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">unit price <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" type="number" name="unit_price" id="unit_price">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">cm price per dzn</label>
                                    <input class="form-control form-control-sm" type="number" name="cm_price_per_dzn"
                                        id="cm_price_per_dzn">
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Order Quantity <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="order_quantity"
                                        id="order_quantity">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Extra Cutting Percent <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" type="number" name="extra_cutting_percent"
                                        id="extra_cutting_percent">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fabric Booking Needed <span
                                            class="text-danger">*</span></label>
                                    <select name="fabric_booking_needed" class="form-control form-control-sm" required>
                                        <option>Select fabric booking needed</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fabric Consumption (kg/dzn) <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" type="number" name="fabric_consumption_kg_dz"
                                        id="fabric_consumption_kg_dz">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Kd Allowance Percent <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" type="number" name="kd_allowance_percent"
                                        id="kd_allowance_percent">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Cutting Consumption
                                        (yards/pcs)</label>
                                    <input class="form-control form-control-sm" type="number" name="cutting_consumption_yards_pcs"
                                        id="cutting_consumption_yards_pcs">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Booking Consumption
                                        (yards/pcs)</label>
                                    <input class="form-control form-control-sm" type="number" name="booking_consumption_yards_pcs"
                                        id="booking_consumption_yards_pcs">
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Delivery Mode <span
                                            class="text-danger">*</span></label>
                                    <select name="delivery_mode" class="form-control form-control-sm" required>
                                        <option>Select delivery_mode</option>
                                        <option value="Sea">Sea</option>
                                        <option value="Air">Air</option>
                                        <option value="Road">Road</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Delivery Date</label>
                                    <input class="form-control form-control-sm" type="date" name="delivery_date" id="delivery_date">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">trims required approved</label>
                                    <select name="trims_required_approved" class="form-control form-control-sm" required>
                                        <option>Select trims required approved</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">closed</label>
                                    <select name="closed" class="form-control form-control-sm" required>
                                        <option>Select closed</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">fabric from stock</label>
                                    <select name="fabric_from_stock" class="form-control form-control-sm" required>
                                        <option>Select fabric from stock</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                
                                <button type="submit" class="btn btn-primary float-end me-2">Save and Go to Next</button>
                                
                                <button type="#" class="btn btn-success float-end me-2">Save and Close</button>
                                
                                <button type="#" class="btn btn-danger float-end me-2">Cancel</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\Inventory\resources\views\database\basicorders\index.blade.php ENDPATH**/ ?>