<?php $__env->startSection('title', 'SEWING MANAGEMENT'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'SEWING MANAGEMENT',
                'subtitle' => 'Sewing Group Assignments',
                'breadcrumbs' => [
                    ['label' => 'SEWING MANAGEMENT', 'url' => route('sms.index')],
                    ['label' => 'Setup', 'url' => route('sms.index')],
                    ['label' => 'Sewing Groups', 'url' => route('sms.setup.sewing_groups.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Sewing Groups List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Group Code</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Employees</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $sewingGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="row-<?php echo e($group->id); ?>">
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($group->group_code); ?></td>
                                    <td><?php echo e($group->name); ?></td>
                                    <td><?php echo e($group->description); ?></td>
                                    <td>
                                        <?php if($group->sewingGroupEmployees->count() > 0): ?>
                                        <ul>
                                            <?php $__currentLoopData = $group->sewingGroupEmployees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($sge->employee ? $sge->employee->name : $sge->employee_id); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                            <!-- <span class="badge bg-info"><?php echo e($group->sewingGroupEmployees->count()); ?> Employees</span> -->
                                            <!-- <i class="fas fa-info-circle text-info" data-bs-toggle="tooltip" title="<?php echo e($group->sewingGroupEmployees->map(function($sge) { return $sge->employee ? $sge->employee->name : $sge->employee_id; })->join(', ')); ?>"></i> -->
                                        <?php else: ?>
                                            <span class="badge bg-secondary">0 Employees</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3<?php echo e($group->id); ?>"
                                                class="group-toggle" data-id="<?php echo e($group->id); ?>"
                                                switch="bool" <?php echo e($group->is_active ? 'checked' : ''); ?> />
                                            <label for="square-switch3<?php echo e($group->id); ?>" data-on-label="Yes"
                                                data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light "
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal<?php echo e($group->id); ?>"><i
                                                class="fas fa-edit"></i></a>
                                        
                                        <a href="#"
                                            class="btn btn-soft-danger waves-effect waves-light delete-group"
                                            data-id="<?php echo e($group->id); ?>" style="padding: 4px 6px;" title="Clear Assignments"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                
                                <div class="modal fade" id="editModal<?php echo e($group->id); ?>" tabindex="-1"
                                    aria-labelledby="editModalLabel<?php echo e($group->id); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel<?php echo e($group->id); ?>">Edit Assignments: <?php echo e($group->name); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editForm<?php echo e($group->id); ?>"
                                                    action="<?php echo e(route('sms.setup.sewing_groups.update', $group->id)); ?>"
                                                    method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    
                                                    <!-- Hidden Group ID -->
                                                    <input type="hidden" name="group_id" value="<?php echo e($group->id); ?>">

                                                    <div class="mb-3">
                                                        <label class="form-label">Group</label>
                                                        <input type="text" class="form-control" value="<?php echo e($group->name); ?> (<?php echo e($group->group_code); ?>)" disabled>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label">Employees</label>
                                                        <select name="employee_ids[]" class="form-control select2" multiple="multiple" style="width: 100%;">
                                                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($employee->employee_id); ?>" 
                                                                    <?php echo e($group->sewingGroupEmployees->contains('employee_id', $employee->employee_id) ? 'selected' : ''); ?>>
                                                                    <?php echo e($employee->name); ?> (<?php echo e($employee->employee_id); ?>)
                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>

                                                    <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'is_active','label' => 'Group Status','options' => ['1' => 'Active', '0' => 'Inactive'],'selected' => $group->is_active ? '1' : '0','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'is_active','label' => 'Group Status','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['1' => 'Active', '0' => 'Inactive']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->is_active ? '1' : '0'),'required' => true]); ?>
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
                                                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'float-start btn-sm submitBtn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'float-start btn-sm submitBtn']); ?>Save Changes <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-account-multiple-plus"></i> Assign Employees to Group</h6>
                </div>
                <div class="card-body">
                    <form id="createForm" action="<?php echo e(route('sms.setup.sewing_groups.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label class="form-label">Select Group <span class="text-danger">*</span></label>
                            <select name="group_id" class="form-control select2" required>
                                <option value="">Select Group</option>
                                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($g->id); ?>" <?php echo e(old('group_id') == $g->id ? 'selected' : ''); ?>>
                                        <?php echo e($g->name); ?> (<?php echo e($g->group_code); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Employees</label>
                            <select name="employee_ids[]" class="form-control select2" multiple="multiple" style="width: 100%;">
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($employee->employee_id); ?>" <?php echo e((collect(old('employee_ids'))->contains($employee->employee_id)) ? 'selected' : ''); ?>>
                                        <?php echo e($employee->name); ?> (<?php echo e($employee->employee_id); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'is_active','label' => 'Group Status','options' => ['1' => 'Active', '0' => 'Inactive'],'selected' => old('is_active', '1'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'is_active','label' => 'Group Status','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['1' => 'Active', '0' => 'Inactive']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('is_active', '1')),'required' => true]); ?>
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
                        <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'float-start btn-sm submitBtn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'float-start btn-sm submitBtn']); ?>Assign Employees <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            // Init for Create form
            $('#createForm .select2').select2({
                placeholder: "Select...",
                allowClear: true
            });

            // Init for Edit modals
            $('.modal').on('shown.bs.modal', function () {
                $(this).find('.select2').select2({
                    dropdownParent: $(this),
                    placeholder: "Select Employees",
                    allowClear: true
                });
            });

            $('.group-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '<?php echo e(route('sms.setup.sewing_groups.toggle')); ?>',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong!');
                    }
                });
            });
        });

        $(document).on('click', '.delete-group', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Clear Assignments?',
                text: "This will remove all employees from this group. The group itself will remain.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, clear it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo e(route('sms.setup.sewing_groups.destroy', ':id')); ?>'.replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Cleared!',
                                    response.message,
                                    'success'
                                );
                                // Reload page to reflect changes
                                location.reload();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\SM\resources\views\setup\sewing_groups\index.blade.php ENDPATH**/ ?>