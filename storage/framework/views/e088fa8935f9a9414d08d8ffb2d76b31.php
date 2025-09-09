
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8" />
        <title><?php echo e($title ?? 'Garments ERP'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Garments ERP - Complete Solution for Garments Manufacturing and Management" />
        <meta name="author" content="ERP Team" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo e(asset('backend/assets/images/favicon.ico')); ?>">
        <!-- preloader css -->
        <link rel="stylesheet" href="<?php echo e(asset('backend/assets/css/preloader.min.css')); ?>" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="<?php echo e(asset('backend/assets/css/bootstrap.min.css')); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?php echo e(asset('backend/assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?php echo e(asset('backend/assets/css/app.min.css')); ?>" id="app-style" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div class="auth-page min-vh-100 d-flex align-items-center justify-content-center bg-light">
            <div class="container">
                <?php echo e($slot); ?>

            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script src="<?php echo e(asset('backend/assets/libs/jquery/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
        <script src="<?php echo e(asset('backend/assets/libs/metismenu/metisMenu.min.js')); ?>"></script>
        <script src="<?php echo e(asset('backend/assets/libs/simplebar/simplebar.min.js')); ?>"></script>
        <script src="<?php echo e(asset('backend/assets/libs/node-waves/waves.min.js')); ?>"></script>
        <script src="<?php echo e(asset('backend/assets/libs/feather-icons/feather.min.js')); ?>"></script>

        <!-- password addon init -->
        <script src="<?php echo e(asset('backend/assets/js/pages/pass-addon.init.js')); ?>"></script>
        <script>
            $(document).ready(function() {
                $('#actionForm').on('submit', function() {
                    let $btn = $('#submitBtn');
                    $btn.prop('disabled', true);
                    $btn.find('.spinner-border').removeClass('d-none');

                    let originalText = $btn.find('.btn-text').text().trim();
                    $btn.find('.btn-text').text(originalText + ' ....');
                });
            });
        </script>
    </body>
</html>
<?php /**PATH D:\laragon\www\new erp\garments_erp\resources\views\layouts\guest.blade.php ENDPATH**/ ?>