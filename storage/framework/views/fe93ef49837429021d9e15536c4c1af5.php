<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startPush('styles'); ?>
    <style>
        input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Increment Enforce',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Increment Enforce', 'url' => route('hris.database.increment-enforce.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Increment Enforce
                </h4>
            </div>
        </div>
        <div class="col-lg-12" style="margin:0px auto">
            <form action="<?php echo e(route('hris.database.bulk-increment.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Increment Enforce</h6>
                    </div>
                    <div style="overflow-x: auto;">
                        <div class="card-body">
                            <table id="datacom" class="table table-sm table-bordered table-hover table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th>EmpID</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>New Designation</th>
                                        <th>Department</th>
                                        <th style="text-align: center;">Line</th>
                                        <th style="text-align: center;">Unit</th>
                                        <th>Joining Date</th>
                                        <th style="text-align: center;">Gross</th>
                                        <th style="text-align: center;">Basic</th>
                                        <th style="text-align: center;">H/Rent</th>
                                        <th style="text-align: center;">Medical</th>
                                        <th>Inc. Date</th>
                                        <th>Eff. Date</th>
                                        <th>Arr. Date</th>
                                        <th style="text-align: center;">Source</th>
                                        <th style="text-align: center;">Value </th>
                                        <th style="text-align: center;">Amount</th>
                                        <th style="text-align: center;">HR % Basic</th>
                                        <th>Type</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>

                                <tbody id="increment_enforce_table_body">
                                     <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="form-check-input employee" name="employee_ids[]" value="<?php echo e($data->employee_id); ?>">
                                                <?php echo e(str_pad($data->employee_id, 6, '0', STR_PAD_LEFT)); ?>

                                            </td>
                                            <td><?php echo e($data->employeeBasic->name); ?></td>
                                            <td><?php echo e($data->designation->designation??'-'); ?></td>
                                            <td><?php echo e($data->new_designation->designation??'-'); ?></td>
                                            <td><?php echo e($data->department->department??'-'); ?></td>
                                            <td style="text-align: center;"><?php echo e($data->line??'-'); ?></td>
                                            <td style="text-align: center;"><?php echo e($data->unit??'-'); ?></td>
                                            <td style="text-align: center;"><?php echo e($data->employeeBasic->joining_date); ?></td>
                                            <td style="text-align: center;"><?php echo e($data->gross_salary); ?></td>
                                            <td style="text-align: center;"><?php echo e($data->basic); ?></td>
                                            <td style="text-align: center;"><?php echo e($data->house_rent_basic); ?></td>
                                            <td style="text-align: center;"><?php echo e($data->medical_allowance); ?></td>
                                            <td style="text-align: center;"><?php echo e($data->increment_date); ?></td>
                                            <td style="text-align: center;"><?php echo e($data->effective_date); ?></td>
                                            <td style="text-align: center;"><?php echo e($data->arrear_upto_date); ?></td>
                                            <td style="text-align: center;"><?php echo e($data->increment_source); ?></td>
                                            <td style="text-align: center;">
                                                <?php echo e($data->increment_value); ?>

                                                <?php echo e($data->increment_value_type); ?>

                                            </td>
                                            <td style="text-align: center;"><?php echo e($data->amount); ?></td>
                                            <td style="text-align: center;"><?php echo e($data->house_rent_basic); ?></td>
                                            <td>-</td>
                                            <td><?php echo e($data->remarks); ?></td>
                                        </tr>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer" style="padding:10px 20px;">
                        <div class="d-flex justify-content-between flex-wrap gap-2">
                            <!-- Left Side Buttons -->
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-outline-success" id="check_all">
                                    <i data-feather="check-square" width="14" height="14"></i> Check All
                                </button>

                                <button type="button" class="btn btn-sm btn-outline-primary" id="uncheck_all">
                                    <i data-feather="x-square" width="14" height="14"></i> Uncheck All
                                </button>
                            </div>

                            <!-- Right Side Buttons -->
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-sm btn-danger" id="discardBtn" disabled>
                                    <i data-feather="log-out" width="14" height="14"></i> Discart
                                </button>

                                <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['id' => 'submitBtn','type' => 'button','class' => 'btn btn-sm btn-primary submitBtn','disabled' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'submitBtn','type' => 'button','class' => 'btn btn-sm btn-primary submitBtn','disabled' => true]); ?>
                                    Enforce
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
   $('#datacom').DataTable({
        paging: false,
        lengthChange: false,
        searching: true,
        ordering: false,
        scrollY: "400px",
        scrollX: true,
        scrollCollapse: true,
        fixedHeader: true,
    });

    $('#check_all').on('click', function () {
        let checkboxes = $('.employee');

        if (checkboxes.length > 0) {
            checkboxes.prop('checked', true);
            $('#check_all').prop('disabled', true);
            $('#uncheck_all').prop('disabled', false);
            handleAddUser();
        } else {
            toastr.error('No found to check all');
        }
    });

    $('#uncheck_all').on('click', function () {
        let checkboxes = $('.employee');

        if (checkboxes.length > 0) {
            checkboxes.prop('checked', false);
            $('#check_all').prop('disabled', false);
            $('#uncheck_all').prop('disabled', true);
            handleAddUser();
        } else {
            toastr.error('No found to uncheck all');
        }
    });

    $(document).on('change', '.employee', function () {
        handleAddUser();
    });

    function handleAddUser() {
        let checkedCount = $('.employee:checked').length;
        if (checkedCount > 0) {
            $('.submitBtn').prop('disabled', false);
        } else {
            $('.submitBtn').prop('disabled', true);
        }
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\new erp\garments_erp\Modules\HRIS\resources\views\database\incrementenforce\index.blade.php ENDPATH**/ ?>