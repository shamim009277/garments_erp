<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Shifting Report',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Report', 'url' => route('hris.index')],
                    ['label' => 'Shifting Report', 'url' => route('hris.report.shifting-report.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <?php if($title == 1): ?>
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Shift</h6>
                        <p class="ms-auto text-center">Date Range: <?php echo e($startDate); ?> To <?php echo e($endDate); ?></p>
                    <?php elseif($title == 2): ?>
                        <h6 class="my-0 text-primary text-center">Designation-wise Daily Shift</h6>
                        <p class="ms-auto text-center">Date Range: <?php echo e($startDate); ?> To <?php echo e($endDate); ?></p>
                    <?php elseif($title == 3): ?>
                        <h6 class="my-0 text-primary text-center">Department-wise Monthly Shift</h6>
                        <p class="ms-auto text-center">Month: <?php echo e($months[$month]); ?> <?php echo e($year); ?></p>
                    <?php elseif($title == 4): ?>
                        <h6 class="my-0 text-primary text-center">Designation-wise Monthly Shift</h6>
                        <p class="ms-auto text-center">Month: <?php echo e($months[$month]); ?> <?php echo e($year); ?></p>
                    <?php endif; ?>
                </div>
                <?php if($title == 1 || $title == 2 || $title == 3 || $title == 4): ?>
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th class="text-center">Organization</th>
                                    <th class="text-center">Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Shift</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td class="text-center"><?php echo e($shift->employeeBasic->organization->short_name); ?></td>
                                        <td class="text-center"><?php echo e(str_pad($shift->employee_id, 6, '0', STR_PAD_LEFT)); ?></td>
                                        <td><?php echo e($shift->employeeBasic->name); ?></td>
                                        <td><?php echo e($shift->employeeBasic->department->department); ?></td>
                                        <td><?php echo e($shift->employeeBasic->designation->designation); ?></td>
                                        <td class="text-center"><?php echo e($shift->employeeBasic->designation->category_code); ?></td>
                                        <td class="text-center"><?php echo e(date('d-m-Y',strtotime($shift->date))); ?></td>
                                        <td class="text-center"><?php echo e($shift->shift); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
            </div>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\HRIS\resources\views\report\shift\preview.blade.php ENDPATH**/ ?>