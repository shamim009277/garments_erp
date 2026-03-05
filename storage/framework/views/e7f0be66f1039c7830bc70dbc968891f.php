<?php $__env->startSection('title', 'Payroll'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'Payroll',
                'subtitle' => 'Overtime',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Report', 'url' => route('payroll.index')],
                    ['label' => 'Overtime', 'url' => route('payroll.report.bonus-report.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <?php if($title == 1): ?>
                        <h6 class="my-0 text-primary text-center">Department-wise Bonus Report</h6>
                        <p class="ms-auto text-center">Date: </p>
                    <?php elseif($title == 2): ?>
                        <h6 class="my-0 text-primary text-center">Individual Card Wise Monthly Bonus Report</h6>
                    <?php endif; ?>
                </div>
                <?php if($title == 1): ?>
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
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
                                    <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="color: #5156be;"><?php echo e($department); ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
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
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php elseif($title == 2): ?>
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; text-align: center; font-weight: bold;">
                                <tr>
                                    <td colspan="10">
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
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $('.table').DataTable({
            'paging': false,
            'searching': false,
            'ordering': false,
            'dom': 'Bfrtip',
            'buttons': [{
                'extend': 'excelHtml5',
                'title': 'Employee Listing',
                'filename': 'Employee Listing',
                'className': 'btn btn-info btn-sm'
            }]
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\Payroll\resources\views\report\bonus\preview.blade.php ENDPATH**/ ?>