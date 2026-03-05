<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gate Out <?php echo e($title); ?></title>
    <link rel="shortcut icon" href="<?php echo e(public_path('backend/assets/images/logo-sm.svg')); ?>">
    <meta name="description" content="Garments ERP - Complete Solution for Garments Manufacturing and Management" />
    <meta name="author" content="ERP Team" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 1.5;
            color: #000;
            margin: 0;
            padding: 0;
        }

        @page {
            margin: 110px 20px 50px 20px;
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
            font-size: 14px;
            font-weight: 600;
            padding-bottom: 10px;
        }

        footer {
            position: fixed;
            bottom: -40px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #555;
            /* border-top: 1px solid #ccc; */
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
            margin-top: 10px;
        }

        thead {
            display: table-header-group;
            background-color: #f2f2f2;
        }

        tfoot {
            display: table-footer-group;
        }

        th, td {
            padding: 2px 2px;
            border: 1px solid #ccc;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .sub-title {
            font-size: 12px;
            color: #666;
        }

        p {
            margin: 0;
        }

        .no-border td, .no-border th {
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

        .no-border, .no-border td, .no-border th {
            border: none !important;
            height: auto !important;
            background-color: transparent !important;
        }
    </style>

</head>
<?php
    $logoPath = $general->logo_path
        ? public_path('storage/' . $general->logo_path)
        : public_path('backend/assets/images/logo-sm.svg');
?>
<body>
    <!-- Watermark -->
    <div class="watermark">
        <?php echo e($general->full_name); ?> - <?php echo e(now()->format('Y')); ?>

    </div>
    <img src="<?php echo e($logoPath ?? asset('backend/assets/images/logo-sm.svg')); ?>" class="watermark-image" alt="watermark">
    <!-- Header -->
    <header>
        <div style="display: flex; align-items: center;">
            <!-- Logo -->
            <div>
                <img src="<?php echo e($logoPath ?? asset('backend/assets/images/logo-sm.svg')); ?>" alt="Logo" style="width: 40px; height: 40px;">
            </div>

            <!-- Company Info -->
            <div class="company-info">
                <div style="font-weight: bold; font-size: 14px; font-family: italic"><?php echo e($general->full_name); ?></div>
                <div style="font-size: 12px;font-weight: normal; font-family: italic">Address, City, Country</div>
                <div style="font-size: 12px;font-weight: normal; font-family: italic">Email: info@company.com | Phone: +880123456789</div>
            </div>
        </div>
    </header>
    <body>
    <table class="no-border">
        <caption style="text-align: center;text-transform: uppercase;"><h4><span style="border: 1px solid black; padding: 5px;"><?php echo e($title); ?></span></h4></caption>
        <tr><th>Challan No</th><td>:<?php echo e($challanMain->challan_no); ?></td><th >Organization</th><td>:<?php echo e($challanMain->organization->name); ?></td></tr>
        <tr><th>Challan Date</th><td>:<?php echo e($challanMain->challan_date); ?></td><th >Store</th><td>:<?php echo e($challanMain->store->name); ?></td></tr>
        <tr><th>Challan By</th><td>:<?php echo e($challanMain->challan_by->name); ?></td><th >Note</th><td>:<?php echo e($challanMain->note); ?></td></tr>
        <tr><th>Purpose of Challan</th><td>:<?php echo e($challanMain->purpose->purpose_name); ?></td><th >Printed by</th><td>:<?php echo e(auth()->user()->name ?? 'System'); ?><br><?php echo e(now()->format('d-m-Y h:i A')); ?></td></tr>
    </table>
    <hr style="border: 1px solid #ccc;">
    <table> 
        <caption style="text-align: center;text-transform: uppercase;"><h4>Item Details</h4></caption>
        <tr>
            <th style="text-align: center;">SL</th>
            <th style="text-align: center;">Item Name</th>
            <th style="text-align: center;">Quantity</th>
            <th style="text-align: center;">Unit</th>
            <th style="text-align: center;">Notes</th>
        </tr>
        <?php $__currentLoopData = $challanDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td style="text-align: center;"><?php echo e($loop->iteration); ?></td>
                <td style="text-align: center;"><?php echo e(@$x->item->item_name); ?></td>
                <td style="text-align: center;"><?php echo e(@$x->challan_qty); ?></td>
                <td style="text-align: center;"><?php echo e(@$x->unit->name); ?></td>
                <td style="text-align: center;"><?php echo e(@$x->note); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    <!-- Footer -->
     
    <footer>
        <div style="display: flex; justify-content: space-between; font-size: 10px;">
            <div>
                Page <span class="page"></span> | <?php echo e(now()->format('d-m-Y h:i A')); ?>

            </div>
        </div>
    </footer>

    <table>

    </table>
</body>
</html>
<?php /**PATH H:\laragon\www\garments_erp\Modules\Inventory\resources\views\database\gateoutchallan\pdf.blade.php ENDPATH**/ ?>