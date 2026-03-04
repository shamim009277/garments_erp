<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Applicant Report',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Report', 'url' => route('hris.index')],
                    ['label' => 'Applicant Report', 'url' => route('hris.report.applicant-report.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-lg-12 pr-0">
            <?php if(isset($message)): ?>
                <div style="text-align:center; padding:50px; font-size:20px; color:red; font-weight:bold;">
                    <?php echo e($message); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $('.table').DataTable({
        'paging'      : false,
        'searching'   : false,
        'ordering'    : false,
        'dom': 'Bfrtip',
        'buttons': [
            {
                'extend': 'excelHtml5',
                'title': 'Employee Listing',
                'filename': 'Employee Listing',
                'className': 'btn btn-info btn-sm'
            }
        ]
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\HRIS\resources\views\report\autogenerationreport\notfound.blade.php ENDPATH**/ ?>