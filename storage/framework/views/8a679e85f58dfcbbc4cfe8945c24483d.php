<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee Category',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Employee Category', 'url' => route('hris.setup.employeecategories.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-lg-8 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Employee Category List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="20%">Name</th>
                                <th width="20%">Bangla</th>
                                <th width="20%">Code</th>
                                <th width="20%">Is Active</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $employeeCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $employeeCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="row-<?php echo e($employeeCategory->id); ?>">
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($employeeCategory->category); ?></td>
                                    <td><?php echo e($employeeCategory->category_bn); ?></td>
                                    <td><?php echo e($employeeCategory->category_code); ?></td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3<?php echo e($employeeCategory->id); ?>" class="employeeCategory-toggle" data-id="<?php echo e($employeeCategory->id); ?>" switch="bool" <?php echo e($employeeCategory->is_active ? 'checked' : ''); ?> />
                                            <label for="square-switch3<?php echo e($employeeCategory->id); ?>" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($employeeCategory->id); ?>"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-employeeCategory" data-id="<?php echo e($employeeCategory->id); ?>" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                    <div id="editModal<?php echo e($employeeCategory->id); ?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Employee Category</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="editForm<?php echo e($employeeCategory->id); ?>" action="<?php echo e(route('hris.setup.employeecategories.update', $employeeCategory->id)); ?>" method="POST">
                                                    <div class="modal-body">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'category','label' => 'Name','type' => 'text','placeholder' => 'Enter name','value' => $employeeCategory->category,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'category','label' => 'Name','type' => 'text','placeholder' => 'Enter name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($employeeCategory->category),'required' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'category_bn','label' => 'Bangla','type' => 'text','placeholder' => 'Enter name','value' => $employeeCategory->category_bn,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'category_bn','label' => 'Bangla','type' => 'text','placeholder' => 'Enter name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($employeeCategory->category_bn),'required' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'category_code','label' => 'Code','type' => 'text','placeholder' => 'Enter name','value' => $employeeCategory->category_code,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'category_code','label' => 'Code','type' => 'text','placeholder' => 'Enter name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($employeeCategory->category_code),'required' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'is_active','label' => 'Is Active','options' => ['1' => 'Active', '0' => 'Inactive'],'selected' => $employeeCategory->is_active,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'is_active','label' => 'Is Active','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['1' => 'Active', '0' => 'Inactive']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($employeeCategory->is_active),'required' => true]); ?>
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
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['id' => 'submitBtn','class' => 'float-start btn-sm submitBtn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'submitBtn','class' => 'float-start btn-sm submitBtn']); ?>Save changes <?php echo $__env->renderComponent(); ?>
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
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Employee Category ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="<?php echo e(route('hris.setup.employeecategories.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'category','label' => 'Name','type' => 'text','placeholder' => 'Enter name','value' => old('category'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'category','label' => 'Name','type' => 'text','placeholder' => 'Enter name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('category')),'required' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'category_bn','label' => 'Bangla','type' => 'text','placeholder' => 'Enter name','value' => old('category_bn'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'category_bn','label' => 'Bangla','type' => 'text','placeholder' => 'Enter name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('category_bn')),'required' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'category_code','label' => 'Code','type' => 'text','placeholder' => 'Enter name','value' => old('category_code'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'category_code','label' => 'Code','type' => 'text','placeholder' => 'Enter name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('category_code')),'required' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'is_active','label' => 'Is Active?','options' => ['1' => 'Active', '0' => 'Inactive'],'selected' => old('is_active', '1'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'is_active','label' => 'Is Active?','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['1' => 'Active', '0' => 'Inactive']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('is_active', '1')),'required' => true]); ?>
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
<?php $component->withAttributes(['class' => 'float-start btn-sm submitBtn']); ?>Save <?php echo $__env->renderComponent(); ?>
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
            $('.employeeCategory-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '<?php echo e(route('hris.setup.employeecategories.toggle')); ?>',
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

        $(document).on('click', '.delete-employeeCategory', function(e) {
            e.preventDefault();
            let employeeCategoryId = $(this).data('id');
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
                        url: '<?php echo e(route('hris.setup.employeecategories.delete')); ?>',
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            id: employeeCategoryId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Employee Category has been deleted.',
                                'success'
                            );
                            $('#row-' + employeeCategoryId).remove();
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                            $('#row-' + employeeCategoryId).remove();
                        }
                    });
                } else {
                    Swal.fire(
                        'Cancelled!',
                        'Employee Category has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\HRIS\resources\views\setup\employeecategories\index.blade.php ENDPATH**/ ?>