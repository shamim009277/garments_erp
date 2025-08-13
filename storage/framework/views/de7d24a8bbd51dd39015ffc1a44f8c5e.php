<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve(['title' => 'Page Not Found - 404'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center py-5">
                    <div class="text-primary"><h1 style="font-size: 6rem !important;">404</h1></div>
                    <h3 class="mt-4">Oops, Page Not Found.</h3>
                    <p class="text-muted font-size-15 font-weight-bold text-danger" style="color:#EB7C22 !important;font-size: 1rem !important;">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
                    <div class="mt-5">
                        <a class="btn btn-primary waves-effect waves-light" href="<?php echo e(url()->previous()); ?>">
                            <i class="mdi mdi-arrow-left"></i> Go Back
                        </a>
                    </div>
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
<?php /**PATH D:\laragon\www\new erp\garments_erp\resources\views/errors/404.blade.php ENDPATH**/ ?>