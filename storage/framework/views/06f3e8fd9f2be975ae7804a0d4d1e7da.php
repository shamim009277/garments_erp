<header>
    <div style="display: flex; align-items: center;">
        <!-- Logo -->
        <div>
            <img src="<?php echo e($logo); ?>" alt="Logo" style="width: 40px; height: 40px;">
        </div>

        <!-- Company Info -->
        <div class="company-info">
            <div style="font-weight: bold; font-size: 14px; font-family: italic"><?php echo e($orgname); ?></div>
            <div style="font-size: 12px;font-weight: normal; font-family: italic"><?php echo e($address); ?></div>
            <div style="font-size: 12px;font-weight: normal; font-family: italic">Email: <?php echo e($email); ?> | Phone: <?php echo e($phone); ?></div>
        </div>
    </div>
    <hr style="border: 1px solid #ccc;">
</header>
<?php /**PATH C:\laragon\www\garments_erp\Modules\HRIS\resources\views\components\reports\header.blade.php ENDPATH**/ ?>