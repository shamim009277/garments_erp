<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Employee Listing Report</title>
    <link rel="shortcut icon" href="<?php echo e(public_path('backend/assets/images/logo-sm.svg')); ?>">
    <meta name="description" content="Garments ERP - Complete Solution for Garments Manufacturing and Management" />
    <meta name="author" content="ERP Team" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 10px;
            line-height: 1.0;
            color: #000;
            margin: 0;
            padding: 0;
        }

        @page {
            margin: 100px 10px 30px 10px;
        }

        .page::after {
            content: counter(page);
        }

        header {
            position: fixed;
            top: -100px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            font-weight: 500;
            padding-bottom: 1px;
        }

        footer {
            position: fixed;
            bottom: -30px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #555;
            border-top: 1px solid #ccc;
            padding-top: 5px;
        }

        footer .printed-by {
            float: left;
            text-align: left;
            width: 50%;
        }

        footer .page-count {
            float: right;
            text-align: right;
            width: 50%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            display: table-header-group;
            background-color: #f2f2f2;
        }

        tfoot {
            display: table-footer-group;
        }

        th,
        td {
            padding: 2px 1px;
            border: 0.2px solid #ccc;
            font-size: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f7f7f7;
        }

        table table th,
        table table td {
            padding: 1px 2px;
            font-size: 10px;
            border: none;
        }

        .title {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 5px;
            text-align: center;
            margin-top: 0px;
        }

        .sub-title {
            font-size: 10px;
            color: #666;
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            margin: 0;
        }

        .no-border td,
        .no-border th {
            border: none !important;
        }

        .company-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            line-height: 1.2;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 40px;
            font-weight: 700;
            color: rgba(0, 0, 0, 0.08);
            pointer-events: none;
            z-index: 0;
            white-space: nowrap;
        }

        .watermark-image {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.08;
            width: 300px;
            height: auto;
            pointer-events: none;
            z-index: 0;
        }
    </style>

</head>

<body>
    <!-- Watermark -->
    <div class="watermark">
        <?php echo e($general->full_name); ?> - <?php echo e(now()->format('Y')); ?>

    </div>
    <img src="<?php echo e(public_path('backend/assets/images/logo-sm.svg')); ?>" class="watermark-image" alt="watermark">
    <!-- Header -->
    <header>
        <div style="display: flex; align-items: center;">
            <!-- Logo -->
            <div>
                <img src="<?php echo e(public_path('backend/assets/images/logo-sm.svg')); ?>" alt="Logo"
                    style="width: 40px; height: 40px;">
            </div>

            <!-- Company Info -->
            <div class="company-info">
                <div style="font-weight: bold; font-size: 14px; font-family: italic"><?php echo e($general->full_name); ?></div>
                <div style="font-size: 12px;font-weight: normal; font-family: italic">Address, City, Country</div>
                <div style="font-size: 12px;font-weight: normal; font-family: italic">Email: info@company.com | Phone:
                    +880123456789</div>
            </div>
        </div>
        <hr style="border: 1px solid #ccc;">
    </header>

    <!-- Footer -->
    <footer>
        <div style="display: flex; justify-content: space-between; font-size: 8px;">
            <div>
                Printed by <?php echo e(auth()->user()->name ?? 'System'); ?>

            </div>
            <div>
                Page <span class="page"></span> | <?php echo e(now()->format('d-m-Y h:i A')); ?>

            </div>
        </div>
    </footer>

    <!-- PDF Body -->
    <?php if($title == 1): ?>
        <h6 class="my-0 text-primary text-center title">Department-wise Salary Report</h6>
        <p class="text-muted mb-0 sub-title">Month: <?php echo e($monthName); ?>, <?php echo e($year); ?></p>
    <?php endif; ?>

    <?php if($title == 1): ?>
        <table class="">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Card</th>
                    <th>Name</th>

                    <th>
                        <table>
                            <tr style="border-bottom: 0.5px solid #ccc;">
                                <th>Grade</th>
                            </tr>
                            <tr>
                                <th>Designation</th>
                            </tr>
                        </table>
                    </th>

                    <th>
                        <table>
                            <tr style="border-bottom: 0.5px solid #ccc;">
                                <th>Join Date</th>
                            </tr>
                            <tr>
                                <th>Resign Date</th>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table>
                            <tr style="border-bottom: 0.5px solid #ccc;">
                                <th>WK</th>
                            </tr>
                            <tr>
                                <th>GWH</th>
                            </tr>
                        </table>
                    </th>

                    <th>
                        <table>
                            <tr>
                                <th colspan="4">Days Status</th>
                            </tr>
                            <tr>
                                <th>Days</th>
                                <th>PR</th>
                                <th>AB</th>
                                <th>Leave</th>
                            </tr>
                        </table>
                    </th>
                    <th>Basic</th>
                    <th>House <br> Rent</th>

                    <th>
                        <table>
                            <tr style="border-bottom: 0.5px solid #ccc;">
                                <th>Medical</th>
                            </tr>
                            <tr>
                                <th>Food</th>
                            </tr>
                        </table>
                    </th>

                    <th>
                        <table>
                            <tr style="border-bottom: 0.5px solid #ccc;">
                                <th>Conv.</th>
                            </tr>
                            <tr>
                                <th>Other</th>
                            </tr>
                        </table>
                    </th>

                    <th>Total <br> Salary</th>
                    <th>Basic <br> Payable</th>
                    <th>Attn. <br> Bonus</th>
                    <th>Gross <br> Payable</th>
                    <th>
                        <table>
                            <tr style="border-bottom: 0.5px solid #ccc;">
                                <th>L.Day</th>
                            </tr>
                            <tr>
                                <th>Att.</th>
                            </tr>
                        </table>
                    </th>

                    <th>
                        <table>
                            <tr>
                                <th colspan="3">Over Time</th>
                            </tr>
                            <tr>
                                <th>Hrs</th>
                                <th>Rate</th>
                                <th>Amount</th>
                            </tr>
                        </table>
                    </th>
                    <th>Arr. Amt</th>
                    <th>
                        <table>
                            <tr style="border-bottom: 0.5px solid #ccc;">
                                <th>NT</th>
                                <th>IF</th>
                                <th>WK</th>
                            </tr>
                            <tr>
                                <th>TF</th>
                                <th>DN</th>
                                <th>Gvt</th>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table style="width: 100%;">
                            <tr>
                                <th colspan="4">Deduction</th>
                            </tr>
                            <tr>
                                <th width="25%">Advance</th>
                                <th width="25%">Absent</th>
                                <th width="25%">Other</th>
                                <th width="25%">Stm</th>
                            </tr>
                        </table>
                    </th>
                    <th>Total <br> Deduction</th>
                    <th>Net <br> Payable</th>
                    <th>Signature <br>A/C No</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $orgName = optional($datas->first())->short_name;
                        $salaries = collect($datas)->where('department', $department);
                    ?>
                    <tr>
                        <td colspan="23" style="font-weight: bold; text-align: left;">Department: <?php echo e($department); ?></td>
                    </tr>
                    <?php $__currentLoopData = $salaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e(str_pad($salary->employee_id, 6, '0', STR_PAD_LEFT)); ?></td>
                            <td><?php echo e($salary->name); ?></td>
                            <td>
                                <table>
                                    <tr style="border-bottom: 0.5px solid #ccc;">
                                        <td><?php echo e($salary->grade); ?></td>
                                    </tr>
                                    <tr>
                                        <td width="40px !important;"><?php echo e($salary->designation); ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td style="width: 60px !important;"><?php echo e(date('d-m-Y', strtotime($salary->joining_date))); ?></td>
                                    </tr>
                                    <tr>
                                        <td>-</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table style="border-collapse: collapse; width: 100%;">
                                    <tr style="border-bottom: 0.5px solid #ccc;">
                                        <td style="text-align: center; vertical-align: middle !important;">
                                            <?php echo e($salary->weekend_days); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle !important;">
                                            <?php echo e($salary->general_holiday_days); ?>

                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td><?php echo e($salary->days); ?></td>
                                        <td><?php echo e($salary->days - $salary->absent_days); ?></td>
                                        <td><?php echo e($salary->absent_days); ?></td>
                                        <td><?php echo e($salary->leave_days); ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td><?php echo e($salary->basic); ?></td>
                            <td><?php echo e($salary->home_allowance); ?></td>
                            <td>
                                <table>
                                    <tr style="border-bottom: 0.5px solid #ccc;">
                                        <td><?php echo e($salary->medical_allowance); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e($salary->food_allowance); ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <tr style="border-bottom: 0.5px solid #ccc;">
                                        <td><?php echo e($salary->conveyance); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo e($salary->other_allowance); ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td><?php echo e($salary->gross_salary); ?></td>
                            <td><?php echo e($salary->basic); ?></td>
                            <td><?php echo e($salary->attendance_bonus); ?></td>
                            <td><?php echo e(number_format($salary->gross_salary + $salary->attendance_bonus, 2)); ?></td>
                            <td>
                                <table>
                                    <tr style="border-bottom: 0.5px solid #ccc;">
                                        <td><?php echo e($salary->late_days); ?></td>
                                    </tr>
                                    <tr>
                                        <td>0</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td><?php echo e($salary->total_ot_hour); ?></td>
                                        <td><?php echo e($salary->total_ot_hour > 0 ? $salary->ot_rate : 0); ?></td>
                                        <td><?php echo e($salary->total_ot_hour > 0 ? $salary->total_ot_amount : 0); ?></td>
                                    </tr>
                                </table>
                            </td>
                            <td>0</td>
                            <td>
                                <table>
                                    <tr style="border-bottom: 0.5px solid #ccc;">
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table style="width: 100%;">
                                    <tr>
                                        <td width="25%"><?php echo e($salary->advance_refund); ?></td>
                                        <td width="25%"><?php echo e($salary->absent_deduction); ?></td>
                                        <td width="25%"><?php echo e($salary->other_deduction); ?></td>
                                        <td width="25%">0</td>
                                    </tr>
                                </table>
                            </td>
                            <td><?php echo e($salary->total_deduction); ?></td>
                            <td><?php echo e(number_format($salary->total_net_payable, 2)); ?></td>
                            <td><?php echo e($salary->account_no); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- Subtotal Row -->
                    <tr style="font-weight:bold; background: #f7bc5d;">
                        <td colspan="7">Subtotal</td>
                        <td><?php echo e(number_format($salaries->sum('basic'), 2)); ?></td>
                        <td><?php echo e(number_format($salaries->sum('home_allowance'), 2)); ?></td>
                        <td>0</td>
                        <td>0</td>
                        <td><?php echo e(number_format($salaries->sum('gross_salary'), 2)); ?></td>
                        <td><?php echo e(number_format($salaries->sum('basic'), 2)); ?></td>
                        <td><?php echo e(number_format($salaries->sum('attendance_bonus'), 2)); ?></td>
                        <td><?php echo e(number_format($salaries->sum('gross_salary') + $salaries->sum('attendance_bonus'), 2)); ?></td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td><?php echo e(number_format($salaries->sum('total_deduction'), 2)); ?></td>
                        <td><?php echo e(number_format($salaries->sum('total_net_payable'), 2)); ?></td>
                        <td></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>

</html>
<?php /**PATH C:\laragon\www\garments_erp\Modules\Payroll\resources\views\report\salary\pdf.blade.php ENDPATH**/ ?>