<?php $__env->startSection('title', 'Movement Pass Report'); ?>
<?php
    $reportTitle = match ($title) {
        1 => 'Department-wise Monthly Movement Pass',
        2 => 'Designation-wise Monthly Movement Pass',
        3 => 'Department-wise Daily Movement Pass',
        4 => 'Designation-wise Daily Movement Pass',
        default => 'Movement Pass Report',
    };

    $reportSubTitle = in_array($title, [1,2])
        ? 'Month: '.($months[$month] ?? '')
        : (in_array($title, [3,4])
            ? "Date Range: {$start_date} To {$end_date}"
            : null);
?>
<?php $__env->startSection('content'); ?>
    <?php if($title == 1 || $title == 2 || $title == 3 || $title == 4): ?>
        <table style="width: 100%;">
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
                <?php if(count($datas) > 0): ?>
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
                <?php else: ?>
                    <tr>
                        <td colspan="12" style="text-align: center; vertical-align: middle;color:#FF6C37">No Data Found <br> <small>Try to change the date range or filter</small></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('hris::components.layouts.pdf', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\HRIS\resources\views\report\movementpass\pdf.blade.php ENDPATH**/ ?>