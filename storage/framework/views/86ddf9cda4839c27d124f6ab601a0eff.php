<?php $__env->startSection('title', 'HRIS'); ?>
<?php $__env->startSection('styles'); ?>
    <style>
        .table, tr, th, td {
            border: none !important;
            border-collapse: collapse;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Settings',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Settings', 'url' => route('hris.settings.hr-settings.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div class="col-lg-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">Settings</h4>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card alert-primary alert-top-border">
                <div class="card-body px-0 py-0">
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist" style="background-color: #4549A2; color: white;border-radius: 0px !important;">
                        <li class="nav-item">
                            <a class="nav-link active border-none" data-bs-toggle="tab" href="#salary" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Salary Structure</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-none" data-bs-toggle="tab" href="#leave" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Leave Options</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content text-muted">
                        <div class="tab-pane active" id="salary" role="tabpanel">
                            <?php echo $__env->make('hris::settings.setting.tab1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                        <div class="tab-pane" id="leave" role="tabpanel">
                            <?php echo $__env->make('hris::settings.setting.tab2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\new erp\garments_erp\Modules\HRIS\resources\views\settings\setting\index.blade.php ENDPATH**/ ?>