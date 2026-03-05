<?php $__env->startSection('title', 'Bonus Report'); ?>
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
        '1' => 'Department-wise Bonus Report',
        '2' => 'Individual Card Wise Monthly Bonus Report',
        default => '',
    };

    $reportSubTitle = in_array($title, [2])
    ? ''
    : (in_array($title, [1])
        ? 'Date: ' . \Carbon\Carbon::parse($date)->format('d-m-Y')
        : '');
?>


<?php $__env->startSection('content'); ?>
    <?php if($title == 1): ?>
        <?php if($uniqueDepartments->count() > 0): ?>
            <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="<?php echo e(!$loop->first ? 'page-break' : ''); ?>">
                    <div style="font-size:12px; font-weight:bold; margin-bottom:5px;">
                        Department: <?php echo e($department); ?>

                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th class="text-center" width="4%">SL</th>
                                <th class="text-center" width="6%">Org</th>
                                <th class="text-center" width="6%">Year</th>
                                <th class="text-center" width="6%">Month</th>
                                <th width="10%">Employee ID</th>
                                <th width="15%">Name</th>
                                <th width="12%">Department</th>
                                <th width="12%">Designation</th>
                                <th width="6%">Category</th>
                                <th class="text-center" width="10%">Base Date</th>
                                <th width="10%">Basic Salary</th>
                                <th width="10%">Amount</th>
                                <th width="10%">Percentage</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $bonuses = collect($datas)->where('department_id', $key)->all();
                            ?>
                            <?php $__currentLoopData = $bonuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bonus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                    <td class="text-center"><?php echo e($bonus->short_name); ?></td>
                                    <td class="text-center"><?php echo e($bonus->year); ?></td>
                                    <td class="text-center"><?php echo e(\Carbon\Carbon::create()->month($bonus->month)->format('F')); ?></td>
                                    <td><?php echo e(str_pad($bonus->employee_id, 8, '0', STR_PAD_LEFT)); ?></td>
                                    <td><?php echo e($bonus->name); ?></td>
                                    <td><?php echo e($bonus->department); ?></td>
                                    <td><?php echo e($bonus->designation); ?></td>
                                    <td class="text-center"><?php echo e($bonus->category); ?></td>
                                    <td class="text-center"><?php echo e(date('d-m-Y', strtotime($bonus->base_date))); ?></td>
                                    <td><?php echo e(number_format($bonus->basic, 2)); ?></td>
                                    <td><?php echo e(number_format($bonus->amount, 2)); ?></td>
                                    <td><?php echo e(number_format($bonus->percentage, 2)); ?></td>
                                    <td class="text-center"></td>
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
    <?php elseif($title == 2): ?>
        <?php if($datas): ?>
        <div class="card-body">
            <div style="overflow-x: auto;">
                <table style="width: 100%; text-align: center; font-weight: bold;">
                    <tr>
                        <td colspan="10" style="font-size:12px; text-align:center;">
                            Employee Name: <?php echo e($datas->name); ?> <br>
                            Employee ID: <?php echo e(str_pad($datas->employee_id, 8, '0', STR_PAD_LEFT)); ?> <br>
                            Designation: <?php echo e($datas->designation); ?> <br>
                            Department: <?php echo e($datas->department); ?> <br>
                            Line: <?php echo e($datas->line); ?> <br>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center" width="4%">SL</th>
                            <th class="text-center" width="6%">Org</th>
                            <th class="text-center" width="6%">Year</th>
                            <th class="text-center" width="6%">Month</th>
                            <th width="12%">Department</th>
                            <th width="12%">Designation</th>
                            <th width="6%">Category</th>
                            <th class="text-center" width="10%">Base Date</th>
                            <th width="10%">Basic Salary</th>
                            <th width="10%">Amount</th>
                            <th width="10%">Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">#</td>
                            <td class="text-center"><?php echo e($datas->short_name); ?></td>
                            <td class="text-center"><?php echo e($datas->year); ?></td>
                            <td class="text-center"><?php echo e(\Carbon\Carbon::create()->month($datas->month)->format('F')); ?></td>
                            <td><?php echo e($datas->department); ?></td>
                            <td><?php echo e($datas->designation); ?></td>
                            <td class="text-center"><?php echo e($datas->category); ?></td>
                            <td class="text-center"><?php echo e(date('d-m-Y', strtotime($datas->base_date))); ?></td>
                            <td><?php echo e(number_format($datas->basic, 2)); ?></td>
                            <td><?php echo e(number_format($datas->amount, 2)); ?></td>
                            <td><?php echo e(number_format($datas->percentage, 2)); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php else: ?>
            <div class="text-center mt-5" style="font-size:12px; font-weight:bold; color:red; margin-top:20px;">
                No data available for this data combination.
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('payroll::components.layouts.pdf', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\Payroll\resources\views\report\bonus\pdf.blade.php ENDPATH**/ ?>