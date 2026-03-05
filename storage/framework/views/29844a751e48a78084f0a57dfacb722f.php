<?php $__env->startSection('title', 'Order Management'); ?>
<?php $__env->startSection('styles'); ?>
<style>
    .table, tr, th, td { border: none !important; border-collapse: collapse; }
    .form-label { font-size: 0.8rem; font-weight: bold; }
    .form-control-sm { font-size: 0.8rem; }
    .btn-xs { padding: 0.1rem 0.3rem; font-size: 0.7rem; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // SweetAlert for delete
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
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
                        form.submit();
                    }
                });
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <?php echo $__env->make('components.breadcrumb', [
        'title' => 'Order Management',
        'subtitle' => 'Sample Order Programme',
        'breadcrumbs' => [
        ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
        ['label' => 'Database', 'url' => route('ordermanagement.index')],
        ['label' => 'Sample Order Programme', 'url' => route('ordermanagement.database.sampleorderprogramme.index')],
        ],
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
     <div class="col-12 mb-3">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!-- Centered Title -->
            <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                Sample Order Programme
            </h4>

            <!-- Search Input + Button in One Line -->
            <form action="#" method="POST" class="d-flex order-0 order-md-1 mb-2 mb-md-0 me-md-2"
                style="max-width: 400px;" role="search">
                <?php echo csrf_field(); ?>
                <input class="form-control form-control-sm me-2" type="search" name="search"
                    placeholder="Basic Order No ..." aria-label="Search">
                <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"><i data-feather="search"
                        width="14" height="14" class="me-1"></i> Search</button>
            </form>
            <?php if(1): ?>
            <!-- Back Button -->
            <a href="<?php echo e(route('ordermanagement.database.sampleorderprogramme.index')); ?>"
                class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2">
                <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
            </a>
            <?php endif; ?>
        </div>
    </div>
    <!-- Sidebar -->
    <div class="col-md-3">
        <div class="card alert-primary alert-top-border padding-card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <i data-feather="list" width="16" height="16"></i>
                    <h6 class="my-0 text-primary ms-2">Initial Orders List</h6>
                </div>
            </div>
            <?php
            $org = collect($orders)->pluck('organization');
            $orgList = collect($org)->unique();
            ?>
            <div class="card-body" style="min-height: 477px;max-height: 477px; overflow-y: auto;">
                <ul class="nav-custom">
                    <?php $__currentLoopData = $orgList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $org): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-custom-item">
                        <input type="checkbox" id="company<?php echo e($org->id); ?>">
                        <label class="nav-custom-link" for="company<?php echo e($org->id); ?>">
                            <span class="nav-custom-caret"></span>
                            <?php echo e($org->name); ?>

                        </label>
                        <?php
                        $ordList = collect($orders)->where('organization_id', $org->id);
                        $buyerList = collect($ordList)->pluck('buyer')->unique();
                        ?>
                        <ul class="nav-custom-content">
                            <?php $__currentLoopData = $buyerList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $buyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-custom-item">
                                <input type="checkbox" id="buyer<?php echo e($buyer->id); ?><?php echo e($org->id); ?>">
                                <label class="nav-custom-link" for="buyer<?php echo e($buyer->id); ?><?php echo e($org->id); ?>">
                                    <span class="nav-custom-caret"></span>
                                    <?php echo e($buyer->buyer_name); ?>

                                </label>
                                <?php
                                $ordList = collect($orders)->where('organization_id', $org->id)->where('buyer_id', $buyer->id);
                                ?>
                                <div class="nav-custom-content">
                                    <?php $__currentLoopData = $ordList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ojrder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('ordermanagement.database.sampleorderprogramme.show', $ojrder->id)); ?>" class="employee-link">
                                        <?php echo e($ojrder->order_code); ?>

                                    </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- Content -->
    <div class="col-md-9">
        <div class="card alert-success alert-top-border mb-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="my-0 text-primary"> <i class="mdi mdi-eye"></i> Initial Order Details: <?php echo e($order->order_code); ?>

                        </h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="text-primary">Basic Information</h6>
                        <table class="table table-sm">
                            <tr>
                                <td width="30%"><strong>Order Code:</strong></td>
                                <td><?php echo e($order->order_code); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Buyer:</strong></td>
                                <td><?php echo e($order->buyer->buyer_name ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Organization:</strong></td>
                                <td><?php echo e($order->organization->name ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Order Quantity:</strong></td>
                                <td><?php echo e($order->order_quantity ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Style:</strong></td>
                                <td><?php echo e($order->style ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>PO:</strong></td>
                                <td><?php echo e($order->po ?? 'N/A'); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-primary">Technical Details</h6>
                        <table class="table table-sm">
                            <tr>
                                <td width="30%"><strong>GSM:</strong></td>
                                <td><?php echo e($order->gsm ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Season:</strong></td>
                                <td><?php echo e($order->seasson ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Fabrication:</strong></td>
                                <td><?php echo e($order->fabrication ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Finish Type:</strong></td>
                                <td><?php echo e($order->finish_type ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Color:</strong></td>
                                <td>
                                    <?php
                                        $colorList = $order->colors->pluck('color_name')->filter()->implode(', ');
                                    ?>
                                    <?php echo e($colorList ?: 'N/A'); ?>

                                </td>
                            </tr>
                            <tr>
                                <td><strong>Size:</strong></td>
                                <td>
                                    <?php
                                        $sizeList = $order->sizes->pluck('size_name')->filter()->implode(', ');
                                    ?>
                                    <?php echo e($sizeList ?: 'N/A'); ?>

                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-primary">Order Details</h6>
                        <table class="table table-sm">
                            <tr>
                                <td width="30%"><strong>Order Type:</strong></td>
                                <td><?php echo e($order->orderType->name ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Merchant:</strong></td>
                                <td><?php echo e($order->merchant->name ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Yarn Count:</strong></td>
                                <td><?php echo e($order->yarnCount->yarn_count_name ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Product Category:</strong></td>
                                <td><?php echo e($order->productCategory->product_category_name ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td width="30%"><strong>Description:</strong></td>
                                <td><?php echo e($order->description ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Instructions:</strong></td>
                                <td><?php echo e($order->instructions ?? 'N/A'); ?></td>
                            </tr>
                              <tr>
                                <td><strong>File:</strong></td>
                                <td>
                                    <?php if($order->file): ?>
                                        <a href="<?php echo e(asset($order->file)); ?>" target="_blank">View File</a>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                  
                </div>
            </div>
        </div>

        <div class="card alert-info alert-top-border">
            <div class="card-header">
                <h6 class="my-0 text-primary">Sample Order Programme for <?php echo e($order->order_code); ?></h6>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('ordermanagement.database.sampleorderprogramme.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="initial_order_id" value="<?php echo e($order->id); ?>">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Style</label>
                            <input type="text" name="style_no" value="<?php echo e($order->style ?? 'N/A'); ?>" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Item Name</label>
                            <select name="item_id" class="form-control form-control-sm select2">
                                <option value="">Select Item</option>
                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>" <?php echo e($order->product_category_id == $item->id ? 'selected' : ''); ?>><?php echo e($item->product_category_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">GSM</label>
                            <input type="text" name="gsm" value="<?php echo e($order->gsm ?? 'N/A'); ?>" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Fab Src.</label>
                            <select name="fab_src" class="form-control form-control-sm select2">
                                <option value="">Select Fabric Source</option>
                                <?php $__currentLoopData = $fabricSources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($source->fabric_source_name); ?>"><?php echo e($source->fabric_source_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Color</label>
                            <?php if (isset($component)) { $__componentOriginalcd5480bec14091361d89d1705da56ae0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd5480bec14091361d89d1705da56ae0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-multiple-input','data' => ['name' => 'colors_id[]','multiple' => true,'options' => $colors->pluck('color_name', 'id'),'selected' => old('colors_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-multiple-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'colors_id[]','multiple' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colors->pluck('color_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('colors_id'))]); ?>
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
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Size</label>
                            <?php if (isset($component)) { $__componentOriginalcd5480bec14091361d89d1705da56ae0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd5480bec14091361d89d1705da56ae0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-multiple-input','data' => ['name' => 'sizes_id[]','multiple' => true,'options' => $sizes->pluck('size_name', 'id'),'selected' => old('sizes_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-multiple-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'sizes_id[]','multiple' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sizes->pluck('size_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('sizes_id'))]); ?>
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
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Sample Type</label>
                            <select name="sample_type_id" class="form-control form-control-sm select2">
                                <option value="">Select Sample Type</option>
                                <?php $__currentLoopData = $sampleTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sampleType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($sampleType->id); ?>"><?php echo e($sampleType->sample_type_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Fabric Composition</label>
                            <select name="composition_id" class="form-control form-control-sm select2">
                                <option value="">Select Composition</option>
                                <?php $__currentLoopData = $compositions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($comp->id); ?>"><?php echo e($comp->composition_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Trims Fabric</label>
                            <input type="text" name="trims_fabric" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Wash Type</label>
                            <select name="wash_type" class="form-control form-control-sm select2">
                                <option value="">Select Wash Type</option>
                                <?php $__currentLoopData = $washTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($wash->wash_type_name); ?>"><?php echo e($wash->wash_type_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                       
                        <div class="col-md-3 mb-2">
                            <label class="form-label">F/Dia(Inch)</label>
                            <input type="text" name="f_dia" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Fin. Fab(Kg)</label>
                            <input type="number" step="0.0001" name="fin_fab_kg" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Qty (Pcs)</label>
                            <input type="number" name="qty_pcs" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Fabric Treatment</label>
                            <select name="fabric_treatment_id" class="form-control form-control-sm select2">
                                <option value="">Select Treatment</option>
                                <?php $__currentLoopData = $fabricTreatments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ft): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($ft->id); ?>"><?php echo e($ft->fabric_treatment_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                         <div class="col-md-3 mb-2">
                            <label class="form-label">Delivery Deadline</label>
                            <input type="date" name="delivery_deadline" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Print & Emb Inst.</label>
                            <textarea name="print_emb_inst" class="form-control form-control-sm" rows="2"></textarea>
                        </div>
                         <div class="col-md-3 mb-2">
                            <label class="form-label">Tri & Acr</label>
                            <textarea name="tri_acr" class="form-control form-control-sm" rows="2"></textarea>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Tri & Acr Deadline</label>
                            <input type="date" name="tri_acr_deadline" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Remarks / Ins.</label>
                            <textarea name="remarks" class="form-control form-control-sm" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-sm">Add Sample Programme</button>
                    </div>
                </form>

                <hr>

               
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h5 class="text-center">Sample Programme List</h5>
             <!-- List -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm text-center" style="font-size: 0.8rem;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fab Src.</th>
                                <th>Color</th>
                                <th>Sample Type</th>
                                <th>Composition</th>
                                <th>Trims Fab</th>
                                <th>Wash</th>
                                <th>Style</th>
                                <th>Item</th>
                                <th>F/Dia</th>
                                <th>GSM</th>
                                <th>Fin Fab</th>
                                <th>Qty</th>
                                <th>Treatment</th>
                                <th>Size</th>
                                <th>Deadline</th>
                                <th>Tri & Acr Deadline</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $samples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sample): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($sample->programme_code); ?></td>
                                <td><?php echo e($sample->fab_src); ?></td>
                                <td>
                                <?php
                                    $colorList = $sample->colors->pluck('color_name')->filter()->implode(', ');
                                ?>
                                <?php echo e($colorList ?: 'N/A'); ?>

                                </td>
                                <td><?php echo e($sample->sampleType->sample_type_name ?? ''); ?></td>
                                <td><?php echo e($sample->composition->composition_name ?? ''); ?></td>
                                <td><?php echo e($sample->trims_fabric); ?></td>
                                <td><?php echo e($sample->wash_type); ?></td>
                                <td><?php echo e($sample->style_no); ?></td>
                                <td><?php echo e($sample->item->product_category_name ?? ''); ?></td>
                                <td><?php echo e($sample->f_dia); ?></td>
                                <td><?php echo e($sample->gsm); ?></td>
                                <td><?php echo e($sample->fin_fab_kg); ?></td>
                                <td><?php echo e($sample->qty_pcs); ?></td>
                                <td><?php echo e($sample->fabricTreatment->fabric_treatment_name ?? ''); ?></td>
                                <td>
                                    <?php
                                        $sizeList = $sample->sizes->pluck('size_name')->filter()->implode(', ');
                                    ?>
                                <?php echo e($sizeList ?: 'N/A'); ?>

                                   
                                </td>
                                <td><?php echo e($sample->delivery_deadline); ?></td>
                                <td><?php echo e($sample->tri_acr_deadline); ?></td>
                                <td>
                                    
                                    <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($sample->id); ?>"><i class="fas fa-edit"></i></a>
                                    <form action="<?php echo e(route('ordermanagement.database.sampleorderprogramme.destroy', $sample->id)); ?>" method="POST" style="display:inline;" class="delete-form">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-soft-danger waves-effect waves-light" style="padding: 4px 6px;" <?php echo e($sample->accept_status == 0 ? '' : 'disabled'); ?>>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <form action="<?php echo e(route('ordermanagement.database.sampleorderprogramme.update', $sample->id)); ?>" method="POST" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <input type="hidden" name="current_status" value="1">
                                        <button type="submit" class="btn btn-soft-warning waves-effect waves-light" style="padding: 4px 6px;" <?php echo e($sample->accept_status == 0 ? '' : 'disabled'); ?>>
                                            <i class="fas fa-recycle"></i>
                                        </button>
                                    </form>


                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal<?php echo e($sample->id); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo e($sample->id); ?>" aria-hidden="true" <?php echo e($sample->accept_status == 0 ? '' : 'disabled'); ?>>
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel<?php echo e($sample->id); ?>">Edit Sample Programme : <?php echo e($sample->programme_code); ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="<?php echo e(route('ordermanagement.database.sampleorderprogramme.update', $sample->id)); ?>" method="POST" <?php echo e($sample->accept_status == 0 ? '' : 'disabled'); ?>>
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <div class="modal-body text-start">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Style</label></th>
                                                                    <td width="30%"><input type="text" name="style_no" value="<?php echo e($sample->style_no); ?>" class="form-control form-control-sm"></td>
                                                                    <th width="20%"><label class="form-label">Item Name</label></th>
                                                                    <td width="30%">
                                                                        <select name="item_id" class="form-control form-control-sm select2">
                                                                            <option value="">Select Item</option>
                                                                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($item->id); ?>" <?php echo e($sample->item_id == $item->id ? 'selected' : ''); ?>><?php echo e($item->product_category_name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">GSM</label></th>
                                                                    <td width="30%"><input type="text" name="gsm" value="<?php echo e($sample->gsm); ?>" class="form-control form-control-sm"></td>
                                                                    <th width="20%"><label class="form-label">Fab Src.</label></th>
                                                                    <td width="30%">
                                                                        <select name="fab_src" class="form-control form-control-sm select2">
                                                                            <option value="">Select Fabric Source</option>
                                                                            <?php $__currentLoopData = $fabricSources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($source->fabric_source_name); ?>" <?php echo e($sample->fab_src == $source->fabric_source_name ? 'selected' : ''); ?>><?php echo e($source->fabric_source_name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Color</label></th>
                                                                    <td width="30%">
                                                                         <?php if (isset($component)) { $__componentOriginalcd5480bec14091361d89d1705da56ae0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd5480bec14091361d89d1705da56ae0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-multiple-input','data' => ['name' => 'colors_id[]','multiple' => true,'options' => $colors->pluck('color_name', 'id'),'selected' => $sample->colors->pluck('id')->toArray()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-multiple-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'colors_id[]','multiple' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colors->pluck('color_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sample->colors->pluck('id')->toArray())]); ?>
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
                                                                    </td>
                                                                    <th width="20%"><label class="form-label">Size</label></th>
                                                                    <td width="30%">
                                                                         <?php if (isset($component)) { $__componentOriginalcd5480bec14091361d89d1705da56ae0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd5480bec14091361d89d1705da56ae0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-multiple-input','data' => ['name' => 'sizes_id[]','multiple' => true,'options' => $sizes->pluck('size_name', 'id'),'selected' => $sample->sizes->pluck('id')->toArray()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-multiple-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'sizes_id[]','multiple' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sizes->pluck('size_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sample->sizes->pluck('id')->toArray())]); ?>
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
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Sample Type</label></th>
                                                                    <td width="30%">
                                                                        <select name="sample_type_id" class="form-control form-control-sm select2">
                                                                            <option value="">Select Sample Type</option>
                                                                            <?php $__currentLoopData = $sampleTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sampleType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($sampleType->id); ?>" <?php echo e($sample->sample_type_id == $sampleType->id ? 'selected' : ''); ?>><?php echo e($sampleType->sample_type_name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </td>
                                                                    <th width="20%"><label class="form-label">Fabric Composition</label></th>
                                                                    <td width="30%">
                                                                        <select name="composition_id" class="form-control form-control-sm select2">
                                                                            <option value="">Select Composition</option>
                                                                            <?php $__currentLoopData = $compositions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($comp->id); ?>" <?php echo e($sample->composition_id == $comp->id ? 'selected' : ''); ?>><?php echo e($comp->composition_name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Trims Fabric</label></th>
                                                                    <td width="30%"><input type="text" name="trims_fabric" value="<?php echo e($sample->trims_fabric); ?>" class="form-control form-control-sm"></td>
                                                                    <th width="20%"><label class="form-label">Wash Type</label></th>
                                                                    <td width="30%">
                                                                        <select name="wash_type" class="form-control form-control-sm select2">
                                                                            <option value="">Select Wash Type</option>
                                                                            <?php $__currentLoopData = $washTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($wash->wash_type_name); ?>" <?php echo e($sample->wash_type == $wash->wash_type_name ? 'selected' : ''); ?>><?php echo e($wash->wash_type_name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">F/Dia(Inch)</label></th>
                                                                    <td width="30%"><input type="text" name="f_dia" value="<?php echo e($sample->f_dia); ?>" class="form-control form-control-sm"></td>
                                                                    <th width="20%"><label class="form-label">Fin. Fab(Kg)</label></th>
                                                                    <td width="30%"><input type="number" step="0.0001" name="fin_fab_kg" value="<?php echo e($sample->fin_fab_kg); ?>" class="form-control form-control-sm"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Qty (Pcs)</label></th>
                                                                    <td width="30%"><input type="number" name="qty_pcs" value="<?php echo e($sample->qty_pcs); ?>" class="form-control form-control-sm"></td>
                                                                    <th width="20%"><label class="form-label">Fabric Treatment</label></th>
                                                                    <td width="30%">
                                                                        <select name="fabric_treatment_id" class="form-control form-control-sm select2">
                                                                            <option value="">Select Treatment</option>
                                                                            <?php $__currentLoopData = $fabricTreatments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ft): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($ft->id); ?>" <?php echo e($sample->fabric_treatment_id == $ft->id ? 'selected' : ''); ?>><?php echo e($ft->fabric_treatment_name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Delivery Deadline</label></th>
                                                                    <td width="30%"><input type="date" name="delivery_deadline" value="<?php echo e($sample->delivery_deadline); ?>" class="form-control form-control-sm"></td>
                                                                    <th width="20%"></th>
                                                                    <td width="30%"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Print & Emb Inst.</label></th>
                                                                    <td colspan="3"><textarea name="print_emb_inst" class="form-control form-control-sm" rows="2"><?php echo e($sample->print_emb_inst); ?></textarea></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Tri & Acr</label></th>
                                                                    <td colspan="3"><textarea name="tri_acr" class="form-control form-control-sm" rows="2"><?php echo e($sample->tri_acr); ?></textarea></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Tri & Acr Deadline</label></th>
                                                                    <td width="30%"><input type="date" name="tri_acr_deadline" value="<?php echo e($sample->tri_acr_deadline); ?>" class="form-control form-control-sm"></td>
                                                                    <th width="20%"></th>
                                                                    <td width="30%"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%"><label class="form-label">Remarks / Ins.</label></th>
                                                                    <td colspan="3"><textarea name="remarks" class="form-control form-control-sm" rows="2"><?php echo e($sample->remarks); ?></textarea></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary btn-sm" <?php echo e($sample->accept_status == 0 ? '' : 'disabled'); ?>>Update Sample Programme</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules/OrderManagement\resources/views/database/sampleorderprogramme/show.blade.php ENDPATH**/ ?>