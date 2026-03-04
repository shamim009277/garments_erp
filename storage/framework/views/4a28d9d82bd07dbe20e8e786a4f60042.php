<?php $__env->startSection('title', 'Shifting Report'); ?>
<?php
    $reportTitle = match ($title) {
        '1' => 'Department-wise Daily Shift',
        '2' => 'Designation-wise Daily Shift',
        '3' => 'Department-wise Monthly Shift',
        '4' => 'Designation-wise Monthly Shift',
    };

    $reportSubTitle = in_array($title, [3,4])
        ? 'Month: '.($months[$month]  ?? '')
        : (in_array($title, [1,2])
            ? "Date Range: {$startDate} To {$endDate}"
            : null);
?>
<?php $__env->startSection('content'); ?>
    <?php if($title == 1 || $title == 2 || $title == 3 || $title == 4): ?>
        <table style="width: 100%;">
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
                <?php if(count($shifts) > 0): ?>
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
                <?php else: ?>
                    <tr>
                        <td colspan="12" style="text-align: center; vertical-align: middle;color:#FF6C37">No Data Found <br> <small>Try to change the date range or filter</small></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('hris::components.layouts.pdf', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\HRIS\resources\views\report\shift\pdf.blade.php ENDPATH**/ ?>