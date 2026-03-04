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
                    Basic Orders(<?php echo $basicorder->order_no; ?>)
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
            <div class="card alert-primary alert-top-border">
                <div class="card-body px-0 py-0" style="min-height: 500px;">
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist" style="background-color: #5559ca; color: white;border-radius: 0px !important;">
                        <li class="nav-item">
                            <a href="<?php echo e(route('inventory.database.basicorders.show', $basicorder->id)); ?>?tab=1" class="nav-link border-none <?php echo e($tab == 1 ? 'active' : ''); ?>" title="Basic" role="tab" style="hover: white !important;">
                                <span class="d-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-block">Basic Order Info</span>
                            </a>
                        </li>
                       
                        <li class="nav-item">
                            <a href="<?php echo e(route('inventory.database.basicorders.show', $basicorder->id)); ?>?tab=2" class="nav-link border-none <?php echo e($tab == 2 ? 'active' : ''); ?>" title="Lot/Ship Info" role="tab">
                                <span class="d-block d-sm-none"><i class="fa fa-credit-card"></i></span>
                                <span class="d-none d-sm-block">Lot/Ship Info</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('inventory.database.basicorders.show', $basicorder->id)); ?>?tab=3" class="nav-link border-none <?php echo e($tab == 3 ? 'active' : ''); ?>" title="Color and Size Info" role="tab">
                                <span class="d-block d-sm-none"><i class="fa fa-credit-card"></i></span>
                                <span class="d-none d-sm-block">Color and Size Info</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content text-muted">
                        <?php if($tab == 1): ?>
                        <div class="tab-pane <?php echo e($tab == 1 ? 'active' : ''); ?>" id="basic" role="tabpanel">
                            <?php echo $__env->make('inventory::database.basicorders.tab1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                        <?php endif; ?>
                        <?php if($tab == 2): ?>
                        <div class="tab-pane <?php echo e($tab == 2 ? 'active' : ''); ?>" id="color" role="tabpanel">
                            <?php echo $__env->make('inventory::database.basicorders.tab2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                        <?php endif; ?>
                        <?php if($tab == 3): ?>
                        <div class="tab-pane <?php echo e($tab == 3 ? 'active' : ''); ?>" id="lot" role="tabpanel">
                            <?php echo $__env->make('inventory::database.basicorders.tab3', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                        <?php endif; ?>
                    </div>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\Inventory\resources\views\database\basicorders\show.blade.php ENDPATH**/ ?>