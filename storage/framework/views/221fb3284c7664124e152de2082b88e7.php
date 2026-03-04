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
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Absent Report</h6>
                        <p class="ms-auto text-center">Date: <?php echo e(date('d-m-Y', strtotime($date))); ?></p>
                    <?php elseif($title == 2): ?>
                        <h6 class="my-0 text-primary text-center">Department-wise Absent Report (Date Range)</h6>
                        <p class="ms-auto text-center">Date Range: <?php echo e(date('d-m-Y', strtotime($start_date))); ?> To <?php echo e(date('d-m-Y', strtotime($end_date))); ?></p>
                    <?php elseif($title == 3): ?>
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Absent (Abnormal)</h6>
                        <p class="ms-auto text-center">Date: <?php echo e(date('d-m-Y', strtotime($date))); ?></p>
                    <?php elseif($title == 4): ?>
                        <h6 class="my-0 text-primary text-center">Department-wise Absent (Abnormal) (Date Range)</h6>
                        <p class="ms-auto text-center">Date Range: <?php echo e(date('d-m-Y', strtotime($start_date))); ?> To <?php echo e(date('d-m-Y', strtotime($end_date))); ?></p>
                    <?php endif; ?>

                </div>
                <?php if($title == 1 || $title == 2): ?>
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
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
                                        </tr>
                                        <?php
                                            $absents = collect($datas)->where('department_id', $key)->all();
                                        ?>
                                        <?php $__currentLoopData = $absents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $absent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\Payroll\resources\views\report\absent\preview.blade.php ENDPATH**/ ?>