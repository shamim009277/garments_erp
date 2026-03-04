<footer>
    <div style="display: flex; justify-content: space-between; font-size: 10px;">
        <div>
            Printed by <?php echo e(auth()->user()->name ?? 'System'); ?>

        </div>
        <div>
            Page <span class="page"></span> | <?php echo e(now()->format('d-m-Y h:i A')); ?>

        </div>
    </div>
</footer>
<?php /**PATH H:\laragon\www\garments_erp\Modules\Payroll\resources\views\components\reports\footer.blade.php ENDPATH**/ ?>