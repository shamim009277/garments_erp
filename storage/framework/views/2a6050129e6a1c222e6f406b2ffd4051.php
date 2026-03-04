<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee Listing',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Report', 'url' => route('hris.index')],
                    ['label' => 'Employee Listing', 'url' => route('hris.report.employee-listings.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <?php if($title == 1): ?>
                        <h6 class="my-0 text-primary text-center">Department-wise Distribution of Employees</h6>
                    <?php elseif($title == 2): ?>
                        <h6 class="my-0 text-primary text-center">Designation-wise Distribution of Employees</h6>
                    <?php elseif($title == 3): ?>
                        <h6 class="my-0 text-primary text-center">Department-wise Attendance Summary</h6>
                    <?php elseif($title == 4): ?>
                        <h6 class="my-0 text-primary text-center">Designation-wise Attendance Summary</h6>
                    <?php endif; ?>
                    <p class="ms-auto text-center">Date: <?php echo e(now()->format('Y-m-d')); ?></p>
                </div>
                <?php if($title == 1): ?>
                <div class="card-body">
                    <div style="overflow-x: auto;">
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
                                <?php $count = $uniqueDepartments->count(); ?>
                                <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php $deptEmployeeCount = $employees->where('department_id', $department->id)->count(); ?>
                                    <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                        <td></td>
                                        <td style="text-align: center; color: #5156be;"><?php echo $department->department; ?>, Number of Employees - <?php echo $deptEmployeeCount; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php $sl1 = 1; ?>
                                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($employee->department_id == $department->id): ?>
                                        <tr>
                                            <td><?php echo e($sl1); ?></td>
                                            <td><?php echo e(str_pad($employee->employee_id, 8, '0', STR_PAD_LEFT)); ?></td>
                                            <td><?php echo e($employee->name); ?></td>
                                            <td><?php echo e($employee->department->department); ?></td>
                                            <td><?php echo e($employee->designation->designation); ?></td>
                                            <td><?php if($employee->designation->category_code == 'O'): ?> Officer <?php elseif($employee->designation->category_code == 'M'): ?> Manager <?php elseif($employee->designation->category_code == 'S'): ?> Staff <?php elseif($employee->designation->category_code == 'W'): ?> Worker <?php endif; ?></td>
                                            <td><?php echo e(date('d-m-Y', strtotime($employee->joining_date))); ?></td>
                                            <td><?php echo e($employee->mdistrict->name ?? ''); ?></td>
                                        </tr>
                                        <?php $sl1++; ?>
                                    <?php endif; ?>
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
                                <?php $deptEmployeeCount = $employees->where('designation_id', $designation->id)->count(); ?>
                                    <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                        <td></td>
                                        <td style="text-align: center; color: #5156be;"><?php echo $designation->designation; ?>, Number of Employees - <?php echo $deptEmployeeCount; ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php $sl1 = 1; ?>
                                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($employee->designation_id == $designation->id): ?>
                                        <tr>
                                            <td><?php echo e($sl1); ?></td>
                                            <td><?php echo e(str_pad($employee->employee_id, 8, '0', STR_PAD_LEFT)); ?></td>
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
                    </div>
                </div>
                <?php elseif($title == 3): ?>
                <div class="card-body">
                    <div style="overflow-x: auto;">
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
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e(str_pad($employee->employee_id, 8, '0', STR_PAD_LEFT)); ?></td>
                                        <td><?php echo e($employee->name); ?></td>
                                        <td><?php echo e($employee->department->department); ?></td>
                                        <td><?php echo e($employee->designation->designation); ?></td>
                                        <td><?php if($employee->designation->category_code == 'O'): ?> Officer <?php elseif($employee->designation->category_code == 'M'): ?> Manager <?php elseif($employee->designation->category_code == 'S'): ?> Staff <?php elseif($employee->designation->category_code == 'W'): ?> Worker <?php endif; ?></td>
                                        <td><?php echo e(date('d-m-Y', strtotime($employee->joining_date))); ?></td>
                                        <td><?php echo e($employee->mdistrict->name ?? 'N/A'); ?></td>
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
                                    <th>SL</th>
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Category</th>
                                    <th>Blood Group</th>
                                    <th>District</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e(str_pad($employee->employee_id, 8, '0', STR_PAD_LEFT)); ?></td>
                                        <td><?php echo e($employee->name); ?></td>
                                        <td><?php echo e($employee->department->department); ?></td>
                                        <td><?php echo e($employee->designation->designation); ?></td>
                                        <td><?php if($employee->designation->category_code == 'O'): ?> Officer <?php elseif($employee->designation->category_code == 'M'): ?> Manager <?php elseif($employee->designation->category_code == 'S'): ?> Staff <?php elseif($employee->designation->category_code == 'W'): ?> Worker <?php endif; ?></td>
                                        <td><?php echo e($employee->employeePersonal->blood_group); ?></td>
                                        <td><?php echo e($employee->mdistrict->name ?? 'N/A'); ?></td>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\HRIS\resources\views\report\summaryreport\preview.blade.php ENDPATH**/ ?>