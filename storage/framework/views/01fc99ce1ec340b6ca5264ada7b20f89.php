<?php $__env->startSection('title', 'Punch Report'); ?>
<?php
    $reportTitle = match ($title) {
        '1' => 'Department-wise Daily Punch',
        '2' => 'Individual Card Wise Monthly Punch',
        '4' => 'Daily Late Arrival',
        '5' => 'Daily Early Departure',
        '6' => 'Daily Single Punch',
    };

    $reportSubTitle = in_array($title, [2])
        ? 'Month: '.($monthName . ' ' . $year  ?? '')
        : (in_array($title, [1,4,5,6])
            ? "Date: {$date}"
            : null);
?>
<?php $__env->startSection('content'); ?>
    <?php if($title == 1): ?>
        <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $departmentDatas = $datas->where('department', $department);
                $sl = 0;
            ?>
            <div style="font-size: 12px; font-weight: bold; text-align: left;">Department: <?php echo e($department); ?></div>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center" width="4%">SL</th>
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
                    <?php if(count($departmentDatas) > 0): ?>
                        <?php $__currentLoopData = $departmentDatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e(++$sl); ?></td>
                                <td><?php echo e(str_pad($data->employee_id, 8, '0', STR_PAD_LEFT)); ?></td>
                                <td><?php echo e($data->name); ?></td>
                                <td><?php echo e($data->department); ?></td>
                                <td><?php echo e($data->designation); ?></td>
                                <td class="text-center"><?php echo e($data->category_code); ?></td>
                                <td class="text-center"><?php echo e(date('d-m-Y', strtotime($data->work_date))); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($data->start_punch)->format('h:i A')); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($data->end_punch)->format('h:i A')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center;" style="font-size: 12px; color: #e70909; text-align: center;">No Data Found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php elseif($title == 2): ?>
        <div class="card-body">
            <?php if($datas->count() > 0): ?>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; text-align: center; font-weight: bold;">
                        <tr>
                            <td colspan="10" style="font-size: 11px; text-align: center;">
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
                                <th class="text-center" width="6%">Category</th>
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
                                    <td><?php echo e(\Carbon\Carbon::parse($data->start_punch)->format('h:i A')); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($data->end_punch)->format('h:i A')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-center" style="font-size: 12px; color: #e70909; text-align: center; margin-top: 40px; font-style: italic;">No Data Found For This Input Date Range</p>
            <?php endif; ?>
        </div>
    <?php elseif($title == 4): ?>
       <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $departmentDatas = $datas->where('department', $department);
                $sl = 0;
            ?>
            <div style="font-size: 12px; font-weight: bold; text-align: left;">Department: <?php echo e($department); ?></div>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center" width="2%">SL</th>
                        <th width="5%">EmpID</th>
                        <th width="15%">Employee Name</th>
                        <th width="12%">Department</th>
                        <th width="12%">Designation</th>
                        <th width="4%">Category</th>
                        <th class="text-center" width="10%">Date</th>
                        <th width="10%">Start Punch</th>
                        <th width="10%">End Punch</th>
                        <th>Is Late</th>
                        <th>Late Minutes</th>
                        <th width="10%">Atten Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($departmentDatas) > 0): ?>
                        <?php $__currentLoopData = $departmentDatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e(++$sl); ?></td>
                                <td><?php echo e(str_pad($data->employee_id, 8, '0', STR_PAD_LEFT)); ?></td>
                                <td><?php echo e($data->name); ?></td>
                                <td><?php echo e($data->department); ?></td>
                                <td><?php echo e($data->designation); ?></td>
                                <td class="text-center"><?php echo e($data->category_code); ?></td>
                                <td class="text-center"><?php echo e(date('d-m-Y', strtotime($data->work_date))); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($data->start_punch)->format('h:i A')); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($data->end_punch)->format('h:i A')); ?></td>
                                <td><?php echo e($data->is_late); ?></td>
                                <td><?php echo e($data->late_minutes); ?></td>
                                <td class="text-center"><?php echo e($data->attn_type); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12" class="text-center;" style="font-size: 12px; color: #e70909; text-align: center;">No Data Found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php elseif($title == 5): ?>
       <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $departmentDatas = $datas->where('department', $department);
                $sl = 0;
            ?>
            <div style="font-size: 12px; font-weight: bold; text-align: left;">Department: <?php echo e($department); ?></div>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center" width="2%">SL</th>
                        <th width="5%">EmpID</th>
                        <th width="15%">Employee Name</th>
                        <th width="12%">Department</th>
                        <th width="12%">Designation</th>
                        <th width="4%">Category</th>
                        <th class="text-center" width="10%">Date</th>
                        <th width="10%">Start Punch</th>
                        <th width="10%">End Punch</th>
                        <th>Is Early</th>
                        <th>Late Minutes</th>
                        <th width="10%">Atten Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($departmentDatas) > 0): ?>
                        <?php $__currentLoopData = $departmentDatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e(++$sl); ?></td>
                                <td><?php echo e(str_pad($data->employee_id, 8, '0', STR_PAD_LEFT)); ?></td>
                                <td><?php echo e($data->name); ?></td>
                                <td><?php echo e($data->department); ?></td>
                                <td><?php echo e($data->designation); ?></td>
                                <td class="text-center"><?php echo e($data->category_code); ?></td>
                                <td class="text-center"><?php echo e(date('d-m-Y', strtotime($data->work_date))); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($data->start_punch)->format('h:i A')); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($data->end_punch)->format('h:i A')); ?></td>
                                <td><?php echo e($data->is_early_leave); ?></td>
                                <td><?php echo e($data->early_minutes); ?></td>
                                <td class="text-center"><?php echo e($data->attn_type); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12" class="text-center;" style="font-size: 12px; color: #e70909; text-align: center;">No Data Found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php elseif($title == 6): ?>
       <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $departmentDatas = $datas->where('department', $department);
                $sl = 0;
            ?>
            <div style="font-size: 12px; font-weight: bold; text-align: left;">Department: <?php echo e($department); ?></div>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center" width="2%">SL</th>
                        <th width="5%">EmpID</th>
                        <th width="15%">Employee Name</th>
                        <th width="12%">Department</th>
                        <th width="12%">Designation</th>
                        <th width="4%">Category</th>
                        <th class="text-center" width="10%">Date</th>
                        <th>Start Punch</th>
                        <th>End Punch</th>  
                        <th>Atten Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($departmentDatas) > 0): ?>
                        <?php $__currentLoopData = $departmentDatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e(++$sl); ?></td>
                                <td><?php echo e(str_pad($data->employee_id, 8, '0', STR_PAD_LEFT)); ?></td>
                                <td><?php echo e($data->name); ?></td>
                                <td><?php echo e($data->department); ?></td>
                                <td><?php echo e($data->designation); ?></td>
                                <td style="text-align: center;"><?php echo e($data->category_code); ?></td>
                                <td class="text-center"><?php echo e(date('d-m-Y', strtotime($data->work_date))); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($data->start_punch)->format('h:i A')); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($data->end_punch)->format('h:i A')); ?></td>
                                <td style="text-align: center;"><?php echo e($data->attn_type); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center;" style="font-size: 12px; color: #e70909; text-align: center;">No Data Found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('payroll::components.layouts.pdf', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\Payroll\resources\views\report\punch\pdf2.blade.php ENDPATH**/ ?>