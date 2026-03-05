<?php $__env->startSection('title', 'Payroll'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .table-wrapper {
            overflow-x: auto;
            border-radius: 6px;
            border: 1px solid #e3e6e9;
            background: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            color: #333;
            background: white;
        }

        th {
            background: #eef3f8;
            color: #1b3c74;
            font-weight: 600;
            padding: 6px;
            border: 1px solid #d5d8dc;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }

        td {
            padding: 6px;
            border: 1px solid #e3e6e9;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
            font-size: 12px;
        }

        tbody tr:nth-child(even) {
            background: #fafbfc;
        }

        tbody tr:hover {
            background: #eaf3ff;
            transition: 0.2s ease-in-out;
        }

        /* Nested table header */
        th table {
            border: none !important;
            width: 100%;
        }

        th table th {
            background: transparent;
            border: none;
            padding: 2px;
            font-size: 10px;
            color: #1b3c74;
        }

        /* Sticky header (optional) */
        thead th {
            position: sticky;
            top: 0;
            z-index: 3;
        }
    </style>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <?php echo $__env->make('components.breadcrumb', [
                'title' => 'Payroll',
                'subtitle' => 'Overtime',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Report', 'url' => route('payroll.index')],
                    ['label' => 'Overtime', 'url' => route('payroll.report.overtime-report.index')],
                ],
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div class="col-lg-12">
            <div class="card alert-primary alert-top-border padding-card">

                <div class="card-header text-center">
                    <?php if($title == 1): ?>
                        <h6 class="text-primary my-0">Department-wise Salary Report</h6>
                        <p class="text-muted mb-0">Month: <?php echo e($monthName); ?>, <?php echo e($year); ?></p>
                    <?php endif; ?>
                </div>

                <?php if($title == 1): ?>
                    <div class="card-body">
                        <div class="table-wrapper">

                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Org</th>
                                        <th>Card</th>
                                        <th>Name</th>

                                        <th>
                                            <table>
                                                <tr>
                                                    <th>Grade</th>
                                                </tr>
                                                <tr>
                                                    <th>Designation</th>
                                                </tr>
                                            </table>
                                        </th>

                                        <th>
                                            <table>
                                                <tr>
                                                    <th>Join Date</th>
                                                </tr>
                                                <tr>
                                                    <th>Resign Date</th>
                                                </tr>
                                            </table>
                                        </th>
                                        <th>
                                            <table>
                                                <tr>
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
                                                <tr>
                                                    <th>Medical</th>
                                                </tr>
                                                <tr>
                                                    <th>Food</th>
                                                </tr>
                                            </table>
                                        </th>

                                        <th>
                                            <table>
                                                <tr>
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
                                                <tr>
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
                                                <tr>
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
                                        <th>Signature /<br> Account No</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $uniqueDepartments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <?php
                                           $orgName = optional($datas->first())->short_name;
                                           $salaries = collect($datas)->where('department', $department);
                                       ?>
                                        <tr>
                                            <td colspan="24" style="font-weight: bold; text-align: left;">Department: <?php echo e($department); ?></td>
                                        </tr>
                                        <?php $__currentLoopData = $salaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($orgName); ?></td>
                                                <td><?php echo e(str_pad($salary->employee_id, 6, '0', STR_PAD_LEFT)); ?></td>
                                                <td><?php echo e($salary->name); ?></td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td><?php echo e($salary->grade); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo e($salary->designation); ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td><?php echo e(date('d-m-Y', strtotime($salary->joining_date))); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>-</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td><?php echo e($salary->weekend_days); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo e($salary->general_holiday_days); ?></td>
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
                                                        <tr>
                                                            <td><?php echo e($salary->medical_allowance); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo e($salary->food_allowance); ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr>
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
                                                        <tr>
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
                                                            <td><?php echo e(($salary->total_ot_hour > 0) ? $salary->ot_rate : 0); ?></td>
                                                            <td><?php echo e(($salary->total_ot_hour > 0) ? $salary->total_ot_amount : 0); ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>0</td>
                                                <td>
                                                    <table>
                                                        <tr>
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
                                        <tr style="font-weight:bold; background: #69b9f3;">
                                            <td colspan="8">Subtotal</td>
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
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH H:\laragon\www\garments_erp\Modules\Payroll\resources\views\report\salary\preview.blade.php ENDPATH**/ ?>