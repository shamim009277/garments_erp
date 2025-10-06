<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Leave Approve Show',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Leave Approve', 'url' => route('hris.database.leave-approve.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Leave Approve :: FormID - <?php echo e($leaveApplication->form_id); ?>

                </h4>

                <!-- Right Side Back Button -->
                <a href="<?php echo e(route('hris.database.leave-approve.index')); ?>" class="btn btn-sm btn-primary order-2">
                    <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
                </a>
            </div>
        </div>
        <div class="col-lg-8 pe-lg-0">
            <form action="<?php echo e(route('hris.database.leave-application.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i>Leave Application Approve</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 pe-lg-0 pe-md-0">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%">Employee ID</th>
                                            <td style="width: 70%">
                                                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'employee_id','id' => 'employee_id','label' => '','class' => 'form-control-sm','placeholder' => 'Employee ID','value' => ''.e(str_pad($leaveApplication->employee_id, 6, '0', STR_PAD_LEFT)).'','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'employee_id','id' => 'employee_id','label' => '','class' => 'form-control-sm','placeholder' => 'Employee ID','value' => ''.e(str_pad($leaveApplication->employee_id, 6, '0', STR_PAD_LEFT)).'','required' => true,'readonly' => true]); ?>
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
                                            <th style="width: 30%">Leave Type</th>
                                            <td style="width: 70%">
                                                <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'leave_type_id','id' => 'leave_type_id','class' => 'select2','options' => $leave_types,'selected' => ''.e($leaveApplication->leave_type_id).'','required' => true,'disabled' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'leave_type_id','id' => 'leave_type_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($leave_types),'selected' => ''.e($leaveApplication->leave_type_id).'','required' => true,'disabled' => true]); ?>
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
                                            <th style="width: 30%">Reason</th>
                                            <td style="width: 70%">
                                                <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'reason_id','id' => 'reason_id','class' => 'select2','options' => $reasons,'selected' => ''.e($leaveApplication->reason_id).'','required' => true,'disabled' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'reason_id','id' => 'reason_id','class' => 'select2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($reasons),'selected' => ''.e($leaveApplication->reason_id).'','required' => true,'disabled' => true]); ?>
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
                                            <th style="width: 30%">Start Date</th>
                                            <td style="width: 70%">
                                                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'start_date','type' => 'date','id' => 'start_date','label' => '','class' => 'form-control-sm','value' => ''.e(date('Y-m-d', strtotime($leaveApplication->start_date))).'','placeholder' => 'Start Date','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'start_date','type' => 'date','id' => 'start_date','label' => '','class' => 'form-control-sm','value' => ''.e(date('Y-m-d', strtotime($leaveApplication->start_date))).'','placeholder' => 'Start Date','required' => true]); ?>
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
                                            <th style="width: 30%">End Date</th>
                                            <td style="width: 70%">
                                                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'end_date','type' => 'date','id' => 'end_date','label' => '','class' => 'form-control-sm','value' => ''.e(date('Y-m-d', strtotime($leaveApplication->end_date))).'','placeholder' => 'End Date','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'end_date','type' => 'date','id' => 'end_date','label' => '','class' => 'form-control-sm','value' => ''.e(date('Y-m-d', strtotime($leaveApplication->end_date))).'','placeholder' => 'End Date','required' => true]); ?>
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
                                            <th style="width: 30%">Days</th>
                                            <td style="width: 70%">
                                                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'days','id' => 'days','label' => '','class' => 'form-control-sm','value' => ''.e($leaveApplication->days).'','placeholder' => 'Days','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'days','id' => 'days','label' => '','class' => 'form-control-sm','value' => ''.e($leaveApplication->days).'','placeholder' => 'Days','required' => true,'readonly' => true]); ?>
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
                            <div class="col-lg-5 col-md-6 pe-lg-0 pe-md-0">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%">Name</th>
                                            <td style="width: 70%">
                                                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'name','id' => 'name','label' => '','class' => 'form-control-sm','placeholder' => 'Name','value' => ''.e($leaveApplication->employee->name).'','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'name','id' => 'name','label' => '','class' => 'form-control-sm','placeholder' => 'Name','value' => ''.e($leaveApplication->employee->name).'','required' => true,'readonly' => true]); ?>
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
                                            <th style="width: 30%">Designation</th>
                                            <td style="width: 70%">
                                                <input type="hidden" name="designation_id" id="designation_id" class="form-control-sm" placeholder="Designation" value="<?php echo e($leaveApplication->designation_id); ?>" required readonly/>
                                                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'designation','id' => 'designation','label' => '','class' => 'form-control-sm','placeholder' => 'Designation','value' => ''.e($leaveApplication->designation->designation).'','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'designation','id' => 'designation','label' => '','class' => 'form-control-sm','placeholder' => 'Designation','value' => ''.e($leaveApplication->designation->designation).'','required' => true,'readonly' => true]); ?>
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
                                            <th style="width: 30%">Department</th>
                                            <td style="width: 70%">
                                                <input type="hidden" name="department_id" id="department_id" class="form-control-sm" placeholder="Department" value="<?php echo e($leaveApplication->department_id); ?>" required readonly/>
                                                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'department','id' => 'department','label' => '','class' => 'form-control-sm','placeholder' => 'Department','value' => ''.e($leaveApplication->department->department).'','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'department','id' => 'department','label' => '','class' => 'form-control-sm','placeholder' => 'Department','value' => ''.e($leaveApplication->department->department).'','required' => true,'readonly' => true]); ?>
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
                                            <th style="width: 30%">Join Date</th>
                                            <td style="width: 70%">
                                                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'join_date','type' => 'text','id' => 'join_date','label' => '','class' => 'form-control-sm','value' => ''.e(date('Y-m-d', strtotime($leaveApplication->employee->joining_date))).'','placeholder' => 'Join Date','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'join_date','type' => 'text','id' => 'join_date','label' => '','class' => 'form-control-sm','value' => ''.e(date('Y-m-d', strtotime($leaveApplication->employee->joining_date))).'','placeholder' => 'Join Date','required' => true,'readonly' => true]); ?>
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
                                            <th style="width: 30%">Application Date</th>
                                            <td style="width: 70%">
                                                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'application_date','type' => 'text','id' => 'application_date','label' => '','class' => 'form-control-sm','value' => ''.e(date('Y-m-d', strtotime($leaveApplication->application_date))).'','placeholder' => 'Application Date','required' => true,'readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'application_date','type' => 'text','id' => 'application_date','label' => '','class' => 'form-control-sm','value' => ''.e(date('Y-m-d', strtotime($leaveApplication->application_date))).'','placeholder' => 'Application Date','required' => true,'readonly' => true]); ?>
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
                                            <th style="width: 30%">Remarks</th>
                                            <td style="width: 70%">
                                                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'remarks','id' => 'remarks','label' => '','class' => 'form-control-sm','value' => ''.e($leaveApplication->remarks).'','placeholder' => 'Remarks','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'remarks','id' => 'remarks','label' => '','class' => 'form-control-sm','value' => ''.e($leaveApplication->remarks).'','placeholder' => 'Remarks','readonly' => true]); ?>
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
                            <div class="col-lg-2" style="padding:0px;">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 100%;text-align: center">Photo</th>
                                        </tr>
                                        <tr>
                                            <td style="display: flex; justify-content: center; align-items: center;">
                                                <?php if($leaveApplication->employee->photo): ?>
                                                    <img src="<?php echo e(asset('storage/' . $leaveApplication->employee->photo)); ?>" alt="Photo" id="photo" class="img-fluid" style="width: 160px; height: 180px; object-fit: cover; padding: 2px;">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('backend/assets/images/demo.png')); ?>" alt="Photo" id="photo" class="img-fluid" style="width: 160px; height: 180px; object-fit: cover; padding: 2px;">
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding:10px 20px;">
                        <button id="submitBtn" type="button" class="btn btn-sm btn-primary float-end"> <i data-feather="log-in" width="14" height="14"></i> Approve</button>
                        <button type="button" id="discardBtn" class="btn btn-sm btn-danger float-end" style="margin-right: 10px;"> <i data-feather="log-out" width="14" height="14"></i> Discard</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Leave Card Summary</h6>
                </div>
                <div class="card-body">
                    <table class="table table-striped" style="width: 100%;text-align: center">
                        <tbody>
                            <tr>
                                <th style="width: 40%">Leave Type</th>
                                <th style="width: 20%">Available</th>
                                <th style="width: 20%">Taken</th>
                                <th style="width: 20%">Balance</th>
                            </tr>
                            <tr>
                                <th style="width: 40%">Casual Leave</th>
                                <td style="width: 20%">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'CLA','id' => 'CLA','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'CLA','id' => 'CLA','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]); ?>
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
                                <td style="width: 20%">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'CLT','id' => 'CLT','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'CLT','id' => 'CLT','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]); ?>
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
                                <td style="width: 20%">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'CLB','id' => 'CLB','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'CLB','id' => 'CLB','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]); ?>
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
                                <th style="width: 40%">Sick Leave</th>
                                <td style="width: 20%">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'SLA','id' => 'SLA','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'SLA','id' => 'SLA','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]); ?>
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
                                <td style="width: 20%">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'SLT','id' => 'SLT','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'SLT','id' => 'SLT','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]); ?>
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
                                <td style="width: 20%">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'SLB','id' => 'SLB','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'SLB','id' => 'SLB','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]); ?>
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
                                <th style="width: 40%">Earned Leave</th>
                                <td style="width: 20%">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'ELA','id' => 'ELA','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'ELA','id' => 'ELA','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]); ?>
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
                                <td style="width: 20%">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'ELT','id' => 'ELT','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'ELT','id' => 'ELT','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]); ?>
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
                                <td style="width: 20%">
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'ELB','id' => 'ELB','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'ELB','id' => 'ELB','label' => '','class' => 'form-control-sm text-center','placeholder' => '0','readonly' => true]); ?>
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
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function () {
            let startPicker, endPicker;

            endPicker = flatpickr("#end_date", {
                dateFormat: "Y-m-d",
                maxDate: "<?php echo e($leaveApplication->end_date); ?>",
                minDate: "<?php echo e($leaveApplication->start_date); ?>",
                onChange: function (selectedDates, dateStr) {
                    if (dateStr) {
                        startPicker.set('maxDate', dateStr);
                    }
                    updateDays();
                }
            });

            startPicker = flatpickr("#start_date", {
                dateFormat: "Y-m-d",
                maxDate: "<?php echo e($leaveApplication->end_date); ?>",
                minDate: "<?php echo e($leaveApplication->start_date); ?>",
                onChange: function (selectedDates, dateStr) {
                    if (dateStr) {
                        endPicker.set('minDate', dateStr);
                    }
                    updateDays();
                }
            });

            function calculateDays(start, end) {
                if (!start || !end) return "";

                let startDate = new Date(start);
                let endDate = new Date(end);

                if (startDate > endDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Date!',
                        text: 'End Date must be greater than or equal to Start Date.',
                    });
                    $("#end_date").val("");
                    $("#days").val("");
                    return "";
                }

                let diffTime = endDate - startDate;
                let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                return diffDays;
            }

            function updateDays() {
                let start = $("#start_date").val();
                let end = $("#end_date").val();
                let days = calculateDays(start, end);

                if (days) {
                    $("#days").val(days);
                }
            }

            $('#start_date,#end_date').trigger('change');
            $("#leave_type_id").on("change", function () {
                let leaveType = $(this).val();
                let departmentId = $("#department_id").val();
                if (departmentId) {
                    $.ajax({
                        url: "<?php echo e(route('hris.database.getleavereason')); ?>",
                        type: "POST",
                        data: {
                            leave_type: leaveType
                        },
                        success: function (response) {
                            $('#reason_id').empty();
                            $('#reason_id').append('<option value="">Select Reason</option>');
                            $.each(response, function(key, value) {
                                $('#reason_id').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to load leave type info.',
                            });
                        }
                    });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Please Input Valid Employee ID First',
                    });
                }
            });

            $(document).on('click', '#discardBtn', function() {
                let id = "<?php echo e($leaveApplication->id); ?>";

                if (id === "") {
                    Swal.fire('Warning', 'Please Input Valid Data!', 'warning');
                    return;
                }

                Swal.fire({
                    title: 'Are you sure? ',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Discard it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                        url: '<?php echo e(route('hris.database.leave-approve.store')); ?>',
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            id: id,
                            form: 4,
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Please wait...',
                                text: 'Processing selected leave applications...',
                                allowOutsideClick: false,
                                didOpen: () => Swal.showLoading()
                            });
                        },
                        success: function(response) {
                            Swal.close();
                            if (response.status === 'success') {
                                Swal.fire('Success', response.message, 'success');

                                // Remove checked rows from table
                                location.href = '<?php echo e(route('hris.database.leave-forward.index')); ?>';
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.close();
                            Swal.fire('Error', error, 'error');
                        }
                    });
                    } else {
                        Swal.fire(
                            'Cancelled!',
                            'Leave Application has not been discarded.',
                            'error'
                        );
                    }
                });
            });

            $(document).on('click', '#submitBtn', function() {
                let id = "<?php echo e($leaveApplication->id); ?>";
                let start_date = $("#start_date").val();
                let end_date = $("#end_date").val();
                let days = $("#days").val();


                if (id === "" || start_date === "" || end_date === "" || days === "") {
                    Swal.fire('Warning', 'Please Input Valid Data!', 'warning');
                    return;
                }

                $.ajax({
                    url: '<?php echo e(route('hris.database.leave-approve.store')); ?>',
                    type: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id: id,
                        form: 3,
                        start_date: start_date,
                        end_date: end_date,
                        days: days,
                    },
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Please wait...',
                            text: 'Processing selected leave applications...',
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });
                    },
                    success: function(response) {
                        Swal.close();
                        if (response.status === 'success') {
                            Swal.fire('Success', response.message, 'success');

                            // Remove checked rows from table
                            location.href = '<?php echo e(route('hris.database.leave-forward.index')); ?>';
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.close();
                        Swal.fire('Error', error, 'error');
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\new erp\garments_erp\Modules\HRIS\resources\views\database\bulkincrement\show.blade.php ENDPATH**/ ?>