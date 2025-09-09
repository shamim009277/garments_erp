<?php $__env->startSection('title', 'Master'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'Master',
                'subtitle' => 'Dashboard',
                'breadcrumbs' => [
                    ['label' => 'Master', 'url' => route('master.index')],
                    ['label' => 'Dashboard'],
                ]
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="my-0">Master Dashboard</h5>
                </div>
                <div class="card-body">
                    <p class="card-title-desc">Welcome to Master Dashboard</p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\new erp\garments_erp\resources\views/master/dashboard.blade.php ENDPATH**/ ?>