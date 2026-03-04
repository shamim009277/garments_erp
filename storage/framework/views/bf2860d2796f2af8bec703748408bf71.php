<?php $__env->startSection('title', 'Sample Production Report'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <?php echo $__env->make('components.breadcrumb', [
        'title' => 'Sample Management',
        'subtitle' => 'Sample Production Report',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Report', 'url' => '#'],
        ['label' => 'Sample Production Report', 'url' => route('sms.report.sample_production')],
        ],
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Filter Report</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('sms.report.sample_production')); ?>" method="GET">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="buyer_id" class="form-label">Buyer</label>
                            <select name="buyer_id" id="buyer_id" class="form-control select2">
                                <option value="">Select Buyer</option>
                                <?php $__currentLoopData = $buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($buyer->id); ?>" <?php echo e(request('buyer_id') == $buyer->id ? 'selected' : ''); ?>><?php echo e($buyer->buyer_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="order_id" class="form-label">Order</label>
                            <select name="order_id" id="order_id" class="form-control select2">
                                <option value="">Select Order</option>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($order->id); ?>" <?php echo e(request('order_id') == $order->id ? 'selected' : ''); ?>><?php echo e($order->order_code); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="color_id" class="form-label">Color</label>
                            <select name="color_id" id="color_id" class="form-control select2">
                                <option value="">Select Color</option>
                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($color->id); ?>" <?php echo e(request('color_id') == $color->id ? 'selected' : ''); ?>><?php echo e($color->color_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="sample_type_id" class="form-label">Sample Type</label>
                            <select name="sample_type_id" id="sample_type_id" class="form-control select2">
                                <option value="">Select Sample Type</option>
                                <?php $__currentLoopData = $sampleTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sampleType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($sampleType->id); ?>" <?php echo e(request('sample_type_id') == $sampleType->id ? 'selected' : ''); ?>><?php echo e($sampleType->sample_type_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="date_from" class="form-label">Date From</label>
                            <input type="date" name="date_from" id="date_from" class="form-control" value="<?php echo e(request('date_from')); ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="date_to" class="form-label">Date To</label>
                            <input type="date" name="date_to" id="date_to" class="form-control" value="<?php echo e(request('date_to')); ?>">
                        </div>
                        <div class="col-md-2 mb-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                        <div class="col-md-2 mb-3 d-flex align-items-end">
                            <a href="<?php echo e(route('sms.report.sample_production')); ?>" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Sample Production List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>Buyer</th>
                                <th>Order No</th>
                                <th>Color</th>
                                <th>Sample Type</th>
                                <th>Production Qty</th>
                                <th>Used Fabric Qty</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $productions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $production): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($production->created_at->format('d-M-Y')); ?></td>
                                    <td><?php echo e(optional($production->buyer)->buyer_name); ?></td>
                                    <td><?php echo e(optional($production->initialOrder)->order_code); ?></td>
                                    <td><?php echo e(optional($production->color)->color_name); ?></td>
                                    <td><?php echo e(optional($production->sampleType)->sample_type_name); ?></td>
                                    <td><?php echo e($production->production_quantity); ?></td>
                                    <td><?php echo e($production->used_fabric_quantity); ?></td>
                                    <td><?php echo e($production->production_notes); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="9" class="text-center">No records found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6" class="text-end">Total</th>
                                <th><?php echo e($totals['production_quantity'] ?? 0); ?></th>
                                <th><?php echo e($totals['used_fabric_quantity'] ?? 0); ?></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        $('.select2').select2();

        $('#buyer_id').change(function() {
            let buyerId = $(this).val();
            $('#order_id').html('<option value="">Select Order</option>');
            $('#color_id').html('<option value="">Select Color</option>');
            
            if (buyerId) {
                let url = "<?php echo e(route('sms.database.sampleorderproduction.get-orders', ':id')); ?>";
                url = url.replace(':id', buyerId);

                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(data) {
                        let options = '<option value="">Select Order</option>';
                        data.forEach(function(order) {
                            options += `<option value="${order.id}">${order.order_code}</option>`;
                        });
                        $('#order_id').html(options);
                    }
                });
            }
        });

        $('#order_id').change(function() {
            let orderId = $(this).val();
            $('#color_id').html('<option value="">Select Color</option>');

            if (orderId) {
                let url = "<?php echo e(route('sms.database.sampleorderproduction.get-samples', ':id')); ?>";
                url = url.replace(':id', orderId);

                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(data) {
                        let options = '<option value="">Select Color</option>';
                        data.forEach(function(color) {
                            options += `<option value="${color.id}">${color.color_name}</option>`;
                        });
                        $('#color_id').html(options);
                    }
                });
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/aandg/public_html/Modules/SM/resources/views/report/sample_production_report.blade.php ENDPATH**/ ?>