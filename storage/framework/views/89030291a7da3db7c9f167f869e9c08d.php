<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Initial Order</title>
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
                <img src="<?php echo e(public_path('backend/assets/images/logo-sm.svg')); ?>" alt="Logo" style="width: 40px; height: 40px;">
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
     <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary">Basic Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>Order Code:</strong></td>
                                    <td><?php echo e($order->order_code); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Buyer:</strong></td>
                                    <td><?php echo e($order->buyer->buyer_name ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Organization:</strong></td>
                                    <td><?php echo e($order->organization->name ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Order Quantity:</strong></td>
                                    <td><?php echo e($order->order_quantity ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Style:</strong></td>
                                    <td><?php echo e($order->style ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>PO:</strong></td>
                                    <td><?php echo e($order->po ?? 'N/A'); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Technical Details</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>GSM:</strong></td>
                                    <td><?php echo e($order->gsm ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Season:</strong></td>
                                    <td><?php echo e($order->seasson ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Fabrication:</strong></td>
                                    <td><?php echo e($order->fabrication ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Finish Type:</strong></td>
                                    <td><?php echo e($order->finish_type ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Color:</strong></td>
                                    <td>
                                        <?php
                                            $colorList = $order->colors->pluck('color_code')->filter()->implode(', ');
                                        ?>
                                        <?php echo e($colorList ?: 'N/A'); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Size:</strong></td>
                                    <td>
                                        <?php
                                            $sizeList = $order->sizes->pluck('size_name')->filter()->implode(', ');
                                        ?>
                                        <?php echo e($sizeList ?: 'N/A'); ?>

                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Order Details</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>Order Type:</strong></td>
                                    <td><?php echo e($order->orderType->name ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Merchant:</strong></td>
                                    <td><?php echo e($order->merchant->name ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Yarn Count:</strong></td>
                                    <td><?php echo e($order->yarnCount->yarn_count_name ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Product Category:</strong></td>
                                    <td><?php echo e($order->productCategory->product_category_name ?? 'N/A'); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Additional Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="30%"><strong>Description:</strong></td>
                                    <td><?php echo e($order->description ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Instructions:</strong></td>
                                    <td><?php echo e($order->instructions ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Created At:</strong></td>
                                    <td><?php echo e($order->created_at->format('d M Y H:i')); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Updated At:</strong></td>
                                    <td><?php echo e($order->updated_at->format('d M Y H:i')); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
</body>
</html>
<?php /**PATH /home/aandg/public_html/Modules/OrderManagement/resources/views/database/initialorders/pdf.blade.php ENDPATH**/ ?>