<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startPush('styles'); ?>
    <style>
        input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }
        .collapse {
            display: none;
            margin-left: 40px;
        }
        .toggle-btn {
            cursor: pointer;
            color: #5156be;
            margin-left: 5px;
        }
        .parent-label {
            font-weight: bold;
        }
        .disabled-select {
            cursor: not-allowed !important;
            background-color: #dad9d9 !important;
        }
        .form-check-input:checked:disabled {
            background-color: #b7bbf5 !important;
            border: 1px solid #b7bbf5 !important;
        }
        table tr td{
            border: none !important;
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
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Shifting List',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Tools', 'url' => route('hris.index')],
                    ['label' => 'Shifting List', 'url' => route('hris.tools.shiftinglist.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Shifting List
                </h4>
            </div>
        </div>
        <div class="col-lg-6 col-md-8" style="margin:0px auto;">
            <form action="<?php echo e(route('hris.tools.shiftinglist.store')); ?>" id="applicantForm" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card alert-primary alert-top-border">
                    <div class="card-header d-flex align-items-center justify-content-between px-4 py-3">
                        <h6 class="my-0 text-primary d-flex align-items-center"><i data-feather="list" width="16" height="16" class="me-2"></i> Department</h6>

                    </div>
                    <div class="card-body" style="max-height:400px;min-height:400px; overflow-y: auto;">
                        <!-- Sample departments -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="department-list">
                                    <!-- Parent 1 -->
                                    <?php $__currentLoopData = $parentDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentDepartment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="parent-wrapper">
                                            <label class="parent-label">
                                                <span class="toggle-btn" data-target="children-<?php echo e($parentDepartment->id); ?>">[+]</span>
                                                <input type="checkbox" class="parent-checkbox departmentID" data-id="<?php echo e($parentDepartment->id); ?>" name="parent_department_id[]" value="<?php echo e($parentDepartment->id); ?>"> <?php echo e($parentDepartment->department); ?>

                                            </label>
                                            <div class="collapse" id="children-<?php echo e($parentDepartment->id); ?>">
                                                <?php $__currentLoopData = $parentDepartment->departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <label><input type="checkbox" class="form-check-input child-of-<?php echo e($parentDepartment->id); ?> departmentID" name="department_id[]" value="<?php echo e($department->id); ?>"> <?php echo e($department->department); ?></label><br>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm" style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td width="40%">
                                                <input type="checkbox" name="all_organization" id="all_organization">
                                                <label class="m-0" for="all_organization">All Org</label>
                                            </td>
                                            <td width="60%" id="all_organization_section">
                                                <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'organization_id','id' => 'organization_id','class' => 'select2','options' => $organizations,'selected' => selected_org($organizations),'placeholder' => 'Select Organization']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'organization_id','id' => 'organization_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($organizations),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(selected_org($organizations)),'placeholder' => 'Select Organization']); ?>
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
                                            <td width="40%">
                                                <label class="m-0" for="year">Year</label>
                                            </td>
                                            <td width="60%">
                                                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'year','class' => 'form-control-sm','type' => 'text','value' => ''.e(date('Y')).'','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'year','class' => 'form-control-sm','type' => 'text','value' => ''.e(date('Y')).'','required' => true,'readonly' => true]); ?>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="progress-container" style="display:none;">
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" id="progress-bar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <div class="text-center mt-1"><small id="progress-text">Initializing...</small></div>
                    </div>
                    <div class="card-footer" style="padding:10px 15px;">
                        <button type="button" class="btn btn-sm btn-outline-primary" id="check_all">Check All</button>
                        <button type="button" class="btn btn-sm btn-outline-danger" id="uncheck_all">Uncheck All</button>
                        <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['id' => 'submitBtn','class' => 'btn-sm  submitBtn','type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'submitBtn','class' => 'btn-sm  submitBtn','type' => 'submit']); ?>Generate <?php echo $__env->renderComponent(); ?>
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
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function () {
        let allOrganization = $('#all_organization').is(':checked');
        if(allOrganization){
            $('#organization_id').prop('disabled', true);
            $('#all_organization_section').addClass('disabled-select');
        }
        handleToggle('#all_organization', '#organization_id', '#all_organization_section');

        $('#all_organization').on('change', function () {
            handleToggle('#all_organization', '#organization_id', '#all_organization_section');
        });

        function handleToggle(checkboxSelector, selectSelector, sectionSelector) {
            const isChecked = $(checkboxSelector).is(':checked');
            $(selectSelector)
                .prop('disabled', isChecked)
                .val(null).trigger('change');

            $(selectSelector).toggleClass('disabled-select', isChecked);
            $(sectionSelector).toggleClass('disabled-select', isChecked);
        }
        $('#organization_id').val(1).trigger('change');


        $('.parent-checkbox.departmentID, .form-check-input.departmentID').prop('checked', true)
        $('.toggle-btn').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const target = $('#' + $(this).data('target'));
            const isOpen = target.is(':visible');
            target.toggle();
            $(this).text(isOpen ? '[+]' : '[-]');
        });

        $('.parent-checkbox').on('change', function () {
            const id = $(this).data('id');
            $(`.child-of-${id}`).prop('checked', this.checked);
        });

        $('.form-check-input').on('change', function () {
            const classList = $(this).attr('class').split(/\s+/);
            const childClass = classList.find(cls => cls.startsWith('child-of-'));
            const parentId = childClass.split('-').pop();
            const children = $(`.child-of-${parentId}`);
            const parent = $(`.parent-checkbox[data-id="${parentId}"]`);
            const anyChecked = children.is(':checked');
            parent.prop('checked', anyChecked);
        });

        $('#check_all').on('click', function () {
            $('.parent-checkbox.departmentID, .form-check-input.departmentID').prop('checked', true);
        });

        $('#uncheck_all').on('click', function () {
            $('.parent-checkbox.departmentID, .form-check-input.departmentID').prop('checked', false);
        });

        $('#applicantForm').on('submit', function (e) {
            e.preventDefault();
            e.stopPropagation();
            let formData = new FormData(this);
            let submitBtn = $('#submitBtn');
            
            submitBtn.prop('disabled', true);
            $('#progress-container').show();
            $('#progress-bar').css('width', '0%').attr('aria-valuenow', 0).text('0%');
            $('#progress-text').text('Starting...');

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                        pollJobStatus(response.job_status_id);
                    } else {
                        toastr.error(response.message);
                        submitBtn.prop('disabled', false);
                        $('#progress-container').hide();
                    }
                },
                error: function (xhr) {
                    let errorMessage = 'An error occurred';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    toastr.error(errorMessage);
                    submitBtn.prop('disabled', false);
                    $('#progress-container').hide();
                }
            });
        });

        function pollJobStatus(jobId) {
            let interval = setInterval(function () {
                $.ajax({
                    url: "<?php echo e(url('hris/tools/shiftinglist/status')); ?>/" + jobId,
                    type: 'GET',
                    success: function (response) {
                        if (response.success) {
                            let percentage = response.progress;
                            $('#progress-bar').css('width', percentage + '%').attr('aria-valuenow', percentage).text(percentage + '%');
                            $('#progress-text').text(response.message);

                            if (response.status === 'completed') {
                                clearInterval(interval);
                                toastr.success('Shifting list generated successfully!');
                                $('#submitBtn').prop('disabled', false);
                                setTimeout(function() {
                                    $('#progress-container').hide();
                                    $('#progress-bar').css('width', '0%').text('0%');
                                }, 3000);
                            } else if (response.status === 'failed') {
                                clearInterval(interval);
                                toastr.error('Job failed: ' + response.message);
                                $('#submitBtn').prop('disabled', false);
                            }
                        }
                    },
                    error: function () {
                        clearInterval(interval);
                        toastr.error('Error checking job status');
                        $('#submitBtn').prop('disabled', false);
                    }
                });
            }, 2000); // Poll every 2 seconds
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\HRIS\resources\views\tools\shiftinglist\index.blade.php ENDPATH**/ ?>