<?php if (isset($component)) { $__componentOriginal55ba0471655f2109b0bd609d6a4fb4d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal55ba0471655f2109b0bd609d6a4fb4d6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'sample::components.layouts.master','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sample::layouts.master'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <h1>Hello World</h1>

    <p>Module: <?php echo config('sample.name'); ?></p>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal55ba0471655f2109b0bd609d6a4fb4d6)): ?>
<?php $attributes = $__attributesOriginal55ba0471655f2109b0bd609d6a4fb4d6; ?>
<?php unset($__attributesOriginal55ba0471655f2109b0bd609d6a4fb4d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal55ba0471655f2109b0bd609d6a4fb4d6)): ?>
<?php $component = $__componentOriginal55ba0471655f2109b0bd609d6a4fb4d6; ?>
<?php unset($__componentOriginal55ba0471655f2109b0bd609d6a4fb4d6); ?>
<?php endif; ?>
<?php /**PATH H:\laragon\www\garments_erp\Modules\Sample\resources\views\index.blade.php ENDPATH**/ ?>