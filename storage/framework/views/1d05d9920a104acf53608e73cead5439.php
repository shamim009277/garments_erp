<?php $__env->startSection('title', 'Sample Production Report'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'Sample Production Report',
                'subtitle' => 'Preview',
                'breadcrumbs' => [
                    ['label' => 'Sample Production Report', 'url' => route('sms.report.sample_production')],
                    ['label' => 'Preview', 'url' => route('sms.report.production.preview')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <?php if($title == 1): ?>
                        <h6 class="my-0 text-primary text-center">Daily Production Report</h6>
                         <p class="ms-auto text-center">Date: <?php echo e(now()->format('Y-m-d')); ?></p>
                    <?php else: ?>
                        <h6 class="my-0 text-primary text-center">Production Report ( Date Range )</h6>
                        <p class="ms-auto text-center">(<?php echo e($startDate); ?> to <?php echo e($endDate); ?>)</p>
                    <?php endif; ?>
                    
                </div>
                <?php if($title == 1): ?>
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Programme ID</th>
                                    <th>Order ID</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Sample Type</th>
                                    <th>Production Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                $sl = 1;
                               ?>
                                <?php $__currentLoopData = $sampleProductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                
                                    <tr>
                                        <td><?php echo e($sl++); ?></td>
                                        <td><?php echo e(@$employee->programme->programme_code); ?></td>
                                        <td><?php echo e(@$employee->initialOrder->order_code); ?></td>
                                        <td><?php echo e(@$employee->color->color_name); ?></td>
                                        <td><?php echo e(@$employee->size->size_name); ?></td>
                                        <td><?php echo e(@$employee->sampleType->sample_type_name); ?></td>
                                        <td><?php echo e(@$employee->production_quantity); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php else: ?>
               <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Programme ID</th>
                                    <th>Order ID</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Sample Type</th>
                                    <th>Production Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sl = 1;
                               ?>
                                <?php $__currentLoopData = $sampleProductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                
                                    <tr>
                                        <td><?php echo e($sl++); ?></td>
                                        <td><?php echo e(@$employee->programme->programme_code); ?></td>
                                        <td><?php echo e(@$employee->initialOrder->order_code); ?></td>
                                        <td><?php echo e(@$employee->color->color_name); ?></td>
                                        <td><?php echo e(@$employee->size->size_name); ?></td>
                                        <td><?php echo e(@$employee->sampleType->sample_type_name); ?></td>
                                        <td><?php echo e(@$employee->production_quantity); ?></td>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\SM\resources\views\report\production\preview.blade.php ENDPATH**/ ?>