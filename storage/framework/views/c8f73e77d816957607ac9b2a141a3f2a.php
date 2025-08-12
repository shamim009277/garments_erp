
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
                        <li class="nav-custom-item">
                            <input type="checkbox" id="basicorder1">
                            <label class="nav-custom-link" for="basicorder1"><span class="nav-custom-caret"></span> Basic
                                Order 1</label>
                        </li>
                        <li class="nav-custom-item">
                            <input type="checkbox" id="basicorder2">
                            <label class="nav-custom-link" for="basicorder2"><span class="nav-custom-caret"></span> Basic
                                Order 2</label>
                        </li>
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
                <!-- This is my Table for Basic Orders -->
                
                <div class="card-body">
                    <form action="<?php echo e(route('inventory.database.basicorders.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Order Type</label>
                                    <select name="order_type" class="form-control" required>
                                        <option value="Confirmed">Confirmed</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Compile Type</label>
                                    <select name="compile_type" class="form-control" required>
                                        <option value="Always Barcode">Always Barcode</option>
                                        <option value="Manual">Manual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Organization</label>
                                    <select name="organization_id" class="form-control" required>
                                        <?php $__currentLoopData = $organizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $organization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($organization->id); ?>"><?php echo e($organization->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Buyer</label>
                                    <select name="buyer_id" class="form-control" required>
                                        <?php $__currentLoopData = $buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($buyer->id); ?>"><?php echo e($buyer->buyer_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Style No</label>
                                    <input class="form-control" type="text" value="Artisanal kale"
                                        id="example-text-input">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Style Description</label>
                                    <input class="form-control" type="text" value="Artisanal kale"
                                        id="example-text-input">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Order No</label>
                                    <input class="form-control" type="text" value="Artisanal kale"
                                        id="example-text-input">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Season</label>
                                    <input class="form-control" type="text" value="Artisanal kale"
                                        id="example-text-input">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fitting Type</label>
                                    <select name="fitting_type" class="form-control" required>
                                        <option value="">Select Fitting Type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Product Category</label>
                                    <select name="product_category_id" class="form-control" required>
                                        <?php $__currentLoopData = $product_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($product_category->id); ?>">
                                                <?php echo e($product_category->product_category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Merchandiser</label>
                                    <select name="merchandiser_id" class="form-control" required>
                                        <?php $__currentLoopData = $merchandisers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchandiser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($merchandiser->id); ?>"><?php echo e($merchandiser->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fabric Type</label>
                                    <select name="fabric_type" class="form-control" required>
                                        <?php $__currentLoopData = $fabric_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fabric_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($fabric_type->id); ?>"><?php echo e($fabric_type->fabric_type_name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Composition</label>
                                    <select name="composition" class="form-control" required>
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
                                    <select name="fabric_treatment" class="form-control" required>
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
                                    <select name="yarn_count" class="form-control" required>
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
                                    <select name="yarn_category" class="form-control" required>
                                        <?php $__currentLoopData = $yarn_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yarn_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($yarn_category->id); ?>">
                                                <?php echo e($yarn_category->yarn_category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">GSM</label>
                                    <input class="form-control" type="text" name="gsm" value="Artisanal kale"
                                        id="gsm">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">BW GSM</label>
                                    <input class="form-control" type="text" name="bw_gsm" value="Artisanal kale"
                                        id="bw_gsm">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Finish Diameter</label>
                                    <input class="form-control" type="text" name="finished_dia"
                                        value="Artisanal kale" id="finished_dia">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Finish Type</label>
                                    <select name="finish_type" class="form-control" required>
                                        <option value="">Select Finish Type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Print Type</label>
                                    <select name="print_type" class="form-control" required>
                                        <option value="">Select Print Type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Print Price Per Dzn</label>
                                    <input class="form-control" type="text" name="print_price_per_dzn"
                                        value="Artisanal kale" id="print_price_per_dzn">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">embroidery type</label>
                                    <select name="embroidery_type" class="form-control" required>
                                        <option value="">Select embroidery type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">embroidery price per dzn</label>
                                    <input class="form-control" type="text" name="embroidery_price_per_dzn"
                                        value="Artisanal kale" id="embroidery_price_per_dzn">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">wash type</label>
                                    <select name="wash_type" class="form-control" required>
                                        <option value="">Select wash type</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Plus">Plus</option>
                                        <option value="Slim">Slim</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">garment dye price per dzn</label>
                                    <input class="form-control" type="text" name="garment_dye_price_per_dzn"
                                        value="Artisanal kale" id="garment_dye_price_per_dzn">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">order date</label>
                                    <input class="form-control" type="date" name="order_date"
                                        value="<?php echo e(date('Y-m-d')); ?>" id="order_date">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">unit price</label>
                                    <input class="form-control" type="text" name="unit_price" value="Artisanal kale"
                                        id="unit_price">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">cm price per dzn</label>
                                    <input class="form-control" type="text" name="cm_price_per_dzn"
                                        value="Artisanal kale" id="cm_price_per_dzn">
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Order Quantity</label>
                                    <input class="form-control" type="text" name="order_quantity"
                                        value="Artisanal kale" id="order_quantity">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Extra Cutting Percent</label>
                                    <input class="form-control" type="text" name="extra_cutting_percent"
                                        value="Artisanal kale" id="extra_cutting_percent">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fabric Booking Needed</label>
                                    <select name="fabric_booking_needed" class="form-control" required>
                                        <option value="">Select fabric booking needed</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>

                            
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Fabric Consumption (kg/dzn)</label>
                                    <input class="form-control" type="text" name="fabric_consumption_kg_dz"
                                        value="Artisanal kale" id="fabric_consumption_kg_dz">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Kd Allowance Percent</label>
                                    <input class="form-control" type="text" name="kd_allowance_percent"
                                        value="Artisanal kale" id="kd_allowance_percent">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Cutting Consumption
                                        (yards/pcs)</label>
                                    <input class="form-control" type="text" name="cutting_consumption_yards_pcs"
                                        value="Artisanal kale" id="cutting_consumption_yards_pcs">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Booking Consumption
                                        (yards/pcs)</label>
                                    <input class="form-control" type="text" name="booking_consumption_yards_pcs"
                                        value="Artisanal kale" id="booking_consumption_yards_pcs">
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Delivery Mode</label>
                                    <select name="delivery_mode" class="form-control" required>
                                        <option value="">Select delivery_mode</option>
                                        <option value="Sea">Sea</option>
                                        <option value="Air">Air</option>
                                        <option value="Road">Road</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Delivery Date</label>
                                    <input class="form-control" type="date" name="delivery_date"
                                        value="Artisanal kale" id="delivery_date">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">trims required approved</label>
                                    <select name="trims_required_approved" class="form-control" required>
                                        <option value="">Select trims required approved</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">closed</label>
                                    <select name="closed" class="form-control" required>
                                        <option value="">Select closed</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">fabric from stock</label>
                                    <select name="fabric_from_stock" class="form-control" required>
                                        <option value="">Select fabric from stock</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
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
    <script>
        let lotIndex = 0;

        document.getElementById('add-lot-btn').addEventListener('click', function() {
            lotIndex++;
            let lotsContainer = document.getElementById('lots-container');

            let lotHtml = `
        <div class="lot" data-lot-index="${lotIndex}">
            <label>Lot No:</label>
            <input type="text" name="lots[${lotIndex}][lot_no]" required>
    
            <h4>Colors</h4>
            <div class="colors-container">
                <div class="color" data-color-index="0">
                    <label>Color Name:</label>
                    <input type="text" name="lots[${lotIndex}][colors][0][color_name]" required>
    
                    <h5>Sizes</h5>
                    <div class="sizes-container">
                        <div class="size" data-size-index="0">
                            <label>Size Name:</label>
                            <input type="text" name="lots[${lotIndex}][colors][0][sizes][0][size_name]" required>
                            <label>Quantity:</label>
                            <input type="number" name="lots[${lotIndex}][colors][0][sizes][0][quantity]" min="0" required>
                        </div>
                    </div>
                    <button type="button" class="add-size-btn">Add Size</button>
                </div>
            </div>
            <button type="button" class="add-color-btn">Add Color</button>
        </div>
        `;
            lotsContainer.insertAdjacentHTML('beforeend', lotHtml);
        });

        // Delegate event listeners for add color and add size buttons
        document.getElementById('lots-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('add-color-btn')) {
                let lotDiv = e.target.closest('.lot');
                let lotIdx = lotDiv.getAttribute('data-lot-index');

                let colorsContainer = lotDiv.querySelector('.colors-container');
                let colorCount = colorsContainer.querySelectorAll('.color').length;
                let colorHtml = `
            <div class="color" data-color-index="${colorCount}">
                <label>Color Name:</label>
                <input type="text" name="lots[${lotIdx}][colors][${colorCount}][color_name]" required>
    
                <h5>Sizes</h5>
                <div class="sizes-container">
                    <div class="size" data-size-index="0">
                        <label>Size Name:</label>
                        <input type="text" name="lots[${lotIdx}][colors][${colorCount}][sizes][0][size_name]" required>
                        <label>Quantity:</label>
                        <input type="number" name="lots[${lotIdx}][colors][${colorCount}][sizes][0][quantity]" min="0" required>
                    </div>
                </div>
                <button type="button" class="add-size-btn">Add Size</button>
            </div>
            `;
                colorsContainer.insertAdjacentHTML('beforeend', colorHtml);
            }

            if (e.target.classList.contains('add-size-btn')) {
                let colorDiv = e.target.closest('.color');
                let lotDiv = e.target.closest('.lot');
                let lotIdx = lotDiv.getAttribute('data-lot-index');
                let colorIdx = colorDiv.getAttribute('data-color-index');

                let sizesContainer = colorDiv.querySelector('.sizes-container');
                let sizeCount = sizesContainer.querySelectorAll('.size').length;
                let sizeHtml = `
            <div class="size" data-size-index="${sizeCount}">
                <label>Size Name:</label>
                <input type="text" name="lots[${lotIdx}][colors][${colorIdx}][sizes][${sizeCount}][size_name]" required>
                <label>Quantity:</label>
                <input type="number" name="lots[${lotIdx}][colors][${colorIdx}][sizes][${sizeCount}][quantity]" min="0" required>
            </div>
            `;
                sizesContainer.insertAdjacentHTML('beforeend', sizeHtml);
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\new erp\garments_erp\Modules/Inventory\resources/views/database/basicorders/index.blade.php ENDPATH**/ ?>