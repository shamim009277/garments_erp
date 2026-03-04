<?php $__env->startSection('title', isset($role) ? 'Role Update' : 'Role Create'); ?>
<?php $__env->startPush('styles'); ?>
    <style>
        input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php
        $isEdit = isset($role) && $role !== null;
        $assignedPermissions = $role?->permissions?->pluck('name')->toArray() ?? [];
        $assignedMenus = $role?->menus?->pluck('id')->toArray() ?? [];
        $assignedModules = $role?->modules?->pluck('id')->toArray() ?? [];
    ?>

    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'Authorization',
                'subtitle' => 'Role',
                'breadcrumbs' => [
                    ['label' => 'Administration', 'url' => route('administration.index')],
                    ['label' => 'Role', 'url' => route('administration.authorization.role.index')],
                    ['label' => $isEdit ? 'Role Update' : 'Role Create'],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-md-12">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h6 class="my-0 text-primary"> <i data-feather="list" style="width: 16px;"></i> <?php echo e($isEdit ? 'Update Role' : 'Role Create'); ?></h6>
                    <div class="action-btn">
                        <a href="<?php echo e(route('administration.authorization.role.index')); ?>" class="btn btn-primary btn-sm">
                            <i data-feather="arrow-left" style="width: 16px;"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo e($isEdit ? route('administration.authorization.role.update', $role->id) : route('administration.authorization.role.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php if($isEdit): ?>
                            <?php echo method_field('PUT'); ?>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Role Name</label>
                                    <input type="text" name="name" id="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('name', $role->name ?? '')); ?>" required>
                                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('name')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('name'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group mt-3">
                                    <label for="permissions">Permissions List</label>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($data->menus->count() > 0): ?>
                                                    <div class="card shadow-sm">
                                                        <div class="card-body">
                                                            
                                                            <div class="form-check mb-2">
                                                                <input type="checkbox"
                                                                    class="form-check-input module-check"
                                                                    name="modules[]"
                                                                    value="<?php echo e($data->id); ?><?php echo e($key); ?>"
                                                                    id="module_<?php echo e($data->id); ?><?php echo e($key); ?>"
                                                                    data-target=".module_<?php echo e($data->id); ?><?php echo e($key); ?>"
                                                                    <?php echo e(in_array($data->id, $assignedModules) ? 'checked' : ''); ?>>
                                                                <label class="form-check-label text-primary fw-semibold" for="module_<?php echo e($data->id); ?><?php echo e($key); ?>">
                                                                    <?php echo e($data->name); ?>

                                                                </label>
                                                            </div>

                                                            
                                                            <?php $__currentLoopData = $data->menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                
                                                                <?php if($menu->has_child != 1 && $menu->parent_id == null): ?>
                                                                    <div class="mb-3 p-3 rounded shadow-sm">
                                                                        <div class="form-check mb-2">
                                                                            <input type="checkbox"
                                                                                class="form-check-input menu-check module_<?php echo e($data->id); ?><?php echo e($key); ?>"
                                                                                name="menus[]"
                                                                                value="<?php echo e($menu->id); ?>"
                                                                                id="menu_<?php echo e($menu->id); ?>"
                                                                                data-target=".menu_<?php echo e($menu->id); ?>"
                                                                                <?php echo e(in_array($menu->id, $assignedMenus) ? 'checked' : ''); ?>>
                                                                            <label class="form-check-label text-info fw-semibold fs-6" for="menu_<?php echo e($menu->id); ?>">
                                                                                <?php echo e($menu->title); ?>

                                                                            </label>
                                                                        </div>

                                                                        
                                                                        <div class="row g-3 menu_<?php echo e($menu->id); ?>" style="margin-left: 15px;">
                                                                            <?php $__currentLoopData = $menu->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div class="col-6 col-sm-4 col-md-3">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input module_<?php echo e($data->id); ?><?php echo e($key); ?> menu_<?php echo e($menu->id); ?>"
                                                                                            type="checkbox"
                                                                                            name="permissions[]"
                                                                                            value="<?php echo e($permission->name); ?>"
                                                                                            <?php echo e(in_array($permission->name, $assignedPermissions) ? 'checked' : ''); ?>>
                                                                                        <label class="form-check-label" for="perm_<?php echo e($index); ?>">
                                                                                            <?php echo e(ucfirst(str_replace('.', ' ', $permission->name))); ?>

                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>

                                                                
                                                                <?php if($menu->has_child == 1 && $menu->parent_id == null): ?>
                                                                    <div class="mb-3 p-3 rounded shadow-sm">
                                                                        <div class="form-check mb-2">
                                                                            <input type="checkbox"
                                                                                class="form-check-input parent-menu-check module_<?php echo e($data->id); ?><?php echo e($key); ?>"
                                                                                name="menus[]"
                                                                                value="<?php echo e($menu->id); ?>"
                                                                                id="menu_<?php echo e($menu->id); ?>"
                                                                                data-target=".parent_menu_<?php echo e($menu->id); ?>"
                                                                                <?php echo e(in_array($menu->id, $assignedMenus) ? 'checked' : ''); ?>>
                                                                            <label class="form-check-label text-info fw-semibold fs-6" for="menu_<?php echo e($menu->id); ?>">
                                                                                <?php echo e($menu->title); ?>

                                                                            </label>
                                                                        </div>

                                                                        
                                                                        <div class="row g-3 parent_menu_<?php echo e($menu->id); ?>" style="margin-left: 15px;">
                                                                            <?php $__currentLoopData = $menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div class="form-check mb-2">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input menu-check1 module_<?php echo e($data->id); ?><?php echo e($key); ?> parent_menu_<?php echo e($menu->id); ?>"
                                                                                        name="menus[]"
                                                                                        value="<?php echo e($child->id); ?>"
                                                                                        id="menu_<?php echo e($child->id); ?>"
                                                                                        data-target=".menu_<?php echo e($child->id); ?>"
                                                                                        <?php echo e(in_array($child->id, $assignedMenus) ? 'checked' : ''); ?>>
                                                                                    <label class="form-check-label text-info fw-semibold fs-6" for="menu_<?php echo e($child->id); ?>">
                                                                                        <?php echo e($child->title); ?>

                                                                                    </label>
                                                                                </div>

                                                                                
                                                                                <?php $__currentLoopData = $child->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <div class="col-6 col-sm-4 col-md-3 menu_<?php echo e($child->id); ?>" style="margin:0px !important">
                                                                                        <div class="form-check" style="margin-left: 15px !important">
                                                                                            <input class="form-check-input module_<?php echo e($data->id); ?><?php echo e($key); ?> menu_<?php echo e($child->id); ?> parent_menu_<?php echo e($menu->id); ?>"
                                                                                                type="checkbox"
                                                                                                name="permissions[]"
                                                                                                value="<?php echo e($permission->name); ?>"
                                                                                                id="perm_<?php echo e($index); ?>"
                                                                                                <?php echo e(in_array($permission->name, $assignedPermissions) ? 'checked' : ''); ?>>
                                                                                            <label class="form-check-label" for="perm_<?php echo e($index); ?>">
                                                                                                <?php echo e(ucfirst(str_replace('.', ' ', $permission->name))); ?>

                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                    </div>
                                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('permissions')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('permissions'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'float-start btn-md submitBtn mt-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'float-start btn-md submitBtn mt-3']); ?><?php echo e($isEdit ? 'Update Role' : 'Add Permission'); ?> <?php echo $__env->renderComponent(); ?>
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
        $(document).ready(function () {
            // ===== Module Check =====
            $(document).on('change', '.module-check', function () {
                let card = $(this).closest('.card');
                card.find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
            });

            // ===== Parent Menu Check =====
            $(document).on('change', '.parent-menu-check', function () {
                let parentDiv = $(this).closest('.mb-3.p-3');
                parentDiv.find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
                updateModuleCheck($(this).closest('.card'));
            });

            // ===== Normal Menu Check =====
            $(document).on('change', '.menu-check', function () {
                let menuDiv = $(this).closest('.mb-3.p-3');
                menuDiv.find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
                updateModuleCheck($(this).closest('.card'));
            });

            // ===== Child Menu Check =====
            $(document).on('change', '.menu-check1', function () {
                let childCheckbox = $(this);

                // শুধুমাত্র নিজে এবং তার permission চেক/আনচেক হবে
                let childId = childCheckbox.val();
                $('.menu_' + childId).prop('checked', childCheckbox.prop('checked'));

                // parent menu check update
                let parentDiv = childCheckbox.closest('.parent_menu_' + childCheckbox.closest('.parent_menu_' + childCheckbox.data('target').replace('.', '')).attr('class').split(' ')[0].replace('.', ''));
                if (!parentDiv.length) {
                    // direct parentDiv selector fail হলে closest parent row
                    parentDiv = childCheckbox.closest('.row').closest('.parent_menu_' + childCheckbox.closest('.row').attr('class').split(' ')[0].replace('.', ''));
                }
                updateParentCheck(childCheckbox);

                // module check update
                updateModuleCheck(childCheckbox.closest('.card'));
            });

            // ===== Permission Check =====
            $(document).on('change', 'input[name="permissions[]"]', function () {
                let checkbox = $(this);
                let row = checkbox.closest('.row');
                if (row.length === 0) return;

                // menu checkbox update
                let menuCheckbox = row.prevAll('input[type="checkbox"]').first();
                if (menuCheckbox.length > 0) {
                    let allPermChecked = row.find('input[type="checkbox"]').length === row.find('input[type="checkbox"]:checked').length;
                    menuCheckbox.prop('checked', allPermChecked);
                }

                // parent menu update
                updateParentCheck(checkbox);

                // module update
                updateModuleCheck(checkbox.closest('.card'));
            });

            // -------- Helper Functions --------
            function updateParentCheck(element) {
                let parentDiv = element.closest('.parent_menu_' + element.closest('.row').attr('class').split(' ')[0].replace('.', ''));
                if (parentDiv.length === 0) return;

                parentDiv.each(function () {
                    let allChildChecked = $(this).find('.menu-check1').length === $(this).find('.menu-check1:checked').length;
                    $(this).closest('.mb-3.p-3').find('.parent-menu-check').prop('checked', allChildChecked);
                });
            }

            function updateModuleCheck(card) {
                let parentMenus = card.find('.parent-menu-check');
                if (parentMenus.length > 0) {
                    let allParentChecked = parentMenus.length === parentMenus.filter(':checked').length;
                    card.find('.module-check').prop('checked', allParentChecked);
                } else {
                    let normalMenus = card.find('.menu-check');
                    if (normalMenus.length > 0) {
                        let allMenuChecked = normalMenus.length === normalMenus.filter(':checked').length;
                        card.find('.module-check').prop('checked', allMenuChecked);
                    }
                }
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\resources\views\administration\authorization\role\create.blade.php ENDPATH**/ ?>