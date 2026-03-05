<?php $__env->startSection('title', 'Movement Pass Report'); ?>
<?php
    $reportTitle = match ($title) {
        1 => 'Department-wise Listing of Employees',
        2 => 'Designation-wise Listing of Employees',
        3 => 'Employees Joined Within Date Range',
        4 => 'Employees With Blood Group',
        default => 'Employee Listing Report',
    };

    $reportSubTitle = in_array($title, [1,2])
        ? null
        : (in_array($title, [3])
            ? "Date Range: {$start_date} To {$end_date}"
            : null);
?>
<?php $__env->startSection('content'); ?>
    <?php if($title == 1 || $title == 3 || $title == 4): ?>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Category</th>
                    <?php if($title == 4): ?>
                    <th>Blood Group</th>
                    <?php endif; ?>
                    <th>Joining Date</th>
                    <th>District</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($employees) > 0): ?>
                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e(str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT)); ?></td>
                            <td><?php echo e($employee->name); ?></td>
                            <td><?php echo e($employee->department->department); ?></td>
                            <td><?php echo e($employee->designation->designation); ?></td>
                            <td><?php if($employee->designation->category_code == 'O'): ?> Officer <?php elseif($employee->designation->category_code == 'M'): ?> Manager <?php elseif($employee->designation->category_code == 'S'): ?> Staff <?php elseif($employee->designation->category_code == 'W'): ?> Worker <?php endif; ?></td>
                            <?php if($title == 4): ?>
                            <td><?php echo e($employee->employeePersonal->blood_group ?? 'N/A'); ?></td>
                            <?php endif; ?>
                            <td><?php echo e(date('d-m-Y', strtotime($employee->joining_date))); ?></td>
                            <td><?php echo e($employee->mdistrict->name ?? 'N/A'); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="12" style="text-align: center; vertical-align: middle;color:#FF6C37">No Data Found <br> <small>Try to change the date range or filter</small></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php elseif($title == 2): ?>
        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Category</th>
                    <th>Joining Date</th>
                    <th>District</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $uniqueDesignations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                        <td colspan="8" style="text-align: center; color: #5156be;"><?php echo $designation->designation; ?></td>
                    </tr>
                    <?php $sl1 = 1; ?>
                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($employee->designation_id == $designation->id): ?>
                        <tr>
                            <td><?php echo e($sl1); ?></td>
                            <td><?php echo e(str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT)); ?></td>
                            <td><?php echo e($employee->name); ?></td>
                            <td><?php echo e($employee->department->department); ?></td>
                            <td><?php echo e($employee->designation->designation); ?></td>
                            <td><?php if($employee->designation->category_code == 'O'): ?> Officer <?php elseif($employee->designation->category_code == 'M'): ?> Manager <?php elseif($employee->designation->category_code == 'S'): ?> Staff <?php elseif($employee->designation->category_code == 'W'): ?> Worker <?php endif; ?></td>
                            <td><?php echo e(date('d-m-Y', strtotime($employee->joining_date))); ?></td>
                            <td><?php echo e($employee->mdistrict->name ?? 'N/A'); ?></td>
                        </tr>
                        <?php $sl1++; ?>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('hris::components.layouts.pdf', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\HRIS\resources\views\report\employeelisting\pdf.blade.php ENDPATH**/ ?>