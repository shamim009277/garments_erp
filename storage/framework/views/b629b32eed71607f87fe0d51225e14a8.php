<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve(['title' => 'Maintenance Mode - 503'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <div class="maintenance-cog-icon text-primary pt-4">
                        <i class="mdi mdi-cog spin-right display-3"></i>
                        <i class="mdi mdi-cog spin-left display-4 cog-icon"></i>
                    </div>
                    <h3 class="mt-4">Site is Under Maintenance</h3>
                    <p class="text-muted font-size-15 font-weight-bold text-danger" style="color:#EB7C22 !important;font-size: 1rem !important;">Site is currently under maintenance. Please check back later.</p>
                </div>
                <?php if (isset($component)) { $__componentOriginal2c18010b4c46e3ecad4e4bc7138a4cc7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2c18010b4c46e3ecad4e4bc7138a4cc7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.footer-copyright','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer-copyright'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2c18010b4c46e3ecad4e4bc7138a4cc7)): ?>
<?php $attributes = $__attributesOriginal2c18010b4c46e3ecad4e4bc7138a4cc7; ?>
<?php unset($__attributesOriginal2c18010b4c46e3ecad4e4bc7138a4cc7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2c18010b4c46e3ecad4e4bc7138a4cc7)): ?>
<?php $component = $__componentOriginal2c18010b4c46e3ecad4e4bc7138a4cc7; ?>
<?php unset($__componentOriginal2c18010b4c46e3ecad4e4bc7138a4cc7); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\garments_erp\resources\views\errors\503.blade.php ENDPATH**/ ?>