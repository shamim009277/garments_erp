<?php $__env->startSection('title', 'Absent Report'); ?>
<style>
    body {
        font-size: 11px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        page-break-inside: auto;
    }

    thead {
        display: table-header-group;
    }

    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }

    th, td {
        border: 1px solid #000;
        padding: 4px;
        vertical-align: middle;
    }

    .text-center {
        text-align: center;
    }

    .page-break {
        page-break-before: always;
    }
</style>
<?php
    $reportTitle = match ($title) {
        '1' => 'Department-wise Daily Absent Report',
        '2' => 'Department-wise Absent Report (Date Range)',
        '3' => 'Department-wise Daily Absent (Abnormal)',
        '4' => 'Department-wise Absent (Abnormal) (Date Range)',
        default => '',
    };

    $reportSubTitle = in_array($title, [2,4])
    ? 'Start Date: ' . \Carbon\Carbon::parse($start_date)->format('d-m-Y') . ' End Date: ' . \Carbon\Carbon::parse($end_date)->format('d-m-Y')
    : (in_array($title, [1, 3,])
        ? 'Date: ' . \Carbon\Carbon::parse($date)->format('d-m-Y')
        : '');
?>


<?php $__env->startSection('content'); ?>
    <?php if($title == 1 || $title == 2): ?>
        <?php if($uniqueDepartments->count() > 0): ?>
            <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="<?php echo e(!$loop->first ? 'page-break' : ''); ?>">
                    <div style="font-size:12px; font-weight:bold; margin-bottom:5px; margin-top:-10px;">
                        Department: <?php echo e($department); ?>

                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Line</th>
                                <th class="text-center">Date</th>
                                <th>Start Punch</th>
                                <th>End Punch</th>
                                <th>Shift</th>
                                <th class="text-center">Attn Type</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $rows = collect($datas)->where('department_id', $key)->values();
                            ?>
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $absent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e(str_pad($absent->employee_id, 6, '0', STR_PAD_LEFT)); ?></td>
                                    <td><?php echo e($absent->name); ?></td>
                                    <td><?php echo e($absent->department); ?></td>
                                    <td><?php echo e($absent->designation); ?></td>
                                    <td class="text-center"><?php echo e($absent->category_code); ?></td>
                                    <td class="text-center"><?php echo e($absent->line); ?></td>
                                    <td class="text-center"><?php echo e(date('d-m-Y', strtotime($absent->work_date))); ?></td>
                                    <td><?php echo e($absent->start_punch ? date('d-m-Y H:i', strtotime($absent->start_punch)) : '0000-00-00 00:00'); ?></td>
                                    <td><?php echo e($absent->end_punch ? date('d-m-Y H:i', strtotime($absent->end_punch)) : '0000-00-00 00:00'); ?></td>
                                    <td><?php echo e($absent->shift); ?></td>
                                    <td class="text-center"><?php echo e($absent->attn_type); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="text-center mt-5" style="font-size:12px; font-weight:bold; color:red; margin-top:20px;">
                No data available for this data combination.
            </div>
        <?php endif; ?>
    
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('payroll::components.layouts.pdf', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\Payroll\resources\views\report\absent\pdf.blade.php ENDPATH**/ ?>