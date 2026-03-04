<?php $__env->startSection('title', 'Edit Sample Delivery'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <?php echo $__env->make('components.breadcrumb', [
        'title' => 'Sample Delivery',
        'subtitle' => 'Edit Sample Delivery',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Database', 'url' => route('sms.index')],
        ['label' => 'Sample Delivery', 'url' => route('sms.database.sampledelivery.index')],
        ['label' => 'Edit', 'url' => '#'],
        ],
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Sample Delivery</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('sms.database.sampledelivery.update', $delivery->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Challan No</label>
                            <input type="text" name="ChallanNo" class="form-control form-control-sm" required value="<?php echo e($delivery->ChallanNo); ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="Date" class="form-control form-control-sm" required value="<?php echo e($delivery->Date); ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Buyer</label>
                            <select name="BuyerID" class="form-select form-select-sm" required>
                                <option value="">Select Buyer</option>
                                <?php $__currentLoopData = $buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($buyer->id); ?>" <?php echo e($delivery->BuyerID == $buyer->id ? 'selected' : ''); ?>><?php echo e($buyer->buyer_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Employee</label>
                            <select name="EmployeeID" class="form-select form-select-sm" required>
                                <option value="">Select Employee</option>
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($employee->id); ?>" <?php echo e($delivery->EmployeeID == $employee->id ? 'selected' : ''); ?>><?php echo e($employee->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Challan Type</label>
                            <select name="ChallanType" class="form-select form-select-sm" required>
                                <option value="1" <?php echo e($delivery->ChallanType == 1 ? 'selected' : ''); ?>>Returnable</option>
                                <option value="2" <?php echo e($delivery->ChallanType == 2 ? 'selected' : ''); ?>>Non-Returnable</option>
                                <option value="3" <?php echo e($delivery->ChallanType == 3 ? 'selected' : ''); ?>>Export</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Goods Type</label>
                            <select name="GoodsType" class="form-select form-select-sm" required>
                                <option value="1" <?php echo e($delivery->GoodsType == 1 ? 'selected' : ''); ?>>Gray Fabric</option>
                                <option value="2" <?php echo e($delivery->GoodsType == 2 ? 'selected' : ''); ?>>Complete Body</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Comments</label>
                            <input type="text" name="Comments" class="form-control form-control-sm" value="<?php echo e($delivery->Comments); ?>">
                        </div>
                    </div>

                    <h5 class="mt-4">Details</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" id="detailsTable">
                            <thead>
                                <tr>
                                    <th>Sample Programme</th>
                                    <th>Color</th>
                                    <th>Quantity</th>
                                    <th>Comments</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $delivery->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <select name="details[<?php echo e($index); ?>][SampleOrderProgrammeID]" class="form-select form-select-sm select2" required>
                                            <option value="">Select Item</option>
                                            <?php $__currentLoopData = $sampleProgrammes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($sp->id); ?>" <?php echo e($detail->SampleOrderProgrammeID == $sp->id ? 'selected' : ''); ?>>
                                                <?php echo e($sp->item->product_category_name ?? 'Item'); ?> - 
                                                <?php echo e($sp->style_no ?? 'No Style'); ?>

                                                (<?php echo e($sp->initialOrder->order_code ?? ''); ?>)
                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td><input type="text" name="details[<?php echo e($index); ?>][Color]" class="form-control form-control-sm" required value="<?php echo e($detail->Color); ?>"></td>
                                    <td><input type="number" name="details[<?php echo e($index); ?>][Quantity]" class="form-control form-control-sm" required value="<?php echo e($detail->Quantity); ?>"></td>
                                    <td><input type="text" name="details[<?php echo e($index); ?>][Comments]" class="form-control form-control-sm" value="<?php echo e($detail->Comments); ?>"></td>
                                    <td><button type="button" class="btn btn-danger btn-xs remove-row">X</button></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-info btn-sm mt-2" id="addRow">Add Row</button>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-sm">Update Delivery</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let rowIdx = <?php echo e(count($delivery->details)); ?>;
        document.getElementById('addRow').addEventListener('click', function() {
            let tableBody = document.querySelector('#detailsTable tbody');
            let options = `
                <option value="">Select Item</option>
                <?php $__currentLoopData = $sampleProgrammes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($sp->id); ?>">
                    <?php echo e($sp->item->product_category_name ?? 'Item'); ?> - 
                    <?php echo e($sp->style_no ?? 'No Style'); ?>

                    (<?php echo e($sp->initialOrder->order_code ?? ''); ?>)
                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            `;

            let newRow = `
                <tr>
                    <td>
                        <select name="details[${rowIdx}][SampleOrderProgrammeID]" class="form-select form-select-sm select2" required>
                            ${options}
                        </select>
                    </td>
                    <td><input type="text" name="details[${rowIdx}][Color]" class="form-control form-control-sm" required></td>
                    <td><input type="number" name="details[${rowIdx}][Quantity]" class="form-control form-control-sm" required></td>
                    <td><input type="text" name="details[${rowIdx}][Comments]" class="form-control form-control-sm"></td>
                    <td><button type="button" class="btn btn-danger btn-xs remove-row">X</button></td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', newRow);
            rowIdx++;
        });

        document.querySelector('#detailsTable').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                if(document.querySelectorAll('#detailsTable tbody tr').length > 1){
                    e.target.closest('tr').remove();
                } else {
                    alert('At least one row is required.');
                }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/aandg/public_html/Modules/SM/resources/views/database/sampledelivery/edit.blade.php ENDPATH**/ ?>