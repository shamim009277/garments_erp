<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <?php
                $module = \App\Models\Administration\Module::where('is_active', 1)
                    ->where('url', $currentModule)
                    ->first();

                $menus = \App\Models\Administration\Menu::with([
                        'module' => function ($q) { $q->where('is_active', 1); },
                        'parent' => function ($q) { $q->where('is_active', 1); },
                        'permissions' => function ($q) { $q->where('is_active', 1); },
                        'childs.permissions' => function ($q) { $q->where('is_active', 1); }
                    ])
                    ->where('is_active', 1)
                    ->whereHas('module', function ($q) { $q->where('is_active', 1); })
                    ->where(function ($query) {
                        $query->whereNull('parent_id')->orWhereHas('parent', function ($q) {
                            $q->where('is_active', 1);
                        });
                    })
                    ->where('module_id', $module->id)
                    ->get();

                $userPermissions = auth()->check()
                    ? collect(auth()->user()->getAllPermissions()->pluck('name')->toArray())
                    : collect([]);
            ?>
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="<?php echo e(url($currentModule)); ?>">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if($menu->has_child == false && $menu->parent_id == null): ?>
                        <?php
                            $menuViewPerms = $menu->permissions
                                ->pluck('name')
                                ->filter(function($n) {
                                    return \Illuminate\Support\Str::endsWith($n, '.view');
                                });
                        ?>

                        <?php if($menuViewPerms->intersect($userPermissions)->isNotEmpty()): ?>
                            <li>
                                <a href="<?php echo e(url($menu->module->url . '/' . $menu->url)); ?>">
                                    <i data-feather="<?php echo e($menu->icon); ?>"></i>
                                    <span><?php echo e($menu->title); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                    
                    <?php elseif($menu->has_child == true && $menu->parent_id == null): ?>
                        <?php
                            $visibleChilds = $menu->childs->filter(function($child) use ($userPermissions) {
                                $childViewPerms = $child->permissions
                                    ->pluck('name')
                                    ->filter(function($n) {
                                        return \Illuminate\Support\Str::endsWith($n, '.view');
                                    });
                                return $childViewPerms->intersect($userPermissions)->isNotEmpty();
                            });
                        ?>

                        <?php if($visibleChilds->isNotEmpty()): ?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="<?php echo e($menu->icon); ?>"></i>
                                    <span><?php echo e($menu->title); ?> (<?php echo e($visibleChilds->count()); ?>)</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false" style="max-height: 600px;overflow-x:hidden;overflow-y:auto">
                                    <?php $__currentLoopData = $visibleChilds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(url($menu->module->url . '/' . $menu->url . '/' . $child->url)); ?>">
                                                <i data-feather="<?php echo e($child->icon); ?>"></i>
                                                <span><?php echo e($child->title); ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<?php /**PATH C:\laragon\www\garments_erp\resources\views\includes\sidebar.blade.php ENDPATH**/ ?>