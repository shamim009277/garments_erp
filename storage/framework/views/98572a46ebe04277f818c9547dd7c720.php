
<button id="<?php echo e($id ?? 'submitBtn'); ?>"
    <?php echo e($attributes->merge(['type' => 'submit','class' => 'btn btn-primary btn-md float-end'])); ?>>
    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
    <i data-feather="plus" style="width: 16px; height: 16px;"></i>
    <span class="btn-text"><?php echo e($slot ?? 'Submit'); ?></span>
</button>
<?php /**PATH H:\laragon\www\garments_erp\resources\views\components\primary-button.blade.php ENDPATH**/ ?>