
<?php $__env->startSection('title', 'Order Management'); ?>
<?php $__env->startSection('styles'); ?>
<style>
    .table,
    tr,
    th,
    td {
        border: none !important;
        border-collapse: collapse;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <?php echo $__env->make('components.breadcrumb', [
        'title' => 'Order Management',
        'subtitle' => 'Initial Orders',
        'breadcrumbs' => [
        ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
        ['label' => 'Database', 'url' => route('ordermanagement.index')],
        ['label' => 'Initial Orders', 'url' => route('ordermanagement.database.initialorders.index')],
        ],
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    <div class="col-md-3">
        <div class="card alert-primary alert-top-border padding-card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <i data-feather="list" width="16" height="16"></i>
                    <h6 class="my-0 text-primary ms-2">Initial Orders List</h6>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control form-control-sm" placeholder="Search here...">
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $org = collect($orders)->pluck('organization');
            $orgList = collect($org)->unique();
            ?>
            <div class="card-body">
                <?php $__currentLoopData = $orgList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $org): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <ul class="nav-custom">
                    <li class="nav-custom-item">
                        <input type="checkbox" id="dept<?php echo e($org->id); ?>">
                        <label class="nav-custom-link" for="dept<?php echo e($org->id); ?>">
                            <span class="nav-custom-caret"> </span>
                            <?php echo e($org->name); ?>

                        </label>
                        <?php
                        $ordList = collect($orders)->where('organization_id', $org->id);
                        ?>
                        <ul class="nav-custom-content">
                            <?php $__currentLoopData = $ordList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-custom-item"><a href="<?php echo e(route('ordermanagement.database.orderpricing.show', $order->id)); ?>" class="nav-custom-link"><?php echo e($order->order_code); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\OrderManagement\resources\views\database\orderpricing\index.blade.php ENDPATH**/ ?>