<?php $__env->startSection('title', 'ORDER MANAGEMENT'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'Dashboard',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Dashboard', 'url' => route('ordermanagement.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-md-8">
            
        </div>

      
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\OrderManagement\resources\views\index.blade.php ENDPATH**/ ?>