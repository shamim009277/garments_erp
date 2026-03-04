<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'id'=>null,
    'options' => [],
    'selected' => '',
    'required' => false,
    'placeholder' => 'Select an option',
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
    'options' => [],
    'selected' => '',
    'required' => false,
    'placeholder' => 'Select an option',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<select
    name="<?php echo e($name); ?>"
    id="<?php echo e($id); ?>"
    <?php if($required): ?> required <?php endif; ?>
    <?php echo e($attributes->merge(['class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : '')])); ?>

>
    <option value=""><?php echo e($placeholder); ?></option>
    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($value); ?>" <?php echo e((old($name, $selected) == $value) ? 'selected' : ''); ?>>
            <?php echo e($label); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<?php /**PATH C:\laragon\www\garments_erp\resources\views\components\select-input.blade.php ENDPATH**/ ?>