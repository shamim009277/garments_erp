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
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Punch</h6>
                        <p class="ms-auto text-center">Date: <?php echo e(date('d-m-Y', strtotime($date))); ?></p>
                    <?php elseif($title == 2): ?>
                        <h6 class="my-0 text-primary text-center">Individual Card Wise Monthly Punch</h6>
                        <p class="ms-auto text-center">Month: <?php echo e($monthName); ?> <br> Year: <?php echo e($year); ?></p>
                    <?php elseif($title == 3): ?>
                        <h6 class="my-0 text-primary text-center">Time Card</h6>
                        <p class="ms-auto text-center"></p>
                    <?php elseif($title == 4): ?>
                        <h6 class="my-0 text-primary text-center">Daily Late Arrival</h6>
                        <p class="ms-auto text-center">Date: <?php echo e(date('d-m-Y', strtotime($date))); ?></p>
                    <?php elseif($title == 5): ?>
                        <h6 class="my-0 text-primary text-center">Daily Early Departure</h6>
                        <p class="ms-auto text-center">Date: <?php echo e(date('d-m-Y', strtotime($date))); ?></p>
                    <?php elseif($title == 6): ?>
                        <h6 class="my-0 text-primary text-center">Daily Single Punch</h6>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                            <td colspan="10" style="color: #5156be;"><?php echo e($department); ?></td>
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
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php elseif($title == 2): ?>
                    <div class="card-body">
                        <?php if($datas->count() > 0): ?>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; text-align: center; font-weight: bold;">
                                <tr>
                                    <td colspan="10">
                                        Employee Name: <?php echo e($employee->name); ?> <br>
                                        Employee ID: <?php echo e(str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT)); ?> <br>
                                        Designation: <?php echo e($employee->designation); ?> <br>
                                        Department: <?php echo e($employee->short_name); ?> <br>
                                        Line: <?php echo e($employee->line); ?> <br>
                                    </td>
                                </tr>
                            </table>
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
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                            <p class="text-center">No data available</p>
                        <?php endif; ?>
                    </div>
                <?php elseif($title == 4): ?>
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">SL</th>
                                        <th class="text-center" width="6%">Org</th>
                                        <th>EmpID</th>
                                        <th width="15%">Name</th>
                                        <th width="12%">Department</th>
                                        <th width="12%">Designation</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center" width="10%">Date</th>
                                        <th>Start Punch</th>
                                        <th>End Punch</th>
                                        <th>Is Late</th>
                                        <th>Late Minutes</th>
                                        <th class="text-center">Atten Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                            <td colspan="13" style="color: #5156be;"><?php echo e($department); ?></td>
                                        </tr>
                                        <?php
                                            $overtimes = collect($datas)->where('department_id', $key)->all();
                                        ?>
                                        <?php $__currentLoopData = $overtimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overtime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                                <td class="text-center"><?php echo e($overtime->short_name); ?></td>
                                                <td><?php echo e(str_pad($overtime->employee_id, 8, '0', STR_PAD_LEFT)); ?></td>
                                                <td><?php echo e($overtime->name); ?></td>
                                                <td><?php echo e($overtime->department); ?></td>
                                                <td><?php echo e($overtime->designation); ?></td>
                                                <td class="text-center"><?php echo e($overtime->category_code); ?></td>
                                                <td class="text-center">
                                                    <?php echo e(date('d-m-Y', strtotime($overtime->work_date))); ?></td>
                                                <td><?php echo e(\Carbon\Carbon::parse($overtime->start_punch)->format('h:i A')); ?></td>
                                                <td><?php echo e(\Carbon\Carbon::parse($overtime->end_punch)->format('h:i A')); ?></td>
                                                <td><?php echo e($overtime->is_late); ?></td>
                                                <td><?php echo e($overtime->late_minutes); ?></td>
                                                <td class="text-center"><?php echo e($overtime->attn_type); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr style="font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                        <td colspan="13" class="text-start">Total Records : <?php echo e(collect($datas)->count()); ?></td>
                                    </tr>
                                </tfoot>
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
                                        <th class="text-center" width="6%">Org</th>
                                        <th>EmpID</th>
                                        <th width="15%">Name</th>
                                        <th width="12%">Department</th>
                                        <th width="12%">Designation</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center" width="10%">Date</th>
                                        <th>Start Punch</th>
                                        <th>End Punch</th>
                                        <th>Is Early</th>
                                        <th>Early Minutes</th>
                                        <th class="text-center">Atten Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                            <td colspan="13" style="color: #5156be;"><?php echo e($department); ?></td>
                                        </tr>
                                        <?php
                                            $overtimes = collect($datas)->where('department_id', $key)->all();
                                        ?>
                                        <?php $__currentLoopData = $overtimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overtime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                                <td class="text-center"><?php echo e($overtime->short_name); ?></td>
                                                <td><?php echo e(str_pad($overtime->employee_id, 8, '0', STR_PAD_LEFT)); ?></td>
                                                <td><?php echo e($overtime->name); ?></td>
                                                <td><?php echo e($overtime->department); ?></td>
                                                <td><?php echo e($overtime->designation); ?></td>
                                                <td class="text-center"><?php echo e($overtime->category_code); ?></td>
                                                <td class="text-center">
                                                    <?php echo e(date('d-m-Y', strtotime($overtime->work_date))); ?></td>
                                                <td><?php echo e(\Carbon\Carbon::parse($overtime->start_punch)->format('h:i A')); ?></td>
                                                <td><?php echo e(\Carbon\Carbon::parse($overtime->end_punch)->format('h:i A')); ?></td>
                                                <td><?php echo e($overtime->is_early_leave); ?></td>
                                                <td><?php echo e($overtime->early_minutes); ?></td>
                                                <td class="text-center"><?php echo e($overtime->attn_type); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr style="font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                        <td colspan="13" class="text-start">Total Records : <?php echo e(collect($datas)->count()); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                <?php elseif($title == 6): ?>
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">SL</th>
                                        <th class="text-center" width="6%">Org</th>
                                        <th>EmpID</th>
                                        <th width="15%">Name</th>
                                        <th width="12%">Department</th>
                                        <th width="12%">Designation</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center" width="10%">Date</th>
                                        <th>Start Punch</th>
                                        <th>End Punch</th>
                                        <th class="text-center">Atten Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                            <td colspan="11" style="color: #5156be;"><?php echo e($department); ?></td>
                                        </tr>
                                        <?php
                                            $overtimes = collect($datas)->where('department_id', $key)->all();
                                        ?>
                                        <?php $__currentLoopData = $overtimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overtime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                                <td class="text-center"><?php echo e($overtime->short_name); ?></td>
                                                <td><?php echo e(str_pad($overtime->employee_id, 8, '0', STR_PAD_LEFT)); ?></td>
                                                <td><?php echo e($overtime->name); ?></td>
                                                <td><?php echo e($overtime->department); ?></td>
                                                <td><?php echo e($overtime->designation); ?></td>
                                                <td class="text-center"><?php echo e($overtime->category_code); ?></td>
                                                <td class="text-center">
                                                    <?php echo e(date('d-m-Y', strtotime($overtime->work_date))); ?></td>
                                                <td><?php echo e(\Carbon\Carbon::parse($overtime->start_punch)->format('h:i A')); ?></td>
                                                <td><?php echo e(\Carbon\Carbon::parse($overtime->end_punch)->format('h:i A')); ?></td>
                                                <td class="text-center"><?php echo e($overtime->attn_type); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr style="font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                        <td colspan="11" class="text-start">Total Records : <?php echo e(collect($datas)->count()); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\Payroll\resources\views\report\punch\preview.blade.php ENDPATH**/ ?>