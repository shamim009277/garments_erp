<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'id'=>null,
    'accept' => 'image/*',
    'preview' => false,
    'value' => null,
    'previewWidth' => 100,
    'previewHeight' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'name',
    'id'=>null,
    'accept' => 'image/*',
    'preview' => false,
    'value' => null,
    'previewWidth' => 100,
    'previewHeight' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="mb-3">
    <input type="file" class="form-control" id="<?php echo e($id); ?>" name="<?php echo e($name); ?>"
        accept="<?php echo e($accept); ?>"
        <?php if($preview): ?> onchange="previewImage_<?php echo e($name); ?>(event)" <?php endif; ?>>

    <?php if($preview): ?>
        <img id="preview-<?php echo e($name); ?>" src="<?php echo e($value ? asset('storage/' . $value) : '#'); ?>" alt="Image Preview"
            style="display: <?php echo e($value ? 'block' : 'none'); ?>; max-width: <?php echo e($previewWidth); ?>px;
            <?php if($previewHeight): ?> max-height: <?php echo e($previewHeight); ?>px; <?php endif; ?>" class="img-thumbnail mt-2">

        <script>
            function previewImage_<?php echo e($name); ?>(event) {
                const input = event.target;
                const preview = document.getElementById('preview-<?php echo e($name); ?>');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    <?php endif; ?>
</div>


<?php /**PATH C:\laragon\www\garments_erp\resources\views\components\image-input.blade.php ENDPATH**/ ?>