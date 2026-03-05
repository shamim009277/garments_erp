<?php $__env->startSection('title', 'Sample Delivery'); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startPush('styles'); ?>
    <style>
        input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }

        .collapse {
            display: none;
            margin-left: 35px;
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
    </style>
<?php $__env->stopPush(); ?>
<div class="row">
    <div class="col-12">
        <?php echo $__env->make('components.breadcrumb', [
        'title' => 'Sample Delivery',
        'subtitle' => 'Sample Delivery List',
        'breadcrumbs' => [
        ['label' => 'Sample Management', 'url' => route('sms.index')],
        ['label' => 'Database', 'url' => route('sms.index')],
        ['label' => 'Sample Delivery', 'url' => route('sms.database.sampledelivery.index')],
        ],
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Employee Listing Report
                    </h6>
                </div>
                <form id="employeeListingForm" action="<?php echo e(route('sms.report.production.preview')); ?>" method="POST" target="_blank">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="row">
                            <!-- Titles -->
                            <div class="col-lg-3 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-header">
                                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16"height="16"></i>Preview Title's</h6>
                                    </div>
                                    <div class="card-body" style="max-height:450px;min-height:450px; overflow-y: auto;">
                                        <div class="form-check">
                                            <input type="radio" id="title1" name="title" value="1"class="form-check-input titles" checked>
                                            <label class="form-check-label" for="title1">Daily Production Report</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-header">
                                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16"height="16"></i> Buyers</h6>
                                    </div>
                                    <div class="card-body" style="max-height:400px;min-height:400px; overflow-y: auto;">
                                        <!-- Sample departments -->
                                        <div class="buyer-list">
                                            <!-- Parent 1 -->
                                            <?php $__currentLoopData = $buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="parent-wrapper">
                                                <label class="parent-label">
                                                    <span class="toggle-btn" data-target="children-<?php echo e($buyer->id); ?>">[+]</span>
                                                    <input type="checkbox" class="parent-checkbox buyerID" data-id="<?php echo e($buyer->id); ?>" name="buyer_id[]" value="<?php echo e($buyer->id); ?>"> <?php echo e($buyer->buyer_name); ?>

                                                </label>
                                                <?php
                                                $ordersList = collect($samples)->where('initialOrder.buyer_id',$buyer->id)->all();
                                                ?>
                                                <div class="collapse" id="children-<?php echo e($buyer->id); ?>">
                                                    <?php $__currentLoopData = $ordersList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $programme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <label><input type="checkbox" class="form-check-input child-of-<?php echo e($buyer->id); ?> ProgrammeID" name="programme_id[]" value="<?php echo e($programme->id); ?>"> <?php echo e($programme->programme_code); ?></label><br>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <div class="card-footer" style="padding:10px 15px;">
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="check_all">Check All</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" id="uncheck_all">Uncheck All</button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-6 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-header">
                                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16"height="16"></i> Sample Types</h6>
                                    </div>
                                    <div class="card-body" style="max-height:400px;min-height:400px; overflow-y: auto;">
                                        <!-- Sample departments -->
                                        <div class="sample-list">
                                            <!-- Parent 1 -->
                                            <?php $__currentLoopData = $sampleTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sample): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="parent-wrapper">
                                                <label class="parent-label">
                                                    <input type="checkbox" class="parent-checkbox-type sampleID" data-id="<?php echo e($sample->id); ?>" name="sample_id[]" value="<?php echo e($sample->id); ?>"> <?php echo e($sample->sample_type_name); ?>

                                                </label>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <div class="card-footer" style="padding:10px 15px;">
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="check_all2">Check All</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" id="uncheck_all2">Uncheck All</button>
                                    </div>
                                </div>

                            </div>
                          
                            <!-- Department & Designation -->
                             <div class="col-lg-3 mb-3 pe-lg-0">
                                <div class="card alert-info alert-top-border">
                                    <div class="card-body" style="max-height:460px;min-height:460px; overflow-y: auto;">
                                        <table class="table table-sm" width="100%">
                                            <tbody>
                                                <tr>
                                                    <th>Start Date</th>
                                                    <td width="60%">
                                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'start_date','type' => 'date','id' => 'start_date','class' => 'form-control-sm','value' => ''.e(old('start_date', $startDate)).'','placeholder' => 'Start Date','disabled' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'start_date','type' => 'date','id' => 'start_date','class' => 'form-control-sm','value' => ''.e(old('start_date', $startDate)).'','placeholder' => 'Start Date','disabled' => true]); ?>
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
                                                    <th width="40%">End Date</th>
                                                    <td width="60%">
                                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'end_date','type' => 'date','id' => 'end_date','class' => 'form-control-sm','value' => ''.e(old('end_date', $endDate)).'','placeholder' => 'End Date','disabled' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'end_date','type' => 'date','id' => 'end_date','class' => 'form-control-sm','value' => ''.e(old('end_date', $endDate)).'','placeholder' => 'End Date','disabled' => true]); ?>
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
                                                    <th width="40%">Organization</th>
                                                    <td width="60%">
                                                        <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'organization_id','id' => 'organization_id','class' => 'select2','options' => $organizations,'selected' => ''.e(old('organization_id', 1)).'','placeholder' => 'Organization']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'organization_id','id' => 'organization_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($organizations),'selected' => ''.e(old('organization_id', 1)).'','placeholder' => 'Organization']); ?>
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
                                                    <th width="40%">View Mode</th>
                                                    <td width="60%">
                                                        <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'view_mode','id' => 'view_mode','class' => 'select2','options' => ['1' => 'Normal View', '2' => 'PDF View'],'selected' => ''.e(old('view_mode', 1)).'','placeholder' => 'View Mode']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'view_mode','id' => 'view_mode','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['1' => 'Normal View', '2' => 'PDF View']),'selected' => ''.e(old('view_mode', 1)).'','placeholder' => 'View Mode']); ?>
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
                                    <div class="card-footer" style="padding:10px 15px;">
                                        <button type="submit" class="btn btn-sm btn-primary float-end">Preview</button>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </form>
            </div>
        </div>
   
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function () {
        $('.parent-checkbox.buyerID, .parent-checkbox-type.sampleID,.form-check-input.buyerID').prop('checked', true);
        $('.ProgrammeID').prop('checked', true);

        $('.titles').prop('checked', false);
        $('#title1').prop('checked', true);

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
            console.log(parent);
            const anyChecked = children.is(':checked');

            parent.prop('checked', anyChecked);
        });

        $('#check_all').on('click', function () {
            $('.parent-checkbox.buyerID, .form-check-input.ProgrammeID').prop('checked', true);
        });

        $('#uncheck_all').on('click', function () {
            $('.parent-checkbox.buyerID, .form-check-input.ProgrammeID').prop('checked', false);
        });

        $('#check_all2').on('click', function () {
            $('.sampleID').prop('checked', true);
        });

        $('#uncheck_all2').on('click', function () {
            $('.sampleID').prop('checked', false);
        });

        // Handle All Category and Line

        handleToggle('#all_category', '#category_id', '#all_category_section');
        handleToggle('#all_line', '#line', '#all_line_section');

        $('#all_category').on('change', function () {
            handleToggle('#all_category', '#category_id', '#all_category_section');
        });

        $('#all_line').on('change', function () {
            handleToggle('#all_line', '#line', '#all_line_section');
        });

        // Handle All District and Blood Group and Reason

        handleToggle('#all_district', '#district_id', '#all_district_section');
        handleToggle('#all_blood_group', '#blood_group', '#all_blood_group_section');
        handleToggle('#all_reason', '#reason_id', '#all_reason_section');

        $('#all_district').on('change', function () {
            handleToggle('#all_district', '#district_id', '#all_district_section');
        });

        $('#all_blood_group').on('change', function () {
            handleToggle('#all_blood_group', '#blood_group', '#all_blood_group_section');
        });

        $('#all_reason').on('change', function () {
            handleToggle('#all_reason', '#reason_id', '#all_reason_section');
        });

        function handleToggle(checkboxSelector, selectSelector, sectionSelector) {
            const isChecked = $(checkboxSelector).is(':checked');

            $(selectSelector)
                .prop('disabled', isChecked)
                .val(null).trigger('change');

            $(selectSelector).toggleClass('disabled-select', isChecked);
            $(sectionSelector).toggleClass('disabled-select', isChecked);
        }
    });

    $('#start_date').on('change', function () {
        let startDate = $(this).val();
        if (startDate) {
            $('#end_date').attr('min', startDate);
        } else {
            $('#end_date').removeAttr('min');
        }
    });

    $('#end_date').on('change', function () {
        let endDate = $(this).val();
        if (endDate) {
            $('#start_date').attr('max', endDate);
        } else {
            $('#start_date').removeAttr('max');
        }
    });


    handleTitleSelection();

    // On title radio change
    $('input[name="title"]').on('change', function() {
        handleTitleSelection();
    });

    function handleTitleSelection() {
        let selectedValue = $('input[name="title"]:checked').val();
        if (selectedValue == '1') {
            $('.departmentID').prop('disabled', false);
            $('.designationID').prop('disabled', true);
            $('.blood_group').prop('disabled', true);
            $('#start_date').prop('disabled', true);
            //$('#all_blood_group').prop('disabled', true);
            $('#end_date').prop('disabled', true);
        } else if (selectedValue == '2') {
            $('.departmentID').prop('disabled', true);
            $('.designationID').prop('disabled', false);
            $('.blood_group').prop('disabled', true);
            $('#start_date').prop('disabled', true);
            $('#end_date').prop('disabled', true);
        } else if (selectedValue == '3') {
            $('.departmentID').prop('disabled', false);
            $('.designationID').prop('disabled', true);
            $('.blood_group').prop('disabled', true);
            $('#start_date').prop('disabled', false);
            $('#end_date').prop('disabled', false);
        } else if (selectedValue == '4') {
            $('.departmentID').prop('disabled', false);
            $('.designationID').prop('disabled', true);
            $('.blood_group').prop('disabled', false);
            $('#start_date').prop('disabled', true);
            $('#end_date').prop('disabled', true);
            //$('#all_blood_group').prop('disabled', false);
        } else {
            $('.designationID').prop('disabled', false);
            $('.departmentID').prop('disabled', false);
        }
    }



</script>
<<<<<<< HEAD:storage/framework/views/81506a08c38d0c7f79b808f68c9f23c2.php

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\SM\resources\views\report\production\index.blade.php ENDPATH**/ ?>
=======
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\SM\resources\views\report\production\index.blade.php ENDPATH**/ ?>
>>>>>>> bce00216910fe6296a78d515b8a3179bbe36c5d5:storage/framework/views/ea443b36d242c140652d33869c9a2140.php
