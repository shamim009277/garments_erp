<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee Movement Pass',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Report', 'url' => route('hris.index')],
                    ['label' => 'Employee Movement Pass', 'url' => route('hris.report.movement-pass.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <?php if($title == 1): ?>
                        <h6 class="my-0 text-primary text-center">Department-wise Monthly Movement Pass</h6>
                        <p class="ms-auto text-center">Month: <?php echo e($months[$month]); ?></p>
                    <?php elseif($title == 2): ?>
                        <h6 class="my-0 text-primary text-center">Designation-wise Monthly Movement Pass</h6>
                        <p class="ms-auto text-center">Month: <?php echo e($months[$month]); ?></p>
                    <?php elseif($title == 3): ?>
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Movement Pass</h6>
                        <p class="ms-auto text-center">Date Range: <?php echo e($start_date); ?> To <?php echo e($end_date); ?></p>
                    <?php elseif($title == 4): ?>
                        <h6 class="my-0 text-primary text-center">Designation-wise Daily Movement Pass</h6>
                        <p class="ms-auto text-center">Date Range: <?php echo e($start_date); ?> To <?php echo e($end_date); ?></p>
                    <?php endif; ?>
                </div>

                <?php if($title == 1 || $title == 2 || $title == 3 || $title == 4): ?>
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Date</th>
                                        <th>In Time</th>
                                        <th>Out Time</th>
                                        <th>Duration</th>
                                        <th>Purpose</th>
                                        <th>Reason</th>
                                        <th>Approved By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><?php echo e(str_pad($data->employee_id, 6, '0', STR_PAD_LEFT)); ?></td>
                                            <td><?php echo e($data->employee->name); ?></td>
                                            <td><?php echo e($data->department->department); ?></td>
                                            <td><?php echo e($data->designation->designation); ?></td>
                                            <td><?php echo e($data->date); ?></td>
                                            <td><?php echo e(date('h:i A', strtotime($data->start_time))); ?></td>
                                            <td><?php echo e(date('h:i A', strtotime($data->end_time))); ?></td>

                                            <td>
                                                <?php if($data->start_time && $data->end_time): ?>
                                                    <?php echo e(\Carbon\Carbon::parse($data->start_time)->diff(\Carbon\Carbon::parse($data->end_time))->format('%h:%I')); ?>

                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($data->purpose->purpose ?? '-'); ?></td>
                                            <td><?php echo e($data->reason->reason); ?></td>
                                            <td><?php echo e($data->approvedBy->name); ?></td>
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
                'title': 'Employee Movement Pass Report',
                'filename': 'Employee_Movement_Pass_Report',
                'className': 'btn btn-info btn-sm'
            }
        ]
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\HRIS\resources\views\report\movementpass\preview.blade.php ENDPATH**/ ?>