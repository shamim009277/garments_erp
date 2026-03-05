<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Time Card</title>
    <link rel="shortcut icon" href="<?php echo e(public_path('backend/assets/images/logo-sm.svg')); ?>">
    <meta name="description" content="Garments ERP - Complete Solution for Garments Manufacturing and Management" />
    <meta name="author" content="ERP Team" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        @page {
            margin: 110px 20px 50px 20px;
            counter-increment: page;
        }

        header {
            position: fixed;
            top: -95px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
        }

        footer {
            position: fixed;
            bottom: -40px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #555;
            border-top: 1px solid #ccc;
            padding-top: 5px;
        }

        .page-number:after {
            content: counter(page);
        }

        table {
            width: 100%;
            border: none;
            margin-top: 10px;
        }

        th,
        td {
            padding: 5px 8px;
            border: none;
            text-align: left;
            vertical-align: middle;
            line-height: 0.6;
        }

        thead {
            background-color: #f2f2f2;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .title {
            text-align: center;
            font-size: 14px;
            font-weight: 700;
            margin-top: -10px;
            padding: 0px 0;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .info-table {
            width: 100%;
            margin-bottom: 8px;
            border-collapse: collapse;
        }

        .info-table td {
            border: none;
            padding: 3px 8px;
            font-size: 10px;
        }

        .company-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            line-height: 1.1;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 38px;
            font-weight: 700;
            color: rgba(0, 0, 0, 0.06);
            pointer-events: none;
            z-index: 0;
            white-space: nowrap;
        }

        .watermark-image {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.07;
            width: 250px;
            height: auto;
            pointer-events: none;
            z-index: 0;
        }

        hr {
            border: none;
            border-top: 0.5px dotted #777;
            margin: 4px 0;
        }

        .summary-table {
            width: 40%;
            float: right;
            margin-top: 10px;
            border: 1px solid #ccc;
        }

        .summary-table td {
            padding: 4px 8px;
            border: none;
            vertical-align: middle;
            font-weight: 600;
        }

        .summary-header {
            background-color: #f2f2f2;
            font-weight: 600;
            text-align: center;
        }

        .signature-section {
            margin-top: 180px;
            width: 100%;
        }

        .signature-section td {
            width: 33%;
            text-align: center;
            vertical-align: bottom;
        }

        footer div {
            display: flex;
            justify-content: space-between;
            font-size: 9px;
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
        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
            <img src="<?php echo e(public_path('backend/assets/images/logo-sm.svg')); ?>" alt="Logo" style="width: 35px; height: 35px;">
            <div class="company-info">
                <div style="font-weight: bold; font-size: 13px;"><?php echo e($general->full_name); ?></div>
                <div style="font-size: 10px;">Address, City, Country</div>
                <div style="font-size: 10px;">Email: info@company.com | Phone: +880123456789</div>
            </div>
        </div>
        <hr>
    </header>

    <!-- Footer -->
    <footer>
        <div>
            <span>Printed by <?php echo e(auth()->user()->name ?? 'System'); ?></span>
            <span>Page <span class="page"></span> | Reporting Date: <?php echo e(now()->format('d-m-Y h:i A')); ?></span>
        </div>
    </footer>

    <?php $__currentLoopData = $uniqueEmployee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $employeeRecords = collect($datas)->where('employee_id', $emp);
            $employee = $employeeRecords->first();

            // Pre-calculate counts once
            $presentCount = $employeeRecords->where('attn_type', 'PR')->count();
            $absentCount = $employeeRecords->where('attn_type', 'AB')->count();
            $holidayCount = $employeeRecords->where('attn_type', 'HD')->count();
            $casualCount = $employeeRecords->where('attn_type', 'CL')->count();
            $sickCount = $employeeRecords->where('attn_type', 'SL')->count();
            $earnCount = $employeeRecords->where('attn_type', 'EL')->count();
            $specialCount = $employeeRecords->where('attn_type', 'SP')->count();
            $lwopCount = $employeeRecords->where('attn_type', 'LWOP')->count();

            // Pre-calculate sums once
            $rwhSum = $employeeRecords->sum('rwh');
            $wwhSum = $employeeRecords->sum('wwh');
            $othSum = $employeeRecords->sum('ot_hours');
            $lateSum = $employeeRecords->sum('late_minutes');
        ?>
        <!-- PDF Body -->
        <?php if($title == 3): ?>
            <p class="title">Time Card</p>
            <hr>
            <!-- Employee Info -->
            <table class="info-table">
                <tr>
                    <td><strong>Employee ID:</strong> <?php echo e(str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT)); ?></td>
                    <td><strong>Organization:</strong> <?php echo e($employee->short_name); ?></td>
                    <td><strong>Time Period:</strong> <?php echo e($monthName); ?> <?php echo e($year); ?></td>
                </tr>
                <tr>
                    <td><strong>Name:</strong> <?php echo e($employee->name); ?></td>
                    <td><strong>Designation:</strong> <?php echo e($employee->designation); ?></td>
                    <td><strong>Joining Date:</strong> <?php echo e($employee->joining_date); ?></td>
                </tr>
                <tr>
                    <td><strong>Department:</strong> <?php echo e($employee->department); ?></td>
                    <td><strong>Line:</strong> <?php echo e($employee->line); ?></td>
                </tr>
            </table>
            <hr>

            <!-- Main Table -->
            <table>
                <thead>
                    <tr>
                        <th>Work Date</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th style="text-align:center;">RWH</th>
                        <th style="text-align:center;">WWH</th>
                        <th style="text-align:center;">OTH</th>
                        <th style="text-align:center;">Shift</th>
                        <th style="text-align:center;">Is Late</th>
                        <th style="text-align:center;">Late Min</th>
                        <th style="text-align:center;">Attn Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $employeeRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(date('d-m-Y', strtotime($record->work_date))); ?></td>
                            <td><?php echo e($record->start_punch ?? '0000-00-00 00:00:00'); ?></td>
                            <td><?php echo e($record->end_punch ?? '0000-00-00 00:00:00'); ?></td>
                            <td style="text-align:center;"><?php echo e($record->rwh ?? '-'); ?></td>
                            <td style="text-align:center;"><?php echo e($record->wwh ?? '-'); ?></td>
                            <td style="text-align:center;"><?php echo e($record->ot_hours ?? '-'); ?></td>
                            <td style="text-align:center;"><?php echo e($record->shift ?? '-'); ?></td>
                            <td style="text-align:center;"><?php echo e($record->is_late); ?></td>
                            <td style="text-align:center;"><?php echo e($record->late_minutes); ?></td>
                            <td style="text-align:center;"><?php echo e($record->attn_type); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="summary-header">Total</td>
                        <td class="summary-header"></td>
                        <td class="summary-header"><?php echo e($rwhSum); ?></td>
                        <td class="summary-header"><?php echo e($wwhSum); ?></td>
                        <td class="summary-header"><?php echo e($othSum); ?></td>
                        <td class="summary-header"></td>
                        <td class="summary-header"></td>
                        <td class="summary-header"><?php echo e($lateSum); ?></td>
                        <td class="summary-header"></td>
                    </tr>
                </tfoot>
            </table>
            <hr>

            <!-- Summary Table -->
            <table class="summary-table">
                <tr>
                    <td colspan="2" class="summary-header">Time Card Summary</td>
                </tr>
                <tr>
                    <td>Present</td>
                    <td style="text-align:right;"><?php echo e($presentCount); ?></td>
                </tr>
                <tr>
                    <td>Absent</td>
                    <td style="text-align:right;"><?php echo e($absentCount); ?></td>
                </tr>
                <tr>
                    <td>Holiday</td>
                    <td style="text-align:right;"><?php echo e($holidayCount); ?></td>
                </tr>
                <tr>
                    <td>Casual Leave</td>
                    <td style="text-align:right;"><?php echo e($casualCount); ?></td>
                </tr>
                <tr>
                    <td>Sick Leave</td>
                    <td style="text-align:right;"><?php echo e($sickCount); ?></td>
                </tr>
                <tr>
                    <td>Earn Leave</td>
                    <td style="text-align:right;"><?php echo e($earnCount); ?></td>
                </tr>
                <?php if($specialCount > 0): ?>
                <tr>
                    <td>Special Leave</td>
                    <td style="text-align:right;"><?php echo e($specialCount); ?></td>
                </tr>
                <?php endif; ?>
                <?php if($lwopCount > 0): ?>
                    <tr>
                        <td>Leave Without Pay</td>
                        <td style="text-align:right;"><?php echo e($lwopCount); ?></td>
                    </tr>
                <?php endif; ?>
            </table>

            <table class="signature-section">
                <tr>
                    <td>
                            Prepared By <br><br>
                            <strong><?php echo e(auth()->user()->name); ?></strong><br><br>
                            <strong>ID : <?php echo e(str_pad(auth()->user()->employee_id, 6, '0', STR_PAD_LEFT)); ?></strong>
                        <br>--------------------
                    </td>
                    <td>Checked By<br>--------------------</td>
                    <td>Approved By<br>--------------------</td>
                </tr>
            </table>

            <?php if(!$loop->last): ?>
                <div style="page-break-after: always;"></div>
            <?php endif; ?>

        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>

</html>
<?php /**PATH H:\laragon\www\garments_erp\Modules\Payroll\resources\views\report\punch\pdf.blade.php ENDPATH**/ ?>