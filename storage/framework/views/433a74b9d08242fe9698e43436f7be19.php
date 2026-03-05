<button id="<?php echo e($id ?? 'submitBtn'); ?>"
    <?php echo e($attributes->merge(['type' => 'submit','class' => 'btn btn-info btn-md float-end'])); ?>>
    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
    <i data-feather="edit" style="width: 16px; height: 16px;"></i>
    <span class="btn-text"><?php echo e($slot ?? 'Edit'); ?></span>
</button><?php /**PATH H:\laragon\www\garments_erp\resources\views/components/info-button.blade.php ENDPATH**/ ?>