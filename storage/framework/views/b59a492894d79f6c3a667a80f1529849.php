<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startPush('styles'); ?>
    <style>
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
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Forwarded Approve',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Settings', 'url' => route('hris.index')],
                    ['label' => 'Forwarded Approve'],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-lg-8 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header py-2 px-3" style="padding: 12px 10px !important">
                    <div class="row w-100 align-items-center" style="margin:0 !important">
                        <!-- Title -->
                        <div class="col-12 col-md-4 mb-2 mb-md-0">
                            <h6 class="my-0 text-primary"><i data-feather="user-plus" width="16" height="16"></i>Input Parameters For Forward & Approve</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="user_form" action="<?php echo e(route('hris.settings.forward-approve.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                        <div class="col-lg-5">
                            <table class="table table-sm" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="width: 100%">
                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'org_id','id' => 'org_id','class' => 'select2','options' => $organizations,'selected' => old('org_id', '1'),'placeholder' => 'Select','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'org_id','id' => 'org_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($organizations),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('org_id', '1')),'placeholder' => 'Select','required' => true]); ?>
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
                                        <td colspan="2" style="width: 100%">
                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'type','id' => 'type','class' => 'select2','options' => ['1' => 'Leave', '2' => 'Movement Pass'],'selected' => old('type', '2'),'placeholder' => 'Select','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'type','id' => 'type','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['1' => 'Leave', '2' => 'Movement Pass']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('type', '2')),'placeholder' => 'Select','required' => true]); ?>
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
                                            <input type="checkbox" name="all_department" id="all_department">
                                            <label class="m-0" for="all_department">All Department</label>
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
                                    <tr>
                                        <td width="40%">
                                            <input type="checkbox" name="all_category" id="all_category" checked>
                                            <label class="m-0" for="all_category">All Category</label>
                                        </td>
                                        <td width="60%" id="all_category_section">
                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'employee_category_id','id' => 'employee_category_id','class' => 'select2','options' => $employeeCategories,'placeholder' => 'Category ID']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'employee_category_id','id' => 'employee_category_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($employeeCategories),'placeholder' => 'Category ID']); ?>
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
                                            <label class="m-0" for="user_id">Users</label>
                                        </td>
                                        <td width="60%" id="user_section">
                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'user_id','id' => 'user_id','class' => 'select2','options' => $activeUsers,'placeholder' => 'User ID','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'user_id','id' => 'user_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activeUsers),'placeholder' => 'User ID','required' => true]); ?>
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
                                            <label class="m-0" for="category_id">Forward/Approve</label>
                                        </td>
                                        <td width="60%" id="category_section">
                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'category_id','id' => 'category_id','class' => 'select2','options' => ['1' => 'Forward', '2' => 'Approve'],'placeholder' => 'Category ID','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'category_id','id' => 'category_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['1' => 'Forward', '2' => 'Approve']),'placeholder' => 'Category ID','required' => true]); ?>
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
                        <div class="col-lg-7 ps-lg-0">
                            <div class="card padding-card">
                                <div class="card-body" style="min-height: 350px;max-height: 350px;overflow-y: auto;padding: 2px 2px !important">
                                    <div style="overflow-x: auto;">
                                        <table class="table table-sm table-striped table-hover" id="user_table" style="width: 100%">
                                            <thead style="position: sticky;top: -20px;background-color: #4f85bc !important" class="table-light">
                                                <tr>
                                                    <th width="25%">EmployeeID</th>
                                                    <th width="25%">Name</th>
                                                    <th width="25%" class="text-center">Department</th>
                                                    <th width="25%" class="text-center">Category</th>
                                                </tr>
                                            </thead>
                                            <tbody id="user_table_body"></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer" style="padding: 12px 10px !important">
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="button" class="btn btn-sm btn-outline-success" id="check_all_add">
                                            <i data-feather="check-square" width="14" height="14"></i> Check All
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-primary" id="uncheck_all_add">
                                            <i data-feather="x-square" width="14" height="14"></i> Uncheck All
                                        </button>
                                        <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['type' => 'submit','id' => 'add_user_button','class' => 'btn btn-sm btn-primary float-end','disabled' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','id' => 'add_user_button','class' => 'btn btn-sm btn-primary float-end','disabled' => true]); ?>Add User <?php echo $__env->renderComponent(); ?>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header" style="padding: 12px 10px !important">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For Replace User ...</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm" style="width: 100%">
                        <thead>
                            <tr>
                                <th width="40%">
                                    <label class="m-0" for="existing_user">Existing User</label>
                                </th>
                                <td width="60%">
                                    <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'existing_user','id' => 'existing_user','class' => 'select2','options' => $activeUsers,'selected' => old('existing_user', '2'),'placeholder' => 'Select']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'existing_user','id' => 'existing_user','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activeUsers),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('existing_user', '2')),'placeholder' => 'Select']); ?>
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
                                <th width="40%">
                                    <label class="m-0" for="replace_user">Replace User</label>
                                </th>
                                <td width="60%">
                                    <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'replace_user','id' => 'replace_user','class' => 'select2','options' => $activeUsers,'selected' => old('replace_user', '2'),'placeholder' => 'Select']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'replace_user','id' => 'replace_user','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activeUsers),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('replace_user', '2')),'placeholder' => 'Select']); ?>
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
                                    <label class="m-0" for="category_id">Forward/Approve</label>
                                </td>
                                <td width="60%" id="forward_approve_section">
                                    <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'replace_category_id','id' => 'replace_category_id','class' => 'select2','options' => ['1' => 'Forward', '2' => 'Approve'],'selected' => old('replace_category_id', '1'),'placeholder' => 'Category ID']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'replace_category_id','id' => 'replace_category_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['1' => 'Forward', '2' => 'Approve']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('replace_category_id', '1')),'placeholder' => 'Category ID']); ?>
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
                                <td colspan="2" style="width: 100%">
                                    <button type="button" class="btn btn-sm btn-primary float-end" id="replace_button" disabled>Replace</button>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 pe-lg-0">
            <div class="card alert-success alert-top-border padding-card">
                <div class="card-header py-2 px-3" style="padding: 12px 10px !important">
                    <div class="row w-100 align-items-center justify-content-between" style="margin: 0 !important">
                        <!-- Title -->
                        <div class="col-12 col-md-auto mb-2 mb-md-0">
                            <h6 class="my-0 text-primary">
                                <i data-feather="user-plus" width="16" height="16"></i> Forwarded User List
                            </h6>
                        </div>

                        <!-- Button -->
                        <div class="col-12 col-md-auto text-md-end">
                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'forward_user_id','id' => 'forward_user_id','class' => 'select2','options' => $activeUsers,'placeholder' => 'User ID','width' => '100%']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'forward_user_id','id' => 'forward_user_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activeUsers),'placeholder' => 'User ID','width' => '100%']); ?>
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
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    <div style="overflow-x: auto;">
                        <table class="table table-sm" style="width: 100%">
                            <thead>
                                <tr class="table-light">
                                    <th width="20%">EmployeeID</th>
                                    <th width="25%">Name</th>
                                    <th width="25%">Department</th>
                                    <th width="25%" class="text-center">Category</th>
                                    <th width="10%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="forward_user_table_body"></tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer" style="padding: 12px 20px !important">
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-sm btn-outline-success" id="check_all_forward">
                            <i data-feather="check-square" width="14" height="14"></i> Check All
                        </button>

                        <button type="button" class="btn btn-sm btn-outline-primary" id="uncheck_all_forward">
                            <i data-feather="x-square" width="14" height="14"></i> Uncheck All
                        </button>

                        <button type="button" class="btn btn-sm btn-outline-danger" id="delete_all_forward" disabled>
                            <i data-feather="trash-2" width="14" height="14"></i> Delete All
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card alert-danger alert-top-border padding-card">
                <div class="card-header py-2 px-3" style="padding: 12px 10px !important">
                    <div class="row w-100 align-items-center justify-content-between" style="margin: 0 !important">
                        <!-- Title -->
                        <div class="col-12 col-md-auto mb-2 mb-md-0">
                            <h6 class="my-0 text-primary">
                                <i data-feather="user-plus" width="16" height="16"></i> Approved User List
                            </h6>
                        </div>

                        <!-- Button -->
                        <div class="col-12 col-md-auto text-md-end">
                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'approved_user_id','id' => 'approved_user_id','class' => 'select2','options' => $activeUsers,'placeholder' => 'User ID','width' => '100%']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'approved_user_id','id' => 'approved_user_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activeUsers),'placeholder' => 'User ID','width' => '100%']); ?>
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
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    <div style="overflow-x: auto;">
                        <table class="table table-sm" style="width: 100%">
                            <thead class="table-light">
                                <tr>
                                    <th width="20%">EmployeeID</th>
                                    <th width="25%">Name</th>
                                    <th width="25%">Department</th>
                                    <th width="20%" class="text-center">Category</th>
                                    <th width="10%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="approved_user_table_body"></tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer" style="padding: 12px 20px !important">
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-sm btn-outline-success" id="check_all_approved">
                            <i data-feather="check-square" width="14" height="14"></i> Check All
                        </button>

                        <button type="button" class="btn btn-sm btn-outline-primary" id="uncheck_all_approved">
                            <i data-feather="x-square" width="14" height="14"></i> Uncheck All
                        </button>

                        <button type="button" class="btn btn-sm btn-outline-danger" id="delete_all_approved" disabled>
                            <i data-feather="trash-2" width="14" height="14"></i> Delete All
                        </button>
                    </div>
                </div>
            </div>
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

            $('#check_all_approved').on('click', function () {
                $('.approved_user').prop('checked', true);
                $('#check_all_approved').prop('disabled', true);
                $('#uncheck_all_approved').prop('disabled', false);
                handleApprovedUser();
            });

            $('#uncheck_all_approved').on('click', function () {
                $('.approved_user').prop('checked', false);
                $('#check_all_approved').prop('disabled', false);
                $('#uncheck_all_approved').prop('disabled', true);
                handleApprovedUser();
            });

            $('#check_all_forward').on('click', function () {
                $('.forward_user').prop('checked', true);
                $('#check_all_forward').prop('disabled', true);
                $('#uncheck_all_forward').prop('disabled', false);
                handleForwardUser();
            });

            $('#uncheck_all_forward').on('click', function () {
                $('.forward_user').prop('checked', false);
                $('#check_all_forward').prop('disabled', false);
                $('#uncheck_all_forward').prop('disabled', true);
                handleForwardUser();
            });

            $('#check_all_add').on('click', function () {
                $('.add_user').prop('checked', true);
                $('#check_all_add').prop('disabled', true);
                $('#uncheck_all_add').prop('disabled', false);
                handleAddUser();
            });

            $('#uncheck_all_add').on('click', function () {
                $('.add_user').prop('checked', false);
                $('#check_all_add').prop('disabled', false);
                $('#uncheck_all_add').prop('disabled', true);
                handleAddUser();
            });

            function handleAddUser() {
                let checkedCount = $('.add_user:checked').length;
                if (checkedCount > 0) {
                    $('#add_user_button').prop('disabled', false);
                } else {
                    $('#add_user_button').prop('disabled', true);
                }
            }

            function handleForwardUser() {
                let checkedCount = $('.forward_user:checked').length;
                if (checkedCount > 0) {
                    $('#delete_all_forward').prop('disabled', false);
                } else {
                    $('#delete_all_forward').prop('disabled', true);
                }
            }

            function handleApprovedUser() {
                let checkedCount = $('.approved_user:checked').length;
                if (checkedCount > 0) {
                    $('#delete_all_approved').prop('disabled', false);
                } else {
                    $('#delete_all_approved').prop('disabled', true);
                }
            }

            $(document).on('change', '.add_user', function () {
                handleAddUser();
            });

            $(document).on('change', '.forward_user', function () {
                handleForwardUser();
            });

            $(document).on('change', '.approved_user', function () {
                handleApprovedUser();
            });

            //Fetch user
            $('#org_id,#department_id,#employee_category_id,#user_id,#type,#category_id').on('change', function () {
                fetchUser();
            });

            function fetchUser() {
                let org_id = $('#org_id').val();
                let user_id = $('#user_id').val();
                let type = $('#type').val();
                let category_id = $('#category_id').val();
                let department_id = $('#department_id').val();
                let employee_category_id = $('#employee_category_id').val();

                let all_department = $('#all_department').is(':checked');
                let all_category = $('#all_category').is(':checked');

                if((all_department || (department_id !== null && department_id !== '')) && (all_category || (employee_category_id !== null && employee_category_id !== '')) && (org_id !== null && org_id !== '')&& (user_id !== null && user_id !== '')&& (type !== null && type !== '')&& (category_id !== null && category_id !== '')){
                    $.ajax({
                        url: "<?php echo e(route('hris.settings.forward-approve.fetch-user')); ?>",
                        type: "POST",
                        data: {
                            org_id: org_id,
                            user_id: user_id,
                            type: type,
                            category_id: category_id,
                            department_id: department_id,
                            employee_category_id: employee_category_id,
                            _token: "<?php echo e(csrf_token()); ?>"
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Please wait...',
                                text: 'Loading employee data...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        },
                        success: function (response) {
                            $('#user_table_body').html('');
                            response.forEach(emp => {
                                $('#user_table_body').append(`
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="employee_id[]" id="employee_${emp.id}" class="add_user" value="${emp.employee_id}">
                                            <label class="m-0" for="employee_${emp.id}">${emp.employee_id}</label>
                                        </td>
                                        <td>${emp.name ?? ''}</td>
                                        <td class="text-center">${emp.department?.department ?? ''}</td>
                                        <td class="text-center">${emp.designation?.category_code ?? ''}</td>
                                    </tr>
                                `);
                            });
                            Swal.close();
                        },
                        error: function (xhr, status, error) {
                            Swal.fire('Error!', 'Something went wrong while fetching data.', 'error');
                        }
                    });
                }else{
                    $('#user_table_body').html('');
                }
            };

            //Existing user & Replace user
            let isResetting = false;

            $('#existing_user,#replace_user').on('change', function () {
                if (isResetting) return;

                let existing_user = $('#existing_user').val();
                let replace_user = $('#replace_user').val();

                if (existing_user == replace_user) {
                    Swal.fire(
                        'Error!',
                        'Existing user and replace user cannot be same.',
                        'error'
                    );
                    isResetting = true;
                    $('#replace_user').val('').trigger('change');
                    isResetting = false;
                }

                if (existing_user && replace_user) {
                    $('#replace_button').prop('disabled', false);
                } else {
                    $('#replace_button').prop('disabled', true);
                }
            });

            //Add User
            $('#add_user_button').on('click', function () {
                let checkedCount = $('.add_user:checked').length;
                if (checkedCount > 0) {

                }else{
                    Swal.fire(
                        'Error!',
                        'Please select at least one user.',
                        'error'
                    );
                }
            });

            //Movement pass holay only approve
            $('#type').on('change', function () {
                let type = $(this).val();
                if (type == 2) {
                    $('#category_id').val('2').trigger('change');
                    $('#category_id').prop('disabled', true);
                    $('#category_id').addClass('disabled-select');

                    $('#replace_category_id').val('2').trigger('change');
                    $('#replace_category_id').prop('disabled', true);
                    $('#replace_category_id').addClass('disabled-select');
                }else{
                    $('#category_id').prop('disabled', false);
                    $('#category_id').removeClass('disabled-select');

                    $('#replace_category_id').prop('disabled', false);
                    $('#replace_category_id').removeClass('disabled-select');
                }
            });
            $('#type').trigger('change');

            //Fetch Approved data
            $('#approved_user_id').on('change', function () {
                fetchApprovedData();
            });

            $('#forward_user_id').on('change', function () {
                fetchForwardData();
            });

            function fetchApprovedData() {
                let approved_user_id = $('#approved_user_id').val();
                let type = $('#type').val();
                let org_id = $('#org_id').val();

                if((org_id !== null && org_id !== '')&& (approved_user_id !== null && approved_user_id !== '')&& (type !== null && type !== '')){
                    $.ajax({
                        url: "<?php echo e(route('hris.settings.forward-approve.fetch-approved-data')); ?>",
                        type: "POST",
                        data: {
                            org_id: org_id,
                            approved_user_id: approved_user_id,
                            type: type,
                            _token: "<?php echo e(csrf_token()); ?>"
                        },
                        success: function(response) {
                            console.log(response);
                            $('#approved_user_table_body').empty();
                            if(response.length == 0){
                                $('#approved_user_table_body').append(`
                                    <tr>
                                        <td colspan="5" class="text-center">No data found</td>
                                    </tr>
                                `);
                            }else{
                                response.forEach(emp => {
                                let row = `
                                    <tr id="row-${emp.id}">
                                        <td>
                                            <input type="checkbox" name="employee_id[]" id="employee_${emp.id}" class="form-check-input approved_user" value="${emp.id}">
                                            <label class="m-0" for="employee_${emp.id}">${emp.employee_id}</label>
                                        </td>
                                        <td>${emp.name}</td>
                                        <td>${emp.department ?? ''}</td>
                                        <td class="text-center">${emp.category_code ?? ''}</td>
                                        <td class="text-center">
                                             <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-approved-user" data-id="${emp.id}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                `;

                                $('#approved_user_table_body').append(row);
                            });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                        }
                    });
                }else{
                    $('#approved_user_table_body').html('');
                }
            }

            function fetchForwardData() {
                let forward_user_id = $('#forward_user_id').val();
                let type = $('#type').val();
                let org_id = $('#org_id').val();
                if(type == 1){
                    if((org_id !== null && org_id !== '')&& (forward_user_id !== null && forward_user_id !== '')&& (type !== null && type !== '')){
                        $.ajax({
                            url: "<?php echo e(route('hris.settings.forward-approve.fetch-forward-data')); ?>",
                            type: "POST",
                        data: {
                            org_id: org_id,
                            forward_user_id: forward_user_id,
                            type: type,
                            _token: "<?php echo e(csrf_token()); ?>"
                        },
                        success: function(response) {
                            console.log(response);
                            $('#forward_user_table_body').empty();
                            if(response.length == 0){
                                $('#forward_user_table_body').append(`
                                    <tr>
                                        <td colspan="5" class="text-center">No data found</td>
                                    </tr>
                                `);
                            }else{
                                response.forEach(emp => {
                                let row = `
                                    <tr id="rowf-${emp.id}">
                                        <td>
                                            <input type="checkbox" name="employee_id[]" id="employee_${emp.id}" class="form-check-input forward_user" value="${emp.id}">
                                            <label class="m-0" for="employee_${emp.id}">${emp.employee_id}</label>
                                        </td>
                                        <td>${emp.name}</td>
                                        <td>${emp.department ?? ''}</td>
                                        <td class="text-center">${emp.category_code ?? ''}</td>
                                        <td class="text-center">
                                             <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-forward-user" data-id="${emp.id}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                `;

                                $('#forward_user_table_body').append(row);
                            });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                        }
                    });
                    }else{
                        $('#forward_user_table_body').html('');
                    }
                }else if(type == 2){
                    Swal.fire(
                        'Error!',
                        'Movement pass does not have forward approval.',
                        'error'
                    );
                }
            }

            $(document).on('click', '.delete-approved-user', function(e) {
                e.preventDefault();
                let approvedUserId = $(this).data('id');
                let type = $('#type').val();
                let form = 1;

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
                            url: '<?php echo e(route('hris.settings.forward-approve.delete-approved-user')); ?>',
                            type: 'POST',
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>',
                                id: approvedUserId,
                                type: type,
                                form: form,
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Approved user has been deleted.',
                                    'success'
                                );
                                $('#row-' + approvedUserId).remove();
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
                            'Approved user has not been deleted.',
                            'error'
                        );
                    }
                });
            });

            $(document).on('click', '.delete-forward-user', function(e) {
                e.preventDefault();
                let forwardUserId = $(this).data('id');
                let type = $('#type').val();
                let form = 3;

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
                            url: '<?php echo e(route('hris.settings.forward-approve.delete-approved-user')); ?>',
                            type: 'POST',
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>',
                                id: forwardUserId,
                                type: type,
                                form: form,
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Approved user has been deleted.',
                                    'success'
                                );
                                $('#rowf-' + forwardUserId).remove();
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
                            'Approved user has not been deleted.',
                            'error'
                        );
                    }
                });
            });

            $(document).on('click', '#delete_all_approved', function(e) {
                e.preventDefault();
                let type = $('#type').val();
                let approvedUserIds = [];
                let form = 2;
                $('.approved_user:checked').each(function() {
                    approvedUserIds.push($(this).val());
                });
                if(approvedUserIds.length == 0){
                    Swal.fire(
                        'Error!',
                        'Please select at least one user.',
                        'error'
                    );
                    return;
                }
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
                            url: '<?php echo e(route('hris.settings.forward-approve.delete-approved-user')); ?>',
                            type: 'POST',
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>',
                                id: approvedUserIds,
                                type: type,
                                form: form
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Forward user has been deleted.',
                                    'success'
                                );
                                $('.approved_user:checked').each(function() {
                                    $(this).closest('tr').remove();
                                });
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
                            'Forward user has not been deleted.',
                            'error'
                        );
                    }
                });
            });

            $(document).on('click', '#delete_all_forward', function(e) {
                e.preventDefault();
                let type = $('#type').val();
                let forwardUserIds = [];
                let form = 4;
                $('.forward_user:checked').each(function() {
                    forwardUserIds.push($(this).val());
                });
                if(forwardUserIds.length == 0){
                    Swal.fire(
                        'Error!',
                        'Please select at least one user.',
                        'error'
                    );
                    return;
                }
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
                            url: '<?php echo e(route('hris.settings.forward-approve.delete-approved-user')); ?>',
                            type: 'POST',
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>',
                                id: forwardUserIds,
                                type: type,
                                form: form
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Forward user has been deleted.',
                                    'success'
                                );
                                $('.forward_user:checked').each(function() {
                                    $(this).closest('tr').remove();
                                });
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
                            'Forward user has not been deleted.',
                            'error'
                        );
                    }
                });
            });

            //Replace User
            $(document).on('click','#replace_button', function () {
                let existing_user = $('#existing_user').val();
                let replace_user = $('#replace_user').val();
                let type = $('#type').val();
                let replace_category_id = $('#replace_category_id').val();

                if ((existing_user != null || existing_user != '') && (replace_user != null || replace_user != '')) {
                    $.ajax({
                        url: '<?php echo e(route('hris.settings.forward-approve.replace-user')); ?>',
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            existing_user: existing_user,
                            replace_user: replace_user,
                            type: type,
                            replace_category_id: replace_category_id,
                        },
                        success: function(response) {
                            if(response.error){
                                Swal.fire(
                                    'Error!',
                                    response.error,
                                    'error'
                                );
                            }else if(response.success){
                                Swal.fire(
                                    'Success!',
                                    response.message,
                                    'success'
                                );
                                isResetting = true;
                                $('#existing_user').val('').trigger('change');
                                $('#replace_user').val('').trigger('change');
                                $('#replace_button').prop('disabled', true);
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/aandg/public_html/Modules/HRIS/resources/views/settings/forward-approve/index.blade.php ENDPATH**/ ?>