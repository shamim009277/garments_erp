<?php $__env->startSection('title', 'Payroll'); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startPush('styles'); ?>
<style>
    .table, tr, th, td {
        border: none !important;
        border-collapse: collapse;
    }
    input[type="checkbox"] {
        display: inline-block !important;
        opacity: 1 !important;
    }
    .disabled-select {
        cursor: not-allowed !important;
        background-color: #dad9d9 !important;
    }
    .form-check-input:checked:disabled {
        background-color: #b7bbf5 !important;
        border: 1px solid #b7bbf5 !important;
    }
</style>
<?php $__env->stopPush(); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'Payroll',
                'subtitle' => 'Punishment',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Database', 'url' => route('payroll.index')],
                    ['label' => 'Punishment', 'url' => route('payroll.database.punishment.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Employee Punishment
                </h4>
            </div>
        </div>
        <div class="col-lg-7 pe-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Input Parameter For Punishment</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;" id="parameterTableBody">
                    <div class="row">
                        <div class="col-md-4">
                            <table class="table table-sm" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'org_id','id' => 'org_id','class' => 'select2','options' => $organizations,'selected' => old('org_id', '1'),'placeholder' => 'Select']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'org_id','id' => 'org_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($organizations),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('org_id', '1')),'placeholder' => 'Select']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $attributes = $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $component = $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-sm" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td width="40%">
                                            <input type="checkbox" name="all_department" id="all_department">
                                            <label class="m-0" for="all_department">All Depart.</label>
                                        </td>
                                        <td width="60%" id="all_department_section">
                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'department_id','id' => 'department_id','class' => 'select2','options' => $departments,'placeholder' => 'Department ID']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'department_id','id' => 'department_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($departments),'placeholder' => 'Department ID']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $attributes = $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $component = $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-sm" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td width="40%">
                                            <input type="checkbox" name="all_category" id="all_category" checked>
                                            <label class="m-0" for="all_category">All Category</label>
                                        </td>
                                        <td width="60%" id="all_category_section">
                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'employee_category_id','id' => 'employee_category_id','class' => 'select2','options' => $categories,'placeholder' => 'Category ID']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'employee_category_id','id' => 'employee_category_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($categories),'placeholder' => 'Category ID']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $attributes = $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36)): ?>
<?php $component = $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36; ?>
<?php unset($__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36); ?>
<?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-9 pe-lg-0" style="overflow-y: auto;min-height: 400px;max-height: 400px;">
                            <table class="table table-sm table-bordered table-striped" style="width: 100%">
                                <thead class="table-light" style="position: sticky; top: 0;">
                                    <tr>
                                        <th>EmployeeID</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Category</th>
                                    </tr>
                                </thead>
                                <tbody id="user_table_body">

                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-3 ps-lg-0" style="overflow-y: auto;min-height: 400px;max-height: 400px;">
                            <table class="table table-sm table-bordered table-striped" style="width: 100%">
                                <thead class="table-light" style="position: sticky; top: 0;">
                                    <tr>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $period; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="punishment_date[]" id="date" value="<?php echo e(date('Y-m-d', strtotime($date))); ?>">
                                            <label class="m-0" for="date"><?php echo e(date('Y-m-d', strtotime($date))); ?></label>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer" style="padding:15px 16px;">
                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['id' => 'submitBtn','class' => 'btn-sm submitBtn float-end','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'submitBtn','class' => 'btn-sm submitBtn float-end','type' => 'submit']); ?>Submit <?php echo $__env->renderComponent(); ?>
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

        <div class="col-lg-5" style="margin:0px auto;">
            <form action="<?php echo e(route('payroll.database.advance.store')); ?>" id="applicantForm" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card alert-primary alert-top-border">
                    <div class="card-header" style="padding: 15px 16px;">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Punishment List</h6>
                    </div>
                    <div class="card-body" style="overflow-y: auto;" id="punishmentTableBody">
                        <table id="punishmentTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>EmpID</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $punishments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $punishment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="row-<?php echo e($punishment->id); ?>">
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e(str_pad($punishment->employee->employee_id, 6, '0', STR_PAD_LEFT)); ?></td>
                                        <td><?php echo e($punishment->employee->name); ?></td>
                                        <td><?php echo e($punishment->punishment_date); ?></td>
                                        <td>
                                            <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-punishment" data-id="<?php echo e($punishment->id); ?>" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        let allCategory = $('#all_category').is(':checked');
        if(allCategory){
            $('#employee_category_id').prop('disabled', true);
            $('#all_category_section').addClass('disabled-select');
        }

        handleToggle('#all_category', '#employee_category_id', '#all_category_section');
        handleToggle('#all_line', '#line', '#all_line_section');

        $('#all_category').on('change', function () {
            handleToggle('#all_category', '#employee_category_id', '#all_category_section');
        });

        $('#all_department').on('change', function () {
            handleToggle('#all_department', '#department_id', '#all_department_section');
        });

        function handleToggle(checkboxSelector, selectSelector, sectionSelector) {
            const isChecked = $(checkboxSelector).is(':checked');

            $(selectSelector)
                .prop('disabled', isChecked)
                .val(null).trigger('change');

            $(selectSelector).toggleClass('disabled-select', isChecked);
            $(sectionSelector).toggleClass('disabled-select', isChecked);
        }

        //Fetch user
        $('#org_id,#department_id,#employee_category_id').on('change', function () {
            fetchUser();
        });

        function fetchUser() {
            let org_id = $('#org_id').val();
            let department_id = $('#department_id').val();
            let employee_category_id = $('#employee_category_id').val();

            let all_department = $('#all_department').is(':checked');
            let all_category = $('#all_category').is(':checked');

            if((all_department || (department_id !== null && department_id !== '')) && (all_category || (employee_category_id !== null && employee_category_id !== '')) && (org_id !== null && org_id !== '')){
                $.ajax({
                    url: "<?php echo e(route('payroll.database.punishment.employee.info')); ?>",
                    type: "POST",
                    data: {
                        org_id: org_id,
                        department_id: department_id,
                        employee_category_id: employee_category_id,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function (response) {
                        $('#user_table_body').html('');
                        response.forEach(emp => {
                            $('#user_table_body').append(`
                                <tr>
                                    <td>
                                        <input type="radio" name="employee_id[]" id="employee_${emp.id}" class="add_user" value="${emp.employee_id}">
                                        <label class="m-0" for="employee_${emp.id}">${emp.employee_id.toString().padStart(6, '0')}</label>
                                    </td>
                                    <td>${emp.name ?? ''}</td>
                                    <td>${emp.department?.department ?? ''}</td>
                                    <td>${emp.designation?.category_code ?? ''}</td>
                                </tr>
                            `);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            }else{
                $('#user_table_body').html('');
            }
        };

        $('#submitBtn').on('click', function () {
            let punishmentDates = [];
            $('input[name="punishment_date[]"]:checked').each(function() {
                punishmentDates.push($(this).val());
            });
            let selectedEmployee = $('input[name="employee_id[]"]:checked').val();

            if (punishmentDates.length === 0 || !selectedEmployee) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select at least one punishment date and an employee',
                });
                return;
            }

            $.ajax({
                url: "<?php echo e(route('payroll.database.punishment.store')); ?>",
                type: "POST",
                data: {
                    punishment_date: punishmentDates,
                    employee_id: selectedEmployee,
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Punishment added successfully',
                        });
                        $('#parameterTableBody').load(location.href + ' #parameterTableBody');
                        $('#punishmentTableBody').load(location.href + ' #punishmentTableBody');
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong',
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });

        $(document).on('click', '.delete-punishment', function(e) {
            e.preventDefault();
            let punishmentId = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo e(route('payroll.database.punishment.delete')); ?>',
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            id: punishmentId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Punishment has been deleted.',
                                'success'
                            );
                            $('#row-' + punishmentId).remove();
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                        }
                    });
                } else {
                    Swal.fire(
                        'Cancelled!',
                        'Punishment has not been deleted.',
                        'error'
                    );
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\Payroll\resources\views\database\punishment\index.blade.php ENDPATH**/ ?>