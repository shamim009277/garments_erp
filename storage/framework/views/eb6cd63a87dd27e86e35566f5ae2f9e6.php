<?php $__env->startSection('title', 'INVENTORY'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Purchase MRR',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Database', 'url' => route('inventory.index')],
                    ['label' => 'Purchase MRR', 'url' => route('inventory.database.gatepurmrr.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Purchase MRR
                </h4>

            </div>
        </div>
        <div class="col-md-3">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i data-feather="list" width="16" height="16"></i> 
                        <h6 class="my-0 text-primary ms-2">Purchase MRR List</h6>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="text" name="search" id="search"  class="form-control form-control-sm" placeholder="Search here...">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-12 d-flex align-items-center mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="pending" value="1" checked>
                                <label class="form-check-label" for="pending">PENDING</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="done" value="2">
                                <label class="form-check-label" for="done">DONE</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group" style="min-height: 690px; overflow-y: auto;" id="gatepurmrr-list">
                        <?php $__currentLoopData = $gatepurmrrs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gatepurmrr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item list-group-item-action p-2 border-0 pur-main" data-id="<?php echo e($gatepurmrr->id); ?>"><?php echo e($gatepurmrr->mrr_date); ?> - <?php echo e($gatepurmrr->mrr_no); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="card alert-info alert-top-border padding-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="list" width="16" height="16"></i> 
                                        <h6 class="my-0 text-primary ms-2"> Input Parameters For Purchase Mrr..</h6>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'btn-sm me-2','dataBsToggle' => 'modal','dataBsTarget' => '#addModal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'btn-sm me-2','data-bs-toggle' => 'modal','data-bs-target' => '#addModal']); ?>Add New <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalc7492c692dd0ef5b4adc5ba366482388 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7492c692dd0ef5b4adc5ba366482388 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.info-button','data' => ['class' => 'btn-sm me-2','dataBsToggle' => 'modal','dataBsTarget' => '#updateModal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('info-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'btn-sm me-2','data-bs-toggle' => 'modal','data-bs-target' => '#updateModal']); ?>Update <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7492c692dd0ef5b4adc5ba366482388)): ?>
<?php $attributes = $__attributesOriginalc7492c692dd0ef5b4adc5ba366482388; ?>
<?php unset($__attributesOriginalc7492c692dd0ef5b4adc5ba366482388); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7492c692dd0ef5b4adc5ba366482388)): ?>
<?php $component = $__componentOriginalc7492c692dd0ef5b4adc5ba366482388; ?>
<?php unset($__componentOriginalc7492c692dd0ef5b4adc5ba366482388); ?>
<?php endif; ?>
                                    <button type="button" class="btn btn-success btn-sm float-end me-2 d-none" id="done-btn">
                                        Send To QC
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm float-end me-2 d-none" id="undo-btn">
                                        Undo
                                    </button>
                                    <!-- Add Modal Start  -->
                                    
                                     <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addModalLabel">Add New Purchase Mrr</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="addFormMain" action="<?php echo e(route('inventory.database.gatepurmrrmains.store')); ?>" method="POST">
                                                    <div class="modal-body">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <th width="35%">Mrr Date</th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'mrr_date','name' => 'mrr_date','class' => 'form-control w-100','type' => 'date','readonly' => true,'value' => $today_date,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'mrr_date','name' => 'mrr_date','class' => 'form-control w-100','type' => 'date','readonly' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($today_date),'required' => true]); ?>
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
                                                                    <tr >
                                                                        <th width="35%">Gate Entry By</th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'gate_entry_by','name' => 'gate_entry_by','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => Auth::user()->name,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'gate_entry_by','name' => 'gate_entry_by','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::user()->name),'required' => true]); ?>
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
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'gate_entry_id','name' => 'gate_entry_id','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => Auth::user()->id,'hidden' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'gate_entry_id','name' => 'gate_entry_id','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::user()->id),'hidden' => true]); ?>
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
                                                                    <tr >
                                                                        <th width="35%">Received By  <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['id' => 'received_by_id','name' => 'received_by_id','options' => $users->pluck('name', 'id'),'selected' => old('received_by'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'received_by_id','name' => 'received_by_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($users->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('received_by')),'required' => true]); ?>
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
                                                                        </td>
                                                                    </tr>
                                                                    <tr >
                                                                        <th width="35%">Driver Name <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'driver_name','name' => 'driver_name','class' => 'form-control w-100','type' => 'text','value' => old('driver_name'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'driver_name','name' => 'driver_name','class' => 'form-control w-100','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('driver_name')),'required' => true]); ?>
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
                                                                    <tr >
                                                                        <th width="35%">Vehicle No</th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'vehicle_no','name' => 'vehicle_no','class' => 'form-control w-100','type' => 'text','value' => old('vehicle_no')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'vehicle_no','name' => 'vehicle_no','class' => 'form-control w-100','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('vehicle_no'))]); ?>
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
                                                                </table>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <table width="100%">
                                                                    <tr >
                                                                        <th width="35%">Organization <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'organization_id','options' => $organizations->pluck('name', 'id'),'selected' => old('organization_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'organization_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($organizations->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('organization_id')),'required' => true]); ?>
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
                                                                        </td>
                                                                    </tr>
                                                                    <tr >
                                                                        <th width="35%">Supplier <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'supplier_id','options' => $suppliers->pluck('name', 'id'),'selected' => old('supplier_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'supplier_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suppliers->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('supplier_id')),'required' => true]); ?>
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
                                                                        </td>
                                                                    </tr>
                                                                    <tr >
                                                                        <th width="35%">Act Challan No</th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'act_challan_no','name' => 'act_challan_no','class' => 'form-control w-100','type' => 'text','value' => old('act_challan_no')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'act_challan_no','name' => 'act_challan_no','class' => 'form-control w-100','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('act_challan_no'))]); ?>
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
                                                                    <tr >
                                                                        <th width="35%">Note</th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'note','name' => 'note','class' => 'form-control w-100','type' => 'text','value' => old('note')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'note','name' => 'note','class' => 'form-control w-100','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('note'))]); ?>
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
                                                                    <tr >
                                                                        <th width="35%">Upload Document</th>
                                                                        <td width="65%">
                                                                            <input id="document" name="document" class="form-control w-100" type="file"  />
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <?php echo method_field('POST'); ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'float-start btn-sm','id' => 'submitBtnMain']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'float-start btn-sm','id' => 'submitBtnMain']); ?>Save <?php echo $__env->renderComponent(); ?>
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
                                     <!-- Add Modal End -->
                                     <!-- Update Modal Start -->
                                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel">Update Purchase Requisition</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="updateFormMain" >
                                                    <div class="modal-body">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <th width="35%">Mrr Date</th>
                                                                        <td width="65%">
                                                                            <input type="hidden" id="u_mrr_id" name="u_mrr_id">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'u_mrr_date','name' => 'mrr_date','class' => 'form-control w-100','type' => 'date','readonly' => true,'value' => $today_date,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_mrr_date','name' => 'mrr_date','class' => 'form-control w-100','type' => 'date','readonly' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($today_date),'required' => true]); ?>
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
                                                                    <tr >
                                                                        <th width="35%">Gate Entry By</th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'u_gate_entry_by','name' => 'gate_entry_by','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => Auth::user()->name,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_gate_entry_by','name' => 'gate_entry_by','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::user()->name),'required' => true]); ?>
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
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'u_gate_entry_by_id','name' => 'gate_entry_by_id','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => Auth::user()->id,'hidden' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_gate_entry_by_id','name' => 'gate_entry_by_id','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::user()->id),'hidden' => true]); ?>
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
                                                                    <tr >
                                                                        <th width="35%">Received By</th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'u_received_by','name' => 'received_by','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => Auth::user()->name,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_received_by','name' => 'received_by','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::user()->name),'required' => true]); ?>
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
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'u_received_by_id','name' => 'received_by_id','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => Auth::user()->id,'hidden' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_received_by_id','name' => 'received_by_id','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::user()->id),'hidden' => true]); ?>
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
                                                                    <tr >
                                                                        <th width="35%">Vehicle No <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'u_vehicle_no','name' => 'vehicle_no','class' => 'form-control w-100','type' => 'text','value' => old('vehicle_no'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_vehicle_no','name' => 'vehicle_no','class' => 'form-control w-100','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('vehicle_no')),'required' => true]); ?>
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
                                                                    <tr >
                                                                        <th width="35%">Driver Name <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'u_driver_name','name' => 'driver_name','class' => 'form-control w-100','type' => 'text','value' => old('driver_name'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_driver_name','name' => 'driver_name','class' => 'form-control w-100','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('driver_name')),'required' => true]); ?>
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
                                                                </table>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <table width="100%">
                                                                    <tr >
                                                                        <th width="35%">Organization <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['id' => 'u_organization_id','name' => 'organization_id','options' => $organizations->pluck('name', 'id'),'selected' => old('organization_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_organization_id','name' => 'organization_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($organizations->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('organization_id')),'required' => true]); ?>
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
                                                                    <tr >
                                                                        <th width="35%">Supplier <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['id' => 'u_supplier_id','name' => 'supplier_id','options' => $suppliers->pluck('name', 'id'),'selected' => old('supplier_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_supplier_id','name' => 'supplier_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suppliers->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('supplier_id')),'required' => true]); ?>
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
                                                                    <tr >
                                                                        <th width="35%">Act Challan No</th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'u_act_challan_no','name' => 'act_challan_no','class' => 'form-control w-100','type' => 'text','value' => old('act_challan_no')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_act_challan_no','name' => 'act_challan_no','class' => 'form-control w-100','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('act_challan_no'))]); ?>
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
                                                                    <tr >
                                                                        <th width="35%">Note</th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'u_note','name' => 'note','class' => 'form-control w-100','type' => 'text','value' => old('note')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_note','name' => 'note','class' => 'form-control w-100','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('note'))]); ?>
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
                                                                     <tr >
                                                                        <th width="35%">Upload Document</th>
                                                                        <td width="65%">
                                                                            <input id="u-document" name="document" class="form-control w-100" type="file"  />
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'float-start btn-sm','id' => 'submitBtnUpdateMain']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'float-start btn-sm','id' => 'submitBtnUpdateMain']); ?>Save <?php echo $__env->renderComponent(); ?>
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
                                     <!-- Update Modal End -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6"> 
                                    <table width="100%">
                                        <tr>
                                            <th width="35%">Mrr No</th>
                                            <td width="65%">
                                                <input type="hidden" id="mrr_no">
                                                :<span id="mrr_no-txt"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="35%">Mrr Date</th>
                                            <td width="65%">
                                                :<span id="mrr_date-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Gate Entry By</th>
                                            <td width="65%">
                                                :<span id="gate_entry_by-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Received By</th>
                                            <td width="65%">
                                                :<span id="received_by-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Vehicle No</th>
                                            <td width="65%">
                                                :<span id="vehicle_no-txt"></span>
                                                
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Driver Name</th>
                                            <td width="65%">
                                                :<span id="driver_name-txt"></span>
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <table width="100%">
                                        <tr >
                                            <th width="35%">Organization</th>
                                            <td width="65%">
                                                :<span id="organization-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Supplier</th>
                                            <td width="65%">
                                                :<span id="supplier-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Act Challan No</th>
                                            <td width="65%">
                                                :<span id="act_challan_no-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Note</th>
                                            <td width="65%">
                                                :<span id="note-txt"></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card alert-info alert-top-border padding-card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="list" width="16" height="16"></i> 
                                        <h6 class="my-0 text-primary ms-2"> Item Entry Lists..</h6>
                                    </div>
                                    <br>
                                    <select name="item_id" class="form-control form-control-sm w-100 w-sm-50" id="search_data"  placeholder="Select Item">
                                        <option value="">Select Item</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="min-height: 385px;">
                            <table class="table table-bordered dt-responsive  nowrap w-100 text-center p-2" width="100%">
                                <thead>
                                    <tr class="p-0">
                                        <th width="5%">#SL</th>
                                        <th width="20%">Name</th>
                                        <th width="10%">Req Quantity</th>
                                        <th width="10%">Remain Quantity</th>
                                        <th width="10%">Unit</th>
                                        <th width="10%">Receive Quantity</th>
                                        <th width="10%">Note</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="item-row">
                                   
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card alert-info alert-top-border padding-card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i data-feather="list" width="16" height="16"></i> 
                                <h6 class="my-0 text-primary ms-2">Received Item Lists..</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="min-height: 385px;">
                    <table class="table table-bordered dt-responsive  nowrap w-100 text-center p-2" width="100%">
                        <thead>
                            <tr class="p-0">
                                <th width="5%">#SL</th>
                                <th width="20%">Req No</th>
                                <th width="20%">Name</th>
                                <th width="10%">Req Qty</th>
                                <th width="10%">Unit</th>
                                <th width="10%">Receive Qty</th>
                                <th width="10%">Note</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="detail-item-row">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {


            (function(){
                $('#mrr_no').val('');
                $('#u_mrr_id').val('');
                $('#u_mrr_date').val('');
                $('#u_gate_entry_by').val('');
                $('#u_gate_entry_by_id').val('');
                $('#u_received_by').val('');
                $('#u_received_by_id').val('');
                $('#u_organization_id').val('');
                $('#u_supplier_id').val('');
                $('#u_act_challan_no').val('');
                $('#u_note').val('');
                $('#search_data').val('');
                $('#item-row').html('');
                $('input[name="status"][value="1"]').prop('checked', true);
            })()


            function updateItem(id){
                let received_qty = $('#receive_qty_'+id).val();
                let note = $('#note_'+id).val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gatepurmrrdetails')); ?>/"+id,
                    data: {
                        received_qty: received_qty,
                        note: note,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        $('#receive_qty_'+id).val(Number(data.message.received_qty).toFixed(2));
                        $('#note_'+id).val(data.message.note);
                        toastr.success('Item updated successfully');
                    },
                    error: function(data) {
                        console.log(data);
                        toastr.error('Something went wrong!');
                    }
                });
            }

            function removeItem(id){
                $.ajax({
                    type: 'DELETE',
                    url: "<?php echo e(url('inventory/database/gatepurmrrdetails')); ?>"+"/"+id,
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        $('#detail-item-row-'+id).remove();
                        toastr.success('Item removed successfully');
                    },
                    error: function(data) {
                        console.log(data);
                        toastr.error('Something went wrong!');
                    }
                });
            }

            function getMrrMain(id){
                $.ajax({
                    type: 'GET',
                    url: "<?php echo e(url('inventory/database/gatepurmrrmains')); ?>/"+id,
                    success: function(data) {
                        console.log(data);
                        mainData = data.reqMain;
                        detailsData = data.reqDetails;
                        $('#mrr_no-txt').text(mainData.mrr_no);
                            $('#mrr_no').val(mainData.mrr_no);
                            $('#mrr_date-txt').text(mainData.mrr_date);
                            $('#gate_entry_by-txt').text(mainData.gate_entry.name);
                            $('#received_by-txt').text(mainData.received_by.name);
                            $('#vehicle_no-txt').text(mainData.vehicle_no);
                            $('#driver_name-txt').text(mainData.driver_name);
                            $('#organization-txt').text(mainData.organization.name);
                            $('#supplier-txt').text(mainData.supplier.name);
                            $('#act_challan_no-txt').text(mainData.act_challan_no);
                            $('#note-txt').text(mainData.note);
                           
                            $('#u_mrr_id').val(mainData.id);
                            $('#u_mrr_date').val(mainData.mrr_date);
                            $('#u_gate_entry_by').val(mainData.gate_entry.name);
                            $('#u_gate_entry_by_id').val(mainData.gate_entry_id);
                            $('#u_received_by').val(mainData.received_by.name);
                            $('#u_received_by_id').val(mainData.received_by_id);
                            $('#u_vehicle_no').val(mainData.vehicle_no);
                            $('#u_driver_name').val(mainData.driver_name);
                            $('#u_act_challan_no').val(mainData.act_challan_no);
                            $('#u_supplier_id').val(mainData.supplier_id);
                            $('#u_organization_id').val(mainData.organization_id);
                            $('#u_note').val(mainData.note);
                            

                            $('#search_data').val('').trigger('change');
                            if(mainData.is_done == 1){
                                if(mainData.is_qa_checked == 1){
                                    $('#done-btn').addClass('d-none');
                                    $('#undo-btn').addClass('d-none');
                                }else{
                                    $('#done-btn').addClass('d-none');
                                    $('#undo-btn').removeClass('d-none');
                                }
                            }else{
                                $('#done-btn').removeClass('d-none');
                                $('#undo-btn').addClass('d-none');
                            }
                        
                        $('#detail-item-row').html('');

                        $.each(detailsData, function(key, x) {
                            let btnElement =( mainData.is_done == 1) ? "N\\A" :`<button type="button" data-id="${x.id}"   class="btn btn-info btn-sm p-1 update-item">Update</button>
                                        <button type="button" data-id="${x.id}"   class="btn btn-danger btn-sm p-1 remove-item">Remove</button>
                                    `;
                            $('#detail-item-row').append(`
                                <tr class="p-0" id="detail-item-row-${x.id}">
                                    <td width="5%">#</td>
                                    <td width="20%">${x.req_main.requisition_no}</td>
                                    <td width="20%">${x.item.item_name}</td>
                                    <td width="10%">${x.req_qty}</td>
                                    <td width="10%">${x.req_unit.name}</td>
                                    <td width="10%">
                                        <input type="text" class="form-control form-control-sm" id="receive_qty_${x.id}" name="" value="${x.received_qty}">
                                    </td>
                                    <td width="10%">
                                        <input type="text" class="form-control form-control-sm" id="note_${x.id}" name="" value="${x.note != null ? x.note: "" }">
                                    </td>
                                    <td width="10%">
                                        ${btnElement}
                                    </td>
                                </tr>
                                `);
                        });

                        $('.update-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            updateItem(id);
                        });

                        $('.remove-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            removeItem(id);
                        });
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }

            $('.pur-main').off('click').on('click', function() {
                let id = $(this).data('id');
                $(".pur-main").removeClass("active");
                $(this).addClass("active");
                getMrrMain(id);
            });

            function searchGatePurMrr(match, search) {
                let reqNo = $('#mrr_no').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(route('inventory.database.gatepurmrrmains.search')); ?>",
                    data: {
                        search: search,
                        match: match,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        $('#gatepurmrr-list').empty();
                        if(data.length == 0) {
                            $('#gatepurmrr-list').append('<li class="list-group-item list-group-item-action p-2 border-0 text-center">No Data Found</li>');
                        }else{
                            $.each(data, function(key, value) {
                                $('#gatepurmrr-list').append(`<li class="list-group-item list-group-item-action p-2 border-0 pur-main ${reqNo == value.mrr_no ? 'active' : ''}" data-id="${value.id}">${value.mrr_date} - ${value.mrr_no}</li>`);
                            });
                        }
                        $('.pur-main').off('click').on('click', function() {
                            let id = $(this).data('id');
                            $(".pur-main").removeClass("active");
                            $(this).addClass("active");
                            getMrrMain(id);
                        });
                        // $('#search_data').html(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }

            $('#search').on('keyup', function() {
                let search = $(this).val();
                if(search.length >= 3 && search != '' && search != null) {
                    searchGatePurMrr(3, search);
                }else{
                    let match = $('input[name="status"]:checked').val();
                    searchGatePurMrr(match, search);
                }
            });


            $('input[name="status"]').off('change').on('change', function() {
                let match = $('input[name="status"]:checked').val();
                searchGatePurMrr(match, '');
            }); 

            $('#search_data').select2({
                    placeholder: 'Search for a Requisition',
                    minimumInputLength: 2,
                    ajax: {
                        type: 'PUT',
                        url: "<?php echo e(route('inventory.database.gatepurmrr.search')); ?>",
                        dataType: 'json',
                        delay: 250,
                        cache: true,
                        data: function (params) {
                            return {
                                search: params.term,
                                mrr_id : $('#u_mrr_id').val(),
                                type:'search',
                                // match: $('input[name="match"]:checked').val(),
                                _token: "<?php echo e(csrf_token()); ?>"
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data.map(item => ({
                                    id: item.id,
                                    text: item.requisition_no,
                                }))
                            };
                        }
                    },
                    templateResult: function (data) {
                        if (!data.id) return data.text;
                        return $(`
                            <div>
                                <strong>${data.text}</strong>
                            </div>
                        `);
                    },

                    templateSelection: function (data) {
                        if (!data.id) return data.text;
                        return `${data.text}`;
                    }
            });

            $('#search_data').on('select2:select', function() {
                let itemId = $(this).val();
                let mrr_id = $('#u_mrr_id').val();
                console.log(itemId, mrr_id);
                $('#item-row').html('');
                if(mrr_id == '') {
                    $('#search_data').val('').trigger('change');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Please select a Mrr number!',
                    });
                    return;
                }
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gatepurmrr/reqmains')); ?>",
                    data: {
                        id: itemId,
                        mrr_id: mrr_id,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        $.each(data.reqDetails, function(key, x) {
                            if(x.is_rejected == 1 || x.pur_stage == 2){
                                
                            }else{

                                $('#item-row').append(`
                                    <tr class="p-0" id="item-row-${x.item_id}">
                                        <td width="5%">${key + 1}</td>
                                        <td width="20%">${x.item.item_name}</td>
                                        <td width="10%">${x.final_app_qty}</td>
                                        <td width="10%">${x.remain_qty}</td>
                                        <td width="10%">${x.pur_unit.name}</td>
                                        <td width="10%">
                                            <input type="text" class="form-control form-control-sm is-invalid updt-enbl" data-pur-detail-id="${x.id}" data-id="${x.item_id}" id="receive_qty_${x.item_id}" name="" value="0">
                                        </td>
                                        <td width="10%">
                                            <input type="text" class="form-control form-control-sm" id="note_${x.item_id}" name="" value="">
                                        </td>
                                        <td width="10%">
                                            <button type="button" data-id="${x.item_id}"  id="update-item-${x.item_id}" class="btn btn-info btn-sm p-1 receive-item">Receive</button>
                                        </td>
                                    </tr>
                                    `);
                            }
                        
                    });

                    $('.updt-enbl').off('change').on('change', function() {
                        let id = $(this).data('id');
                        let value = $(this).val();
                        if(value == '' || value == null || value == undefined || value == 0 || value <= 0){
                            $(this).removeClass('is-valid');
                            $(this).addClass('is-invalid');
                        }else{
                            $(this).removeClass('is-invalid');
                            $(this).addClass('is-valid');
                        }
                    });


                    $('.receive-item').off('click').on('click', function() {
                        let itemId = $(this).data('id');
                        receiveItem(itemId);
                    });

                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });

            function receiveItem(itemId) {
                let mrrId = $('#u_mrr_id').val();
                if(mrrId == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Please select a requisition number!',
                    });
                    return;
                }
                let receiveQty = $('#receive_qty_' + itemId).val();
                if(receiveQty == '' || receiveQty == null || receiveQty == undefined || receiveQty == 0 || receiveQty <= 0){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Please enter a valid quantity!',
                    });
                    return;
                }
                let note = $('#note_' + itemId).val();
                let reqMainId = $('#search_data').val();
                let reqDetailId = $('#receive_qty_' + itemId).data('pur-detail-id');
                console.log(itemId, mrrId, receiveQty, note, reqMainId, reqDetailId);
                $.ajax({
                    type: 'POST',
                    url: "<?php echo e(route('inventory.database.gatepurmrrdetails.store')); ?>",
                    data: {
                        mrr_id: mrrId,
                        item_id: itemId,
                        received_qty: receiveQty,
                        note: note,
                        req_main_id: reqMainId,
                        req_detail_id: reqDetailId,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        if(data.success == false){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error...',
                                text: data.message,
                            });
                            return;   
                        }
                        $('#item-row-' + itemId).remove();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success...',
                            text: 'Item received successfully!',
                        });
                        let x = data.message;
                        $('#detail-item-row').append(`
                         <tr class="p-0" id="detail-item-row-${x.id}">
                            <td width="5%">#</td>
                            <td width="20%">${x.req_main.requisition_no}</td>
                            <td width="20%">${x.item.item_name}</td>
                            <td width="10%">${x.req_qty}</td>
                            <td width="10%">${x.req_unit.name}</td>
                            <td width="10%">
                                <input type="text" class="form-control form-control-sm" id="receive_qty_${x.id}" name="" value="${x.received_qty}">
                            </td>
                            <td width="10%">
                                <input type="text" class="form-control form-control-sm" id="note_${x.id}" name="" value="${x.note != null ? x.note: "" }">
                            </td>
                            <td width="10%">
                                <button type="button" data-id="${x.id}"   class="btn btn-info btn-sm p-1 update-item">Update</button>
                                <button type="button" data-id="${x.id}"   class="btn btn-danger btn-sm p-1 remove-item">Remove</button>
                            </td>
                        </tr>
                        `);

                        $('.update-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            updateItem(id);
                        });

                        $('.remove-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            removeItem(id);
                        });
                    },
                    error: function(data) {
                        console.log(data);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error...',
                            text: 'Item received failed!',
                        });
                    }
                });
            }


            $("#done-btn").off('click').on('click',function() {
                let req_id = $('#u_mrr_id').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gatepurmrrmains/multiplestatus')); ?>/"+req_id,
                    data: {
                        is_done: 1,
                        done_by: "<?php echo e(Auth::user()->id); ?>",
                        done_date: "<?php echo e(date('Y-m-d')); ?>",
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        getMrrMain(req_id);
                        searchGatePurMrr(2, '');
                        $('input[name="status"][value="2"]').prop('checked', true);
                        $('input[name="status"][value="1"]').prop('checked', false);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })

            $("#undo-btn").off('click').on('click',function() {
                let req_id = $('#u_mrr_id').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gatepurmrrmains/multiplestatus')); ?>/"+req_id,
                    data: {
                        is_done: 0,
                        done_by: "",
                        done_date: "",
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        getMrrMain(req_id);
                        searchGatePurMrr(1, '');
                        $('input[name="status"][value="1"]').prop('checked', true);
                        $('input[name="status"][value="2"]').prop('checked', false);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })
            
            $('#addFormMain').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                submitBtnMain.disabled = true;
                submitBtnMain.innerHTML = 'Saving...';
                $.ajax({
                    url: '<?php echo e(route('inventory.database.gatepurmrrmains.store')); ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('#addModal').modal('hide');
                            $('#addFormMain')[0].reset();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success...',
                                text: response.message,
                            });
                            console.log(response.data);

                            $('#mrr_no-txt').text(response.data.mrr_no);
                            $('#mrr_no').val(response.data.mrr_no);
                            $('#mrr_date-txt').text(response.data.mrr_date);
                            $('#gate_entry_by-txt').text(response.data.gate_entry.name);
                            $('#received_by-txt').text(response.data.received_by.name);
                            $('#vehicle_no-txt').text(response.data.vehicle_no);
                            $('#driver_name-txt').text(response.data.driver_name);
                            $('#organization-txt').text(response.data.organization.name);
                            $('#supplier-txt').text(response.data.supplier.name);
                            $('#act_challan_no-txt').text(response.data.act_challan_no);
                            $('#note-txt').text(response.data.note);
                           
                            $('#u_mrr_id').val(response.data.id);
                            $('#u_mrr_date').val(response.data.mrr_date);
                            $('#u_gate_entry_by_id').val(response.data.gate_entry_id);
                            $('#u_received_by_id').val(response.data.received_by_id);
                            $('#u_vehicle_no').val(response.data.vehicle_no);
                            $('#u_driver_name').val(response.data.driver_name);
                            $('#u_act_challan_no').val(response.data.act_challan_no);
                            $('#u_supplier_id').val(response.data.supplier_id);
                            $('#u_organization_id').val(response.data.organization_id);
                            $('#u_note').val(response.data.note);
                            searchGatePurMrr(1, '');

                            if(response.data.is_done == 1){
                                $('#done-btn').addClass('d-none');
                                $('#undo-btn').removeClass('d-none');
                            }else{
                                $('#done-btn').removeClass('d-none');
                                $('#undo-btn').addClass('d-none');
                            }
                            
                            // $('#purrequisitionList').DataTable().ajax.reload();
                        } else {
                                Swal.fire({
                                icon: 'error',
                                title: 'Error...',
                                text: response.message,
                            });
                        }
                        submitBtnMain.disabled = false;
                        submitBtnMain.innerHTML = 'Save';
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error...',
                            text: response.responseJSON.message,
                        });
                        submitBtnMain.disabled = false;
                        submitBtnMain.innerHTML = 'Save';
                    }
                });
            });


            $('#updateFormMain').on('submit', function(e) {
                e.preventDefault();
                let id = $('#u_mrr_id').val();
                let mrrDate = $('#u_mrr_date').val();
                let gateEntryById = $('#u_gate_entry_by_id').val();
                let receivedById = $('#u_received_by_id').val();
                let vehicleNo = $('#u_vehicle_no').val();
                let driverName = $('#u_driver_name').val();
                let actChallanNo = $('#u_act_challan_no').val();
                let supplierId = $('#u_supplier_id').val();
                let organizationId = $('#u_organization_id').val();
                let note = $('#u_note').val();
                submitBtnUpdateMain.disabled = true;
                submitBtnUpdateMain.innerHTML = 'Updating...';
                if ($('#u-document')[0].files.length > 0) {
                    const formData = new FormData();
                    formData.append('document', $('#u-document')[0].files[0]);
                    formData.append('_token', '<?php echo e(csrf_token()); ?>');
                    // Send via AJAX
                     $.ajax({
                    url: '<?php echo e(url('inventory/database/gatepurmrrmains/document-update')); ?>/'+id,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(response) {
                       console.log(response);
                    }
                });
                } else {
                    console.log('No file selected');
                }
                $.ajax({
                    url: '<?php echo e(url('inventory/database/gatepurmrrmains')); ?>/'+id,
                    type: 'PUT',
                    data: {
                        id: id,
                        mrr_date: mrrDate,
                        gate_entry_id: gateEntryById,
                        received_by_id: receivedById,
                        vehicle_no: vehicleNo,
                        driver_name: driverName,
                        act_challan_no: actChallanNo,
                        supplier_id: supplierId,
                        organization_id: organizationId,
                        note: note,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#updateModal').modal('hide');
                            $('#updateFormMain')[0].reset();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success...',
                                text: response.message,
                            });
                            console.log(response.data);
                            $('#mrr_no-txt').text(response.data.mrr_no);
                            $('#mrr_no').val(response.data.mrr_no);
                            $('#mrr_date-txt').text(response.data.mrr_date);
                            $('#gate_entry_by-txt').text(response.data.gate_entry.name);
                            $('#received_by-txt').text(response.data.received_by.name);
                            $('#vehicle_no-txt').text(response.data.vehicle_no);
                            $('#driver_name-txt').text(response.data.driver_name);
                            $('#organization-txt').text(response.data.organization.name);
                            $('#supplier-txt').text(response.data.supplier.name);
                            $('#act_challan_no-txt').text(response.data.act_challan_no);
                            $('#note-txt').text(response.data.note);
                           
                            $('#u_mrr_id').val(response.data.id);
                            $('#u_mrr_date').val(response.data.mrr_date);
                            $('#u_gate_entry_by_id').val(response.data.gate_entry_id);
                            $('#u_received_by_id').val(response.data.received_by_id);
                            $('#u_vehicle_no').val(response.data.vehicle_no);
                            $('#u_driver_name').val(response.data.driver_name);
                            $('#u_act_challan_no').val(response.data.act_challan_no);
                            $('#u_supplier_id').val(response.data.supplier_id);
                            $('#u_organization_id').val(response.data.organization_id);
                            $('#u_note').val(response.data.note);
                            // $('#purrequisitionList').DataTable().ajax.reload();
                        } else {
                                Swal.fire({
                                icon: 'error',
                                title: 'Error...',
                                text: response.message,
                            });
                        }
                        submitBtnUpdateMain.disabled = false;
                        submitBtnUpdateMain.innerHTML = 'Update';
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error...',
                            text: response.responseJSON.message,
                        });
                        submitBtnUpdateMain.disabled = false;
                        submitBtnUpdateMain.innerHTML = 'Update';
                    }
                });
            });

            
        });

       
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\Inventory\resources\views\database\gatepurmrr\index.blade.php ENDPATH**/ ?>