
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
    <div class="col-md-3">
        <div class="card alert-primary alert-top-border padding-card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <i data-feather="list" width="16" height="16"></i>
                    <h6 class="my-0 text-primary ms-2">Initial Orders List</h6>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <input type="text" name="search" id="search" class="form-control form-control-sm" placeholder="Search here...">
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $org = collect($orders)->pluck('organization');
            $orgList = collect($org)->unique();
            ?>
            <div class="card-body">
                <?php $__currentLoopData = $orgList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $org): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <ul class="nav-custom">
                    <li class="nav-custom-item">
                        <input type="checkbox" id="dept<?php echo e($org->id); ?>">
                        <label class="nav-custom-link" for="dept<?php echo e($org->id); ?>">
                            <span class="nav-custom-caret"> </span>
                            <?php echo e($org->name); ?>

                        </label>
                        <?php
                        $ordList = collect($orders)->where('organization_id', $org->id);
                        ?>
                        <ul class="nav-custom-content">
                            <?php $__currentLoopData = $ordList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-custom-item"><a href="<?php echo e(route('ordermanagement.database.orderpricing.show', $x->id)); ?>" class="nav-custom-link"><?php echo e($x->order_code); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card alert-info alert-top-border">
            <div class="card-header">
                <h6 class="my-0 text-primary"> <i class="mdi mdi-file-document"></i> PRICING FORMAT
                </h6>
            </div>
            <div class="card-body p-2">
                <form action="<?php echo e(route('ordermanagement.database.orderpricing.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('POST'); ?>
                    <input type="hidden" name="initial_order_id" value="<?php echo e($check ? $order->initial_order_id : $order->id); ?>">
                    <input type="hidden" name="order_code" value="<?php echo e($order->order_code ?? ''); ?>" />
                    <input type="hidden" name="form_number" value="0" />
                    <!-- Top Section -->
                    <div class="row mb-5">

                        <!-- Column 1 -->
                        <div class="col-md-5">
                            <table class="table table-bordered table-sm mb-0">

                                <tr>
                                    <td class="fw-bold">Organization</td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'organization','class' => 'form-control form-control-sm border-0','value' => ''.e($order->organization->name ?? '').'','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'organization','class' => 'form-control form-control-sm border-0','value' => ''.e($order->organization->name ?? '').'','readonly' => true]); ?>
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
                                        <input type="hidden" name="organization_id" value="<?php echo e($order->organization_id ?? ''); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Buyer</td>
                                    <td>
                                        <input type="hidden" name="buyer_id" value="<?php echo e($order->buyer_id ?? ''); ?>" />
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'buyer','class' => 'form-control form-control-sm border-0','value' => ''.e($order->buyer->buyer_name ?? '').'','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'buyer','class' => 'form-control form-control-sm border-0','value' => ''.e($order->buyer->buyer_name ?? '').'','readonly' => true]); ?>
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
                                    <td class="fw-bold">ORDER QTY.</td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'order_quantity','class' => 'form-control form-control-sm border-0','value' => ''.e($order->order_quantity ?? '').'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'order_quantity','class' => 'form-control form-control-sm border-0','value' => ''.e($order->order_quantity ?? '').'','required' => true]); ?>
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
                                    <td class="fw-bold">SEASON</td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'seasson','class' => 'form-control form-control-sm border-0','value' => ''.e($order->seasson ?? '').'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'seasson','class' => 'form-control form-control-sm border-0','value' => ''.e($order->seasson ?? '').'','required' => true]); ?>
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
                                    <td class="fw-bold">STYLE</td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'style','class' => 'form-control form-control-sm border-0','value' => ''.e($order->style ?? '').'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'style','class' => 'form-control form-control-sm border-0','value' => ''.e($order->style ?? '').'','required' => true]); ?>
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
                                    <td class="fw-bold">FABRICATION</td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'fabrication','class' => 'form-control form-control-sm border-0','value' => ''.e($order->fabrication ?? '').'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'fabrication','class' => 'form-control form-control-sm border-0','value' => ''.e($order->fabrication ?? '').'','required' => true]); ?>
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
                                    <td class="fw-bold">GSM</td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'gsm','class' => 'form-control form-control-sm border-0','value' => ''.e($order->gsm ?? '').'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'gsm','class' => 'form-control form-control-sm border-0','value' => ''.e($order->gsm ?? '').'','required' => true]); ?>
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
                                    <td class="fw-bold">BRAND CATEGORY</td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'brand_category_id','options' => $brandCategories->pluck('category_name', 'id'),'selected' => $order->brand_category_id ?? old('brand_category_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'brand_category_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($brandCategories->pluck('category_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order->brand_category_id ?? old('brand_category_id'))]); ?>
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

                                <tr>
                                    <td class="fw-bold">PRICE/PCS ($)</td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['name' => 'price_per_pcs','class' => 'form-control form-control-sm border-0 fw-bold text-center','style' => 'font-size: 1.2em;','value' => ''.e($order->pricing->price_per_pcs ?? '0.00').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'price_per_pcs','class' => 'form-control form-control-sm border-0 fw-bold text-center','style' => 'font-size: 1.2em;','value' => ''.e($order->pricing->price_per_pcs ?? '0.00').'']); ?>
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
                        <div class="col-md-4">
                            <table class="table table-bordered table-sm mb-0">
                                <tr>
                                    <td class="fw-bold">EMBROIDERY</td>
                                    <td>
                                        <select name="has_embroidery" class="form-select form-select-sm border-0">
                                            <option value="N" <?php echo e(($order->pricing->has_embroidery ?? 'N') == 'N' ? 'selected' : ''); ?>>N</option>
                                            <option value="Y" <?php echo e(($order->pricing->has_embroidery ?? 'N') == 'Y' ? 'selected' : ''); ?>>Y</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">PRINT</td>
                                    <td>
                                        <select name="has_print" class="form-select form-select-sm border-0">
                                            <option value="N" <?php echo e(($order->pricing->has_print ?? 'N') == 'N' ? 'selected' : ''); ?>>N</option>
                                            <option value="Y" <?php echo e(($order->pricing->has_print ?? 'N') == 'Y' ? 'selected' : ''); ?>>Y</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">PATCHES</td>
                                    <td>
                                        <select name="has_patches" class="form-select form-select-sm border-0">
                                            <option value="N" <?php echo e(($order->pricing->has_patches ?? 'N') == 'N' ? 'selected' : ''); ?>>N</option>
                                            <option value="Y" <?php echo e(($order->pricing->has_patches ?? 'N') == 'Y' ? 'selected' : ''); ?>>Y</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" style="font-size: 0.8rem;">KNITTING+DYEING ALLOWANCE %</td>
                                    <td><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['type' => 'number','step' => '0.01','name' => 'knitting_dyeing_allowance_percent','class' => 'form-control form-control-sm border-0','value' => ''.e($order->pricing->knitting_dyeing_allowance_percent ?? '0.00').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','step' => '0.01','name' => 'knitting_dyeing_allowance_percent','class' => 'form-control form-control-sm border-0','value' => ''.e($order->pricing->knitting_dyeing_allowance_percent ?? '0.00').'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" style="font-size: 0.8rem;">CUTTING WASTAGE ALLOWANCE %</td>
                                    <td><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['type' => 'number','step' => '0.01','name' => 'cutting_wastage_allowance_percent','class' => 'form-control form-control-sm border-0','value' => ''.e($order->pricing->cutting_wastage_allowance_percent ?? '0.00').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','step' => '0.01','name' => 'cutting_wastage_allowance_percent','class' => 'form-control form-control-sm border-0','value' => ''.e($order->pricing->cutting_wastage_allowance_percent ?? '0.00').'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold" style="font-size: 0.8rem;">DOLLAR CONVERTION RATE (BDT)</td>
                                    <td><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['type' => 'number','step' => '0.01','name' => 'dollar_conversion_rate','class' => 'form-control form-control-sm border-0','value' => ''.e($order->pricing->dollar_conversion_rate ?? '0.00').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','step' => '0.01','name' => 'dollar_conversion_rate','class' => 'form-control form-control-sm border-0','value' => ''.e($order->pricing->dollar_conversion_rate ?? '0.00').'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">NO. OF M/C REQ.</td>
                                    <td><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['type' => 'number','name' => 'no_of_mc_req','class' => 'form-control form-control-sm border-0','value' => ''.e($order->no_of_mc_req ?? '').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','name' => 'no_of_mc_req','class' => 'form-control form-control-sm border-0','value' => ''.e($order->no_of_mc_req ?? '').'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">AVG. PRODUCTIVITY</td>
                                    <td><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['type' => 'number','name' => 'avg_productivity','class' => 'form-control form-control-sm border-0','value' => ''.e($order->avg_productivity ?? '').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','name' => 'avg_productivity','class' => 'form-control form-control-sm border-0','value' => ''.e($order->avg_productivity ?? '').'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">CAD CONSUMPTION (KG/Dzn.)</td>
                                    <td><?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['type' => 'number','name' => 'cad_consumption_kg_dzn','class' => 'form-control form-control-sm border-0','value' => ''.e($order->cad_consumption_kg_dzn ?? '').'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','name' => 'cad_consumption_kg_dzn','class' => 'form-control form-control-sm border-0','value' => ''.e($order->cad_consumption_kg_dzn ?? '').'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?></td>
                                </tr>
                            </table>
                        </div>
                        <!-- Column 4 (Photo) -->
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-header bg-info text-white text-center py-1">GARMENTS PHOTO</div>
                                <div class="card-body p-1 d-flex align-items-center justify-content-center border">
                                    <?php if(isset($order) && $order->file): ?>
                                    <img src="<?php echo e(asset($order->file)); ?>" alt="Garment" class="img-fluid" style="max-height: 150px;">
                                    <?php else: ?>
                                    <div class="text-muted text-center" style="height: 100px; line-height: 100px;">No Image</div>
                                    <?php endif; ?>
                                </div>
                                <div style="margin-top: 10px;text-align: center;">
                                    <strong>Upload Image:</strong>
                                    <input type="file" name="file" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-right mt-3">
                            <button type="button" class="btn btn-secondary me-auto">Cancel</button>

                            <button type="submit" class="btn btn-primary me-auto">Save & Proceed</button>
                        </div>
                    </div>
                </form>
            </div>
             <div class="row mb-4">
                        <div class="col-12">
                            <div class="text-center fw-bold border border-dark">FABRICS CONSUMPTION</div>
                            <table class="table table-bordered table-sm text-center mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>FABRICS (KG/DZN.)</th>
                                        <th>CUTTING (KG/DZN.)</th>
                                        <th>RIB (KG/DZN.)</th>
                                        <th>YARN (KG/DZN.)</th>
                                        <th>TOTAL FABRICS (KG/DZN.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="number" step="0.0001" name="fabrics_kg_dzn" class="form-control form-control-sm border-0 text-center" value="<?php echo e($order->pricing->fabrics_kg_dzn ?? '0.00'); ?>"></td>
                                        <td><input type="number" step="0.0001" name="cutting_kg_dzn" class="form-control form-control-sm border-0 text-center" value="<?php echo e($order->pricing->cutting_kg_dzn ?? '0.00'); ?>"></td>
                                        <td><input type="number" step="0.0001" name="rib_kg_dzn" class="form-control form-control-sm border-0 text-center" value="<?php echo e($order->pricing->rib_kg_dzn ?? '0.00'); ?>"></td>
                                        <td><input type="number" step="0.0001" name="yarn_kg_dzn" class="form-control form-control-sm border-0 text-center" value="<?php echo e($order->pricing->yarn_kg_dzn ?? '0.00'); ?>"></td>
                                        <td><input type="number" step="0.0001" name="total_fabrics_kg_dzn" class="form-control form-control-sm border-0 text-center fw-bold" value="<?php echo e($order->pricing->total_fabrics_kg_dzn ?? '0.00'); ?>" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

            <!-- Tabs -->
            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                <li class="nav-item">
                    <button class="nav-link" id="measurement-tab" data-bs-toggle="tab" data-bs-target="#measurement" type="button" role="tab" aria-controls="measurement" aria-selected="false">GARMENTS MEASUREMENT</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="cost-breakup-tab" data-bs-toggle="tab" data-bs-target="#cost-breakup" type="button" role="tab" aria-controls="cost-breakup" aria-selected="false">FABRICS COST BREAKUP</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="cost-summary-tab" data-bs-toggle="tab" data-bs-target="#cost-summary" type="button" role="tab" aria-controls="cost-summary" aria-selected="false">FABRICS PRICE/ DZN.</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="accessories-tab" data-bs-toggle="tab" data-bs-target="#accessories" type="button" role="tab" aria-controls="accessories" aria-selected="false">ACCESSORIES LIST</button>
                </li>
            </ul>

            <div class="tab-content p-3 border border-top-0">
                <!-- Tab 2: Garments Measurement -->
                <div class="tab-pane fade" id="measurement" role="tabpanel" aria-labelledby="measurement-tab" style="min-height: 400px;">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center fw-bold border mb-1">GARMENTS MEASUREMENT</div>
                            
                            <!-- Dynamic Measurement UI -->
                            <?php
                                $pricingId = null;
                                if(isset($order->initial_order_id)) { // OrderPricing model
                                    $pricingId = $order->id;
                                    $measurements = $order->measurements;
                                } elseif(isset($order->pricing)) { // InitialOrder model
                                    $pricingId = $order->pricing->id ?? null;
                                    $measurements = $order->pricing->measurements ?? collect([]);
                                } else {
                                    $measurements = collect([]);
                                }
                            ?>

                            <?php if($pricingId): ?>
                            <div class="card mb-2 border-0">
                                <div class="card-body p-0">
                                    <div class="row g-1 align-items-center mb-2">
                                        <div class="col-md-5">
                                            <?php if (isset($component)) { $__componentOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfbd96fa9ceb0dd232d7f99b6c6b44c36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input','data' => ['name' => 'part_name_id','id' => 'new_part_name_id','options' => $partNames->pluck('part_name', 'id'),'selected' => $order->part_name_id ?? old('part_name_id')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'part_name_id','id' => 'new_part_name_id','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($partNames->pluck('part_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($order->part_name_id ?? old('part_name_id'))]); ?>
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
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" id="new_measurement_value" class="form-control form-control-sm" placeholder="Value">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-sm btn-success w-100" id="addMeasurementBtn">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="alert alert-warning py-1 mb-2">Please save the pricing details first to add measurements.</div>
                            <?php endif; ?>

                            <table class="table table-bordered table-sm" id="measurementsTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Part Name</th>
                                        <th>Value</th>
                                        <th style="width: 50px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="measurementsTableBody">
                                    <?php $__currentLoopData = $measurements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $measurement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr id="measurement-row-<?php echo e($measurement->id); ?>">
                                            <td><?php echo e($measurement->partName->part_name ?? ''); ?></td>
                                            <td><?php echo e($measurement->value); ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger py-0 px-1 delete-measurement-btn" data-id="<?php echo e($measurement->id); ?>">&times;</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tab 3: Fabrics Cost Breakup -->
                <div class="tab-pane fade" id="cost-breakup" role="tabpanel" aria-labelledby="cost-breakup-tab"  style="min-height: 400px;">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center fw-bold border mb-1">FABRICS COST BREAKUP</div>
                            <div class="mt-3">
                                <div class="bg-light p-2 border mb-2">
                                    <div class="row g-2 align-items-center">
                                        <div class="col-md-5">
                                            <select id="costing_head_select" class="form-control form-control-sm">
                                                <option value="">Select Costing Head</option>
                                                <?php $__currentLoopData = $costingHeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $costingHead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($costingHead->id); ?>"><?php echo e($costingHead->costing_head_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" step="0.0001" id="fabrics_cost_value" class="form-control form-control-sm" placeholder="Value">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-sm btn-primary w-100" id="addFabricsCostBtn">Add</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <table class="table table-bordered table-sm text-center" id="fabricsCostTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Costing Head</th>
                                            <th>Value</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="fabricsCostList">
                                        <?php if(isset($order->pricing) && $order->pricing->fabricsCosts): ?>
                                            <?php $__currentLoopData = $order->pricing->fabricsCosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fabricsCost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr data-id="<?php echo e($fabricsCost->id); ?>">
                                                <td><?php echo e($fabricsCost->costingHead->costing_head_name ?? 'N/A'); ?></td>
                                                <td><?php echo e($fabricsCost->value); ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger delete-fabrics-cost" data-id="<?php echo e($fabricsCost->id); ?>">Delete</button>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php elseif(isset($order->fabricsCosts)): ?>
                                             <?php $__currentLoopData = $order->fabricsCosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fabricsCost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr data-id="<?php echo e($fabricsCost->id); ?>">
                                                <td><?php echo e($fabricsCost->costingHead->costing_head_name ?? 'N/A'); ?></td>
                                                <td><?php echo e($fabricsCost->value); ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger delete-fabrics-cost" data-id="<?php echo e($fabricsCost->id); ?>">Delete</button>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 4: Cost Summary (FABRICS PRICE/ DZN.) -->
                <div class="tab-pane fade" id="cost-summary" role="tabpanel" aria-labelledby="cost-summary-tab"  style="min-height: 400px;">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <td>FABRICS PRICE/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="fabrics_price_dzn" class="form-control form-control-sm border-0 text-center" value="<?php echo e($order->pricing->fabrics_price_dzn ?? '0.00'); ?>"></td>
                                </tr>
                                <tr>
                                    <td>ACCESSORIES PRICE/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="accessories_price_dzn" class="form-control form-control-sm border-0 text-center" value="<?php echo e($order->pricing->accessories_price_dzn ?? '0.00'); ?>"></td>
                                </tr>
                                <tr>
                                    <td>PRINT CHARGE/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="print_charge_dzn" class="form-control form-control-sm border-0 text-center" value="<?php echo e($order->pricing->print_charge_dzn ?? '0.00'); ?>"></td>
                                </tr>
                                <tr>
                                    <td>EMBROIDERY CHARGE/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="embroidery_charge_dzn" class="form-control form-control-sm border-0 text-center" value="<?php echo e($order->pricing->embroidery_charge_dzn ?? '0.00'); ?>"></td>
                                </tr>
                                <tr>
                                    <td>GARMENT WASH/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="garment_wash_dzn" class="form-control form-control-sm border-0 text-center" value="<?php echo e($order->pricing->garment_wash_dzn ?? '0.00'); ?>"></td>
                                </tr>
                                <tr>
                                    <td>CM/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="cm_dzn" class="form-control form-control-sm border-0 text-center" value="<?php echo e($order->pricing->cm_dzn ?? '0.00'); ?>"></td>
                                </tr>
                                <tr>
                                    <td>BANK, C&F, OTHERS/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="bank_cnf_others_dzn" class="form-control form-control-sm border-0 text-center" value="<?php echo e($order->pricing->bank_cnf_others_dzn ?? '0.00'); ?>"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">COMMERCIAL COST/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="commercial_cost_dzn" class="form-control form-control-sm border-0 text-center fw-bold" value="<?php echo e($order->pricing->commercial_cost_dzn ?? '0.00'); ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">PROFIT/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="profit_dzn" class="form-control form-control-sm border-0 text-center fw-bold" value="<?php echo e($order->pricing->profit_dzn ?? '0.00'); ?>"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">FOB/ DZN.</td>
                                    <td><input type="number" step="0.0001" name="fob_dzn" class="form-control form-control-sm border-0 text-center fw-bold" value="<?php echo e($order->pricing->fob_dzn ?? '0.00'); ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">FOB/ PCS.</td>
                                    <td><input type="number" step="0.0001" name="fob_pcs" class="form-control form-control-sm border-0 text-center fw-bold" value="<?php echo e($order->pricing->fob_pcs ?? '0.00'); ?>" readonly></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold"></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary w-100" id="btnAdd">Save</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tab 5: Accessories List -->
                <div class="tab-pane fade" id="accessories" role="tabpanel" aria-labelledby="accessories-tab"  style="min-height: 400px;">
                    <div class="row">
                        <div class="col-12">
                            <!-- Input Section -->
                            <div class="bg-light p-2 border mb-2">
                                <div class="row g-2 align-items-center">
                                    <div class="col-md-5">
                                        <select id="acc_accessory_id" class="form-control form-control-sm">
                                            <option value="">Select Accessory</option>
                                            <?php $__currentLoopData = $accessories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($acc->id); ?>"><?php echo e($acc->accessories_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="number" step="0.0001" id="acc_value" class="form-control form-control-sm" placeholder="Value">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-sm btn-primary w-100" id="btnAddAccessory">Add</button>
                                    </div>
                                </div>
                            </div>

                            <!-- List Table -->
                            <table class="table table-bordered table-sm text-center" id="accessoriesTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>ITEM NAME</th>
                                        <th>VALUE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="accessoriesListBody">
                                    <?php
                                        $accessoriesList = collect([]);
                                        if(isset($order->pricing) && $order->pricing->accessories) {
                                            $accessoriesList = $order->pricing->accessories;
                                        } elseif(isset($order->accessories)) {
                                            $accessoriesList = $order->accessories;
                                        }
                                    ?>
                                    <?php $__currentLoopData = $accessoriesList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr data-id="<?php echo e($acc->id); ?>">
                                        <td><?php echo e($acc->accessory ? $acc->accessory->accessories_name : $acc->item_name); ?></td>
                                        <td><?php echo e($acc->value); ?></td>
                                        <td><button type="button" class="btn btn-sm btn-danger delete-accessory-btn" data-id="<?php echo e($acc->id); ?>">Delete</button></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control-sm {
        padding: 2px 5px;
        font-size: 0.85rem;
    }

    .table-sm td,
    .table-sm th {
        padding: 4px;
        vertical-align: middle;
    }

    /* Custom Tab Styling */
    .nav-tabs-custom {
        background-color: #5559ca;
        border-bottom: none;
        padding: 0;
    }
    
    .nav-tabs-custom .nav-link {
        color: #ffffff;
        border: none;
        border-radius: 0;
        margin-bottom: 0;
        font-weight: 500;
    }
    
    .nav-tabs-custom .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        border: none;
    }
    
    .nav-tabs-custom .nav-link.active {
        background-color: #ffffff;
        color: #5559ca;
        font-weight: bold;
        border: 1px solid #dee2e6;
        border-bottom-color: #fff;
    }
</style>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        // Calculation Logic
        function calculateFabricsTotal() {
            let fabrics = parseFloat($('input[name="fabrics_kg_dzn"]').val()) || 0;
            let cutting = parseFloat($('input[name="cutting_kg_dzn"]').val()) || 0;
            let rib = parseFloat($('input[name="rib_kg_dzn"]').val()) || 0;
            let yarn = parseFloat($('input[name="yarn_kg_dzn"]').val()) || 0;
            let total = fabrics + cutting + rib + yarn;
            $('input[name="total_fabrics_kg_dzn"]').val(total.toFixed(4));
        }

        function calculateCommercialCost() {
            let fabrics_price = parseFloat($('input[name="fabrics_price_dzn"]').val()) || 0;
            let accessories_price = parseFloat($('input[name="accessories_price_dzn"]').val()) || 0;
            let print_charge = parseFloat($('input[name="print_charge_dzn"]').val()) || 0;
            let embroidery_charge = parseFloat($('input[name="embroidery_charge_dzn"]').val()) || 0;
            let garment_wash = parseFloat($('input[name="garment_wash_dzn"]').val()) || 0;
            let cm = parseFloat($('input[name="cm_dzn"]').val()) || 0;
            let bank_cnf = parseFloat($('input[name="bank_cnf_others_dzn"]').val()) || 0;

            let total = fabrics_price + accessories_price + print_charge + embroidery_charge + garment_wash + cm + bank_cnf;
            $('input[name="commercial_cost_dzn"]').val(total.toFixed(4));
            calculateFOB();
        }

        function calculateFOB() {
            let commercial_cost = parseFloat($('input[name="commercial_cost_dzn"]').val()) || 0;
            let profit = parseFloat($('input[name="profit_dzn"]').val()) || 0;
            let fob_dzn = commercial_cost + profit;
            let fob_pcs = fob_dzn / 12;

            $('input[name="fob_dzn"]').val(fob_dzn.toFixed(4));
            $('input[name="fob_pcs"]').val(fob_pcs.toFixed(4));
            $('input[name="price_per_pcs"]').val(fob_pcs.toFixed(4)); // Update Top Price/Pcs
        }

        function calculateAccessoriesCost() {
            let totalCost = 0;
            $('#accessoriesTable tbody tr').each(function() {
                // Try to get value from input (legacy/fallback) or text (new)
                let costVal = 0;
                let costInput = $(this).find('input[name*="[cost_per_dzn]"]');
                if(costInput.length > 0) {
                    costVal = parseFloat(costInput.val()) || 0;
                } else {
                    // New structure: 6th column (index 5)
                    let textVal = $(this).find('td:eq(5)').text();
                    costVal = parseFloat(textVal) || 0;
                }
                totalCost += costVal;
            });
            $('input[name="accessories_price_dzn"]').val(totalCost.toFixed(4));
            calculateCommercialCost();
        }

        // Bind Events
        $('input[name="fabrics_kg_dzn"], input[name="cutting_kg_dzn"], input[name="rib_kg_dzn"], input[name="yarn_kg_dzn"]').on('input', calculateFabricsTotal);

        $('input[name="fabrics_price_dzn"], input[name="accessories_price_dzn"], input[name="print_charge_dzn"], input[name="embroidery_charge_dzn"], input[name="garment_wash_dzn"], input[name="cm_dzn"], input[name="bank_cnf_others_dzn"]').on('input', calculateCommercialCost);

        $('input[name="profit_dzn"]').on('input', calculateFOB);

        // Recalculate on load
        calculateAccessoriesCost();

        // --- Fabrics Cost AJAX Handling ---
        
        // Add Fabrics Cost
        $('#addFabricsCostBtn').click(function() {
            let costingHeadId = $('#costing_head_select').val();
            let value = $('#fabrics_cost_value').val();
            
            // Try to resolve orderPricingId safely
            let orderPricingId = '<?php echo e(isset($order->pricing) ? $order->pricing->id : ((isset($order) && $check) ? $order->id : "")); ?>';

            if(!costingHeadId) {
                alert('Please select a costing head.');
                return;
            }

            if(!value) {
                alert('Please enter a value.');
                return;
            }

            if(!orderPricingId) {
                alert('Order Pricing ID not found. Please save the order first.');
                return;
            }

            $.ajax({
                url: "<?php echo e(route('ordermanagement.database.orderpricing.fabrics-cost.store')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    order_pricing_id: orderPricingId,
                    costing_head_id: costingHeadId,
                    value: value
                },
                success: function(response) {
                    if(response.status === 'success') {
                        let item = response.fabricsCost;
                        let row = `
                            <tr data-id="${item.id}">
                                <td>${item.costing_head ? item.costing_head.costing_head_name : 'N/A'}</td>
                                <td>${item.value}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger delete-fabrics-cost" data-id="${item.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                        $('#fabricsCostList').append(row);
                        
                        // Clear inputs
                        $('#costing_head_select').val('');
                        $('#fabrics_cost_value').val('');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    let msg = 'Error adding fabrics cost';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

        // Delete Fabrics Cost
        $(document).on('click', '.delete-fabrics-cost', function() {
            if(!confirm('Are you sure you want to delete this item?')) return;
            
            let btn = $(this);
            let id = btn.data('id');
            let url = "<?php echo e(route('ordermanagement.database.orderpricing.fabrics-cost.delete', ':id')); ?>";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
                    if(response.status === 'success') {
                        btn.closest('tr').remove();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                     let msg = 'Error deleting item';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

        // --- Accessories AJAX Handling ---

        // Add Accessory
        $('#btnAddAccessory').click(function() {
            let accessoryId = $('#acc_accessory_id').val();
            let value = parseFloat($('#acc_value').val()) || 0;
            
            // Try to resolve orderPricingId safely
            let orderPricingId = '<?php echo e(isset($order->pricing) ? $order->pricing->id : ((isset($order) && $check) ? $order->id : "")); ?>';

            if(!accessoryId) {
                alert('Please select an accessory.');
                return;
            }
            
            if(!value) {
                alert('Please enter a value.');
                return;
            }

            if(!orderPricingId) {
                alert('Order Pricing ID not found. Please save the order first.');
                return;
            }

            $.ajax({
                url: "<?php echo e(route('ordermanagement.database.orderpricing.accessory.store')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    order_pricing_id: orderPricingId,
                    accessory_id: accessoryId,
                    value: value
                },
                success: function(response) {
                    if(response.status === 'success') {
                        let acc = response.accessory;
                        
                        let row = `
                            <tr data-id="${acc.id}">
                                <td>${acc.accessory ? acc.accessory.accessories_name : (acc.item_name || '')}</td>
                                <td>${acc.value}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger delete-accessory-btn" data-id="${acc.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                        $('#accessoriesListBody').append(row);
                        
                        // Update total
                        calculateAccessoriesCost();

                        // Clear inputs
                        $('#acc_accessory_id').val('');
                        $('#acc_value').val('');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    let msg = 'Error adding accessory';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

        // Delete Accessory
        $(document).on('click', '.delete-accessory-btn', function() {
            if(!confirm('Are you sure you want to delete this item?')) return;
            
            let btn = $(this);
            let id = btn.data('id');
            let url = "<?php echo e(route('ordermanagement.database.orderpricing.accessory.delete', ':id')); ?>";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
                    if(response.status === 'success') {
                        btn.closest('tr').remove();
                        calculateAccessoriesCost();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                     let msg = 'Error deleting item';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

        // --- Measurements AJAX Handling ---
        
        // Add Measurement
        $('#addMeasurementBtn').click(function() {
            let partNameId = $('#new_part_name_id').val();
            let value = $('#new_measurement_value').val();
            let orderPricingId = '<?php echo e($pricingId); ?>';

            if(!partNameId || !value) {
                alert('Please select a part and enter a value.');
                return;
            }

            if(!orderPricingId) {
                alert('Order Pricing ID not found. Please save the order first.');
                return;
            }

            $.ajax({
                url: "<?php echo e(route('ordermanagement.database.orderpricing.measurement.store')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    order_pricing_id: orderPricingId,
                    part_name_id: partNameId,
                    value: value
                },
                success: function(response) {
                    if(response.status === 'success') {
                        let measurement = response.measurement;
                        let row = `
                            <tr id="measurement-row-${measurement.id}">
                                <td>${measurement.part_name ? measurement.part_name.part_name : ''}</td>
                                <td>${measurement.value}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger py-0 px-1 delete-measurement-btn" data-id="${measurement.id}">&times;</button>
                                </td>
                            </tr>
                        `;
                        $('#measurementsTableBody').append(row);
                        
                        // Clear inputs
                        $('#new_part_name_id').val('');
                        $('#new_measurement_value').val('');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    let msg = 'Error adding measurement';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

        // Delete Measurement
        $(document).on('click', '.delete-measurement-btn', function() {
            if(!confirm('Are you sure you want to delete this measurement?')) return;
            
            let btn = $(this);
            let id = btn.data('id');
            let url = "<?php echo e(route('ordermanagement.database.orderpricing.measurement.delete', ':id')); ?>";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
                    if(response.status === 'success') {
                        $('#measurement-row-' + id).remove();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                     let msg = 'Error deleting measurement';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

        // --- Fabrics Cost Breakup AJAX Handling ---
        
        // Add Fabrics Cost
        $('#addFabricsCostBtn').click(function() {
            let costingHeadId = $('#costing_head_select').val();
            let value = $('#fabrics_cost_value').val();
            // Try to resolve orderPricingId safely
            let orderPricingId = '<?php echo e(isset($order->pricing) ? $order->pricing->id : ((isset($order) && $check) ? $order->id : "")); ?>';

            if(!costingHeadId || !value) {
                alert('Please select a costing head and enter a value.');
                return;
            }

            if(!orderPricingId) {
                alert('Order Pricing ID not found. Please save the order first.');
                return;
            }

            $.ajax({
                url: "<?php echo e(route('ordermanagement.database.orderpricing.fabrics-cost.store')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    order_pricing_id: orderPricingId,
                    costing_head_id: costingHeadId,
                    value: value
                },
                success: function(response) {
                    if(response.status === 'success') {
                        let fabricsCost = response.fabricsCost;
                        let row = `
                            <tr data-id="${fabricsCost.id}">
                                <td>${fabricsCost.costing_head ? fabricsCost.costing_head.costing_head_name : ''}</td>
                                <td>${fabricsCost.value}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger delete-fabrics-cost" data-id="${fabricsCost.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                        $('#fabricsCostList').append(row);
                        
                        // Clear inputs
                        $('#costing_head_select').val('');
                        $('#fabrics_cost_value').val('');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    let msg = 'Error adding fabrics cost';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

        // Delete Fabrics Cost
        $(document).on('click', '.delete-fabrics-cost', function() {
            if(!confirm('Are you sure you want to delete this item?')) return;
            
            let btn = $(this);
            let id = btn.data('id');
            let url = "<?php echo e(route('ordermanagement.database.orderpricing.fabrics-cost.delete', ':id')); ?>";
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
                    if(response.status === 'success') {
                        btn.closest('tr').remove();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                     let msg = 'Error deleting item';
                    if(xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }
                    alert(msg);
                }
            });
        });

    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/aandg/public_html/Modules/OrderManagement/resources/views/database/orderpricing/show.blade.php ENDPATH**/ ?>