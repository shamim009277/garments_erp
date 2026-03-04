<?php $__env->startSection('title', 'ORDER MANAGEMENT'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'BOM Setup',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'BOM Setup', 'url' => route('ordermanagement.setup.bomsetups.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        
         <div class="col-md-3">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary">
                        <i class="mdi mdi-list"></i> Input Parameters For New BOM Setup ...
                    </h6>
                </div>
               
                <div class="card-body">
                    <form action="<?php echo e(route('ordermanagement.setup.bomsetups.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Item</label>
                                <input type="hidden" name="buyer_id" value="<?php echo e($buyerId->id); ?>">
                                 <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'item_id','required' => true,'options' => $items->pluck('item_name', 'id'),'selected' => old('item_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'item_id','required' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($items->pluck('item_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('item_id'))]); ?>
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
                            <div class="col-md-6">
                                <label class="form-label">Consumption</label>
                                <input type="number" step="0.0001" name="consumption" class="form-control"
                                    value="<?php echo e(old('consumption')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Consumption (PCS)</label>
                                <input type="number" step="0.0001" name="consumption_pcs" class="form-control"
                                    value="<?php echo e(old('consumption_pcs')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Convert Ratio</label>
                                <input type="number" step="0.0001" name="convert_ratio" class="form-control"
                                    value="<?php echo e(old('convert_ratio')); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Consumption Unit</label>
                                <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
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
<?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Purchase Unit</label>
                                 <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
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
<?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Extra</label>
                                <input type="number" step="0.01" name="extra" class="form-control"
                                    value="<?php echo e(old('extra')); ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Supplier</label>
                                
                                 <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
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
<?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Breakdown ID</label>
                                 <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
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
<?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Create Date</label>
                                <input type="date" name="create_date" class="form-control"
                                    value="<?php echo e(date('Y-m-d')); ?>" disabled>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Remarks</label>
                                <textarea name="remarks" class="form-control" rows="2"><?php echo e(old('remarks')); ?></textarea>
                            </div>
                        </div>
                        <div class="mt-3">
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary">
                        <i data-feather="list" width="16" height="16"></i> BOM Setup List For : <?php echo e($buyerId->buyer_name); ?>

                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Consumption</th>
                                <th>Consumption (PCS)</th>
                                <th>Convert Ratio</th>
                                <th>Consumption Unit</th>
                                <th>Unit</th>
                                <th>Extra</th>
                                <th>Supplier</th>
                                <th>Breakdown</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $boms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e(optional($bom->item)->item_name); ?></td>
                                    <td><?php echo e($bom->consumption); ?></td>
                                    <td><?php echo e($bom->consumption_pcs); ?></td>
                                    <td><?php echo e($bom->convert_ratio); ?></td>
                                    <td><?php echo e(optional($bom->consumptionUnit)->name); ?></td>
                                    <td><?php echo e(optional($bom->unit)->name); ?></td>
                                    <td><?php echo e($bom->extra); ?></td>
                                    <td><?php echo e(optional($bom->supplier)->name); ?></td>
                                    <td><?php echo e($bom->breakdown_id); ?></td>
                                    <td><?php echo e($bom->remarks); ?></td>
                                    <td>
                                        <a href="#"
                                            class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal<?php echo e($bom->id); ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('ordermanagement.setup.bomsetups.destroy', $bom->id)); ?>"
                                            method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this BOM setup?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editModal<?php echo e($bom->id); ?>" tabindex="-1"
                                    aria-labelledby="editModalLabel<?php echo e($bom->id); ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel<?php echo e($bom->id); ?>">Edit BOM Setup</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo e(route('ordermanagement.setup.bomsetups.update', $bom->id)); ?>"
                                                    method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Buyer</label>
                                                            <select name="buyer_id" class="form-select">
                                                                <option value="">Select Buyer</option>
                                                                <?php $__currentLoopData = $buyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($buyer->id); ?>"
                                                                        <?php echo e($bom->buyer_id == $buyer->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($buyer->buyer_name); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Organization</label>
                                                            <select name="organization_id" class="form-select">
                                                                <option value="">Select Organization</option>
                                                                <?php $__currentLoopData = $organizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $organization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($organization->id); ?>"
                                                                        <?php echo e($bom->organization_id == $organization->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($organization->name); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Item</label>
                                                            <select name="item_id" class="form-select">
                                                                <option value="">Select Item</option>
                                                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($item->id); ?>"
                                                                        <?php echo e($bom->item_id == $item->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($item->item_name); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Consumption</label>
                                                            <input type="number" step="0.0001" name="consumption"
                                                                class="form-control"
                                                                value="<?php echo e($bom->consumption); ?>">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Consumption (PCS)</label>
                                                            <input type="number" step="0.0001" name="consumption_pcs"
                                                                class="form-control"
                                                                value="<?php echo e($bom->consumption_pcs); ?>">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Convert Ratio</label>
                                                            <input type="number" step="0.0001" name="convert_ratio"
                                                                class="form-control"
                                                                value="<?php echo e($bom->convert_ratio); ?>">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Consumption Unit</label>
                                                            <select name="consumption_unit_id" class="form-select">
                                                                <option value="">Select Unit</option>
                                                                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($unit->id); ?>"
                                                                        <?php echo e($bom->consumption_unit_id == $unit->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($unit->name); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Unit</label>
                                                            <select name="unit_id" class="form-select">
                                                                <option value="">Select Unit</option>
                                                                <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($unit->id); ?>"
                                                                        <?php echo e($bom->unit_id == $unit->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($unit->name); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Extra</label>
                                                            <input type="number" step="0.01" name="extra"
                                                                class="form-control"
                                                                value="<?php echo e($bom->extra); ?>">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Supplier</label>
                                                            <select name="supplier_id" class="form-select">
                                                                <option value="">Select Supplier</option>
                                                                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($supplier->id); ?>"
                                                                        <?php echo e($bom->supplier_id == $supplier->id ? 'selected' : ''); ?>>
                                                                        <?php echo e($supplier->name); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Breakdown ID</label>
                                                            <input type="number" name="breakdown_id" class="form-control"
                                                                value="<?php echo e($bom->breakdown_id); ?>">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Create Date</label>
                                                            <input type="date" name="create_date" class="form-control"
                                                                value="<?php echo e($bom->create_date); ?>">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">Remarks</label>
                                                            <textarea name="remarks" class="form-control" rows="2"><?php echo e($bom->remarks); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'btn-sm submitBtn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'btn-sm submitBtn']); ?>Save <?php echo $__env->renderComponent(); ?>
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
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

       
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\OrderManagement\resources\views\setup\bomsetups\show.blade.php ENDPATH**/ ?>