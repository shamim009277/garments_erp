<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Unit',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Setup', 'url' => route('hris.index')],
                    ['label' => 'Unit', 'url' => route('hris.setup.units.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-lg-8 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Unit List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="20%">Unit</th>
                                <th width="10%">Code</th>
                                <th width="45%">Line</th>
                                <th width="10%">Is Active</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $assoc = array_combine(json_decode($unit->line_id, true), json_decode($unit->line, true));
                                    $lines_custom = $assoc+$lines;
                                ?>
                                <tr id="row-<?php echo e($unit->id); ?>">
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($unit->unit); ?></td>
                                    <td><?php echo e($unit->code); ?></td>
                                    <td>
                                        <?php echo e(implode(',', json_decode($unit->line, true))); ?>

                                    </td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3<?php echo e($unit->id); ?>" class="unit-toggle" data-id="<?php echo e($unit->id); ?>" switch="bool" <?php echo e($unit->is_active ? 'checked' : ''); ?> />
                                            <label for="square-switch3<?php echo e($unit->id); ?>" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($unit->id); ?>"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-unit" data-id="<?php echo e($unit->id); ?>" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                    <div id="editModal<?php echo e($unit->id); ?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Unit</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="editForm<?php echo e($unit->id); ?>" action="<?php echo e(route('hris.setup.units.update', $unit->id)); ?>" method="POST">
                                                    <div class="modal-body">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'unit','label' => 'Unit','type' => 'text','placeholder' => 'Enter unit','value' => $unit->unit,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'unit','label' => 'Unit','type' => 'text','placeholder' => 'Enter unit','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unit->unit),'required' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'code','label' => 'Code','type' => 'text','placeholder' => 'Enter code','value' => $unit->code,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'code','label' => 'Code','type' => 'text','placeholder' => 'Enter code','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unit->code),'required' => true]); ?>
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
                                                        <label for="line_id">Line <span class="text-danger">*</span></label>
                                                        <?php if (isset($component)) { $__componentOriginalcd5480bec14091361d89d1705da56ae0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd5480bec14091361d89d1705da56ae0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-multiple-input','data' => ['name' => 'line_id[]','id' => 'line_id_edit_'.e($unit->id).'','class' => 'select2 multiselect mb-2','options' => $lines_custom,'selected' => json_decode($unit->line_id, true) ?? [],'multiple' => true,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-multiple-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'line_id[]','id' => 'line_id_edit_'.e($unit->id).'','class' => 'select2 multiselect mb-2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($lines_custom),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(json_decode($unit->line_id, true) ?? []),'multiple' => true,'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcd5480bec14091361d89d1705da56ae0)): ?>
<?php $attributes = $__attributesOriginalcd5480bec14091361d89d1705da56ae0; ?>
<?php unset($__attributesOriginalcd5480bec14091361d89d1705da56ae0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcd5480bec14091361d89d1705da56ae0)): ?>
<?php $component = $__componentOriginalcd5480bec14091361d89d1705da56ae0; ?>
<?php unset($__componentOriginalcd5480bec14091361d89d1705da56ae0); ?>
<?php endif; ?>
                                                        <br>
                                                        <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'is_active','label' => 'Is Active','options' => ['1' => 'Active', '0' => 'Inactive'],'selected' => $unit->is_active,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'is_active','label' => 'Is Active','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['1' => 'Active', '0' => 'Inactive']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($unit->is_active),'required' => true]); ?>
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Unit ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="<?php echo e(route('hris.setup.units.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'unit','label' => 'Unit','type' => 'text','placeholder' => 'Enter unit','value' => old('unit'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'unit','label' => 'Unit','type' => 'text','placeholder' => 'Enter unit','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('unit')),'required' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'code','label' => 'Code','type' => 'text','placeholder' => 'Enter code','value' => old('code'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'code','label' => 'Code','type' => 'text','placeholder' => 'Enter code','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('code')),'required' => true]); ?>
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
                        <label for="line_id">Line <span class="text-danger">*</span></label>
                        <?php if (isset($component)) { $__componentOriginalcd5480bec14091361d89d1705da56ae0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd5480bec14091361d89d1705da56ae0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-multiple-input','data' => ['name' => 'line_id[]','id' => 'classification_id_add','class' => 'select2 multiselect mb-2','options' => $lines,'selected' => old('classification_id', []),'multiple' => true,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-multiple-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'line_id[]','id' => 'classification_id_add','class' => 'select2 multiselect mb-2','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($lines),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('classification_id', [])),'multiple' => true,'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcd5480bec14091361d89d1705da56ae0)): ?>
<?php $attributes = $__attributesOriginalcd5480bec14091361d89d1705da56ae0; ?>
<?php unset($__attributesOriginalcd5480bec14091361d89d1705da56ae0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcd5480bec14091361d89d1705da56ae0)): ?>
<?php $component = $__componentOriginalcd5480bec14091361d89d1705da56ae0; ?>
<?php unset($__componentOriginalcd5480bec14091361d89d1705da56ae0); ?>
<?php endif; ?>
                        <br><br>
                        <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'is_active','class' => 'mb-2','label' => 'Is Active?','options' => ['1' => 'Active', '0' => 'Inactive'],'selected' => old('is_active', '1'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'is_active','class' => 'mb-2','label' => 'Is Active?','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['1' => 'Active', '0' => 'Inactive']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('is_active', '1')),'required' => true]); ?>
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
            $('#line_id_add').select2({
                placeholder: 'Select Line',
                allowClear: true,
                multiple: true,
            });

            $('.select2.multiselect').each(function() {
                if (!$(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2();
                }
            });

            $('.unit-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '<?php echo e(route('hris.setup.units.toggle')); ?>',
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

        $(document).on('click', '.delete-unit', function(e) {
            e.preventDefault();
            let unitId = $(this).data('id');
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
                        url: '<?php echo e(route('hris.setup.units.delete')); ?>',
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            id: unitId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Unit has been deleted.',
                                'success'
                            );
                            $('#row-' + unitId).remove();
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
                        'Unit has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\new erp\garments_erp\Modules\HRIS\resources\views\setup\unit\index.blade.php ENDPATH**/ ?>