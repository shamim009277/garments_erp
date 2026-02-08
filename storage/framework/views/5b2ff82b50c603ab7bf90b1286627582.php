<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startPush('styles'); ?>
<style>
    .no-calendar {
        pointer-events: none;
        background-color: #848485;

    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'New Applicant',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'New Applicant', 'url' => route('hris.database.new-applicants.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    <?php echo e($unique_applicant ? "New Applicant || Applicant ID : $unique_applicant->id" : 'New Applicant'); ?>

                </h4>

                <!-- Search Input + Button in One Line -->
                <form action="<?php echo e(route('hris.database.new-applicants.search')); ?>" method="POST"
                    class="d-flex order-0 order-md-1 mb-2 mb-md-0 me-md-2" style="max-width: 400px;" role="search">
                    <?php echo csrf_field(); ?>
                    <input class="form-control form-control-sm me-2" type="search" name="search"
                        placeholder="Applicant Card No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"><i data-feather="search"
                            width="14" height="14" class="me-1"></i> Search</button>
                </form>
                <?php if($unique_applicant): ?>
                    <!-- Back Button -->
                    <a href="<?php echo e(route('hris.database.new-applicants.index')); ?>"
                        class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2"><i
                            data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-4 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Pending
                        Applicant List</h6>
                </div>
                <div class="card-body" style="min-height: 457px;max-height: 457px; overflow-y: auto;">
                    <?php
                        $companyWise = collect($pending_applicants)->groupBy('org_id');
                    ?>
                    <ul class="nav-custom">
                        <?php $__currentLoopData = $companyWise; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $companyId => $companyApplicants): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $companyName = $companyApplicants->first()->Organization->short_name ?? 'N/A';
                                $departmentWise = $companyApplicants->groupBy('department_id');
                                $isCompanyActive = $unique_applicant && $unique_applicant->org_id == $companyId;
                            ?>


                            <li class="nav-custom-item">
                                <input type="checkbox" id="company<?php echo e($companyId); ?>" <?php echo e($isCompanyActive ? 'checked' : ''); ?>>
                                <label class="nav-custom-link" for="company<?php echo e($companyId); ?>" style="<?php echo e($isCompanyActive ? 'background:#f2b14b; border-radius: 3px;' : ''); ?>">
                                    <span class="nav-custom-caret"></span>
                                    <?php echo e($companyName); ?> (<?php echo e($companyApplicants->count()); ?>)
                                </label>

                                <ul class="nav-custom-content">
                                    <?php $__currentLoopData = $departmentWise; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $departmentId => $departmentApplicants): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $departmentName = $departmentApplicants->first()->department->department ?? 'N/A';
                                            $dateWise = $departmentApplicants->groupBy('entry_date');
                                            $isDepartmentActive = $unique_applicant && $unique_applicant->org_id == $companyId && $unique_applicant->department_id == $departmentId;
                                        ?>

                                        <li class="nav-custom-item">
                                            <input type="checkbox" id="dept<?php echo e($companyId); ?>-<?php echo e($departmentId); ?>" <?php echo e($isDepartmentActive ? 'checked' : ''); ?>>
                                            <label class="nav-custom-link" for="dept<?php echo e($companyId); ?>-<?php echo e($departmentId); ?>" style="<?php echo e($isDepartmentActive ? 'background:#D75350; border-radius: 3px;' : ''); ?>">
                                                <span class="nav-custom-caret"></span>
                                                <?php echo e($departmentName); ?> (<?php echo e($departmentApplicants->count()); ?>)
                                            </label>

                                            <ul class="nav-custom-content">
                                                <?php $__currentLoopData = $dateWise; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entryDate => $dateApplicants): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $isDateActive = $unique_applicant && $unique_applicant->org_id == $companyId && $unique_applicant->department_id == $departmentId && $unique_applicant->entry_date == $entryDate;
                                                    ?>

                                                    <li class="nav-custom-item">
                                                        <input type="checkbox" id="date<?php echo e($companyId); ?>-<?php echo e($departmentId); ?>-<?php echo e($entryDate); ?>" <?php echo e($isDateActive ? 'checked' : ''); ?>>
                                                        <label class="nav-custom-link" for="date<?php echo e($companyId); ?>-<?php echo e($departmentId); ?>-<?php echo e($entryDate); ?>" style="<?php echo e($isDateActive ? 'background:#75bcf5; border-radius: 3px;' : ''); ?>">
                                                            <span class="nav-custom-caret"></span>
                                                            <?php echo e(\Carbon\Carbon::parse($entryDate)->format('d-M-Y')); ?> (<?php echo e($dateApplicants->count()); ?>)
                                                        </label>

                                                        <div class="nav-custom-content">
                                                            <?php $__currentLoopData = $dateApplicants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $applicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <a href="<?php echo e(route('hris.database.new-applicants.show', $applicant->id)); ?>"
                                                                    class="employee-link" style="<?php echo e($unique_applicant && $unique_applicant->id == $applicant->id ? 'color: #ffffff; background:#4549A2; border-radius: 3px;' : ''); ?>">
                                                                    <?php echo e($applicant->id); ?> :: <?php echo e(strtoupper($applicant->name)); ?>

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

        <div class="col-lg-8">
            <form action="<?php echo e($unique_applicant ? route('hris.database.new-applicants.update', $unique_applicant->id) : route('hris.database.new-applicants.store')); ?>" id="applicantForm" method="POST">
                <?php echo csrf_field(); ?>
                <?php if($unique_applicant): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>
                <div class="card alert-info alert-top-border">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap px-10 py-12" style="padding: 16px 20px">
                        <h6 class="my-0 text-primary d-flex align-items-center gap-1"><i data-feather="list" width="18" height="18"></i>
                            <?php echo e($unique_applicant ? 'Edit Applicant Information' : 'Input Parameters For New Applicant ...'); ?>

                        </h6>

                        <div class="d-flex gap-2 mt-2 mt-md-0">
                            <?php if($unique_applicant): ?>
                                <a href="javascript:void(0);" data-id="<?php echo e($unique_applicant->id); ?>"
                                    class="btn btn-danger btn-sm d-flex align-items-center delete-applicant"
                                    data-id="<?php echo e($unique_applicant->id); ?>"><i data-feather="trash-2" width="16"
                                        height="16" class="me-1"></i> Delete</a>
                                <button class="btn btn-warning btn-sm d-flex align-items-center text-white"><i
                                        data-feather="star" width="16" height="16" class="me-1"></i>
                                    Sticker</button>
                            <?php else: ?>
                                <a href="javascript:void(0);" id="resetForm" class="btn btn-secondary btn-sm d-flex align-items-center"><i data-feather="rotate-ccw" width="16" height="16" class="me-1"></i> Reset</a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body" style="min-height: 400px;max-height: 400px; overflow-y: auto;">
                        <div class="row">
                            <?php if($unique_applicant): ?>
                                <div class="col-lg-4 col-md-6 pr-0">
                                    <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'entry_date ','label' => 'Entry Date','type' => 'date','placeholder' => 'Enter entry date','value' => old(
                                            'entry_date',
                                            $unique_applicant ? $unique_applicant->entry_date : null,
                                        ),'required' => true,'readonly' => true,'class' => 'no-calendar']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'entry_date ','label' => 'Entry Date','type' => 'date','placeholder' => 'Enter entry date','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                            'entry_date',
                                            $unique_applicant ? $unique_applicant->entry_date : null,
                                        )),'required' => true,'readonly' => true,'class' => 'no-calendar']); ?>
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
                            <?php endif; ?>
                            <?php
                                $selectedOrg = old('org_id', $unique_applicant->org_id ?? ($organizations->count() === 1 ? $organizations->keys()->first() : 1));
                            ?>
                            <div class="col-lg-4 col-md-6 pr-0">
                                <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'org_id','id' => 'org_id','label' => 'Organization','options' => $organizations,'selected' => $selectedOrg,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'org_id','id' => 'org_id','label' => 'Organization','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($organizations),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($selectedOrg),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $attributes = $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $component = $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
                            </div>
                            <div class="col-lg-4 col-md-6 pr-0">
                                <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'name','label' => 'Name','type' => 'text','placeholder' => 'Enter name','value' => old('name', $unique_applicant ? $unique_applicant->name : null),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'name','label' => 'Name','type' => 'text','placeholder' => 'Enter name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('name', $unique_applicant ? $unique_applicant->name : null)),'required' => true]); ?>
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
                            <div class="col-lg-4 col-md-6 pr-0">
                                <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'birth_date','label' => 'Birth Date','type' => 'text','id' => 'birth_date','placeholder' => 'Enter birth date','value' => old(
                                        'birth_date',
                                        $unique_applicant
                                            ? \Carbon\Carbon::parse($unique_applicant->birth_date)->format('d-m-Y')
                                            : null,
                                    ),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'birth_date','label' => 'Birth Date','type' => 'text','id' => 'birth_date','placeholder' => 'Enter birth date','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                        'birth_date',
                                        $unique_applicant
                                            ? \Carbon\Carbon::parse($unique_applicant->birth_date)->format('d-m-Y')
                                            : null,
                                    )),'required' => true]); ?>
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
                            <div class="col-lg-4 col-md-6 pr-0">
                                <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'name_bangla','label' => 'Name Bangla','type' => 'text','placeholder' => 'Enter name bangla','value' => old(
                                        'name_bangla',
                                        $unique_applicant ? $unique_applicant->name_bangla : null,
                                    )]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'name_bangla','label' => 'Name Bangla','type' => 'text','placeholder' => 'Enter name bangla','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                        'name_bangla',
                                        $unique_applicant ? $unique_applicant->name_bangla : null,
                                    ))]); ?>
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

                            <div class="col-lg-4 col-md-6 pr-0">
                                <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'mobile','label' => 'Mobile','type' => 'text','pattern' => '(01)[0-9]{9}','maxlength' => '11','placeholder' => 'Enter mobile','value' => old('mobile', $unique_applicant ? $unique_applicant->mobile : null),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'mobile','label' => 'Mobile','type' => 'text','pattern' => '(01)[0-9]{9}','maxlength' => '11','placeholder' => 'Enter mobile','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('mobile', $unique_applicant ? $unique_applicant->mobile : null)),'required' => true]); ?>
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

                            <div class="col-lg-4 col-md-6 pr-0">
                                <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'department_id','id' => 'department_id','label' => 'Department (Apply For)','options' => $departments,'selected' => old(
                                        'department_id',
                                        $unique_applicant ? $unique_applicant->department_id : null,
                                    ),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'department_id','id' => 'department_id','label' => 'Department (Apply For)','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($departments),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                        'department_id',
                                        $unique_applicant ? $unique_applicant->department_id : null,
                                    )),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $attributes = $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $component = $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
                            </div>

                            <div class="col-lg-4 col-md-6 pr-0">
                                <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'designation_id','id' => 'designation_id','label' => 'Designation (Apply For)','options' => $designations,'selected' => old(
                                        'designation_id',
                                        $unique_applicant ? $unique_applicant->designation_id : null,
                                    ),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'designation_id','id' => 'designation_id','label' => 'Designation (Apply For)','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($designations),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                        'designation_id',
                                        $unique_applicant ? $unique_applicant->designation_id : null,
                                    )),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $attributes = $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $component = $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
                            </div>

                            <div class="col-lg-4 col-md-6 pr-0">
                                <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'line','id' => 'line','label' => 'Line (Apply For)','options' => $lines,'selected' => old(
                                        'line',
                                        $unique_applicant ? $unique_applicant->line : 0,
                                    ),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'line','id' => 'line','label' => 'Line (Apply For)','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($lines),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                        'line',
                                        $unique_applicant ? $unique_applicant->line : 0,
                                    )),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $attributes = $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $component = $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
                            </div>

                            <div class="col-lg-4 col-md-6 pr-0">
                                <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'district_id','label' => 'District','options' => $districts,'selected' => old(
                                        'district_id',
                                        $unique_applicant ? $unique_applicant->district_id : null,
                                    ),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'district_id','label' => 'District','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($districts),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                        'district_id',
                                        $unique_applicant ? $unique_applicant->district_id : null,
                                    )),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $attributes = $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $component = $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
                            </div>
                            <div class="col-lg-4 col-md-6 pr-0">
                                <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'identification_type','id' => 'identification_type','label' => 'Identification Type','options' => ['1' => 'National ID', '2' => 'Birth Certificate'],'selected' => old(
                                        'identification_type',
                                        $unique_applicant ? $unique_applicant->identification_type : 1,
                                    ),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'identification_type','id' => 'identification_type','label' => 'Identification Type','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['1' => 'National ID', '2' => 'Birth Certificate']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                        'identification_type',
                                        $unique_applicant ? $unique_applicant->identification_type : 1,
                                    )),'required' => true]); ?>
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
                            </div>

                            <div class="col-lg-4 col-md-6 pr-0" id="nid_section">
                                <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'national_id','label' => 'National ID','id' => 'national_id','type' => 'number','pattern' => '[0-9]{10,17}','minlength' => '10','maxlength' => '17','placeholder' => 'Enter national id','value' => old(
                                        'national_id',
                                        $unique_applicant ? $unique_applicant->national_id : null,
                                    ),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'national_id','label' => 'National ID','id' => 'national_id','type' => 'number','pattern' => '[0-9]{10,17}','minlength' => '10','maxlength' => '17','placeholder' => 'Enter national id','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                        'national_id',
                                        $unique_applicant ? $unique_applicant->national_id : null,
                                    )),'required' => true]); ?>
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

                            <div class="col-lg-4 col-md-6 pr-0" id="birth_certificate_section">
                                <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'birth_certificate_no','label' => 'Birth Certificate No','id' => 'birth_certificate_no','type' => 'number','pattern' => '[0-9]{10,30}','minlength' => '13','maxlength' => '30','placeholder' => 'Enter birth certificate no','value' => old(
                                        'birth_certificate_no',
                                        $unique_applicant ? $unique_applicant->birth_certificate_no : null,
                                    )]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'birth_certificate_no','label' => 'Birth Certificate No','id' => 'birth_certificate_no','type' => 'number','pattern' => '[0-9]{10,30}','minlength' => '13','maxlength' => '30','placeholder' => 'Enter birth certificate no','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                        'birth_certificate_no',
                                        $unique_applicant ? $unique_applicant->birth_certificate_no : null,
                                    ))]); ?>
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

                            <?php if($unique_applicant): ?>
                                <div class="col-lg-4 col-md-6 pr-0">
                                    <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'interviewer_employee_id','label' => 'Interviewer Employee ID','id' => 'interviewer_employee_id','type' => 'number','pattern' => '[0-9]{10,30}','minlength' => '6','maxlength' => '20','placeholder' => 'Enter interviewer employee id','value' => old(
                                            'interviewer_employee_id',
                                            $unique_applicant ? $unique_applicant->interviewer_employee_id : null,
                                        )]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'interviewer_employee_id','label' => 'Interviewer Employee ID','id' => 'interviewer_employee_id','type' => 'number','pattern' => '[0-9]{10,30}','minlength' => '6','maxlength' => '20','placeholder' => 'Enter interviewer employee id','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                            'interviewer_employee_id',
                                            $unique_applicant ? $unique_applicant->interviewer_employee_id : null,
                                        ))]); ?>
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

                                <div class="col-lg-4 col-md-6 pr-0">
                                    <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'interview_status','id' => 'interview_status','label' => 'Interview Status','options' => [
                                            'Pending' => 'Pending',
                                            'Selected' => 'Selected',
                                            'Disqualify' => 'Disqualify',
                                            'Not Recruit' => 'Not Recruit',
                                        ],'selected' => old(
                                            'interview_status',
                                            $unique_applicant ? $unique_applicant->interview_status : 'Pending',
                                        )]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'interview_status','id' => 'interview_status','label' => 'Interview Status','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                                            'Pending' => 'Pending',
                                            'Selected' => 'Selected',
                                            'Disqualify' => 'Disqualify',
                                            'Not Recruit' => 'Not Recruit',
                                        ]),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                            'interview_status',
                                            $unique_applicant ? $unique_applicant->interview_status : 'Pending',
                                        ))]); ?>
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
                                </div>

                                <div class="col-lg-4 col-md-6 pr-0" id="final_designation_section">
                                    <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'final_designation_id','id' => 'final_designation_id','label' => 'Final Designation','options' => $designations,'selected' => old(
                                            'final_designation_id',
                                            $unique_applicant ? $unique_applicant->final_designation_id : null,
                                        )]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'final_designation_id','id' => 'final_designation_id','label' => 'Final Designation','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($designations),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                            'final_designation_id',
                                            $unique_applicant ? $unique_applicant->final_designation_id : null,
                                        ))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $attributes = $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $component = $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
                                </div>

                                <div class="col-lg-4 col-md-6 pr-0" id="joining_date_section">
                                    <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'joining_date','label' => 'Joining Date','id' => 'joining_date','class' => 'holiday-date','type' => 'text','placeholder' => 'Enter joining date','value' => old(
                                            'joining_date',
                                            $unique_applicant
                                                ? \Carbon\Carbon::parse($unique_applicant->joining_date)->format(
                                                    'd-m-Y',
                                                )
                                                : null,
                                        )]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'joining_date','label' => 'Joining Date','id' => 'joining_date','class' => 'holiday-date','type' => 'text','placeholder' => 'Enter joining date','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                            'joining_date',
                                            $unique_applicant
                                                ? \Carbon\Carbon::parse($unique_applicant->joining_date)->format(
                                                    'd-m-Y',
                                                )
                                                : null,
                                        ))]); ?>
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

                                <div class="col-lg-4 col-md-6 pr-0" id="proposed_salary_section">
                                    <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'proposed_salary','label' => 'Proposed Salary','id' => 'proposed_salary','type' => 'number','pattern' => '[0-9]{10,30}','placeholder' => 'Enter proposed salary','value' => old(
                                            'proposed_salary',
                                            $unique_applicant ? $unique_applicant->proposed_salary : null,
                                        )]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'proposed_salary','label' => 'Proposed Salary','id' => 'proposed_salary','type' => 'number','pattern' => '[0-9]{10,30}','placeholder' => 'Enter proposed salary','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                            'proposed_salary',
                                            $unique_applicant ? $unique_applicant->proposed_salary : null,
                                        ))]); ?>
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

                                <div class="col-lg-4 col-md-6 pr-0" id="determined_salary_section">
                                    <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'determined_salary','label' => 'Determined Salary','id' => 'determined_salary','type' => 'number','pattern' => '[0-9]{10,30}','placeholder' => 'Enter determined salary','value' => old(
                                            'determined_salary',
                                            $unique_applicant ? $unique_applicant->determined_salary : null,
                                        )]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'determined_salary','label' => 'Determined Salary','id' => 'determined_salary','type' => 'number','pattern' => '[0-9]{10,30}','placeholder' => 'Enter determined salary','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                            'determined_salary',
                                            $unique_applicant ? $unique_applicant->determined_salary : null,
                                        ))]); ?>
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

                                <div class="col-lg-4 col-md-6 pr-0" id="remarks_section">
                                    <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'remarks','label' => 'Remarks','id' => 'remarks','type' => 'text','placeholder' => 'Enter remarks','value' => old('remarks', $unique_applicant ? $unique_applicant->remarks : null)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'remarks','label' => 'Remarks','id' => 'remarks','type' => 'text','placeholder' => 'Enter remarks','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('remarks', $unique_applicant ? $unique_applicant->remarks : null))]); ?>
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
                            <?php endif; ?>

                            <div class="col-lg-4 col-md-6 pr-0">
                                <div class="form-check" style="margin-top: 38px;">
                                    <input class="form-check-input" type="checkbox" style="display: inline-block;" name="ipe_assessment_required" id="ipe_assessment_required" :checked="<?php echo e(old('ipe_assessment_required', $unique_applicant ? $unique_applicant->ipe_assessment_required : null) ? 'checked' : ''); ?>">
                                    <label class="form-check-label" for="ipe_assessment_required">IPE Assessment Required</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding:14px 20px;">
                        <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'float-start btn-sm submitBtn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'float-start btn-sm submitBtn']); ?><?php echo e($unique_applicant ? 'Update' : 'Submit'); ?> <?php echo $__env->renderComponent(); ?>
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
        $(document).ready(function() {
            let holidays = <?php echo json_encode($holidays, 15, 512) ?>;
            flatpickr("#joining_date", {
                dateFormat: "d-m-Y",
                allowInput: false,
                minDate: "<?php echo e($today); ?>",
                disable: holidays,
            });

            flatpickr("#birth_date", {
                dateFormat: "d-m-Y",
                maxDate: "<?php echo e($maxDate); ?>",
                allowInput: false,
            });

            $('#birth_certificate_section').hide();
            $('#identification_type').on('change', function() {
                let identification_type = $(this).val();
                if (identification_type == 1) {
                    $('#nid_section').show();
                    $('#birth_certificate_section').hide();
                    $('#national_id').prop('required', true);
                    $('#birth_certificate_no').prop('required', false);
                } else {
                    $('#nid_section').hide();
                    $('#birth_certificate_section').show();
                    $('#national_id').prop('required', false);
                    $('#birth_certificate_no').prop('required', true);
                }
            });

            $('#interview_status').on('change', function() {
                let interview_status = $(this).val();
                if (interview_status === 'Selected') {
                    $('#final_designation_id').show();
                    $('#joining_date_section').show();
                    $('#proposed_salary_section').show();
                    $('#determined_salary_section').show();
                    $('#remarks_section').show();

                    $('#joining_date').prop('required', true);
                    $('#proposed_salary').prop('required', true);
                    $('#determined_salary').prop('required', true);
                    $('#remarks').prop('required', true);
                } else {
                    $('#final_designation_id').hide();
                    $('#joining_date_section').hide();
                    $('#proposed_salary_section').hide();
                    $('#determined_salary_section').hide();
                    $('#remarks_section').hide();

                    $('#joining_date').prop('required', false);
                    $('#proposed_salary').prop('required', false);
                    $('#determined_salary').prop('required', false);
                    $('#remarks').prop('required', false);
                }
            });

            $(document).ready(function() {
                $('#interview_status').trigger('change');
            });

            $(document).ready(function() {
                $('#identification_type').trigger('change');
            });
        });

        $(document).ready(function() {
            let today = new Date().toISOString().split('T')[0];
            $('#joining_date').attr('min', today);
        });

        $('#resetForm').on('click', function() {
            window.location.reload();
        });

        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true
            });
        });

        $(document).on('click', '.delete-applicant', function(e) {
            e.preventDefault();
            let applicantId = $(this).data('id');
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
                        url: '<?php echo e(route('hris.database.new-applicants.delete')); ?>',
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            id: applicantId
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Deleted!', 'Applicant has been deleted.', 'success');
                                location.href =
                                    '<?php echo e(route('hris.database.new-applicants.index')); ?>';
                            } else {
                                Swal.fire('Error!', response.message);
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                } else {
                    Swal.fire('Cancelled!', 'Applicant has not been deleted.', 'error');
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\server2\htdocs\garments_erp\garments_erp\Modules/HRIS\resources/views/database/newapplicant/index.blade.php ENDPATH**/ ?>