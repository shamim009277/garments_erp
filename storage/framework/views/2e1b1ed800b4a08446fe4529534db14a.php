<?php $__env->startSection('title', 'ORDER MANAGEMENT'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'BOM Setup',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'BOM Setup', 'url' => route('ordermanagement.setup.bomsetups.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div class="col-md-3">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i data-feather="list" width="16" height="16"></i>
                        <h6 class="my-0 text-primary ms-2">Buyers List</h6>
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
                <div class="card-body">
                    <?php $__currentLoopData = $buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <ul class="nav-custom">
                        <li class="nav-custom-item">
                            <input type="checkbox" id="dept<?php echo e($buyer->id); ?>">
                                <a href="<?php echo e(route('ordermanagement.setup.bomsetups.show', $buyer->id)); ?>" class="nav-custom-link"><?php echo e($buyer->buyer_name); ?></a>
                        </li>
                    </ul>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\OrderManagement\resources\views\setup\bomsetups\index.blade.php ENDPATH**/ ?>