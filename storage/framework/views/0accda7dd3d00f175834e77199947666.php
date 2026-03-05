<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.table, tr, th, td {
    border: none !important;
    border-collapse: collapse;
}
</style>
<?php $__env->stopPush(); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Edit Exceptional Holiday',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Tools', 'url' => route('hris.index')],
                    ['label' => 'Exceptional Holiday', 'url' => route('hris.tools.editexceptional-holidays.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Edit Exceptional Holiday
                </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2 ps-lg-0" style="margin:0px auto;"></div>
        <div class="col-lg-4 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display For Date</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <table class="table table-sm" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="70%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'display_date','id' => 'display_date','class' => 'form-control-sm','type' => 'date','value' => ''.e(date('Y-m-d')).'','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'display_date','id' => 'display_date','class' => 'form-control-sm','type' => 'date','value' => ''.e(date('Y-m-d')).'','required' => true,'readonly' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                                </td>
                                <td width="30%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['id' => 'submitBtn','class' => 'btn-sm submitBtn float-end display','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'submitBtn','class' => 'btn-sm submitBtn float-end display','type' => 'submit']); ?>Display <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display For Employee ID</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <table class="table table-sm" style="width: 100%">
                        <tbody>
                            <tr>
                                <th width="30%" style="border: none;">EmpID</th>
                                <td width="70%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'emp_id','id' => 'emp_id','class' => 'form-control-sm','type' => 'text','value' => ''.e(old('emp_id')).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'emp_id','id' => 'emp_id','class' => 'form-control-sm','type' => 'text','value' => ''.e(old('emp_id')).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Start Date</th>
                                <td width="70%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'display_date','id' => 'start_date','class' => 'form-control-sm','type' => 'date','value' => ''.e(date('Y-m-d')).'','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'display_date','id' => 'start_date','class' => 'form-control-sm','type' => 'date','value' => ''.e(date('Y-m-d')).'','required' => true,'readonly' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">End Date</th>
                                <td width="70%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'display_date','id' => 'end_date','class' => 'form-control-sm','type' => 'date','value' => ''.e(date('Y-m-d')).'','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'display_date','id' => 'end_date','class' => 'form-control-sm','type' => 'date','value' => ''.e(date('Y-m-d')).'','required' => true,'readonly' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Holiday</th>
                                <td width="70%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'holiday','id' => 'holiday','class' => 'select2','options' => ['Sunday'=>'Sunday','Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday','Saturday'=>'Saturday'],'selected' => ''.e(old('holiday')).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'holiday','id' => 'holiday','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Sunday'=>'Sunday','Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday','Saturday'=>'Saturday']),'selected' => ''.e(old('holiday')).'','required' => true]); ?>
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
                            <tr>
                                <th colspan="3" class="flex justify-end items-center gap-2" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['id' => 'displayBtn','class' => 'btn-sm submitBtn display-date','type' => 'button','style' => 'margin-left: 8px;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'displayBtn','class' => 'btn-sm submitBtn display-date','type' => 'button','style' => 'margin-left: 8px;']); ?>
                                        Display
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

                                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['id' => 'regenBtn','class' => 'btn-sm btn-info submitBtn re-generate','type' => 'button']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'regenBtn','class' => 'btn-sm btn-info submitBtn re-generate','type' => 'button']); ?>
                                        Re-Generate
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
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-2 ps-lg-0" style="margin:0px auto;"></div>
    </div>
    <div class="row">
        <div class="col-lg-8 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border" style="min-height: 400px;max-height: 400px;overflow-y: auto;">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display Employee</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <div style="overflow-x: auto;">
                        <table class="table table-sm table-hover table-striped" style="width: 100%">
                            <thead class="table-light">
                                <tr>
                                    <th width="15%">Employee ID</th>
                                    <th width="25%">Name</th>
                                    <th width="25%">Holiday Date</th>
                                    <th width="25%">Day</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="employeedata"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        $(document).on('click', '.display', function(e) {
            e.preventDefault();
            let displayDate = $('#display_date').val();
            let form = 1;

            $.ajax({
                url: '<?php echo e(route('hris.tools.editexceptional-holidays.store')); ?>',
                type: 'POST',
                data: {
                    date: displayDate,
                    form: form,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Please wait...',
                        text: 'Loading employee holiday data...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    $('#employeedata').empty();

                    if (response.success && response.data.length > 0) {
                        let row = ``;
                        response.data.forEach(emp => {
                            const date = new Date(emp.holiday_date);
                            const dayName = date.toLocaleDateString("en-US", { weekday: "long" });

                            row += `
                                <tr id="row-${emp.id}">
                                    <td>${emp.employee_id}</td>
                                    <td>${emp.employee_basic.name}</td>
                                    <td>${emp.holiday_date}</td>
                                    <td>${dayName}</td>
                                    <td>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-Display"
                                        data-id="${emp.id}" style="padding: 4px 6px;">
                                        <i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#employeedata').html(row);
                        Swal.close();
                    } else {
                        Swal.fire(
                            'Info!',
                            'No data found!',
                            'info'
                        );
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong while fetching data.', 'error');
                }
            });
        });


        $(document).on('click', '.delete-Display', function(e) {
            let id = $(this).data('id');
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
                        url: '<?php echo e(route('hris.tools.editexceptional-holidays.delete')); ?>',
                        type: 'POST',
                        data: {
                            id: id,
                            _token: '<?php echo e(csrf_token()); ?>'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'Holiday has been deleted.',
                                    'success'
                                );
                                $('#row-' + id).remove();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Holiday has not been deleted.',
                                    'error'
                                );
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', '.display-date', function(e) {
            e.preventDefault();
            let startDate = $('#start_date').val();
            let endDate = $('#end_date').val();
            let empId = $('#emp_id').val();
            let form = 2;

            if(startDate == '' || endDate == '' || empId == ''){
                Swal.fire(
                    'Error!',
                    'Please fill Employee ID, Start Date and End Date fields.',
                    'error'
                );
                return;
            }

            $.ajax({
                url: '<?php echo e(route('hris.tools.editexceptional-holidays.store')); ?>',
                type: 'POST',
                data: {
                    emp_id: empId,
                    start_date: startDate,
                    end_date: endDate,
                    form: form,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Please wait...',
                        text: 'Loading employee holiday data...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    $('#employeedata').empty();

                    if (response.success && response.data.length > 0) {
                        let row = ``;
                        response.data.forEach(emp => {
                            const date = new Date(emp.holiday_date);
                            const dayName = date.toLocaleDateString("en-US", { weekday: "long" });

                            row += `
                                <tr id="row-${emp.id}">
                                    <td>${emp.employee_id}</td>
                                    <td>${emp.employee_basic.name}</td>
                                    <td>${emp.holiday_date}</td>
                                    <td>${dayName}</td>
                                    <td>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-Display"
                                        data-id="${emp.id}" style="padding: 4px 6px;">
                                        <i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#employeedata').html(row);
                        Swal.close();
                    } else {
                        Swal.fire(
                            'Info!',
                            'No data found!',
                            'info'
                        );
                    }
                }
            });
        });

        $(document).on('click', '.re-generate', function(e) {
            e.preventDefault();
            let startDate = $('#start_date').val();
            let endDate = $('#end_date').val();
            let empId = $('#emp_id').val();
            let holiday = $('#holiday').val();
            let form = 3;

            if(startDate == '' || endDate == '' || empId == '' || holiday == ''){
                Swal.fire(
                    'Error!',
                    'Please fill all Employee ID, Start Date, End Date and Holiday fields.',
                    'error'
                );
                return;
            }

            $.ajax({
                url: '<?php echo e(route('hris.tools.editexceptional-holidays.store')); ?>',
                type: 'POST',
                data: {
                    emp_id: empId,
                    start_date: startDate,
                    end_date: endDate,
                    holiday: holiday,
                    form: form,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    $('#employeedata').empty();

                    if (response.success && response.data.length > 0) {
                        Swal.fire(
                            'Success!',
                            'Holiday has been generated successfully.',
                            'success'
                        );
                        let row = ``;
                        response.data.forEach(emp => {
                            const date = new Date(emp.holiday_date);
                            const dayName = date.toLocaleDateString("en-US", { weekday: "long" });

                            row += `
                                <tr id="row-${emp.id}">
                                    <td>${emp.employee_id}</td>
                                    <td>${emp.employee_basic.name}</td>
                                    <td>${emp.holiday_date}</td>
                                    <td>${dayName}</td>
                                    <td>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-Display"
                                        data-id="${emp.id}" style="padding: 4px 6px;">
                                        <i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#employeedata').html(row);

                    } else {
                        Swal.fire(
                            'Info!',
                            'No data found!',
                            'info'
                        );
                    }
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\HRIS\resources\views\tools\editexceptionalholiday\index.blade.php ENDPATH**/ ?>