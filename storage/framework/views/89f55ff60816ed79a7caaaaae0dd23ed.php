<div class="row g-3">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-bottom">
                <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Assigned Shipment Schedule
                    <?php echo $basicorder->order_no; ?></h6>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo e(route('inventory.database.basicorders.lots-colors-sizes.store', $basicorder->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="text-primary">Order Lots ( <?php echo $basicorder->order_quantity; ?>)</h3>
                        </div>
                        <div class="col-lg-12">
                            <div id="lots-container">
                                <div class="lot" data-lot-index="0">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'lots[0][lot_no]','label' => 'Lot No','placeholder' => 'Enter lot no','value' => old('lots.0.lot_no'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lots[0][lot_no]','label' => 'Lot No','placeholder' => 'Enter lot no','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('lots.0.lot_no')),'required' => true]); ?>
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
                                        </div>
                                        <div class="col-lg-4">
                                            <h4>Colors</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="colors-container">
                                                <div class="color" data-color-index="0">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'lots[0][colors][0][color_name]','label' => 'Color Name','placeholder' => 'Enter color name','options' => $colors->pluck('color_name', 'id'),'selected' => old('lots.0.colors.0.color_name'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lots[0][colors][0][color_name]','label' => 'Color Name','placeholder' => 'Enter color name','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colors->pluck('color_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('lots.0.colors.0.color_name')),'required' => true]); ?>
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
                                                        <div class="col-lg-4">
                                                            <h5>Sizes</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="sizes-container">
                                                                <div class="size" data-size-index="0">
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                            <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'lots[0][colors][0][sizes][0][size_name]','label' => 'Size Name','placeholder' => 'Enter size name','options' => $sizes->pluck('size_name', 'id'),'selected' => old(
                                                                                    'lots.0.colors.0.sizes.0.size_name',
                                                                                ),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lots[0][colors][0][sizes][0][size_name]','label' => 'Size Name','placeholder' => 'Enter size name','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sizes->pluck('size_name', 'id')),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                                                                    'lots.0.colors.0.sizes.0.size_name',
                                                                                )),'required' => true]); ?>
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
                                                                        <div class="col-lg-4">
                                                                            <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'lots[0][colors][0][sizes][0][quantity]','label' => 'Quantity','placeholder' => 'Enter quantity','value' => old(
                                                                                    'lots.0.colors.0.sizes.0.quantity',
                                                                                ),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lots[0][colors][0][sizes][0][quantity]','label' => 'Quantity','placeholder' => 'Enter quantity','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old(
                                                                                    'lots.0.colors.0.sizes.0.quantity',
                                                                                )),'required' => true]); ?>
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
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button"
                                                                class="btn btn-primary btn-sm mt-2 add-size-btn">Add
                                                                Size</button>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary btn-sm mt-2 add-color-btn">Add
                                                        Color</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm mt-2" id="add-lot-btn">Add Lot</button>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary float-end me-2">Submit Order</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let lotIndex = 0;

    document.getElementById('add-lot-btn').addEventListener('click', function() {
        lotIndex++;
        let lotsContainer = document.getElementById('lots-container');

        let lotHtml = `
        <div class="lot" data-lot-index="${lotIndex}">
            <div class="row">
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'lots[${lotIndex}][lot_no]','label' => 'Lot No','placeholder' => 'Enter lot no','value' => old('lots.${lotIndex}.lot_no'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lots[${lotIndex}][lot_no]','label' => 'Lot No','placeholder' => 'Enter lot no','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('lots.${lotIndex}.lot_no')),'required' => true]); ?>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4>Colors</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="colors-container">
                        <div class="color" data-color-index="0">
                            <div class="row">
                                <div class="col-lg-4">
                                    <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'lots[${lotIndex}][colors][0][color_name]','label' => 'Color Name','placeholder' => 'Enter color name','options' => $colors->pluck('color_name', 'id'),'value' => old('lots.${lotIndex}.colors.0.color_name'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lots[${lotIndex}][colors][0][color_name]','label' => 'Color Name','placeholder' => 'Enter color name','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colors->pluck('color_name', 'id')),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('lots.${lotIndex}.colors.0.color_name')),'required' => true]); ?>
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
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Sizes</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="sizes-container">
                                        <div class="size" data-size-index="0">
                                            <div class="row">
                                                <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'lots[${lotIndex}][colors][0][sizes][0][size_name]','label' => 'Size Name','placeholder' => 'Enter size name','options' => $sizes->pluck('size_name', 'id'),'value' => old('lots.${lotIndex}.colors.0.sizes.0.size_name'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lots[${lotIndex}][colors][0][sizes][0][size_name]','label' => 'Size Name','placeholder' => 'Enter size name','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sizes->pluck('size_name', 'id')),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('lots.${lotIndex}.colors.0.sizes.0.size_name')),'required' => true]); ?>
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
                                                <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'lots[${lotIndex}][colors][0][sizes][0][quantity]','label' => 'Quantity','placeholder' => 'Enter quantity','value' => old('lots.${lotIndex}.colors.0.sizes.0.quantity'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lots[${lotIndex}][colors][0][sizes][0][quantity]','label' => 'Quantity','placeholder' => 'Enter quantity','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('lots.${lotIndex}.colors.0.sizes.0.quantity')),'required' => true]); ?>
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
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm mt-2 add-size-btn">Add Size</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        lotsContainer.insertAdjacentHTML('beforeend', lotHtml);
    });

    // Delegate event listeners for add color and add size buttons
    document.getElementById('lots-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('add-color-btn')) {
            let lotDiv = e.target.closest('.lot');
            let lotIdx = lotDiv.getAttribute('data-lot-index');

            let colorsContainer = lotDiv.querySelector('.colors-container');
            let colorCount = colorsContainer.querySelectorAll('.color').length;
            let colorHtml = `
            <div class="color" data-color-index="${colorCount}">
                <div class="row">
                    <div class="col-lg-4">
                        <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'lots[${lotIdx}][colors][${colorCount}][color_name]','label' => 'Color Name','placeholder' => 'Enter color name','options' => $colors->pluck('color_name', 'id'),'value' => old('lots.${lotIdx}.colors.${colorCount}.color_name'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lots[${lotIdx}][colors][${colorCount}][color_name]','label' => 'Color Name','placeholder' => 'Enter color name','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colors->pluck('color_name', 'id')),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('lots.${lotIdx}.colors.${colorCount}.color_name')),'required' => true]); ?>
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
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h5>Sizes</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sizes-container">
                            <div class="size" data-size-index="0">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'lots[${lotIdx}][colors][${colorCount}][sizes][0][size_name]','label' => 'Size Name','placeholder' => 'Enter size name','options' => $sizes->pluck('size_name', 'id'),'value' => old('lots.${lotIdx}.colors.${colorCount}.sizes.0.size_name'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lots[${lotIdx}][colors][${colorCount}][sizes][0][size_name]','label' => 'Size Name','placeholder' => 'Enter size name','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sizes->pluck('size_name', 'id')),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('lots.${lotIdx}.colors.${colorCount}.sizes.0.size_name')),'required' => true]); ?>
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
                                    <div class="col-lg-4">
                                        <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'lots[${lotIdx}][colors][${colorCount}][sizes][0][quantity]','label' => 'Quantity','placeholder' => 'Enter quantity','value' => old('lots.${lotIdx}.colors.${colorCount}.sizes.0.quantity'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lots[${lotIdx}][colors][${colorCount}][sizes][0][quantity]','label' => 'Quantity','placeholder' => 'Enter quantity','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('lots.${lotIdx}.colors.${colorCount}.sizes.0.quantity')),'required' => true]); ?>
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
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm mt-2 add-size-btn">Add Size</button>
                    </div>
                </div>
            </div>
            `;
            colorsContainer.insertAdjacentHTML('beforeend', colorHtml);
        }

        if (e.target.classList.contains('add-size-btn')) {
            let colorDiv = e.target.closest('.color');
            let lotDiv = e.target.closest('.lot');
            let lotIdx = lotDiv.getAttribute('data-lot-index');
            let colorIdx = colorDiv.getAttribute('data-color-index');

            let sizesContainer = colorDiv.querySelector('.sizes-container');
            let sizeCount = sizesContainer.querySelectorAll('.size').length;
            let sizeHtml = `
            <div class="size" data-size-index="${sizeCount}">
                <div class="row">
                    <div class="col-lg-4">
                    <?php if (isset($component)) { $__componentOriginal243648788f657c94d456cacfc3f7cdc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal243648788f657c94d456cacfc3f7cdc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-input-group','data' => ['name' => 'lots[${lotIdx}][colors][${colorIdx}][sizes][${sizeCount}][size_name]','label' => 'Size Name','placeholder' => 'Enter size name','options' => $sizes->pluck('size_name', 'id'),'value' => old('lots.${lotIdx}.colors.${colorIdx}.sizes.${sizeCount}.size_name'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lots[${lotIdx}][colors][${colorIdx}][sizes][${sizeCount}][size_name]','label' => 'Size Name','placeholder' => 'Enter size name','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sizes->pluck('size_name', 'id')),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('lots.${lotIdx}.colors.${colorIdx}.sizes.${sizeCount}.size_name')),'required' => true]); ?>
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
                    <div class="col-lg-4">
                    <?php if (isset($component)) { $__componentOriginal66a280159691934507706df376ef5a6a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal66a280159691934507706df376ef5a6a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-group','data' => ['name' => 'lots[${lotIdx}][colors][${colorIdx}][sizes][${sizeCount}][quantity]','label' => 'Quantity','placeholder' => 'Enter quantity','value' => old('lots.${lotIdx}.colors.${colorIdx}.sizes.${sizeCount}.quantity'),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'lots[${lotIdx}][colors][${colorIdx}][sizes][${sizeCount}][quantity]','label' => 'Quantity','placeholder' => 'Enter quantity','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('lots.${lotIdx}.colors.${colorIdx}.sizes.${sizeCount}.quantity')),'required' => true]); ?>
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
                    </div>
            </div>
            `;

            sizesContainer.insertAdjacentHTML('beforeend', sizeHtml);
        }
    });
</script>
<?php /**PATH D:\laragon\www\new erp\garments_erp\Modules/Inventory\resources/views/database/basicorders/tab2.blade.php ENDPATH**/ ?>