<div class="card alert-info alert-top-border padding-card">
    <div class="card-header">
        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Input
            Parameters For Basic Order <?php echo $basicorder->order_no; ?></h6>
    </div>
    <?php 

    // dd($basicorder);
    ?>
    <div class="card-body">
        <form action="<?php echo e(route('inventory.database.basicorders.update', $basicorder->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <input type="hidden" name="id" value="<?php echo e($basicorder->id); ?>">   
            <div class="row">
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Order Type</label>
                        <select name="order_type"  class="form-control form-control-sm" required>
                            <option value="Confirmed" <?php echo e($basicorder->order_type == 'Confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                            <option value="Pending" <?php echo e($basicorder->order_type == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="Cancelled" <?php echo e($basicorder->order_type == 'Cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Compile Type</label>
                        <select name="compile_type" class="form-control form-control-sm" required>
                            <option value="Always Barcode" <?php echo e($basicorder->compile_type == 'Always Barcode' ? 'selected' : ''); ?>>Always Barcode</option>
                            <option value="Manual" <?php echo e($basicorder->compile_type == 'Manual' ? 'selected' : ''); ?>>Manual</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Organization <span
                                class="text-danger">*</span></label>
                        <select name="organization_id" class="form-control form-control-sm" required>
                            <?php $__currentLoopData = $organizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $organization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($organization->id); ?>" <?php echo e($basicorder->organization_id == $organization->id ? 'selected' : ''); ?>><?php echo e($organization->name); ?></option>
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
                                <option value="<?php echo e($buyer->id); ?>" <?php echo e($basicorder->buyer_id == $buyer->id ? 'selected' : ''); ?>><?php echo e($buyer->buyer_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Style No</label>
                        <input class="form-control form-control-sm" name="style_no" type="text" id="example-text-input" value="<?php echo e($basicorder->style_no); ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Style Description</label>
                        <input class="form-control form-control-sm" name="style_description" type="text" value="<?php echo e($basicorder->style_description); ?>"
                            id="example-text-input">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Order No <span
                                class="text-danger">(Auto)</span></label>
                        <input class="form-control form-control-sm" name="order_no" type="text" id="example-text-input" value="<?php echo e($basicorder->order_no); ?>" readonly>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Season</label>
                        <input class="form-control form-control-sm" name="season" type="text" id="example-text-input" value="<?php echo e($basicorder->season); ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Fitting Type</label>
                        <select name="fitting_type" class="form-control form-control-sm" required>
                            <option>Select Fitting Type</option>
                            <option value="Regular" <?php echo e($basicorder->fitting_type == 'Regular' ? 'selected' : ''); ?>>Regular</option>
                            <option value="Plus" <?php echo e($basicorder->fitting_type == 'Plus' ? 'selected' : ''); ?>>Plus</option>
                            <option value="Slim" <?php echo e($basicorder->fitting_type == 'Slim' ? 'selected' : ''); ?>>Slim</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Product Category <span
                                class="text-danger">*</span></label>
                        <select name="product_category_id" class="form-control form-control-sm" required>
                            <?php $__currentLoopData = $product_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($product_category->id); ?>" <?php echo e($basicorder->product_category_id == $product_category->id ? 'selected' : ''); ?>>
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
                                <option value="<?php echo e($merchandiser->id); ?>" <?php echo e($basicorder->merchandiser_id == $merchandiser->id ? 'selected' : ''); ?>><?php echo e($merchandiser->name); ?></option>
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
                                <option value="<?php echo e($fabric_type->id); ?>" <?php echo e($basicorder->fabric_type_id == $fabric_type->id ? 'selected' : ''); ?>><?php echo e($fabric_type->fabric_type_name); ?>

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
                                <option value="<?php echo e($composition->id); ?>" <?php echo e($basicorder->composition_id == $composition->id ? 'selected' : ''); ?>><?php echo e($composition->composition_name); ?>

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
                                <option value="<?php echo e($fabric_treatment->id); ?>" <?php echo e($basicorder->fabric_treatment_id == $fabric_treatment->id ? 'selected' : ''); ?>>
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
                                <option value="<?php echo e($yarn_count->id); ?>" <?php echo e($basicorder->yarn_count_id == $yarn_count->id ? 'selected' : ''); ?>><?php echo e($yarn_count->yarn_count_name); ?>

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
                                <option value="<?php echo e($yarn_category->id); ?>" <?php echo e($basicorder->yarn_category_id == $yarn_category->id ? 'selected' : ''); ?>>
                                    <?php echo e($yarn_category->yarn_category_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">GSM <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="text" name="gsm" id="gsm" value="<?php echo e($basicorder->gsm); ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">BW GSM <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="text" name="bw_gsm" id="bw_gsm" value="<?php echo e($basicorder->bw_gsm); ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Finish Diameter <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="number" name="finished_dia" id="finished_dia" value="<?php echo e($basicorder->finished_dia); ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Finish Type</label>
                        <select name="finish_type" class="form-control form-control-sm" required>
                            <option>Select Finish Type</option>
                            <option value="Regular" <?php echo e($basicorder->finish_type == 'Regular' ? 'selected' : ''); ?>>Regular</option>
                            <option value="Plus" <?php echo e($basicorder->finish_type == 'Plus' ? 'selected' : ''); ?>>Plus</option>
                            <option value="Slim" <?php echo e($basicorder->finish_type == 'Slim' ? 'selected' : ''); ?>>Slim</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Print Type</label>
                        <select name="print_type" class="form-control form-control-sm" required>
                            <option>Select Print Type</option>
                            <option value="Regular" <?php echo e($basicorder->print_type == 'Regular' ? 'selected' : ''); ?>>Regular</option>
                            <option value="Plus" <?php echo e($basicorder->print_type == 'Plus' ? 'selected' : ''); ?>>Plus</option>
                            <option value="Slim" <?php echo e($basicorder->print_type == 'Slim' ? 'selected' : ''); ?>>Slim</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Print Price Per Dzn <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="number" name="print_price_per_dzn"
                            id="print_price_per_dzn" value="<?php echo e($basicorder->print_price_per_dzn); ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">embroidery type</label>
                        <select name="embroidery_type" class="form-control form-control-sm" required>
                            <option>Select embroidery type</option>
                            <option value="Regular" <?php echo e($basicorder->embroidery_type == 'Regular' ? 'selected' : ''); ?>>Regular</option>
                            <option value="Plus" <?php echo e($basicorder->embroidery_type == 'Plus' ? 'selected' : ''); ?>>Plus</option>
                            <option value="Slim" <?php echo e($basicorder->embroidery_type == 'Slim' ? 'selected' : ''); ?>>Slim</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">embroidery price per dzn</label>
                        <input class="form-control form-control-sm" type="number" name="embroidery_price_per_dzn"
                            id="embroidery_price_per_dzn" value="<?php echo e($basicorder->embroidery_price_per_dzn); ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">wash type</label>
                        <select name="wash_type" class="form-control form-control-sm" required>
                            <option>Select wash type</option>
                            <option value="Regular" <?php echo e($basicorder->wash_type == 'Regular' ? 'selected' : ''); ?>>Regular</option>
                            <option value="Plus" <?php echo e($basicorder->wash_type == 'Plus' ? 'selected' : ''); ?>>Plus</option>
                            <option value="Slim" <?php echo e($basicorder->wash_type == 'Slim' ? 'selected' : ''); ?>>Slim</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">garment dye price per dzn</label>
                        <input class="form-control form-control-sm" type="number" name="garment_dye_price_per_dzn"
                            id="garment_dye_price_per_dzn" value="<?php echo e($basicorder->garment_dye_price_per_dzn); ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">order date</label>
                        <input class="form-control form-control-sm" type="date" name="order_date"
                            value="<?php echo e($basicorder->order_date); ?>" id="order_date">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">unit price <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="number" name="unit_price" id="unit_price" value="<?php echo e($basicorder->unit_price); ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">cm price per dzn</label>
                        <input class="form-control form-control-sm" type="number" name="cm_price_per_dzn"
                            id="cm_price_per_dzn" value="<?php echo e($basicorder->cm_price_per_dzn); ?>">
                    </div>
                </div>
                
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Order Quantity <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="text" name="order_quantity"
                            id="order_quantity" value="<?php echo e($basicorder->order_quantity); ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Extra Cutting Percent <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="number" name="extra_cutting_percent"
                            id="extra_cutting_percent" value="<?php echo e($basicorder->extra_cutting_percent); ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Fabric Booking Needed <span
                                class="text-danger">*</span></label>
                        <select name="fabric_booking_needed" class="form-control form-control-sm" required>
                            <option>Select fabric booking needed</option>
                            <option value="1" <?php echo e($basicorder->fabric_booking_needed == 1 ? 'selected' : ''); ?>>Yes</option>
                            <option value="0" <?php echo e($basicorder->fabric_booking_needed == 0 ? 'selected' : ''); ?>>No</option>
                        </select>
                    </div>
                </div>

                
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Fabric Consumption (kg/dzn) <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="number" name="fabric_consumption_kg_dz"
                            id="fabric_consumption_kg_dz" value="<?php echo e($basicorder->fabric_consumption_kg_dz); ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Kd Allowance Percent <span
                                class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="number" name="kd_allowance_percent"
                            id="kd_allowance_percent" value="<?php echo e($basicorder->kd_allowance_percent); ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Cutting Consumption
                            (yards/pcs)</label>
                        <input class="form-control form-control-sm" type="number" name="cutting_consumption_yards_pcs"
                            id="cutting_consumption_yards_pcs" value="<?php echo e($basicorder->cutting_consumption_yards_pcs); ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Booking Consumption
                            (yards/pcs)</label>
                        <input class="form-control form-control-sm" type="number" name="booking_consumption_yards_pcs"
                            id="booking_consumption_yards_pcs" value="<?php echo e($basicorder->booking_consumption_yards_pcs); ?>">
                    </div>
                </div>
                
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Delivery Mode <span
                                class="text-danger">*</span></label>
                        <select name="delivery_mode" class="form-control form-control-sm" required>
                            <option>Select delivery_mode</option>
                            <option value="Sea" <?php echo e($basicorder->delivery_mode == 'Sea' ? 'selected' : ''); ?>>Sea</option>
                            <option value="Air" <?php echo e($basicorder->delivery_mode == 'Air' ? 'selected' : ''); ?>>Air</option>
                            <option value="Road" <?php echo e($basicorder->delivery_mode == 'Road' ? 'selected' : ''); ?>>Road</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Delivery Date</label>
                        <input class="form-control form-control-sm" type="date" name="delivery_date" id="delivery_date" value="<?php echo e($basicorder->delivery_date); ?>">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">trims required approved</label>
                        <select name="trims_required_approved" class="form-control form-control-sm" required>
                            <option>Select trims required approved</option>
                            <option value="1" <?php echo e($basicorder->trims_required_approved == 1 ? 'selected' : ''); ?>>Yes</option>
                            <option value="0" <?php echo e($basicorder->trims_required_approved == 0 ? 'selected' : ''); ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">closed</label>
                        <select name="closed" class="form-control form-control-sm" required>
                            <option>Select closed</option>
                            <option value="1" <?php echo e($basicorder->closed == 1 ? 'selected' : ''); ?>>Yes</option>
                            <option value="0" <?php echo e($basicorder->closed == 0 ? 'selected' : ''); ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">fabric from stock</label>
                        <select name="fabric_from_stock" class="form-control form-control-sm" required>
                            <option>Select fabric from stock</option>
                            <option value="1" <?php echo e($basicorder->fabric_from_stock == 1 ? 'selected' : ''); ?>>Yes</option>
                            <option value="0" <?php echo e($basicorder->fabric_from_stock == 0 ? 'selected' : ''); ?>>No</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    
                    <button type="submit" class="btn btn-primary float-end me-2">Update and Go to Next</button>
                    
                    <button type="#" class="btn btn-success float-end me-2">Update and Close</button>
                    
                    <button type="#" class="btn btn-danger float-end me-2">Cancel</button>
                </div>

            </div>
        </form>
    </div>
</div><?php /**PATH H:\laragon\www\garments_erp\Modules/OrderManagement\resources/views/database/basicorders/tab1.blade.php ENDPATH**/ ?>