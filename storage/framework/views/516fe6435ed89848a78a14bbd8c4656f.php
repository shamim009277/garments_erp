<footer class="footer" style="<?php echo e(request()->segment(1) == 'dashboard' ? 'width: 100%; left: 0px !important' : ''); ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © <?php echo e($general->full_name); ?>.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    <?php echo e($general->full_name); ?> <a href="#!" class="text-decoration-underline"></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH D:\laragon\www\new erp\garments_erp\resources\views\includes\footer.blade.php ENDPATH**/ ?>