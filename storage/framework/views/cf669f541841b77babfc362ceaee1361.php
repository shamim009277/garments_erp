<?php $__env->startSection('title', 'ORDER MANAGEMENT'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
         <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'Boms',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Database', 'url' => route('ordermanagement.index')],
                    ['label' => 'Boms', 'url' => route('ordermanagement.database.boms.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Bom
                </h4>

                <!-- Search Input + Button in One Line -->
                <form action="#" method="POST" class="d-flex order-0 order-md-1 mb-2 mb-md-0 me-md-2"
                    style="max-width: 400px;" role="search">
                    <?php echo csrf_field(); ?>
                    <input class="form-control form-control-sm me-2" type="search" name="search"
                        placeholder="Order No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"><i data-feather="search"
                            width="14" height="14" class="me-1"></i> Search</button>
                </form>
                <?php if(1): ?>
                    <!-- Back Button -->
                    <a href="<?php echo e(route('ordermanagement.database.boms.index')); ?>"
                        class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2">
                        <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-2 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Basic Order
                        List</h6>
                </div>
                <div class="card-body" style="min-height: 457px;max-height: 457px; overflow-y: auto;">
                    <ul class="nav-custom">
                        <?php $__currentLoopData = $buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $buyerOrders = collect($ListOfOrders)->where('buyer_id', $buyer->id);

                            ?>
                            <li class="nav-custom-item">
                                <input type="checkbox" id="buyer<?php echo e($buyer->id); ?>">
                                <label class="nav-custom-link" for="buyer<?php echo e($buyer->id); ?>"><span
                                        class="nav-custom-caret"></span> <?php echo e($buyer->buyer_name); ?>

                                    (<?php echo e($buyerOrders->count()); ?>)</label>
                                <div class="nav-custom-content">
                                    <ul class="nav-custom">
                                        <?php $__currentLoopData = $buyerOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="nav-custom-item">
                                                <a href="<?php echo e(route('ordermanagement.database.boms.show', $order->id)); ?>">
                                                    <label class="nav-custom-link" for="order<?php echo e($order->id); ?>"><span
                                                            class="nav-custom-caret"></span> <?php echo $order->order_no; ?>: <?php echo $order->style_no; ?></label>
                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary">
                        <i data-feather="list" width="16" height="16"></i> BOM Setup List For : <?php echo e($buyerId->buyer_name); ?>

                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-4 ms-auto">
                            <input type="text" id="bom-items-search" class="form-control form-control-sm"
                                placeholder="Search items...">
                        </div>
                    </div>
                     <form action="<?php echo e(route('ordermanagement.database.boms.update', $order->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('POST'); ?>
                    <div style="height: 400px; overflow-y: auto;">
                   
                        <table id="bom-items-table" class="table nowrap w-100" >
                        <thead>
                            <tr>
                                <th style="width: 2%;">#</th>
                                <th style="width: 8%;">Item</th>
                                <th style="width: 5%;">Cons</th>
                                <th style="width: 5%;">Cons (PCS)</th>
                                <th style="width: 14%;">Cons Unit</th>
                                <th style="width: 5%;">Con Ratio</th>
                                <th style="width: 14%;">Pur Unit</th>
                                <th style="width: 5%;">Extra (%)</th>
                                <th style="width: 16%;">Supplier</th>
                                <th style="width: 14%;">Breakdown</th>
                                <th style="width: 14%;">Remarks</th>
                            </tr>
                        </thead>
                        <tbody >
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" style="display: block;" type="checkbox" name="item_ids[]" value="<?php echo e($item->id); ?>">
                                        </div>
                                    </td>
                                    <td><?php echo e($item->item_name); ?></td>
                                    <td><input type="text" name="consumption[<?php echo e($item->id); ?>]" class="form-control form-control-sm" required></td>
                                    <td><input type="text" name="consumption_pcs[<?php echo e($item->id); ?>]" class="form-control form-control-sm" required></td>
                                   <td> <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'consumption_unit_id','required' => true,'options' => $units->pluck('name', 'id'),'selected' => old('consumption_unit_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'consumption_unit_id','required' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($units->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('consumption_unit_id'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $attributes = $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $component = $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?></td>
                                    <td><input type="text" name="convert_ratio[<?php echo e($item->id); ?>]" class="form-control form-control-sm" required></td>

                                    <td> <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'unit_id','required' => true,'options' => $units->pluck('name', 'id'),'selected' => old('unit_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'unit_id','required' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($units->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('unit_id'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $attributes = $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $component = $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?></td>
                                    <td><input type="text" name="extra[<?php echo e($item->id); ?>]" class="form-control form-control-sm" required></td>
                                    <td> <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'supplier_id','required' => true,'options' => $suppliers->pluck('name', 'id'),'selected' => old('supplier_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'supplier_id','required' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suppliers->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('supplier_id'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $attributes = $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $component = $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?></td>
                                    <td> <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'breakdown_id','required' => true,'options' => [1=>'All',2=>'Color',3=>'Size',4=>'Color & Size'],'selected' => old('breakdown_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'breakdown_id','required' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([1=>'All',2=>'Color',3=>'Size',4=>'Color & Size']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('breakdown_id'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $attributes = $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2)): ?>
<?php $component = $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2; ?>
<?php unset($__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2); ?>
<?php endif; ?></td>
                                    <td><textarea name="remarks[<?php echo e($item->id); ?>]" class="form-control form-control-sm"></textarea></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-sm">Update BOM</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>


    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var searchInput = document.getElementById('bom-items-search');
            var table = document.getElementById('bom-items-table');

            if (!searchInput || !table) {
                return;
            }

            searchInput.addEventListener('keyup', function () {
                var value = this.value.toLowerCase();
                var rows = table.querySelectorAll('tbody tr');

                rows.forEach(function (row) {
                    var text = row.textContent.toLowerCase();
                    row.style.display = text.indexOf(value) > -1 ? '' : 'none';
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\OrderManagement\resources\views\database\boms\show.blade.php ENDPATH**/ ?>