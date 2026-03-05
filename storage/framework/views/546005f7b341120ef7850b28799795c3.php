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
                'subtitle' => 'Employee',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Employee', 'url' => route('hris.database.employee.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div class="col-lg-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">Employee | ID : <?php echo e($employee->employee_id); ?></h4>
                <!-- Search Form -->
                <form action="<?php echo e(route('hris.database.employee.search')); ?>" method="POST" class="d-flex order-0 order-md-1 mb-2 mb-md-0 me-md-2" style="max-width: 400px;" role="search">
                    <?php echo csrf_field(); ?>
                    <input class="form-control form-control-sm me-2" type="search" name="search" placeholder="Applicant Card No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit">
                        <i data-feather="search" width="14" height="14" class="me-1"></i> Search
                    </button>
                </form>

                <!-- Back Button -->
                <a href="<?php echo e(route('hris.database.employee.index')); ?>" class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2">
                    <i data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back
                </a>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card alert-primary alert-top-border">
                <div class="card-body px-0 py-0" style="min-height: 500px;">
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist" style="background-color: #5559ca; color: white;border-radius: 0px !important;">
                        <li class="nav-item">
                            <a href="#basic" data-url="<?php echo e(route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 1])); ?>" class="nav-link border-none <?php echo e($tab == 1 ? 'active' : ''); ?>" title="Basic" role="tab" style="hover: white !important;">
                                <span class="d-block d-sm-none"><i class="fa fa-user"></i></span>
                                <span class="d-none d-sm-block">Basic</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#salary" data-url="<?php echo e(route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 2])); ?>" class="nav-link border-none <?php echo e($tab == 2 ? 'active' : ''); ?>" title="Salary Info" role="tab">
                                <span class="d-block d-sm-none"><i class="fa fa-credit-card"></i></span>
                                <span class="d-none d-sm-block">Salary Info</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#education" data-url="<?php echo e(route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 3])); ?>" class="nav-link border-none <?php echo e($tab == 3 ? 'active' : ''); ?>" title="Education" role="tab">
                                <span class="d-block d-sm-none"><i class="fa fa-graduation-cap"></i></span>
                                <span class="d-none d-sm-block">Education</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#training" data-url="<?php echo e(route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 4])); ?>" class="nav-link border-none <?php echo e($tab == 4 ? 'active' : ''); ?>" title="Training" role="tab">
                                <span class="d-block d-sm-none"><i class="fa fa-chalkboard-teacher"></i></span>
                                <span class="d-none d-sm-block">Training</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#experience" data-url="<?php echo e(route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 5])); ?>" class="nav-link border-none <?php echo e($tab == 5 ? 'active' : ''); ?>" title="Experience" role="tab">
                                <span class="d-block d-sm-none"><i class="fa fa-toolbox"></i></span>
                                <span class="d-none d-sm-block">Experience</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#service" data-url="<?php echo e(route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 6])); ?>" class="nav-link border-none <?php echo e($tab == 6 ? 'active' : ''); ?>" title="Service" role="tab">
                                <span class="d-block d-sm-none"><i class="fa fa-briefcase"></i></span>
                                <span class="d-none d-sm-block">Service</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#reference" data-url="<?php echo e(route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 7])); ?>" class="nav-link border-none <?php echo e($tab == 7 ? 'active' : ''); ?>" title="Reference" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-address-card"></i></span>
                                <span class="d-none d-sm-block">Reference</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#documents" data-url="<?php echo e(route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 8])); ?>" class="nav-link border-none <?php echo e($tab == 8 ? 'active' : ''); ?>" title="Documents" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Documents</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#miscellaneous" data-url="<?php echo e(route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 9])); ?>" class="nav-link border-none <?php echo e($tab == 9 ? 'active' : ''); ?>" title="Mescellaneous" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-tools"></i></span>
                                <span class="d-none d-sm-block">Mescellaneous</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#bangla" data-url="<?php echo e(route('hris.database.employee.show', ['employee' => $employee->id,'tab' => 10])); ?>" class="nav-link border-none <?php echo e($tab == 10 ? 'active' : ''); ?>" title="Bangla" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Bangla</span>
                            </a>
                        </li>
                        <li class="nav-item">

                        </li>
                    </ul>

                    <div class="tab-content text-muted">
                        <div class="tab-pane <?php echo e($tab == 1 ? 'active' : ''); ?>    " id="basic" role="tabpanel">
                            <?php if($tab == 1): ?>
                                <?php echo $__env->make('hris::database.employee.tab1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane <?php echo e($tab == 2 ? 'active' : ''); ?>" id="salary" role="tabpanel">
                            <?php if($tab == 2): ?>
                                <?php echo $__env->make('hris::database.employee.tab2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane <?php echo e($tab == 3 ? 'active' : ''); ?>" id="education" role="tabpanel">
                            <?php if($tab == 3): ?>
                                <?php echo $__env->make('hris::database.employee.tab3', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane <?php echo e($tab == 4 ? 'active' : ''); ?>" id="training" role="tabpanel">
                            <?php if($tab == 4): ?>
                                <?php echo $__env->make('hris::database.employee.tab4', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane <?php echo e($tab == 5 ? 'active' : ''); ?>" id="experience" role="tabpanel">
                            <?php if($tab == 5): ?>
                                <?php echo $__env->make('hris::database.employee.tab5', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane <?php echo e($tab == 6 ? 'active' : ''); ?>" id="service" role="tabpanel">
                            <?php if($tab == 6): ?>
                                <?php echo $__env->make('hris::database.employee.tab6', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane <?php echo e($tab == 7 ? 'active' : ''); ?>" id="reference" role="tabpanel">
                            <?php if($tab == 7): ?>
                                <?php echo $__env->make('hris::database.employee.tab7', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane <?php echo e($tab == 8 ? 'active' : ''); ?>" id="documents" role="tabpanel">
                            <?php if($tab == 8): ?>
                                <?php echo $__env->make('hris::database.employee.tab8', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane <?php echo e($tab == 9 ? 'active' : ''); ?>" id="miscellaneous" role="tabpanel">
                            <?php if($tab == 9): ?>
                                <?php echo $__env->make('hris::database.employee.tab9', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane <?php echo e($tab == 10 ? 'active' : ''); ?>" id="bangla" role="tabpanel">
                            <?php if($tab == 10): ?>
                                <?php echo $__env->make('hris::database.employee.tab10', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane <?php echo e($tab == 11 ? 'active' : ''); ?>" id="operation" role="tabpanel">
                            <?php if($tab == 11): ?>
                                <?php echo $__env->make('hris::database.employee.tab11', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
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
            // Initialize plugins for initial load
            initPlugins();

            $('.nav-link').on('click', function(e) {
                e.preventDefault();
                var target = $(this).attr('href');
                var url = $(this).data('url');
                var tabContent = $(target);

                // Update active state
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
                $('.tab-pane').removeClass('active');
                tabContent.addClass('active');

                // Load content if empty
                if (tabContent.html().trim() === '') {
                    // Show loader
                    tabContent.html('<div class="text-center p-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
                    
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(response) {
                            tabContent.html(response);
                            initPlugins();
                        },
                        error: function(xhr) {
                            tabContent.html('<div class="alert alert-danger">Error loading data</div>');
                        }
                    });
                }
            });

            function initPlugins() {
                // Date restriction
                let today = new Date().toISOString().split('T')[0];
                if($('#joining_date').length > 0) {
                    $('#joining_date').attr('min', today);
                }

                // Initialize Select2
                if($('.select2').length > 0) {
                    $('.select2').select2({
                        placeholder: "Select an option",
                        allowClear: true,
                        width: '100%'
                    });
                }
                
                // Re-initialize feather icons if they are used in the partials
                if(typeof feather !== 'undefined') {
                    feather.replace();
                }

                // Salary tab logic (tab2) – jQuery handlers
                let salaryWrapper = $('#salaryTabWrapper');
                if (salaryWrapper.length) {
                    let setting = salaryWrapper.data('setting') || {};

                    $('#gross_salary')
                        .off('input.salary')
                        .on('input.salary', function () {
                            let gross = parseFloat($(this).val()) || 0;

                            let medical = parseFloat(setting.medical_allowance || 0);
                            let food = parseFloat(setting.food_allowance || 0);
                            let conveyance = parseFloat(setting.conveyance || 0);
                            let hr_percent = parseFloat(setting.house_rant_percent_basic || 0);

                            let total_allowance = medical + food + conveyance;
                            let basic = Math.round((gross - total_allowance) / ((hr_percent + 100) / 100));
                            let house_rent = Math.round((basic / 100) * hr_percent);

                            $('#basicSalary').val(isNaN(basic) ? 0 : basic);
                            $('#home_allowance').val(isNaN(house_rent) ? 0 : house_rent);
                        });

                    $(document)
                        .off('change.salary', '#salary_from_bank')
                        .on('change.salary', '#salary_from_bank', function(e) {
                            e.preventDefault();
                            let salary_from_bank = $(this).val();
                            if (salary_from_bank === 'Y') {
                                $('#account_no').prop('required', true);
                            } else {
                                $('#account_no').prop('required', false);
                            }
                        });
                }
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\garments_erp\Modules\HRIS\resources\views\database\employee\show.blade.php ENDPATH**/ ?>