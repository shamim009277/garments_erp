<?php $__env->startSection('title', 'Sample Delivery'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <?php echo $__env->make('components.breadcrumb', [
        'title' => 'Sample Delivery',
        'subtitle' => 'Sample Delivery List',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Database', 'url' => route('sms.index')],
        ['label' => 'Sample Delivery', 'url' => route('sms.database.sampledelivery.index')],
        ],
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Create Sample Delivery</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('sms.database.sampledelivery.store')); ?>" method="POST">
                    <input type="hidden" name="form_type" value="1">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Challan No</label>
                            <input type="text" name="ChallanNo" class="form-control form-control-sm" disabled >
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="Date" class="form-control form-control-sm" required value="<?php echo e(date('Y-m-d')); ?>">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Employee</label>
                            <select name="EmployeeID" class="form-control form-control-sm select2" required>
                                <option value="">Select Employee</option>
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($employee->id); ?>"><?php echo e($employee->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Challan Type</label>
                            <select name="ChallanType" class="form-select form-select-sm" required>
                                <option value="1">Returnable</option>
                                <option value="2">Non-Returnable</option>
                                <option value="3">Export</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Goods Type</label>
                            <select name="GoodsType" class="form-select form-select-sm" required>
                                <option value="1">Gray Fabric</option>
                                <option value="2">Complete Body</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Comments</label>
                            <input type="text" name="Comments" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary btn-sm">Save Delivery</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Sample Delivery List</h5>
                <a href="<?php echo e(route('sms.database.sampledelivery.create')); ?>" class="btn btn-primary btn-sm">Create New Delivery</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Challan No</th>
                                <th>Date</th>
                                <th>Buyer</th>
                                <th>Employee</th>
                                <th>Challan Type</th>
                                <th>Goods Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $deliveries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delivery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($delivery->ChallanNo); ?></td>
                                <td><?php echo e($delivery->Date); ?></td>
                                <td><?php echo e($delivery->buyer->buyer_name ?? 'N/A'); ?></td>
                                <td><?php echo e($delivery->employee->name ?? 'N/A'); ?></td>
                                <td>
                                    <?php if($delivery->ChallanType == 1): ?> Returnable
                                    <?php elseif($delivery->ChallanType == 2): ?> Non-Returnable
                                    <?php elseif($delivery->ChallanType == 3): ?> Export
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($delivery->GoodsType == 1): ?> Gray Fabric
                                    <?php elseif($delivery->GoodsType == 2): ?> Complete Body
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('sms.database.sampledelivery.show', $delivery->id)); ?>" class="btn btn-info btn-xs"><i class="fas fa-eye"></i></a>
                                    <a href="<?php echo e(route('sms.database.sampledelivery.edit', $delivery->id)); ?>" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i></a>
                                    <form action="<?php echo e(route('sms.database.sampledelivery.destroy', $delivery->id)); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2();

        

    });
</script>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\SM\resources\views\database\sampledelivery\index.blade.php ENDPATH**/ ?>