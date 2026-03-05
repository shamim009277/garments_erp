<?php $__env->startSection('title', 'Sample Management'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'SAMPLE MANAGEMENT',
                'subtitle' => 'Dashboard',
                'breadcrumbs' => [
                    ['label' => 'SAMPLE MANAGEMENT', 'url' => route('sms.index')],  
                    ['label' => 'Dashboard', 'url' => route('sms.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-md-8">
            
        </div>

      
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\SM\resources\views\index.blade.php ENDPATH**/ ?>