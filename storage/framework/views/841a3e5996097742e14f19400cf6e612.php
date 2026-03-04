<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $__env->yieldContent('title', 'Report'); ?></title>
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
            padding: 2px 4px;
            border: 0.5px solid #cccccc;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .title {
            font-size: 12px;
            font-weight: bold;
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
            margin-top: -5px;
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
<?php
    $orgdata = $ornizations_data->where('id', $orgid)->first();
    $orgname = $orgdata->name ?? ($general->full_name ?? 'Ayasha & Galeya Fashions Ltd');
    $address = $orgdata->address ?? ('01, Hariken Road, Dawlotpur, National University, Gazipur' ?? '01, Hariken Road, Dawlotpur, National University, Gazipur');
    $email = $orgdata->email ?? ('info@company.com' ?? 'info@company.com');
    $phone = $orgdata->phone ?? ('+880123456789' ?? '+880123456789');

    if (!empty($orgdata?->path)) {
        $logo = public_path('storage/' . $orgdata->path);
    } elseif (!empty($general?->full_name)) {
        $logo = public_path('storage/' . $general->logo_path);
    } else {
        $logo = public_path('backend/assets/images/logo-sm.svg');
    }
?>

<body>
    <!-- Watermark -->
    <div class="watermark">
        <?php echo e($orgname); ?> - <?php echo e(now()->format('Y')); ?>

    </div>
    <img src="<?php echo e($logo); ?>" class="watermark-image" alt="watermark">
    <!-- Header -->
    <?php if (isset($component)) { $__componentOriginalb3d0082ee7441c380e1c808629ee8e27 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb3d0082ee7441c380e1c808629ee8e27 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'hris::components.reports.header','data' => ['orgname' => $orgname,'address' => $address,'email' => $email,'phone' => $phone,'logo' => $logo]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hris::reports.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['orgname' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($orgname),'address' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($address),'email' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($email),'phone' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($phone),'logo' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($logo)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb3d0082ee7441c380e1c808629ee8e27)): ?>
<?php $attributes = $__attributesOriginalb3d0082ee7441c380e1c808629ee8e27; ?>
<?php unset($__attributesOriginalb3d0082ee7441c380e1c808629ee8e27); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb3d0082ee7441c380e1c808629ee8e27)): ?>
<?php $component = $__componentOriginalb3d0082ee7441c380e1c808629ee8e27; ?>
<?php unset($__componentOriginalb3d0082ee7441c380e1c808629ee8e27); ?>
<?php endif; ?>

    <!-- Footer -->
    <?php if (isset($component)) { $__componentOriginald6635a79a4329e7d82203ed0fead1aef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald6635a79a4329e7d82203ed0fead1aef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'hris::components.reports.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hris::reports.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald6635a79a4329e7d82203ed0fead1aef)): ?>
<?php $attributes = $__attributesOriginald6635a79a4329e7d82203ed0fead1aef; ?>
<?php unset($__attributesOriginald6635a79a4329e7d82203ed0fead1aef); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald6635a79a4329e7d82203ed0fead1aef)): ?>
<?php $component = $__componentOriginald6635a79a4329e7d82203ed0fead1aef; ?>
<?php unset($__componentOriginald6635a79a4329e7d82203ed0fead1aef); ?>
<?php endif; ?>

    <!-- PDF Body -->
    <?php if(!empty($reportTitle)): ?>
        <h3 style="text-align:center; font-size:12px; margin-top:-15px; padding:0px; margin-bottom:0px;">
            <?php echo e($reportTitle); ?>

        </h3>
    <?php endif; ?>

    <?php if(!empty($reportSubTitle)): ?>
        <p style="text-align:center; font-size:10px; font-weight:bold; margin-top:-20px;">
            <?php echo e($reportSubTitle); ?>

        </p>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php if (isset($component)) { $__componentOriginale2b69dafb76a7b6972143ab485a0fbe9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2b69dafb76a7b6972143ab485a0fbe9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'hris::components.reports.signature','data' => ['orgname' => $orgname]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('hris::reports.signature'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['orgname' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($orgname)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale2b69dafb76a7b6972143ab485a0fbe9)): ?>
<?php $attributes = $__attributesOriginale2b69dafb76a7b6972143ab485a0fbe9; ?>
<?php unset($__attributesOriginale2b69dafb76a7b6972143ab485a0fbe9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale2b69dafb76a7b6972143ab485a0fbe9)): ?>
<?php $component = $__componentOriginale2b69dafb76a7b6972143ab485a0fbe9; ?>
<?php unset($__componentOriginale2b69dafb76a7b6972143ab485a0fbe9); ?>
<?php endif; ?>
</body>
</html>
<?php /**PATH /home/aandg/public_html/Modules/Payroll/resources/views/components/layouts/pdf.blade.php ENDPATH**/ ?>