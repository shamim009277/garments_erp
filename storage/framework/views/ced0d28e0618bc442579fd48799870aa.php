
<?php $__env->startSection('title', 'Order Management'); ?>
<?php $__env->startSection('styles'); ?>
<style>
    .table,
    tr,
    th,
    td {
        border: none !important;
        border-collapse: collapse;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <?php echo $__env->make('components.breadcrumb', [
        'title' => 'Order Management',
        'subtitle' => 'Initial Orders',
        'breadcrumbs' => [
        ['label' => 'Order Management', 'url' => route('ordermanagement.index')],
        ['label' => 'Database', 'url' => route('ordermanagement.index')],
        ['label' => 'Initial Orders', 'url' => route('ordermanagement.database.initialorders.index')],
        ],
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    <div class="col-12 mb-3">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!-- Centered Title -->
            <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                Initial Orders
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
            <a href="<?php echo e(route('ordermanagement.database.initialorders.index')); ?>"
                class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2">
                <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
            </a>
            <?php endif; ?>
        </div>
    </div>
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
                                    <?php $__currentLoopData = $ordList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('ordermanagement.database.initialorders.show', $order->id)); ?>" class="employee-link">
                                        <?php echo e($order->order_code); ?>

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
    <div class="col-md-9">
        <div class="card alert-info alert-top-border">
            <div class="card-header">
                <h6 class="my-0 text-primary"> <i class="mdi mdi-plus"></i> Create New Initial Order
                </h6>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('ordermanagement.database.initialorders.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Basic Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Organization *:</strong></td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'organization_id','required' => true,'class' => 'form-control form-control-sm','options' => $organizations->pluck('name', 'id'),'selected' => old('organization_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'organization_id','required' => true,'class' => 'form-control form-control-sm','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($organizations->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('organization_id'))]); ?>
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
                                <tr>
                                    <td width="30%"><strong>Buyer *:</strong></td>
                                    <td width="70%">
                                        <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'buyer_id','class' => 'form-control form-control-sm','options' => $buyers->pluck('buyer_name', 'id'),'selected' => old('buyer_id'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'buyer_id','class' => 'form-control form-control-sm','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($buyers->pluck('buyer_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('buyer_id')),'required' => true]); ?>
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
                                <tr>
                                    <td><strong>Order Quantity:</strong></td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'order_quantity','class' => 'form-control-sm','placeholder' => 'Enter order quantity','value' => old('order_quantity'),'type' => 'number','min' => '0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'order_quantity','class' => 'form-control-sm','placeholder' => 'Enter order quantity','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('order_quantity')),'type' => 'number','min' => '0']); ?>
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
                                <tr>
                                    <td><strong>Style:</strong></td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'style','class' => 'form-control-sm','placeholder' => 'Enter style','value' => old('style')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'style','class' => 'form-control-sm','placeholder' => 'Enter style','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('style'))]); ?>
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
                                <tr>
                                    <td><strong>PO:</strong></td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'po','class' => 'form-control-sm','placeholder' => 'Enter PO number','value' => old('po')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'po','class' => 'form-control-sm','placeholder' => 'Enter PO number','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('po'))]); ?>
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

                        <!-- Technical Details -->
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Technical Details</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>GSM:</strong></td>
                                    <td width="70%">
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'gsm','class' => 'form-control-sm','placeholder' => 'Enter GSM','value' => old('gsm')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'gsm','class' => 'form-control-sm','placeholder' => 'Enter GSM','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('gsm'))]); ?>
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
                                <tr>
                                    <td><strong>Season:</strong></td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'seasson','class' => 'form-control-sm','placeholder' => 'Enter season','value' => old('seasson')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'seasson','class' => 'form-control-sm','placeholder' => 'Enter season','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('seasson'))]); ?>
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
                                <tr>
                                    <td><strong>Fabrication:</strong></td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'fabrication','class' => 'form-control-sm','placeholder' => 'Enter fabrication','value' => old('fabrication')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'fabrication','class' => 'form-control-sm','placeholder' => 'Enter fabrication','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('fabrication'))]); ?>
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
                                <tr>
                                    <td><strong>Finish Type:</strong></td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'finish_type','class' => 'form-control-sm','placeholder' => 'Enter finish type','value' => old('finish_type')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'finish_type','class' => 'form-control-sm','placeholder' => 'Enter finish type','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('finish_type'))]); ?>
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
                                <tr>
                                    <td><strong>Color:</strong></td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginalcd5480bec14091361d89d1705da56ae0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd5480bec14091361d89d1705da56ae0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-multiple-input','data' => ['name' => 'color_id[]','multiple' => true,'options' => $colors->pluck('color_name', 'id'),'selected' => old('color_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-multiple-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'color_id[]','multiple' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colors->pluck('color_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('color_id'))]); ?>
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
                                    <td><strong>Size:</strong></td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginalcd5480bec14091361d89d1705da56ae0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd5480bec14091361d89d1705da56ae0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-multiple-input','data' => ['name' => 'size_id[]','multiple' => true,'options' => $sizes->pluck('size_name', 'id'),'selected' => old('size_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-multiple-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'size_id[]','multiple' => true,'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sizes->pluck('size_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('size_id'))]); ?>
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
                            </table>
                        </div>

                        <!-- Order Details -->
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Order Details</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>Order Type:</strong></td>
                                    <td width="70%">
                                        <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'order_type_id','options' => $orderTypes->pluck('order_type', 'id'),'selected' => old('order_type_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'order_type_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($orderTypes->pluck('order_type', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('order_type_id'))]); ?>
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
                                <tr>
                                    <td><strong>Merchant:</strong></td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'merchant_id','options' => $merchants->pluck('name', 'id'),'selected' => old('merchant_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'merchant_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($merchants->pluck('name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('merchant_id'))]); ?>
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
                                <tr>
                                    <td><strong>Yarn Count:</strong></td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'yarn_count_id','options' => $yarnCounts->pluck('yarn_count_name', 'id'),'selected' => old('yarn_count_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'yarn_count_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($yarnCounts->pluck('yarn_count_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('yarn_count_id'))]); ?>
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
                                <tr>
                                    <td><strong>Product Category:</strong></td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2da57bd62e95163b41a4e48b6d67ccd2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-search-input','data' => ['name' => 'product_category_id','options' => $productCategories->pluck('product_category_name', 'id'),'selected' => old('product_category_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'product_category_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($productCategories->pluck('product_category_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('product_category_id'))]); ?>
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

                        <!-- Additional Information -->
                        <div class="col-md-6">
                            <h6 class="text-primary mb-3">Additional Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>Description:</strong></td>
                                    <td width="70%">
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'description','class' => 'form-control-sm','placeholder' => 'Enter description','value' => old('description')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'description','class' => 'form-control-sm','placeholder' => 'Enter description','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('description'))]); ?>
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
                                <tr>
                                    <td><strong>Upload File:</strong></td>
                                    <td>
                                        <input type="file" name="file" class="form-control form-control-sm">
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Instructions:</strong></td>
                                    <td>
                                        <textarea name="instructions" class="form-control form-control-sm" rows="3"
                                            placeholder="Enter instructions"><?php echo e(old('instructions')); ?></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'float-start']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'float-start']); ?>Save Order <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                            <a href="<?php echo e(route('ordermanagement.database.initialorders.index')); ?>"
                                class="btn btn-secondary float-start ms-2">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\OrderManagement\resources\views\database\initialorders\index.blade.php ENDPATH**/ ?>