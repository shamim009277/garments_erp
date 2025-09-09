<?php $__env->startSection('title', 'Inventory'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'Inventory',
                'subtitle' => 'Dashboard',
                'breadcrumbs' => [
                    ['label' => 'Inventory', 'url' => route('inventory.index')],
                    ['label' => 'Dashboard'],
                ]
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12">
            <div class="card border-top border-0 border-2 border-primary">
                <div class="card-header">
                    <h5 class="my-0 text-primary">Inventory Dashboard</h5>
                </div>
                <div class="card-body">
                    <p class="card-title-desc">Module: <?php echo e($currentModule); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\new erp\garments_erp\Modules/Inventory\resources/views/index.blade.php ENDPATH**/ ?>