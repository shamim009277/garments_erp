
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'id'=>null,
    'value' => '',
    'required' => false,
    'disabled' => false,
    'type' => 'text',
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
    'value' => '',
    'required' => false,
    'disabled' => false,
    'type' => 'text',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<input type="<?php echo e($type); ?>" name="<?php echo e($name); ?>" id="<?php echo e($id); ?>" value="<?php echo e(old($name, $value)); ?>"
    <?php echo e($attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')])); ?>

    <?php if($required): ?> required <?php endif; ?>
    <?php if($disabled): ?> disabled <?php endif; ?>
>
<?php /**PATH E:\server2\htdocs\garments_erp\garments_erp\resources\views/components/text-input.blade.php ENDPATH**/ ?>