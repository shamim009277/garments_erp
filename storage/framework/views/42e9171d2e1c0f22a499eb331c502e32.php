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
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Attendance</h6>
                        <p class="ms-auto text-center">Date: <?php echo e(date('d-m-Y', strtotime($date))); ?></p>
                    <?php elseif($title == 2): ?>
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Attendance</h6>
                        <p class="ms-auto text-center">Month: <?php echo e($monthName); ?> <br> Year: <?php echo e($year); ?></p>
                    <?php elseif($title == 3): ?>
                        <h6 class="my-0 text-primary text-center">Section Wise Daily Attendence Summary</h6>
                        <p class="ms-auto text-center">Date: <?php echo e(date('d-m-Y', strtotime($date))); ?></p>
                    <?php elseif($title == 4): ?>
                        <h6 class="my-0 text-primary text-center">Department Wise Daily Attendence Summary</h6>
                        <p class="ms-auto text-center">Date: <?php echo e(date('d-m-Y', strtotime($date))); ?></p>
                    <?php elseif($title == 5): ?>
                        <h6 class="my-0 text-primary text-center">Company Wise Daily Attendence Summary</h6>
                        <p class="ms-auto text-center">Date: <?php echo e(date('d-m-Y', strtotime($date))); ?></p>
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
                                        <th width="10%">Employee ID</th>
                                        <th width="15%">Employee Name</th>
                                        <th width="12%">Department</th>
                                        <th width="12%">Designation</th>
                                        <th width="6%">Category</th>
                                        <th class="text-center" width="10%">Date</th>
                                        <th width="10%">Start Punch</th>
                                        <th width="10%">End Punch</th>
                                        <th class="text-center" width="5%">Attn Type</th>
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
                                        </tr>
                                        <?php
                                            $overtimes = collect($datas)->where('department_id', $key)->all();
                                        ?>
                                        <?php $__currentLoopData = $overtimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overtime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                                <td class="text-center"><?php echo e($overtime->short_name); ?></td>
                                                <td><?php echo e(str_pad($overtime->employee_id, 6, '0', STR_PAD_LEFT)); ?></td>
                                                <td><?php echo e($overtime->name); ?></td>
                                                <td><?php echo e($overtime->department); ?></td>
                                                <td><?php echo e($overtime->designation); ?></td>
                                                <td><?php echo e($overtime->category_code); ?></td>
                                                <td class="text-center">
                                                    <?php echo e(date('d-m-Y', strtotime($overtime->work_date))); ?></td>
                                                <td><?php echo e($overtime->start_punch); ?></td>
                                                <td><?php echo e($overtime->end_punch); ?></td>
                                                <td class="text-center"><?php echo e($overtime->attn_type); ?></td>
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
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">SL</th>
                                        <th class="text-center" width="6%">Org</th>
                                        <th width="10%">Employee ID</th>
                                        <th width="15%">Employee Name</th>
                                        <th width="12%">Department</th>
                                        <th width="12%">Designation</th>
                                        <th width="6%">Category</th>
                                        <th class="text-center" width="10%">Date</th>
                                        <th width="10%">Start Punch</th>
                                        <th width="10%">End Punch</th>
                                        <th class="text-center" width="5%">Attn Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                            <td class="text-center"><?php echo e($data->short_name); ?></td>
                                            <td><?php echo e(str_pad($data->employee_id, 6, '0', STR_PAD_LEFT)); ?></td>
                                            <td><?php echo e($data->name); ?></td>
                                            <td><?php echo e($data->department); ?></td>
                                            <td><?php echo e($data->designation); ?></td>
                                            <td><?php echo e($data->category_code); ?></td>
                                            <td class="text-center"><?php echo e(date('d-m-Y', strtotime($data->work_date))); ?></td>
                                            <td><?php echo e($data->start_punch); ?></td>
                                            <td><?php echo e($data->end_punch); ?></td>
                                            <td class="text-center"><?php echo e($data->attn_type); ?></td>
                                        </tr>
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
                                        <th class="text-center" width="4%">SL</th>
                                        <th class="text-center" width="10%">Org</th>
                                        <th width="10%">Section Name</th>
                                        <th width="10%" class="text-center">Total Employee</th>
                                        <th width="10%" class="text-center">Present</th>
                                        <th width="10%" class="text-center">Absent</th>
                                        <th width="10%" class="text-center">Leave</th>
                                        <th class="text-center" width="10%">Present %</th>
                                        <th class="text-center" width="10%">OT Hours</th>
                                        <th class="text-center" width="10%">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $employees = collect($datas)->where('department_id', $key);
                                            $totalEmployee = $employees->count();
                                            $present = $employees->where('attn_type', 'PR')->count();
                                            $absent = $employees->where('attn_type', 'AB')->count();
                                            $leave = $employees->whereIn('attn_type', ['SL', 'CL', 'EL'])->count();
                                            $presentPercentage = ($present / max($totalEmployee, 1)) * 100;
                                            $otHours = $employees->sum('ot_hours');
                                            $orgName = optional($employees->first())->short_name;
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                            <td class="text-center"><?php echo e($orgName); ?></td>
                                            <td><?php echo e($department); ?></td>
                                            <td class="text-center"><?php echo e($totalEmployee); ?></td>
                                            <td class="text-center text-success fw-bold"><?php echo e($present); ?></td>
                                            <td class="text-center text-danger fw-bold"><?php echo e($absent); ?></td>
                                            <td class="text-center text-warning fw-bold"><?php echo e($leave); ?></td>
                                            <td class="text-center"><?php echo e(number_format($presentPercentage, 2)); ?></td>
                                            <td class="text-center"><?php echo e($otHours); ?></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                <?php elseif($title == 4): ?>
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">SL</th>
                                        <th class="text-center" width="10%">Org</th>
                                        <th width="10%">Department Name</th>
                                        <th width="10%" class="text-center">Total Employee</th>
                                        <th width="10%" class="text-center">Present</th>
                                        <th width="10%" class="text-center">Absent</th>
                                        <th width="10%" class="text-center">Leave</th>
                                        <th class="text-center" width="10%">Present %</th>
                                        <th class="text-center" width="10%">OT Hours</th>
                                        <th class="text-center" width="10%">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $employees = collect($datas)->where('parent_department_id', $key);
                                            $totalEmployee = $employees->count();
                                            $present = $employees->where('attn_type', 'PR')->count();
                                            $absent = $employees->where('attn_type', 'AB')->count();
                                            $leave = $employees->whereIn('attn_type', ['SL', 'CL', 'EL'])->count();
                                            $presentPercentage = ($present / max($totalEmployee, 1)) * 100;
                                            $otHours = $employees->sum('ot_hours');
                                            $orgName = optional($employees->first())->short_name;
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                            <td class="text-center"><?php echo e($orgName); ?></td>
                                            <td><?php echo e($department); ?></td>
                                            <td class="text-center"><?php echo e($totalEmployee); ?></td>
                                            <td class="text-center text-success fw-bold"><?php echo e($present); ?></td>
                                            <td class="text-center text-danger fw-bold"><?php echo e($absent); ?></td>
                                            <td class="text-center text-warning fw-bold"><?php echo e($leave); ?></td>
                                            <td class="text-center"><?php echo e(number_format($presentPercentage, 2)); ?></td>
                                            <td class="text-center"><?php echo e($otHours); ?></td>
                                            <td></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php elseif($title == 5): ?>
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">SL</th>
                                        <th class="text-center" width="10%">Organization</th>
                                        <th width="10%" class="text-center">Total Employee</th>
                                        <th width="10%" class="text-center">Present</th>
                                        <th width="10%" class="text-center">Absent</th>
                                        <th width="10%" class="text-center">Leave</th>
                                        <th class="text-center" width="10%">Present %</th>
                                        <th class="text-center" width="10%">OT Hours</th>
                                        <th class="text-center" width="10%">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $uniqueOrganization; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $organization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $employees = collect($datas)->where('org_id', $key);
                                            $totalEmployee = $employees->count();
                                            $present = $employees->where('attn_type', 'PR')->count();
                                            $absent = $employees->where('attn_type', 'AB')->count();
                                            $leave = $employees->whereIn('attn_type', ['SL', 'CL', 'EL'])->count();
                                            $presentPercentage = ($present / max($totalEmployee, 1)) * 100;
                                            $otHours = $employees->sum('ot_hours');
                                            $orgName = optional($employees->first())->name;
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                            <td class="text-center"><?php echo e($orgName); ?></td>
                                            <td class="text-center"><?php echo e($totalEmployee); ?></td>
                                            <td class="text-center text-success fw-bold"><?php echo e($present); ?></td>
                                            <td class="text-center text-danger fw-bold"><?php echo e($absent); ?></td>
                                            <td class="text-center text-warning fw-bold"><?php echo e($leave); ?></td>
                                            <td class="text-center"><?php echo e(number_format($presentPercentage, 2)); ?></td>
                                            <td class="text-center"><?php echo e($otHours); ?></td>
                                            <td></td>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\Payroll\resources\views\report\attendence\preview.blade.php ENDPATH**/ ?>