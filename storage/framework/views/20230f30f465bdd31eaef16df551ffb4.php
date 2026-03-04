<div class="page-title-box d-sm-flex align-items-center justify-content-between">
    <?php if($title): ?>
        <h4 class="mb-sm-0 font-size-18">
            <?php echo e($title); ?>

            <?php if($subtitle): ?>
                | <span class="text-muted font-size-12"><?php echo e($subtitle); ?></span>
            <?php endif; ?>
        </h4>
    <?php endif; ?>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('dashboard')); ?>">
                    <i data-feather="home" class="icon-xs align-middle" style="margin-top: -5px;width: 12px;"></i>
                </a>
            </li>
            <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="breadcrumb-item <?php echo e($loop->last ? 'active' : ''); ?>">
                    <?php if(!$loop->last): ?>
                        <a href="<?php echo e($item['url']); ?>"><?php echo e($item['label']); ?></a>
                    <?php else: ?>
                        <?php echo e($item['label']); ?>

                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </div>
</div>
<?php /**PATH H:\laragon\www\garments_erp\resources\views/components/breadcrumb.blade.php ENDPATH**/ ?>