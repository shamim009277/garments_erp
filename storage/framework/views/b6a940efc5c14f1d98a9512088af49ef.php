<?php $__env->startSection('title', 'Attendance Report'); ?>
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
        '1' => 'Department-wise Daily Attendance',
        '2' => 'Individual Card Wise Monthly Attendance',
        '3' => 'Section Wise Daily Attendance Summary',
        '4' => 'Department Wise Daily Attendance Summary',
        '5' => 'Company Wise Daily Attendance Summary',
        default => '',
    };

    $reportSubTitle = in_array($title, [2])
    ? 'Month: ' . ($monthName . ' ' . $year ?? '')
    : (in_array($title, [1, 3, 4, 5])
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
                                <th class="text-center">SL</th>
                                <th class="text-center">Org</th>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Category</th>
                                <th class="text-center">Date</th>
                                <th>Start Punch</th>
                                <th>End Punch</th>
                                <th class="text-center" width="5px">Attn Type</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $rows = collect($datas)->where('department_id', $key)->values();
                            ?>
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overtime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                    <td class="text-center"><?php echo e($overtime->short_name); ?></td>
                                    <td><?php echo e(str_pad($overtime->employee_id, 8, '0', STR_PAD_LEFT)); ?></td>
                                    <td><?php echo e($overtime->name); ?></td>
                                    <td><?php echo e($overtime->department); ?></td>
                                    <td><?php echo e($overtime->designation); ?></td>
                                    <td><?php echo e($overtime->category_code); ?></td>
                                    <td class="text-center">
                                        <?php echo e(date('d-m-Y', strtotime($overtime->work_date))); ?>

                                    </td>
                                    <td><?php echo e($overtime->start_punch); ?></td>
                                    <td><?php echo e($overtime->end_punch); ?></td>
                                    <td class="text-center"><?php echo e($overtime->attn_type); ?></td>
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
        <?php if($datas->count() > 0): ?>
            <div class="card-body">
                <div style="overflow-x: auto;">
                    <?php
                        $sindata = $datas->first();
                        $department = $sindata->department;
                    ?>
                    <div style="font-size:10px; font-weight:bold; margin-bottom:5px;">
                            Name: <?php echo e($sindata->name); ?> <br> 
                            Employee ID: <?php echo e(str_pad($sindata->employee_id, 8, '0', STR_PAD_LEFT)); ?> <br>
                            Department: <?php echo e($department); ?>

                    </div>
                    <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">SL</th>
                                <th class="text-center">Org</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Category</th>
                                <th class="text-center">Date</th>
                                <th>Start Punch</th>
                                <th>End Punch</th>
                                <th class="text-center">Attn Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                    <td class="text-center"><?php echo e($data->short_name); ?></td>
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
        <?php else: ?>
            <div class="text-center mt-5" style="font-size:12px; font-weight:bold; color:red; margin-top:20px;">
                No data available for this data combination.
            </div>
        <?php endif; ?>
    <?php elseif($title == 3): ?>
        <?php if($datas->count() > 0): ?>
            <div class="card-body">
                <div style="overflow-x: auto;">
                    <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center" width="4%">SL</th>
                                <th class="text-center" width="5%">Org</th>
                                <th width="16%">Section Name</th>
                                <th width="15%" class="text-center">Total Employee</th>
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
                                    <td class="text-center"><?php echo e($present); ?></td>
                                    <td class="text-center"><?php echo e($absent); ?></td>
                                    <td class="text-center"><?php echo e($leave); ?></td>
                                    <td class="text-center"><?php echo e(number_format($presentPercentage, 2)); ?></td>
                                    <td class="text-center"><?php echo e($otHours); ?></td>
                                    <td></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr style="background-color: #04386b; color: #fff;">
                                <td colspan="3" class="text-center">Summary</td>
                                <td class="text-center"><?php echo e(collect($datas)->count()); ?></td>
                                <td class="text-center"><?php echo e(collect($datas)->where('attn_type', 'PR')->count()); ?></td>
                                <td class="text-center"><?php echo e(collect($datas)->where('attn_type', 'AB')->count()); ?></td>
                                <td class="text-center"><?php echo e(collect($datas)->whereIn('attn_type', ['SL', 'CL', 'EL'])->count()); ?></td>
                                <td class="text-center"><?php echo e(number_format((collect($datas)->where('attn_type', 'PR')->count() / max(collect($datas)->count(), 1)) * 100, 2)); ?></td>
                                <td class="text-center"><?php echo e(collect($datas)->sum('ot_hours')); ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        <?php else: ?>
            <div class="text-center mt-5" style="font-size:12px; font-weight:bold; color:red; margin-top:20px;">
                No data available for this data combination.
            </div>
        <?php endif; ?>
    <?php elseif($title == 4): ?>
        <?php if(count($uniqueDepartments) > 0): ?>
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
                        <tfoot >
                            <tr style="background-color: #04386b; color: #fff;">
                                <td colspan="3" class="text-center">Summary</td>
                                <td class="text-center"><?php echo e(collect($datas)->count()); ?></td>
                                <td class="text-center"><?php echo e(collect($datas)->where('attn_type', 'PR')->count()); ?></td>
                                <td class="text-center"><?php echo e(collect($datas)->where('attn_type', 'AB')->count()); ?></td>
                                <td class="text-center"><?php echo e(collect($datas)->whereIn('attn_type', ['SL', 'CL', 'EL'])->count()); ?></td>
                                <td class="text-center"><?php echo e(number_format((collect($datas)->where('attn_type', 'PR')->count() / max(collect($datas)->count(), 1)) * 100, 2)); ?></td>
                                <td class="text-center"><?php echo e(collect($datas)->sum('ot_hours')); ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center mt-5" style="font-size:12px; font-weight:bold; color:red; margin-top:20px;">
                No data available for this data combination.
            </div>
        <?php endif; ?>
    <?php elseif($title == 5): ?>
        <?php if($datas->count() > 0): ?>
        <div class="card-body">
            <div style="overflow-x: auto;">
                <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center" width="4%">SL</th>
                            <th class="text-center" width="20%">Organization</th>
                            <th width="10%" class="text-center">Employee</th>
                            <th class="text-center">Present</th>
                            <th class="text-center">Absent</th>
                            <th class="text-center">Leave</th>
                            <th class="text-center">Present %</th>
                            <th class="text-center">OT Hours</th>
                            <th class="text-center">Remarks</th>
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
                    <tfoot>
                        <tr style="background-color: #04386b; color: #fff;">
                            <td colspan="2" class="text-center">Summary</td>
                            <td class="text-center"><?php echo e(collect($datas)->count()); ?></td>
                            <td class="text-center"><?php echo e(collect($datas)->where('attn_type', 'PR')->count()); ?></td>
                            <td class="text-center"><?php echo e(collect($datas)->where('attn_type', 'AB')->count()); ?></td>
                            <td class="text-center"><?php echo e(collect($datas)->whereIn('attn_type', ['SL', 'CL', 'EL'])->count()); ?></td>
                            <td class="text-center"><?php echo e(number_format((collect($datas)->where('attn_type', 'PR')->count() / max(collect($datas)->count(), 1)) * 100, 2)); ?></td>
                            <td class="text-center"><?php echo e(collect($datas)->sum('ot_hours')); ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
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

<?php echo $__env->make('payroll::components.layouts.pdf', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/aandg/public_html/Modules/Payroll/resources/views/report/attendence/pdf.blade.php ENDPATH**/ ?>