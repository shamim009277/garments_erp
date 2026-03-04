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
                'subtitle' => 'Edit Shifting List',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Tools', 'url' => route('hris.index')],
                    ['label' => 'Shifting List', 'url' => route('hris.tools.edit-shiftinglist.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Edit Shifting List
                </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-1 ps-lg-0" style="margin:0px auto;"></div>
        <div class="col-lg-4 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display For Date</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <table class="table table-sm" style="width: 100%">
                        <tbody>
                            <tr>
                                <th width="20%" style="border: none;">Date</th>
                                <td width="50%" style="border: none;">
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

        <div class="col-lg-6 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display/Chage Shift For Employee</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <table class="table table-sm" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="80%" style="border: none;">
                                    <div class="row">
                                        <div class="col-4">
                                            <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'emp_id','id' => 'emp_id','class' => 'form-control-sm','type' => 'text','value' => ''.e(old('emp_id')).'','placeholder' => 'Employee ID','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'emp_id','id' => 'emp_id','class' => 'form-control-sm','type' => 'text','value' => ''.e(old('emp_id')).'','placeholder' => 'Employee ID','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal66a280159691934507706df376ef5a6a)): ?>
<?php $attributes = $__attributesOriginal66a280159691934507706df376ef5a6a; ?>
<?php unset($__attributesOriginal66a280159691934507706df376ef5a6a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal66a280159691934507706df376ef5a6a)): ?>
<?php $component = $__componentOriginal66a280159691934507706df376ef5a6a; ?>
<?php unset($__componentOriginal66a280159691934507706df376ef5a6a); ?>
<?php endif; ?>
                                        </div>
                                        <div class="col-4">
                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'shift','id' => 'shift','class' => 'select2','value' => ''.e(old('shift')).'','placeholder' => 'Shift','required' => true,'options' => $shifts]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'shift','id' => 'shift','class' => 'select2','value' => ''.e(old('shift')).'','placeholder' => 'Shift','required' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($shifts)]); ?>
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
                                        </div>
                                        <div class="col-4">
                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'to_shift','id' => 'to_shift','class' => 'select2','value' => ''.e(old('to_shift')).'','placeholder' => 'To Shift','required' => true,'options' => $shifts]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'to_shift','id' => 'to_shift','class' => 'select2','value' => ''.e(old('to_shift')).'','placeholder' => 'To Shift','required' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($shifts)]); ?>
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
                                        </div>
                                    </div>
                                </td>
                                <td width="20%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['id' => 'submitBtn','class' => 'btn-sm submitBtn float-end display-date','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'submitBtn','class' => 'btn-sm submitBtn float-end display-date','type' => 'submit']); ?>Display <?php echo $__env->renderComponent(); ?>
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
                            <tr>
                                <td width="80%" style="border: none;">
                                    <div class="row">
                                        <div class="col-4">
                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'start_date','id' => 'start_date','class' => 'form-control-sm','type' => 'date','value' => ''.e($startDate).'','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'start_date','id' => 'start_date','class' => 'form-control-sm','type' => 'date','value' => ''.e($startDate).'','required' => true,'readonly' => true]); ?>
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
                                        </div>
                                        <div class="col-4">
                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'end_date','id' => 'end_date','class' => 'form-control-sm','type' => 'date','value' => ''.e($endDate).'','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'end_date','id' => 'end_date','class' => 'form-control-sm','type' => 'date','value' => ''.e($endDate).'','required' => true,'readonly' => true]); ?>
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
                                        </div>
                                        <div class="col-4">
                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'holiday','id' => 'holiday','class' => 'select2','value' => ''.e(old('holiday')).'','placeholder' => 'Holiday','required' => true,'options' => ['Saturday'=>'Saturday','Sunday'=>'Sunday','Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'holiday','id' => 'holiday','class' => 'select2','value' => ''.e(old('holiday')).'','placeholder' => 'Holiday','required' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Saturday'=>'Saturday','Sunday'=>'Sunday','Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday'])]); ?>
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
                                        </div>
                                    </div>
                                </td>
                                <td width="20%" style="border: none;">
                                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['id' => 'submitBtn','class' => 'btn-sm btn-danger submitBtn float-end re-generate','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'submitBtn','class' => 'btn-sm btn-danger submitBtn float-end re-generate','type' => 'submit']); ?>Re-Generate <?php echo $__env->renderComponent(); ?>
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

        <div class="col-lg-1 ps-lg-0" style="margin:0px auto;"></div>
    </div>
    <div class="row">
        <div class="col-lg-10 ps-lg-0" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border" style="min-height: 400px;max-height: 400px;overflow-y: auto;">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Display Employee Shift</h6>
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <div style="overflow-x: auto;">
                        <table class="table table-sm table-hover table-striped" style="width: 100%">
                            <thead class="table-light">
                                <tr>
                                    <th width="15%">Employee ID</th>
                                    <th width="25%">Name</th>
                                    <th width="25%">Date</th>
                                    <th width="25%">Joining Date</th>
                                    <th width="25%">Shift</th>
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
        $('#shift').select2({
            placeholder: "Shift",
            allowClear: true,
            width: '100%'
        });

        $('#to_shift').select2({
            placeholder: "To Shift",
            allowClear: true,
            width: '100%'
        });

         $(document).on('blur', '#emp_id', function(e) {
            let empId = $(this).val();
            if (empId.length >= 8) {
                employeeInfo(empId);
            }else{
                $('#holiday').val('').trigger('change');
            }
        });

        function employeeInfo(empId) {
            if (empId.length >= 8) {
                $.ajax({
                    url: "<?php echo e(route('hris.tools.edit-shiftinglist.getEmployee')); ?>",
                    type: "POST",
                    data: {
                        employee_id: empId,
                        _token: '<?php echo e(csrf_token()); ?>'
                        },
                    success: function (response) {
                        if (response.success && response.data) {
                            $('#holiday').val(response.data.refrerence_holiday).trigger('change');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Employee not found.',
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to load employee info.',
                        });
                    }
                });
            }else{
                $('#holiday').val('');
            }
        }

        $(document).on('click', '.display', function(e) {
            e.preventDefault();
            let displayDate = $('#display_date').val();
            let form = 1;

            $.ajax({
                url: '<?php echo e(route('hris.tools.edit-shiftinglist.store')); ?>',
                type: 'POST',
                data: {
                    date: displayDate,
                    form: form,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Please wait...',
                        text: 'Loading employee shifting data...',
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
                            empId = emp.employee_id.toString().padStart(6, "0");
                            row += `
                                <tr id="row-${emp.id}">
                                    <td>${empId}</td>
                                    <td>${emp.employee_basic.name}</td>
                                    <td>${emp.date}</td>
                                    <td>${emp.employee_basic.joining_date}</td>
                                    <td><input type="text" name="shift" id="shift" data-id="${emp.id}" data-emp-id="${emp.employee_id}" class="form-control form-control-sm shift" value="${emp.shift}" /></td>
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
                url: '<?php echo e(route('hris.tools.edit-shiftinglist.store')); ?>',
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
                            empId = emp.employee_id.toString().padStart(6, "0");
                            row += `
                                <tr id="row-${emp.id}">
                                    <td>${empId}</td>
                                    <td>${emp.employee_basic.name}</td>
                                    <td>${emp.date}</td>
                                    <td>${emp.employee_basic.joining_date}</td>
                                    <td><input type="text" name="shift" id="shift" data-id="${emp.id}" data-emp-id="${emp.employee_id}" class="form-control form-control-sm shift" value="${emp.shift}" /></td>
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
            let shift = $('#shift').val();
            let to_shift = $('#to_shift').val();
            let form = 3;

            if(startDate == '' || endDate == '' || empId == '' || shift == ''){
                Swal.fire(
                    'Error!',
                    'Please fill all Employee ID, Start Date, End Date and Shift fields.',
                    'error'
                );
                return;
            }

            if(to_shift == shift){
                Swal.fire(
                    'Error!',
                    'To Shift cannot be same as Shift.',
                    'error'
                );
                return;
            }

            if (shift !== '' && to_shift !== '' && holiday === '') {
                Swal.fire(
                    'Error!',
                    'If Shift and To Shift are filled, Holiday cannot be empty.',
                    'error'
                );
                return;
            }

            $.ajax({
                url: '<?php echo e(route('hris.tools.edit-shiftinglist.store')); ?>',
                type: 'POST',
                data: {
                    emp_id: empId,
                    start_date: startDate,
                    end_date: endDate,
                    holiday: holiday,
                    shift: shift,
                    to_shift: to_shift,
                    form: form,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function(response) {
                    $('#employeedata').empty();
                    if (response.success && response.data && response.data.length > 0) {
                        Swal.fire(
                            'Success!',
                            'Holiday has been generated successfully.',
                            'success'
                        );
                        let row = ``;
                        response.data.forEach(emp => {
                            empId = emp.employee_id.toString().padStart(6, "0");
                            row += `
                                <tr id="row-${emp.id}">
                                    <td>${empId}</td>
                                    <td>${emp.employee_basic.name}</td>
                                    <td>${emp.date}</td>
                                    <td>${emp.employee_basic.joining_date}</td>
                                    <td><input type="text" name="shift" id="shift" data-id="${emp.id}" data-emp-id="${emp.employee_id}" class="form-control form-control-sm shift" value="${emp.shift}" /></td>
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

        $(document).on("blur", ".shift", function () {
            let shift = $(this).val();
            let id = $(this).data("id");
            let form = 1;

            $.ajax({
                url: "<?php echo e(url('hris/tools/edit-shiftinglist')); ?>/" + id,
                type: "PUT",
                data: {
                    shift: shift,
                    form: form,
                    _token: "<?php echo e(csrf_token()); ?>",

                },
                success: function (response) {
                    if(response.success){
                        toastr.success(response.message);
                    }else{
                        toastr.error(response.message);
                    }
                },
                error: function (xhr) {
                    toastr.error(xhr.responseJSON.message);
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\HRIS\resources\views\tools\editshiftinglist\index.blade.php ENDPATH**/ ?>