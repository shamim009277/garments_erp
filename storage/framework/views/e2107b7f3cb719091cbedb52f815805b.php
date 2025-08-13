<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startPush('styles'); ?>
    <style>
        .image-wrapper {
            overflow: hidden;
            width: 100%;
            height: 200px;
            border-radius: 8px;
        }

        .image-wrapper img {
            width: 100%;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .image-wrapper:hover img {
            transform: scale(1.1);
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row" style="padding: 0px !important;margin-top: -15px;">
        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $imagePath = 'backend/assets/images/modules/' . $module->image;
            ?>
            <?php echo $__env->make('components.module', [
                'url' => $module->slug,
                'image' => $imagePath,
                'title' => $module->name,
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\new erp\garments_erp\resources\views/dashboard.blade.php ENDPATH**/ ?>