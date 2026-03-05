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
                    ['label' => 'Overtime', 'url' => route('payroll.report.overtime-report.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <?php if($title == 1): ?>
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Basis Monthly Overtime</h6>
                        <p class="ms-auto text-center">Date Range: <?php echo e(date('d-m-Y', strtotime($start_date))); ?> To <?php echo e(date('d-m-Y', strtotime($end_date))); ?></p>
                    <?php elseif($title == 2): ?>
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Overtime</h6>
                        <p class="ms-auto text-center">Date: <?php echo e(date('d-m-Y', strtotime($date))); ?></p>
                    <?php elseif($title == 3): ?>
                        <h6 class="my-0 text-primary text-center">Department-wise Monthly Total Overtime</h6>
                        <p class="ms-auto text-center">Date Range: <?php echo e(date('d-m-Y', strtotime($start_date))); ?> To <?php echo e(date('d-m-Y', strtotime($end_date))); ?></p>
                    <?php endif; ?>
                </div>
                <?php if($title == 1): ?>
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Org</th>
                                    <th>Employee ID</th>
                                    <th>Name</th>

                                    <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th class="text-center"><?php echo e(date('d', strtotime($date))); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $records): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $employee = $records->first()->employee;
                                        $organization = $records->first()->organization;
                                    ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($organization->short_name); ?></td>
                                        <td><?php echo e(str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT)); ?></td>
                                        <td><?php echo e($employee->name); ?></td>

                                        <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $entry = $records->firstWhere('work_date', $date);
                                            ?>
                                            <td class="text-center"><?php echo e($entry->ot_hours ?? '-'); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <td class="text-center"><?php echo e($records->sum('ot_hours')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php elseif($title == 2): ?>
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="10%">Org</th>
                                    <th width="10%">Employee ID</th>
                                    <th width="18%">Employee Name</th>
                                    <th width="18%">Department</th>
                                    <th width="15%">Designation</th>
                                    <th width="10%">Category</th>
                                    <th width="10%">Date</th>
                                    <th width="4%">OT Hour</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                    </tr>
                                    <?php
                                        $overtimes = collect($datas)->where('employee.department_id', $key)->all();
                                    ?>
                                    <?php $__currentLoopData = $overtimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overtime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($overtime->organization?->short_name); ?></td>
                                            <td><?php echo e(str_pad($overtime->employee_id, 6, '0', STR_PAD_LEFT)); ?></td>
                                            <td><?php echo e($overtime->employee?->name); ?></td>
                                            <td><?php echo e($overtime->employee?->department?->department); ?></td>
                                            <td><?php echo e($overtime->employee?->designation?->designation); ?></td>
                                            <td><?php echo e($overtime->employee?->designation?->category_code); ?></td>
                                            <td><?php echo e(date('d-m-Y', strtotime($overtime->work_date))); ?></td>
                                            <td class="text-center"><?php echo e($overtime->ot_hours); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php elseif($title == 3): ?>
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="10%">Org</th>
                                    <th width="10%">Employee ID</th>
                                    <th width="15%">Employee Name</th>
                                    <th width="15%">Department</th>
                                    <th width="15%">Designation</th>
                                    <th width="10%">Category</th>
                                    <th width="10%">Total OT Hour</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="color: #5156be;"><?php echo e($department); ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                        $overtimes = collect($datas)->where('employee.department_id', $key)->all();
                                        $employeeids = collect($overtimes)->pluck('employee_id')->unique();

                                        $totalHours = collect($overtimes)->groupBy('employee_id')->map(function ($overtime) {
                                            return $overtime->sum('ot_hours');
                                        });
                                        $sl = 1;
                                    ?>

                                    <?php $__currentLoopData = $employeeids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $employeeid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $overtime = collect($overtimes)->where('employee_id', $employeeid)->first();
                                        ?>
                                        <tr>
                                            <td><?php echo e($sl++); ?></td>
                                            <td><?php echo e($overtime->short_name); ?></td>
                                            <td><?php echo e(str_pad($overtime->employee_id, 6, '0', STR_PAD_LEFT)); ?></td>
                                            <td><?php echo e($overtime->name); ?></td>
                                            <td><?php echo e($overtime->department); ?></td>
                                            <td><?php echo e($overtime->designation); ?></td>
                                            <td><?php echo e($overtime->category_code); ?></td>
                                            <td><?php echo e($totalHours[$employeeid]); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\Payroll\resources\views\report\overtime\preview.blade.php ENDPATH**/ ?>