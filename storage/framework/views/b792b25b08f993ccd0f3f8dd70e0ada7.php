<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startPush('styles'); ?>
    <style>
        .select2-selection{
            height: 35px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            height: 32px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            height: 32px !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee ID Assign',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Employee ID Assign', 'url' => route('hris.database.employee-idassign.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">Applicant Employee ID Assign</h4>

                <!-- Search Input + Button in One Line -->
                <form class="d-flex order-0 order-md-1" style="max-width: 400px;" role="search">
                    <input class="form-control form-control-sm me-2" type="search" placeholder="Applicant Card No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit">
                        <i data-feather="search" width="14" height="14" class="me-1"></i> Search
                    </button>
                </form>
            </div>
        </div>
        <div class="col-lg-8 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card" >
                <div class="card-header" style="padding:14px 20px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Applicant For EmployeeID</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 pe-lg-1 ps-md-0">
                            <div class="card border border-primary">
                                <div class="card-header" style="padding:10px 16px;">
                                    <h6 class="my-0 text-primary">Pending Applicant List For EmployeeID</h6>
                                </div>
                                <div class="card-body" style="min-height: 450px;max-height: 450px; overflow-y: auto;">
                                    <div class="row">
                                        <div class="col-12">
                                            <ul class="nav-custom">
                                                <?php $__currentLoopData = $unique_department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $applicant_date_wises = collect($pending_applicants)
                                                            ->where('department_id', $department->department_id)
                                                            ->groupBy('entry_date')
                                                            ->all();
                                                    ?>
                                                    <li class="nav-custom-item">
                                                        <input type="checkbox" id="dept<?php echo e($department->department_id); ?>" <?php echo e($unique_applicant && $unique_applicant->department_id == $department->department_id ? 'checked' : ''); ?>>
                                                        <label class="nav-custom-link" for="dept<?php echo e($department->department_id); ?>"><span class="nav-custom-caret"></span> <?php echo e($department->department->department); ?> (<?php echo e(collect($pending_applicants)->where('department_id', $department->department_id)->count()); ?>)</label>
                                                        <ul class="nav-custom-content">
                                                            <?php $__currentLoopData = $applicant_date_wises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $applicants): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $applicants_date_wises = collect($pending_applicants)
                                                                        ->where('department_id', $department->department_id)
                                                                        ->where('entry_date', $key)
                                                                        ->all();
                                                                ?>
                                                                <li class="nav-custom-item">
                                                                    <input type="checkbox" id="dept<?php echo e($department->department_id); ?>-<?php echo e($key); ?>" <?php echo e($unique_applicant && $unique_applicant->entry_date == $key && $unique_applicant->department_id == $department->department_id ? 'checked' : ''); ?>>
                                                                    <label class="nav-custom-link" style="<?php echo e($unique_applicant && $unique_applicant->entry_date == $key && $unique_applicant->department_id == $department->department_id ? 'background-color: #EBF0F6;' : ''); ?>" for="dept<?php echo e($department->department_id); ?>-<?php echo e($key); ?>"><span class="nav-custom-caret"></span> <?php echo e(Carbon\Carbon::parse($key)->format('d-M-Y')); ?> (<?php echo e(collect($pending_applicants)->where('department_id', $department->department_id)->where('entry_date', $key)->count()); ?>)</label>
                                                                    <div class="nav-custom-content">
                                                                        <?php $__currentLoopData = $applicants_date_wises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <a href="javascript:void(0);" data-id="<?php echo e($applicant->id); ?>" data-final_designation_id="<?php echo e($applicant->final_designation_id); ?>" style="<?php echo e($unique_applicant && $unique_applicant->id == $applicant->id ? 'color: #FF6C37; background-color: #EBF0F6;' : ''); ?>" class="employee-link employee-show"><?php echo e($applicant->id); ?> :: <?php echo e(strtoupper($applicant->name)); ?></a>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </div>
                                                                </li>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 ps-lg-1 ps-md-1">
                            <form action="<?php echo e(route('hris.database.employee-idassign.store')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                            <div class="card border border-info">
                                <div class="card-header" style="padding:10px 16px;">
                                    <h6 class="my-0 text-primary">Input Parameters For EmployeeID</h6>
                                </div>
                                <div class="card-body" style="min-height: 400px;max-height: 400px; overflow-y: auto;">
                                    <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['label' => 'Applicant ID','id' => 'applicant_id','name' => 'applicant_id','type' => 'text','placeholder' => 'Applicant ID','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Applicant ID','id' => 'applicant_id','name' => 'applicant_id','type' => 'text','placeholder' => 'Applicant ID','readonly' => true]); ?>
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
                                    <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['label' => 'Employee ID','id' => 'employee_id','name' => 'employee_id','type' => 'text','placeholder' => 'Employee ID','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Employee ID','id' => 'employee_id','name' => 'employee_id','type' => 'text','placeholder' => 'Employee ID','required' => true]); ?>
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
                                    <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'final_designation_id','id' => 'final_designation_id','label' => 'Final Designation','class' => 'select2','options' => $designations,'selected' => old('final_designation_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'final_designation_id','id' => 'final_designation_id','label' => 'Final Designation','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($designations),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('final_designation_id')),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal243648788f657c94d456cacfc3f7cdc3)): ?>
<?php $attributes = $__attributesOriginal243648788f657c94d456cacfc3f7cdc3; ?>
<?php unset($__attributesOriginal243648788f657c94d456cacfc3f7cdc3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal243648788f657c94d456cacfc3f7cdc3)): ?>
<?php $component = $__componentOriginal243648788f657c94d456cacfc3f7cdc3; ?>
<?php unset($__componentOriginal243648788f657c94d456cacfc3f7cdc3); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'recruitment_type','id' => 'recruitment_type','label' => 'Recruitment Type','options' => ['N' => 'New', 'R' => 'Replacement'],'selected' => old('final_designation_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'recruitment_type','id' => 'recruitment_type','label' => 'Recruitment Type','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['N' => 'New', 'R' => 'Replacement']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('final_designation_id')),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal243648788f657c94d456cacfc3f7cdc3)): ?>
<?php $attributes = $__attributesOriginal243648788f657c94d456cacfc3f7cdc3; ?>
<?php unset($__attributesOriginal243648788f657c94d456cacfc3f7cdc3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal243648788f657c94d456cacfc3f7cdc3)): ?>
<?php $component = $__componentOriginal243648788f657c94d456cacfc3f7cdc3; ?>
<?php unset($__componentOriginal243648788f657c94d456cacfc3f7cdc3); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'replace_id','id' => 'replace_id','groupId' => 'replace_id_group','label' => 'Replacement ID','type' => 'text','placeholder' => 'Replacement ID']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'replace_id','id' => 'replace_id','group_id' => 'replace_id_group','label' => 'Replacement ID','type' => 'text','placeholder' => 'Replacement ID']); ?>
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
                                <div class="card-footer" style="padding:10px 16px;">
                                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'float-start btn-sm submitBtn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'float-start btn-sm submitBtn']); ?>Assign <?php echo $__env->renderComponent(); ?>
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
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header" style="padding:14px 20px;">
                    <h6 class="my-0 text-primary"><i data-feather="list" width="18" height="18"></i> Applicant For File Entry</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 pe-lg-1 ps-md-0">
                            <div class="card border border-primary">
                                <div class="card-header" style="padding:10px 16px;">
                                    <h6 class="my-0 text-primary">Applicant List For File Entry</h6>
                                </div>
                                <div class="card-body" style="min-height: 450px;max-height: 400px; overflow-y: auto;">
                                    <ul class="nav-custom">
                                        <?php $__currentLoopData = $unique_selected_department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selected_department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $applicant_date_wises = collect($selected_applicants)
                                                    ->where('department_id', $selected_department->department_id)
                                                    ->groupBy('entry_date')
                                                    ->all();
                                            ?>
                                            <li class="nav-custom-item">
                                                <input type="checkbox" id="deptf<?php echo e($selected_department->department_id); ?>" <?php echo e($unique_applicant && $unique_applicant->department_id == $selected_department->department_id ? 'checked' : ''); ?>>
                                                <label class="nav-custom-link" for="deptf<?php echo e($selected_department->department_id); ?>"><span class="nav-custom-caret"></span> <?php echo e($selected_department->department->department); ?> (<?php echo e(collect($selected_applicants)->where('department_id', $selected_department->department_id)->count()); ?>)</label>
                                                <ul class="nav-custom-content">
                                                    <?php $__currentLoopData = $applicant_date_wises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $applicants): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $applicants_date_wises = collect($selected_applicants)
                                                                ->where('department_id', $selected_department->department_id)
                                                                ->where('entry_date', $key)
                                                                ->all();
                                                        ?>
                                                        <li class="nav-custom-item">
                                                            <input type="checkbox" id="deptf<?php echo e($selected_department->department_id); ?>-<?php echo e($key); ?>" <?php echo e($unique_applicant && $unique_applicant->entry_date == $key && $unique_applicant->department_id == $selected_department->department_id ? 'checked' : ''); ?>>
                                                            <label class="nav-custom-link" style="<?php echo e($unique_applicant && $unique_applicant->entry_date == $key && $unique_applicant->department_id == $selected_department->department_id ? 'background-color: #EBF0F6;' : ''); ?>" for="deptf<?php echo e($selected_department->department_id); ?>-<?php echo e($key); ?>"><span class="nav-custom-caret"></span> <?php echo e(Carbon\Carbon::parse($key)->format('d-M-Y')); ?> (<?php echo e(collect($pending_applicants)->where('department_id', $selected_department->department_id)->where('entry_date', $key)->count()); ?>)</label>
                                                            <div class="nav-custom-content">
                                                                <?php $__currentLoopData = $applicants_date_wises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <a href="javascript:void(0);" data-id="<?php echo e($applicant->id); ?>" data-final_designation_id="<?php echo e($applicant->final_designation_id); ?>" style="<?php echo e($unique_applicant && $unique_applicant->id == $applicant->id ? 'color: #FF6C37; background-color: #EBF0F6;' : ''); ?>" class="employee-link"><?php echo e($applicant->id); ?> :: <?php echo e($applicant->employee_id); ?> :: <?php echo e(strtoupper($applicant->name)); ?></a>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#replace_id_group').hide();
            $('#recruitment_type').on('change', function() {
                let recruitment_type = $(this).val();
                if (recruitment_type == 'R') {
                    $('#replace_id_group').show();
                    $('#replace_id').prop('required', true);
                } else {
                    $('#replace_id_group').hide();
                    $('#replace_id').prop('required', false);
                }
            });

            $(document).ready(function() {
                $('#recruitment_type').trigger('change');
            });
        });

        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
                width: '100%',
                allowClear: true
            });
        });

        $(document).on('click', '.employee-show', function(e) {
            e.preventDefault();
            let applicantId = $(this).data('id');
            let finalDesignationId = $(this).data('final_designation_id');
            let recruitmentType = $(this).data('recruitment_type');
            $('#applicant_id').val(applicantId);
            $('#final_designation_id').val(finalDesignationId).change();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\new erp\garments_erp\Modules\HRIS\resources\views\database\employeeidassign\index.blade.php ENDPATH**/ ?>