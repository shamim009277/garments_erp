<?php $__env->startSection('title', 'Administration'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'Administration',
                'subtitle' => 'Dashboard',
                'breadcrumbs' => [
                    ['label' => 'Administration', 'url' => route('administration.index')],
                    ['label' => 'Dashboard'],
                ]
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-header bg-primary">
                    <h5 class="my-0 text-white">Modules</h5>
                </div>
                <div class="card-body">
                    <p class="card-title-desc">Active: <?php echo e($modules->count()); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-header bg-warning">
                    <h5 class="my-0 text-white">Active Modules</h5>
                </div>
                <div class="card-body">
                    <p class="card-title-desc">Module: <?php echo e($currentModule); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-header bg-success">
                    <h5 class="my-0 text-white">Administration Dashboard</h5>
                </div>
                <div class="card-body">
                    <p class="card-title-desc">Module: <?php echo e($currentModule); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-header bg-info">
                    <h5 class="my-0 text-white">Administration Dashboard</h5>
                </div>
                <div class="card-body">
                    <p class="card-title-desc">Module: <?php echo e($currentModule); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\resources\views\administration\dashboard.blade.php ENDPATH**/ ?>