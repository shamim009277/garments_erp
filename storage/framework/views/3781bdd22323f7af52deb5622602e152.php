<?php $__env->startSection('title', 'INVENTORY'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'INVENTORY',
                'subtitle' => 'Gate Out Challan',
                'breadcrumbs' => [
                    ['label' => 'INVENTORY', 'url' => route('inventory.index')],
                    ['label' => 'Database', 'url' => route('inventory.index')],
                    ['label' => 'Gate Out Challan', 'url' => route('inventory.database.gateoutchallans.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Gate Out Challan
                </h4>

            </div>
        </div>
        <div class="col-md-3">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <i data-feather="list" width="16" height="16"></i> 
                        <h6 class="my-0 text-primary ms-2">Gate Out Challan List</h6>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-5 d-flex align-items-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="pending" value="1" checked>
                                <label class="form-check-label" for="pending">PENDING</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="done" value="2">
                                <label class="form-check-label" for="done">DONE</label>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="input-group">
                                <input type="text" name="search" id="search"  class="form-control form-control-sm" placeholder="Search here...">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group" style="min-height: 650px; overflow-y: auto;" id="purrequisition-list">
                        <?php $__currentLoopData = $gateoutchallans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateoutchallan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item list-group-item-action p-2 border-0 pur-main" data-id="<?php echo e($gateoutchallan->id); ?>"><?php echo e($gateoutchallan->challan_date); ?> - <?php echo e($gateoutchallan->challan_no); ?></li>
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
                                        <h6 class="my-0 text-primary ms-2"> Input Parameters For Gate Out Challan..</h6>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'btn-sm me-2','id' => 'addBtn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'btn-sm me-2','id' => 'addBtn']); ?>Add New <?php echo $__env->renderComponent(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.info-button','data' => ['class' => 'btn-sm me-2','id' => 'updateBtn']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('info-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'btn-sm me-2','id' => 'updateBtn']); ?>Update <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7492c692dd0ef5b4adc5ba366482388)): ?>
<?php $attributes = $__attributesOriginalc7492c692dd0ef5b4adc5ba366482388; ?>
<?php unset($__attributesOriginalc7492c692dd0ef5b4adc5ba366482388); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7492c692dd0ef5b4adc5ba366482388)): ?>
<?php $component = $__componentOriginalc7492c692dd0ef5b4adc5ba366482388; ?>
<?php unset($__componentOriginalc7492c692dd0ef5b4adc5ba366482388); ?>
<?php endif; ?>
                                    <button type="button" class="btn btn-sm btn-danger me-2 float-end" id="deleteBtn">
                                        <i data-feather="trash-2" width="14" height="14"></i> Delete
                                    </button>
                                    <a type="button" class="btn btn-sm btn-success me-2 float-end" href="" target="_blank" id="printgtBtn">
                                        <i data-feather="printer" width="14" height="14"></i> Gate Pass Print
                                    </a>
                                    <a type="button" class="btn btn-sm btn-secondary me-2 float-end" href="" target="_blank" id="printchBtn">
                                        <i data-feather="printer" width="14" height="14"></i> Challan Print
                                    </a>
                                     <!-- Add Modal Start  -->
                                    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addModalLabel">Add New Gate Out Challan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="addFormMain" action="<?php echo e(route('inventory.database.gateoutchallanmains.store')); ?>" method="POST">
                                                    <div class="modal-body">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <th width="35%">Challan Date</th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'challan_date','name' => 'challan_date','class' => 'form-control w-100','type' => 'date','readonly' => true,'value' => $today_date,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'challan_date','name' => 'challan_date','class' => 'form-control w-100','type' => 'date','readonly' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($today_date),'required' => true]); ?>
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
                                                                        <th width="35%">Challan By</th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'challan_by','name' => 'challan_by','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => Auth::user()->name,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'challan_by','name' => 'challan_by','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::user()->name),'required' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'challan_by_id','name' => 'challan_by_id','class' => 'form-control w-100','type' => 'text','value' => Auth::user()->id,'hidden' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'challan_by_id','name' => 'challan_by_id','class' => 'form-control w-100','type' => 'text','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Auth::user()->id),'hidden' => true]); ?>
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
                                                                        <th width="35%">Purpose of Challan <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['id' => 'purpose_id','name' => 'purpose_id','options' => $challanpurposes->pluck('purpose_name', 'id'),'selected' => old('purpose_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'purpose_id','name' => 'purpose_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($challanpurposes->pluck('purpose_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('purpose_id')),'required' => true]); ?>
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
                                                                </table>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <table width="100%">
                                                                    <tr >
                                                                        <th width="35%">Organization <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'org_id','options' => $organizations->pluck('name', 'id'),'selected' => old('org_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'org_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($organizations->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('org_id')),'required' => true]); ?>
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
                                                                        <th width="35%">Store <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'store_id','options' => $store_locations->pluck('name', 'id'),'selected' => old('store_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'store_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($store_locations->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('store_id')),'required' => true]); ?>
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
                                                                        <th width="35%">Party <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'party_id','options' => $suppliers->pluck('name', 'id'),'selected' => old('party_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'party_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suppliers->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('party_id')),'required' => true]); ?>
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
                                                                </table>
                                                            </div>
                                                        </div>
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
                                                    <h5 class="modal-title" id="updateModalLabel">Update Gate Out Challan</h5>
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
                                                                        <th width="35%">Challan Date</th>
                                                                        <td width="65%">
                                                                            <input type="hidden" id="u_challan_id" name="u_challan_id">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'u_challan_date','name' => 'u_challan_date','class' => 'form-control w-100','type' => 'date','readonly' => true,'value' => old('challan_date'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_challan_date','name' => 'u_challan_date','class' => 'form-control w-100','type' => 'date','readonly' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('challan_date')),'required' => true]); ?>
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
                                                                        <th width="35%">Challan By</th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'u_challan_by','name' => 'challan_by','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => old('challan_by'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_challan_by','name' => 'challan_by','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('challan_by')),'required' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'u_challan_by_id','name' => 'challan_by_id','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => old('challan_by_id'),'hidden' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_challan_by_id','name' => 'challan_by_id','class' => 'form-control w-100','type' => 'text','readonly' => true,'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('challan_by_id')),'hidden' => true]); ?>
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
                                                                        <th width="35%">Purpose of Challan <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['id' => 'u_purpose_id','name' => 'purpose_id','options' => $challanpurposes->pluck('purpose_name', 'id'),'selected' => old('purpose_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_purpose_id','name' => 'purpose_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($challanpurposes->pluck('purpose_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('purpose_id')),'required' => true]); ?>
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
                                                                </table>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <table width="100%">
                                                                    <tr >
                                                                        <th width="35%">Organization <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['id' => 'u_org_id','name' => 'org_id','options' => $organizations->pluck('name', 'id'),'selected' => old('org_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_org_id','name' => 'org_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($organizations->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('org_id')),'required' => true]); ?>
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
                                                                        <th width="35%">Store <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['id' => 'u_store_id','name' => 'store_id','options' => $store_locations->pluck('name', 'id'),'selected' => old('store_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_store_id','name' => 'store_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($store_locations->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('store_id')),'required' => true]); ?>
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
                                                                        <th width="35%">Party <span style="color: red">*</span></th>
                                                                        <td width="65%">
                                                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['id' => 'u_party_id','name' => 'party_id','options' => $suppliers->pluck('name', 'id'),'selected' => old('party_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'u_party_id','name' => 'party_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suppliers->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('party_id')),'required' => true]); ?>
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
                                            <th width="35%">Challan No</th>
                                            <td width="65%">
                                                <input type="hidden" id="challan_no">
                                                :<span id="challan_no-txt"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="35%">Challan Date</th>
                                            <td width="65%">
                                                :<span id="challan_date-txt"></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="35%">Challan By</th>
                                            <td width="65%">
                                                :<span id="challan_by-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Purpose of Challan <span style="color: red">*</span></th>
                                            <td width="65%">
                                                :<span id="purpose-txt"></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <table width="100%">
                                        <tr >
                                            <th width="35%">Organization <span style="color: red">*</span></th>
                                            <td width="65%">
                                                :<span id="organization-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Store <span style="color: red">*</span></th>
                                            <td width="65%">
                                                :<span id="store-txt"></span>
                                            </td>
                                        </tr>
                                        <tr >
                                            <th width="35%">Party <span style="color: red">*</span></th>
                                            <td width="65%">
                                                :<span id="party-txt"></span>
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
                                        <th width="10%">Unit</th>
                                        <th width="10%">Challan Unit</th>
                                        <th width="10%">Quantity</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="item-row">
                                   
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-success btn-sm float-end me-2 d-none" id="done-btn">
                                Done
                            </button>
                            <button type="button" class="btn btn-danger btn-sm float-end me-2 d-none" id="undo-btn">
                                Undo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {


            (function(){
                $('#u_challan_id').val('');
                $('#u_challan_date').val('');
                $('#u_challan_by').val('');
                $('#u_challan_by_id').val('');
                $('#u_purpose_id').val('');
                $('#u_org_id').val('');
                $('#u_store_id').val('');
                $('#u_party_id').val('');
                $('#u_note').val('');
                $('#item-row').html('');
                $('input[name="status"][value="1"]').prop('checked', true);
            })()

            // load Data
            function getChallanMain(id){
                $.ajax({
                    type: 'GET',
                    url: "<?php echo e(url('inventory/database/gateoutchallanmains')); ?>/"+id,
                    success: function(data) {
                        console.log(data);
                        mainData = data.challanMain;
                        detailsData = data.challanDetails;

                        $('#challan_no').val(mainData.challan_no);
                        $('#challan_no-txt').text(mainData.challan_no);
                        $('#challan_date-txt').text(mainData.challan_date);
                        $('#challan_by-txt').text(mainData.challan_by.name);
                        $('#purpose-txt').text(mainData.purpose.purpose_name);
                        $('#organization-txt').text(mainData.organization.name);
                        $('#store-txt').text(mainData.store.name);
                        $('#party-txt').text(mainData.party.name);
                        $('#note-txt').text(mainData.note);

                        $('#u_challan_id').val(mainData.id);
                        $('#u_challan_date').val(mainData.challan_date);
                        $('#u_challan_by').val(mainData.challan_by.name);
                        $('#u_challan_by_id').val(mainData.challan_by_id);
                        $('#u_purpose_id').val(mainData.purpose_id);
                        $('#u_org_id').val(mainData.org_id);
                        $('#u_store_id').val(mainData.store_id);
                        $('#u_party_id').val(mainData.party_id);
                        $('#u_note').val(mainData.note);
                        $('#printgtBtn').attr('href', "<?php echo e(url('inventory/database/gateoutchallanmains/gtpdf')); ?>/"+id);
                        $('#printchBtn').attr('href', "<?php echo e(url('inventory/database/gateoutchallanmains/chpdf')); ?>/"+id);
                        
                        if(mainData.is_done == 1){
                            $('#done-btn').addClass('d-none');
                            if(mainData.is_approved == 1){
                                $('#undo-btn').addClass('d-none');
                            }else{
                                $('#undo-btn').removeClass('d-none');
                            }
                        }else{
                            $('#done-btn').removeClass('d-none');
                            $('#undo-btn').addClass('d-none');
                        }
                        
                        
                        $('#item-row').html('');
                        $.each(detailsData, function(key, value) {
                            let unit = data.units.find(u => u.id == value.item.unit_id);
                            let pur_units = data.units.filter(u => u.unit_standards == unit.unit_standards);
                            console.log(pur_units);
                            let element = '';
                            if(mainData.is_done == 1){
                                element = 'N\\A';
                                if(value.is_rejected == 1){
                                    element = 'Rejected';
                                }
                            }else{
                                element = `<button type="button" data-id="${value.id}" id="update-item-${value.id}" class="btn btn-info btn-sm p-1 update-item">Update</button>
                                        <button type="button" data-id="${value.id}" id="remove-item-${value.id}" class="btn btn-danger btn-sm p-1 remove-item">Remove</button>`;
                            }
                                $('#item-row').append(`
                                <tr id="item-row-${value.id}">
                                    <td>${key + 1}</td>
                                    <td>${value.item.item_name}</td>
                                    <td>${value.item.unit.name}</td>
                                    <td width="10%">
                                        <select name="unit_id" class="form-control form-control-sm updt-enbl" data-id="${value.id}" id="unit_id_${value.id}" ${mainData.is_done == 1 ? 'disabled' : ''}>
                                            <option value="">Select Unit</option>
                                            ${pur_units.map(x => `<option value="${x.id}" ${x.id == value.unit_id ? 'selected' : ''}>${x.name}</option>`).join('')}
                                        </select>
                                    </td>
                                    <td width="10%"><input type="text" class="form-control form-control-sm updt-enbl" data-id="${value.id}" id="challan_qty_${value.id}" value="${value.challan_qty?value.challan_qty:0}" ${mainData.is_done == 1 ? 'disabled' : ''}></td>
                                    <td>
                                    ${element}
                                    </td>
                                </tr>
                            `);
                        });
                        $('.updt-enbl').off('change').on('change', function() {
                            let id = $(this).data('id');
                            console.log(id);
                            $('#update-item-'+id).prop('disabled', false);
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

            // Add Main Part

            $('#addBtn').off('click').on('click',function() {
                $('#addModal').modal('show');
            });

            
            $('#addFormMain').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                submitBtnMain.disabled = true;
                submitBtnMain.innerHTML = 'Saving...';
                $.ajax({
                    url: '<?php echo e(route('inventory.database.gateoutchallanmains.store')); ?>',
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

                            
                            // $('#done-btn').removeClass('d-none');

                            $('#challan_no').val(response.data.challan_no);
                            $('#challan_no-txt').text(response.data.challan_no);
                            $('#challan_by-txt').text(response.data.challan_by.name);
                            $('#challan_date-txt').text(response.data.challan_date);
                            $('#purpose-txt').text(response.data.purpose.purpose_name);
                            $('#organization-txt').text(response.data.organization.name);
                            $('#store-txt').text(response.data.store.name);
                            $('#party-txt').text(response.data.party.name);
                            $('#note-txt').text(response.data.note);

                            $('#u_challan_id').val(response.data.id);
                            $('#u_challan_date').val(response.data.challan_date);
                            $('#u_challan_by').val(response.data.challan_by.name);
                            $('#u_challan_by_id').val(response.data.challan_by_id);
                            $('#u_purpose_id').val(response.data.purpose_id);
                            $('#u_org_id').val(response.data.org_id);
                            $('#u_store_id').val(response.data.store_id);
                            $('#u_party_id').val(response.data.party_id);
                            $('#u_note').val(response.data.note);
                            searchRequisition(1, '');
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



            $("#done-btn").off('click').on('click',function() {
                let challan_id = $('#u_challan_id').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gateoutchallanmains/multiplestatus')); ?>/"+challan_id,
                    data: {
                        is_done: 1,
                        done_by_id: "<?php echo e(Auth::user()->id); ?>",
                        done_date: "<?php echo e(date('Y-m-d')); ?>",
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        getChallanMain(challan_id);
                        searchRequisition(2, '');
                        $('input[name="status"][value="2"]').prop('checked', true);
                        $('input[name="status"][value="1"]').prop('checked', false);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })

            $("#undo-btn").off('click').on('click',function() {
                let challan_id = $('#u_challan_id').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gateoutchallanmains/multiplestatus')); ?>/"+challan_id,
                    data: {
                        is_done: 0,
                        done_by_id: "",
                        done_date: "",
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        getChallanMain(challan_id);
                        searchRequisition(1, '');
                        $('input[name="status"][value="1"]').prop('checked', true);
                        $('input[name="status"][value="2"]').prop('checked', false);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            })

            // Update Main Starts
            $("#updateBtn").off('click').on('click',function() {
                $("#updateModal").modal('show');
            })
            $('#updateFormMain').on('submit', function(e) {
                e.preventDefault();
                let id = $('#u_challan_id').val();
                let challan_date = $('#u_challan_date').val();
                let challan_by_id = $('#u_challan_by_id').val();
                let purpose_id = $('#u_purpose_id').val();
                let org_id = $('#u_org_id').val();
                let store_id = $('#u_store_id').val();
                let party_id = $('#u_party_id').val();
                let note = $('#u_note').val();
                submitBtnUpdateMain.disabled = true;
                submitBtnUpdateMain.innerHTML = 'Updating...';
                $.ajax({
                    url: '<?php echo e(url('inventory/database/gateoutchallanmains')); ?>/'+id,
                    type: 'PUT',
                    data: {
                        id: id,
                        challan_date: challan_date,
                        challan_by_id: challan_by_id,
                        purpose_id: purpose_id,
                        org_id: org_id,
                        store_id: store_id,
                        party_id: party_id,
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

                             $('#challan_no').val(response.data.challan_no);
                            $('#challan_no-txt').text(response.data.challan_no);
                            $('#challan_by-txt').text(response.data.challan_by.name);
                            $('#challan_date-txt').text(response.data.challan_date);
                            $('#purpose-txt').text(response.data.purpose.purpose_name);
                            $('#organization-txt').text(response.data.organization.name);
                            $('#store-txt').text(response.data.store.name);
                            $('#party-txt').text(response.data.party.name);
                            $('#note-txt').text(response.data.note);

                            $('#u_challan_id').val(response.data.id);
                            $('#u_challan_date').val(response.data.challan_date);
                            $('#u_challan_by').val(response.data.challan_by.name);
                            $('#u_challan_by_id').val(response.data.challan_by_id);
                            $('#u_purpose_id').val(response.data.purpose_id);
                            $('#u_org_id').val(response.data.org_id);
                            $('#u_store_id').val(response.data.store_id);
                            $('#u_party_id').val(response.data.party_id);
                            $('#u_note').val(response.data.note);
                        } else {
                                Swal.fire({
                                icon: 'error',
                                title: 'Error...',
                                text: response.message,
                            });
                        }
                        submitBtnUpdateMain.disabled = false;
                        submitBtnUpdateMain.innerHTML = 'Update';
                        $("#updateModal").modal('hide');
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

            // Delete Requisition Main
            $(document).on('click', '#deleteBtn', function(e) {
                e.preventDefault();
                let challanMainId = $('#u_challan_id').val();
                if(challanMainId == null || challanMainId == undefined || challanMainId == ''){
                    Swal.fire({
                        title: 'Error!',
                        text: "Challan Main not found!",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                }else{
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
                            url: '<?php echo e(url('inventory/database/gateoutchallanmains')); ?>/'+challanMainId,
                            type: 'DELETE',
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>',
                                id: challanMainId
                            },
                            success: function(response) {
                                if(response.success){
                                    Swal.fire(
                                        'Deleted!',
                                        'Challan Main has been deleted.',
                                        'success'
                                    );
                                    window.location.reload();
                                }else{
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
                    } else {
                        Swal.fire(
                            'Cancelled!',
                            'Challan Main has not been deleted.',
                            'error'
                        );
                    }
                });}
            });
            // Requisition Main Load
            $('.pur-main').off('click').on('click', function() {
                let id = $(this).data('id');
                $(".pur-main").removeClass("active");
                $(this).addClass("active");
                getChallanMain(id);
            });

            function searchRequisition(match, search) {
                let chalanNo = $('#challan_no').val();
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(route('inventory.database.gateoutchallanmains.search')); ?>",
                    data: {
                        search: search,
                        match: match,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        $('#purrequisition-list').empty();
                        if(data.length == 0) {
                            $('#purrequisition-list').append('<li class="list-group-item list-group-item-action p-2 border-0 text-center">No Data Found</li>');
                        }else{
                            $.each(data, function(key, value) {
                                $('#purrequisition-list').append(`<li class="list-group-item list-group-item-action p-2 border-0 pur-main ${chalanNo == value.challan_no ? 'active' : ''}" data-id="${value.id}">${value.challan_date} - ${value.challan_no}</li>`);
                            });
                        }
                        $('.pur-main').off('click').on('click', function() {
                            let id = $(this).data('id');
                            $(".pur-main").removeClass("active");
                            $(this).addClass("active");
                            getChallanMain(id);
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
                    searchRequisition(3, search);
                }else{
                    let match = $('input[name="status"]:checked').val();
                    searchRequisition(match, search);
                }
            });


            $('input[name="status"]').off('change').on('change', function() {
                let match = $('input[name="status"]:checked').val();
                searchRequisition(match, '');
            }); 

            // Search Item Data

            $('#search_data').select2({
                    placeholder: 'Search for a Product',
                    minimumInputLength: 2,
                    ajax: {
                        type: 'PUT',
                        url: "<?php echo e(route('inventory.database.gateoutchallans.search')); ?>",
                        dataType: 'json',
                        delay: 250,
                        cache: true,
                        data: function (params) {
                            return {
                                search: params.term,
                                type:'search',
                                // match: $('input[name="match"]:checked').val(),
                                _token: "<?php echo e(csrf_token()); ?>"
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data.map(item => ({
                                    id: item.id,
                                    text: item.item_name,
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
            // Add Item
            $('#search_data').on('select2:select', function() {
                let itemId = $(this).val();
                let challan_no = $('#challan_no').val();
                console.log(itemId, challan_no);
                if(challan_no == '') {
                    $('#search_data').val('').trigger('change');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Please select a requisition number!',
                    });
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: "<?php echo e(route('inventory.database.gateoutchallandetails.store')); ?>",
                    data: {
                        item_id: itemId,
                        challan_no: challan_no,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        if(data.success){
                        $('#item-row').append(`
                         <tr class="p-0" id="item-row-${data.details.id}">
                            <td width="5%">1</td>
                            <td width="20%">${data.details.item.item_name}</td>
                            <td width="10%">${data.unit.name}</td>
                            <td width="10%">
                                <select name="unit_id" class="form-control form-control-sm updt-enbl" data-id="${data.details.id}" id="unit_id_${data.details.id}">
                                    <option value="">Select Unit</option>
                                    ${data.units.map(unit => `<option value="${unit.id}">${unit.name}</option>`).join('')}
                                </select>
                            </td>
                            <td width="10%"><input type="text" class="form-control form-control-sm updt-enbl" data-id="${data.details.id}" id="challan_qty_${data.details.id}" value="0"></td>

                            <td width="10%">
                                <button type="button" data-id="${data.details.id}" id="update-item-${data.details.id}" class="btn btn-info btn-sm p-1 update-item">Update</button>
                                <button type="button" data-id="${data.details.id}" id="remove-item-${data.details.id}" class="btn btn-danger btn-sm p-1 remove-item">Remove</button>
                            </td>
                        </tr>
                        `);
                        $('.updt-enbl').off('change').on('change', function() {
                            let id = $(this).data('id');
                            console.log(id);
                            $('#update-item-'+id).prop('disabled', false);
                        });
                        $('.update-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            updateItem(id);
                        });
                        $('.remove-item').off('click').on('click', function() {
                            let id = $(this).data('id');
                            removeItem(id);
                        });
                        $("#undo-btn").addClass('d-none');
                        $("#done-btn").removeClass('d-none');
                        }else{
                            toastr.error(data.message);
                        }                        
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });
            // Update Item
            function updateItem(id){
                let unit_id = $('#unit_id_'+id).val();
                let challan_qty = $('#challan_qty_'+id).val();
                // console.log(unit_id, challan_qty,id);
                $.ajax({
                    type: 'PUT',
                    url: "<?php echo e(url('inventory/database/gateoutchallandetails')); ?>/"+id,
                    data: {
                        unit_id: unit_id,
                        challan_qty: challan_qty,
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        if(data.success){
                            $('#unit_id_'+id).val(data.data.unit_id);
                            $('#challan_qty_'+id).val(Number(data.data.challan_qty).toFixed(2));
                            toastr.success('Item updated successfully');
                            $('#update-item-'+id).prop('disabled', true);
                        }else{
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        toastr.error('Something went wrong!');
                    }
                });
            }
            // Remove Item
            function removeItem(id){
                $.ajax({
                    type: 'DELETE',
                    url: "<?php echo e(url('inventory/database/gateoutchallandetails')); ?>"+"/"+id,
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        $('#item-row-'+id).remove();
                        toastr.success('Item removed successfully');
                    },
                    error: function(data) {
                        console.log(data);
                        toastr.error('Something went wrong!');
                    }
                });
            }
            
            
        });

       
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\Inventory\resources\views\database\gateoutchallan\index.blade.php ENDPATH**/ ?>