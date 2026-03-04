<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startPush('styles'); ?>
    <style>
        input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }
        input.start_date,
        input.end_date {
            min-width: 140px;
            max-width: 180px;
            width: 100%;
        }

        td input.start_date,
        td input.end_date {
            box-sizing: border-box;
        }

        @media (max-width: 576px) {
            input.start_date,
            input.end_date {
                min-width: 120px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Leave Application Approve',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Leave Application Approve', 'url' => route('hris.database.leave-approve.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Leave Application Approve
                </h4>
            </div>
        </div>
        <div class="col-lg-12">
            <form action="<?php echo e(route('hris.database.leave-application.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i>Leave Application Approve</h6>
                    </div>
                    <div style="overflow-x: auto;">
                        <div class="card-body">
                            <table class="table table-sm table-bordered table-hover table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 100px; white-space: nowrap;">Emp ID#</th>
                                        <th style="white-space: nowrap;">Name</th>
                                        <th style="white-space: nowrap;">Designation</th>
                                        <th style="white-space: nowrap;">Department</th>
                                        <th style="white-space: nowrap;">Join Date</th>
                                        <th style="width: 200px; white-space: nowrap;">Start Date</th>
                                        <th style="width: 200px; white-space: nowrap;">End Date</th>
                                        <th style="width: 80px; text-align: center; white-space: nowrap;">Days</th>
                                        <th style="text-align: center; white-space: nowrap;">Balance</th>
                                        <th style="text-align: center; white-space: nowrap;">Type</th>
                                        <th style="width: 200px; white-space: nowrap;">Reason</th>
                                        <th style="width: 100px; white-space: nowrap;">Input Date</th>
                                    </tr>
                                </thead>

                                <tbody id="leave_forward_table_body">
                                    <?php $__currentLoopData = $leaveApplications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leaveApplication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td style="white-space: nowrap;">
                                                <input type="checkbox" class="row_checkbox" id="form_id" name="form_id[]" value="<?php echo e($leaveApplication->form_id); ?>"<?php echo e($leaveApplication->is_writable ? 'checked' : ''); ?>>
                                                <a href="<?php echo e(route('hris.database.leave-approve.show', $leaveApplication->id)); ?>" style="font-weight: bold; white-space: nowrap;">
                                                    <?php echo e(str_pad($leaveApplication->employee_id, 6, '0', STR_PAD_LEFT)); ?>

                                                </a>
                                            </td>
                                            <td style="white-space: nowrap;"><?php echo e($leaveApplication->employee->name); ?></td>
                                            <td style="white-space: nowrap;"><?php echo e($leaveApplication->designation->designation); ?></td>
                                            <td style="white-space: nowrap;"><?php echo e($leaveApplication->department->department); ?></td>
                                            <td style="white-space: nowrap;"><?php echo e($leaveApplication->employee->joining_date); ?></td>
                                            <td style="white-space: nowrap;">
                                                <input type="text" id="start_date<?php echo e($leaveApplication->form_id); ?>" class="form-control form-control-sm start_date"
                                                    name="start_date[]" value="<?php echo e($leaveApplication->start_date); ?>"
                                                    <?php echo e($leaveApplication->is_writable ? '' : 'readonly'); ?>>
                                            </td>

                                            <td style="white-space: nowrap;">
                                                <input type="text" id="end_date<?php echo e($leaveApplication->form_id); ?>" class="form-control form-control-sm end_date"
                                                    name="end_date[]" value="<?php echo e($leaveApplication->end_date); ?>"
                                                    <?php echo e($leaveApplication->is_writable ? '' : 'readonly'); ?>>
                                            </td>

                                            <td style="text-align: center; white-space: nowrap;">
                                                <input type="text" id="days<?php echo e($leaveApplication->form_id); ?>" class="form-control form-control-sm days"
                                                    name="days[]" value="<?php echo e($leaveApplication->days); ?>"
                                                    <?php echo e($leaveApplication->is_writable ? '' : 'readonly'); ?> style="text-align: center;">
                                            </td>
                                            <td style="text-align: center; white-space: nowrap;"><?php echo e($leaveApplication->balance??0); ?></td>
                                            <td style="text-align: center; white-space: nowrap;"><?php echo e($leaveApplication->leave_type_id); ?></td>
                                            <td style="white-space: nowrap;"><?php echo e($leaveApplication->leaveReason->reason); ?></td>
                                            <td style="white-space: nowrap;"><?php echo e($leaveApplication->application_date); ?></td>
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
                                Total: <?php echo count($leaveApplications); ?> &nbsp;&nbsp;
                                <button type="button" class="btn btn-sm btn-outline-success" id="check_all_forward">
                                    <i data-feather="check-square" width="14" height="14"></i> Check All
                                </button>

                                <button type="button" class="btn btn-sm btn-outline-primary" id="uncheck_all_forward">
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
                                    Approve
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
$(document).ready(function () {

    /* ---------------- HELPERS ---------------- */
    let previousValues = {};

    function calculateDays(start, end) {
        let startDate = new Date(start);
        let endDate   = new Date(end);

        if (isNaN(startDate) || isNaN(endDate)) return 0;

        let diffTime = endDate - startDate;
        let diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24)) + 1;
        return diffDays > 0 ? diffDays : 0;
    }

    function toggleButtons() {
        let anyChecked = $('.row_checkbox:checked').length > 0;
        $('#discardBtn, #submitBtn').prop('disabled', !anyChecked);
    }

    /* ---------------- CHECK / UNCHECK ALL ---------------- */
    $('#check_all_forward').on('click', function () {
        $('.row_checkbox').prop('checked', true).trigger('change');
    });

    $('#uncheck_all_forward').on('click', function () {
        $('.row_checkbox').prop('checked', false).trigger('change');
    });

    /* ---------------- SINGLE CHECKBOX ---------------- */
    $(document).on('change', '.row_checkbox', function () {
        let row = $(this).closest('tr');
        let isChecked = $(this).is(':checked');

        row.find('.start_date, .end_date')
           .prop('readonly', !isChecked);

        toggleButtons();
    });

    $('.row_checkbox').trigger('change');
    toggleButtons();

    /* ---------------- STORE PREVIOUS VALUE ---------------- */
    $(document).on('focus', '.start_date, .end_date', function () {
        previousValues[this.id] = this.value;
    });

    /* ---------------- DATE CHANGE ---------------- */
    $(document).on('change', '.start_date, .end_date', function () {

        let row        = $(this).closest('tr');
        let startInput = row.find('.start_date');
        let endInput   = row.find('.end_date');
        let daysInput  = row.find('.days');

        let start = startInput.val();
        let end   = endInput.val();

        if (!start || !end) {
            daysInput.val(0);
            return;
        }

        let startDate = new Date(start);
        let endDate   = new Date(end);

        if (startDate > endDate) {
            Swal.fire({
                title: 'Error!',
                text: 'Start Date cannot be after End Date!',
                icon: 'error',
                confirmButtonText: 'OK'
            });

            startInput.val(previousValues[startInput.attr('id')] || '');
            endInput.val(previousValues[endInput.attr('id')] || '');

            let restoredStart = startInput.val();
            let restoredEnd   = endInput.val();

            daysInput.val(
                restoredStart && restoredEnd
                    ? calculateDays(restoredStart, restoredEnd)
                    : 0
            );
            return;
        }

        daysInput.val(calculateDays(start, end));
    });

    /* ---------------- INIT PREVIOUS VALUES ---------------- */
    $('.start_date, .end_date').each(function () {
        previousValues[this.id] = this.value;
    });

    /* ---------------- DISCARD ---------------- */
    $('#discardBtn').on('click', function () {

        let form_id = [], start_date = [], end_date = [], days = [];

        $('.row_checkbox:checked').each(function () {
            let row = $(this).closest('tr');

            form_id.push($(this).val());
            start_date.push(row.find('.start_date').val());
            end_date.push(row.find('.end_date').val());
            days.push(row.find('.days').val());
        });

        if (!form_id.length) {
            Swal.fire('Warning', 'No row selected!', 'warning');
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, discard it!'
        }).then((result) => {

            if (!result.isConfirmed) return;

            $.ajax({
                url: '<?php echo e(route('hris.database.leave-approve.store')); ?>',
                type: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    form_id,
                    form: 1,
                    start_date,
                    end_date,
                    days
                },
                beforeSend() {
                    Swal.fire({
                        title: 'Please wait...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                },
                success(res) {
                    Swal.close();
                    if (res.status === 'success') {
                        Swal.fire('Success', res.message, 'success');
                        $('.row_checkbox:checked').closest('tr').fadeOut(300, function () {
                            $(this).remove();
                        });
                    } else {
                        Swal.fire('Error', res.message, 'error');
                    }
                }
            });
        });
    });

    /* ---------------- SUBMIT ---------------- */
    $('#submitBtn').on('click', function () {

        let form_id = [], start_date = [], end_date = [], days = [];

        $('.row_checkbox:checked').each(function () {
            let row = $(this).closest('tr');

            form_id.push($(this).val());
            start_date.push(row.find('.start_date').val());
            end_date.push(row.find('.end_date').val());
            days.push(row.find('.days').val());
        });

        if (!form_id.length) {
            Swal.fire('Warning', 'No row selected!', 'warning');
            return;
        }

        $.ajax({
            url: '<?php echo e(route('hris.database.leave-approve.store')); ?>',
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                form_id,
                form: 2,
                start_date,
                end_date,
                days
            },
            beforeSend() {
                Swal.fire({
                    title: 'Please wait...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
            },
            success(res) {
                Swal.close();
                if (res.status === 'success') {
                    Swal.fire('Success', res.message, 'success');
                    $('.row_checkbox:checked').closest('tr').fadeOut(300, function () {
                        $(this).remove();
                    });
                } else {
                    Swal.fire('Error', res.message, 'error');
                }
            }
        });
    });

});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\HRIS\resources\views\database\leaveapprove\index.blade.php ENDPATH**/ ?>