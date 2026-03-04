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
        .employee-active {
            background-color: #4549A2;
            color: #FFFFFF;
        }
        .employee-active:hover {
            color: #000000;
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
                                                <?php $__currentLoopData = $grouped_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $org_id => $departments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $orgFirst = collect($pending_applicants)->where('org_id', $org_id)->first();
                                                        $orgName = $orgFirst && $orgFirst['organization'] ?? $orgFirst->organization ? ($orgFirst['organization']['short_name'] ?? ($orgFirst->organization->short_name ?? 'N/A')) : 'N/A';
                                                        $orgCount = collect($pending_applicants)->where('org_id', $org_id)->count();
                                                    ?>

                                                    <li class="nav-custom-item">
                                                        <input type="checkbox" id="org<?php echo e($org_id); ?>">
                                                        <label class="nav-custom-link" for="org<?php echo e($org_id); ?>">
                                                            <span class="nav-custom-caret"></span>
                                                            <?php echo e($orgName); ?> (<?php echo e($orgCount); ?>)
                                                        </label>

                                                        <ul class="nav-custom-content">
                                                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept_id => $dates): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $deptFirst = collect($pending_applicants)
                                                                        ->where('department_id', $dept_id)
                                                                        ->where('org_id', $org_id)
                                                                        ->first();

                                                                    $deptName = $deptFirst && ($deptFirst['department'] ?? $deptFirst->department)
                                                                        ? ($deptFirst['department']['department'] ?? $deptFirst->department->department)
                                                                        : 'Unknown Dept';

                                                                    $deptCount = collect($pending_applicants)
                                                                        ->where('org_id', $org_id)
                                                                        ->where('department_id', $dept_id)
                                                                        ->count();
                                                                ?>

                                                                <li class="nav-custom-item">
                                                                    <input type="checkbox" id="dept<?php echo e($dept_id); ?>-org<?php echo e($org_id); ?>">
                                                                    <label class="nav-custom-link" for="dept<?php echo e($dept_id); ?>-org<?php echo e($org_id); ?>">
                                                                        <span class="nav-custom-caret"></span>
                                                                        <?php echo e($deptName); ?> (<?php echo e($deptCount); ?>)
                                                                    </label>

                                                                    <ul class="nav-custom-content">
                                                                        <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry_date => $applicants): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <li class="nav-custom-item">
                                                                                <input type="checkbox" id="dept<?php echo e($dept_id); ?>-<?php echo e($entry_date); ?>-org<?php echo e($org_id); ?>">
                                                                                <label class="nav-custom-link" for="dept<?php echo e($dept_id); ?>-<?php echo e($entry_date); ?>-org<?php echo e($org_id); ?>">
                                                                                    <span class="nav-custom-caret"></span>
                                                                                    <?php echo e(\Carbon\Carbon::parse($entry_date)->format('d-M-Y')); ?>

                                                                                    (<?php echo e(count($applicants)); ?>)
                                                                                </label>

                                                                                <div class="nav-custom-content">
                                                                                    <?php $__currentLoopData = $applicants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                        <?php
                                                                                            $applicantId = is_array($applicant) ? ($applicant['id'] ?? null) : ($applicant->id ?? null);
                                                                                            $applicantName = is_array($applicant) ? ($applicant['name'] ?? '') : ($applicant->name ?? '');
                                                                                            $finalDesignationId = is_array($applicant) ? ($applicant['final_designation_id'] ?? null) : ($applicant->final_designation_id ?? null);

                                                                                            $uniqueApplicantId = isset($unique_applicant)
                                                                                                ? (is_array($unique_applicant) ? ($unique_applicant['id'] ?? null) : ($unique_applicant->id ?? null))
                                                                                                : null;

                                                                                            $activeStyle = ($uniqueApplicantId && $uniqueApplicantId == $applicantId)
                                                                                                ? 'color: #FF6C37; background-color: #EBF0F6;'
                                                                                                : '';
                                                                                        ?>

                                                                                        <a href="javascript:void(0);"
                                                                                        data-id="<?php echo e($applicantId); ?>"
                                                                                        data-ORG_id="<?php echo e($applicant->org_id); ?>"
                                                                                        data-final_designation_id="<?php echo e($finalDesignationId); ?>"
                                                                                        class="employee-link employee-show"
                                                                                        style="<?php echo e($activeStyle); ?>">
                                                                                            <?php echo e($applicantId); ?> :: <?php echo e(strtoupper($applicantName)); ?>

                                                                                        </a>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </div>
                                                                            </li>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </ul>
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
                                        <input type="hidden" id="applicant_id" name="applicant_id">
                                        <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['label' => 'Applicant Name','id' => 'applicant_name','name' => 'applicant_name','type' => 'text','placeholder' => 'Applicant Name','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Applicant Name','id' => 'applicant_name','name' => 'applicant_name','type' => 'text','placeholder' => 'Applicant Name','readonly' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['label' => 'Employee ID','id' => 'employee_id','name' => 'employee_id','type' => 'text','placeholder' => 'Employee ID','pattern' => '^[0-9]{6,8}$','title' => 'Employee ID must be exactly 6 to 8 digits','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Employee ID','id' => 'employee_id','name' => 'employee_id','type' => 'text','placeholder' => 'Employee ID','pattern' => '^[0-9]{6,8}$','title' => 'Employee ID must be exactly 6 to 8 digits','required' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'org_id','id' => 'org_id','label' => 'Organization','class' => 'select2','options' => $organizations,'selected' => selected_org($organizations),'required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'org_id','id' => 'org_id','label' => 'Organization','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($organizations),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(selected_org($organizations)),'required' => true,'readonly' => true]); ?>
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
                                        <?php $__currentLoopData = $grouped_selected_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $org_id => $departments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $orgIdOuter = $org_id;
                                                $orgFirst = collect($selected_applicants)->where('org_id', $org_id)->first();
                                                $orgName = $orgFirst && ($orgFirst['organization'] ?? $orgFirst->organization)
                                                    ? ($orgFirst['organization']['short_name'] ?? $orgFirst->organization->short_name ?? 'N/A')
                                                    : 'N/A';
                                                $orgCount = collect($departments)
                                                    ->map(fn($dates) => collect($dates)->map(fn($apps) => count($apps))->sum())
                                                    ->sum();
                                            ?>

                                            <li class="nav-custom-item">
                                                <input type="checkbox" id="org_<?php echo e($orgIdOuter); ?>">
                                                <label class="nav-custom-link" for="org_<?php echo e($orgIdOuter); ?>">
                                                    <span class="nav-custom-caret"></span>
                                                    <?php echo e($orgName); ?> (<?php echo e($orgCount); ?>)
                                                </label>

                                                <ul class="nav-custom-content">
                                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept_id => $dates): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $deptFirst = collect($selected_applicants)
                                                                ->where('department_id', $dept_id)
                                                                ->where('org_id', $orgIdOuter)
                                                                ->first();

                                                            $deptName = $deptFirst && ($deptFirst['department'] ?? $deptFirst->department)
                                                                ? ($deptFirst['department']['department'] ?? $deptFirst->department->department)
                                                                : 'Unknown Dept';

                                                            $deptCount = collect($dates)->map(fn($apps) => count($apps))->sum();
                                                        ?>

                                                        <li class="nav-custom-item">
                                                            <input type="checkbox" id="dept_<?php echo e($dept_id); ?>-org_<?php echo e($orgIdOuter); ?>">
                                                            <label class="nav-custom-link" for="dept_<?php echo e($dept_id); ?>-org_<?php echo e($orgIdOuter); ?>">
                                                                <span class="nav-custom-caret"></span>
                                                                <?php echo e($deptName); ?> (<?php echo e($deptCount); ?>)
                                                            </label>

                                                            <ul class="nav-custom-content">
                                                                <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry_date => $applicants): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php
                                                                        $dateCount = count($applicants);
                                                                    ?>

                                                                    <li class="nav-custom-item">
                                                                        <input type="checkbox" id="dept_<?php echo e($dept_id); ?>-<?php echo e($entry_date); ?>-org_<?php echo e($orgIdOuter); ?>">
                                                                        <label class="nav-custom-link" for="dept_<?php echo e($dept_id); ?>-<?php echo e($entry_date); ?>-org_<?php echo e($orgIdOuter); ?>">
                                                                            <span class="nav-custom-caret"></span>
                                                                            <?php echo e(\Carbon\Carbon::parse($entry_date)->format('d-M-Y')); ?> (<?php echo e($dateCount); ?>)
                                                                        </label>

                                                                        <div class="nav-custom-content">
                                                                            <?php $__currentLoopData = $applicants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php
                                                                                    $applicantId = is_array($applicant) ? ($applicant['id'] ?? null) : ($applicant->id ?? null);
                                                                                    $applicantName = is_array($applicant) ? ($applicant['name'] ?? '') : ($applicant->name ?? '');
                                                                                    $finalDesignationId = is_array($applicant) ? ($applicant['final_designation_id'] ?? null) : ($applicant->final_designation_id ?? null);
                                                                                ?>

                                                                                <a href="javascript:void(0);" data-id="<?php echo e($applicantId); ?>" data-org-id="<?php echo e($orgIdOuter); ?>" data-dept-id="<?php echo e($dept_id); ?>" data-final-designation-id="<?php echo e($finalDesignationId); ?>" class="employee-link employee-show">
                                                                                    <?php echo e($applicantId); ?> :: <?php echo e(strtoupper($applicantName)); ?>

                                                                                </a>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </div>
                                                                    </li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
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
            $('.employee-show').removeClass('employee-active');
            $(this).addClass('employee-active');

            let applicantId = $(this).data('id');
            let orgId = $(this).data('org_id');
            let applicantName = $(this).text().trim();
            let finalDesignationId = $(this).data('final_designation_id');

            $('#applicant_id').val(applicantId);
            $('#applicant_name').val(applicantName);
            $('#org_id').val(orgId).change();
            $('#final_designation_id').val(finalDesignationId).change();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\HRIS\resources\views\database\employeeidassign\index.blade.php ENDPATH**/ ?>