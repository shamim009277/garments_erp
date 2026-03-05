<table class="no-border" style="width:100%; position: fixed; bottom: 16px;">
    <tr>
        <td style="width:50%; text-align:left; line-height: 1.2;">
            <p style="margin-top:8px; font-weight:600;">Printed By</p>
            <p style="font-size:11px;">
                <?php echo e($printedBy ?? auth()->user()->name ?? 'System'); ?>

            </p>
            <p style="font-size:10px;">
                <?php echo e($printedAt ?? now()->format('d-m-Y h:i A')); ?>

            </p>
        </td>

        <td style="width:50%; text-align:right; line-height: 1.2;">
            <p style="margin-top:8px; font-weight:600;">Authorized Signature</p>
            <p style="font-size:11px;">
                <?php echo e($orgname); ?>

            </p>
            <p style="font-size:10px;">
                <?php echo e($designation ?? 'HR / Management'); ?>

            </p>
        </td>
    </tr>
</table>
<?php /**PATH C:\laragon\www\garments_erp\Modules\HRIS\resources\views\components\reports\signature.blade.php ENDPATH**/ ?>