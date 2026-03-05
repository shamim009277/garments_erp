<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Applicant Report</title>
    <link rel="shortcut icon" href="<?php echo e(public_path('backend/assets/images/logo-sm.svg')); ?>">
    <meta name="description" content="Garments ERP - Complete Solution for Garments Manufacturing and Management" />
    <meta name="author" content="ERP Team" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 1.6;
            color: #000;
            margin: 0;
            padding: 0;
        }

        @page {
           /*  margin: 110px 20px 50px 20px; */
             margin: 5px 15px 20px 15px;
        }
      @font-face {
        font-family: 'NotoSansBengali';
        src: url('<?php echo e(public_path('fonts/NotoSansBengali.ttf')); ?>') format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    body body {
        font-family: 'notosansbengali';
        font-size: 13px;
    }
  /*       @font-face {
        font-family: 'NotoSansBengali';
        src: url('<?php echo e(public_path('fonts/NotoSansBengali.ttf')); ?>') format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    body {
        font-family: 'NotoSansBengali', sans-serif;
    } */

        .page::after {
            content: counter(page);
        }

       /*  header {
            position: fixed;
            top: -100px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            padding-bottom: 10px;
        } */

        footer {
            position: fixed;
            bottom: -10px;
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
            margin-top: 12px;
        }

        thead {
            display: table-header-group;
            background-color: #f2f2f2;
        }

        tfoot {
            display: table-footer-group;
        }

        th, td {
            padding: 6px 8px;
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
        .page-break { 
    page-break-after: always; 
}

    </style>
    
</head>
<body>   
     <!-- Watermark -->
    
   
    <!-- Header -->
   

    <!-- Footer -->
    <footer>
        <div style="display: flex; justify-content: space-between; font-size: 10px;">
            <div>
                Printed by <?php echo e(auth()->user()->name ?? 'System'); ?>

            </div>
            <div>
                Page <span class="page"></span> | <?php echo e(now()->format('d-m-Y h:i A')); ?>

            </div>
        </div>
    </footer> 
    <div class="row">
         
        
           
<?php if(count($employees) > 0): ?>
    <?php
        // প্রতি পৃষ্ঠায় 4টা applicant দেখাবে
        $chunks = $employees->chunk(4);
    ?>

    <?php $__currentLoopData = $chunks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <table style="width: 100%; margin-top: 20px;">
            <?php $__currentLoopData = $page->chunk(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td style="width: 50%; padding: 5px;" valign="top">
                            <table style=" width: 100%; border: 1px solid #000; line-height: 1.6em; font-size: 15px; height: 920px; min-height: 920px;">
                                 <tr>
                                    <td colspan="2" style="text-align: center;">
                                        
                                        <span style="font-size: 20px;"> <?php echo e($employee->org_bn_name ?? "আয়েশা এন্ড গালিয়া ফ্যাশন্স লিমিটেড"); ?> 
                                    </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center; font-weight: bold; font-size: 18px; background: #faf7fc; color: #000;">
                                        সাময়িক গেট পাস
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td colspan="2" style="width: 100%; vertical-align: top; font-size: 14px;">
                                        
                                        <strong>নাম :-</strong> <?php echo e($employee->name_bangla); ?><br>
                                        <strong>পদবী :-</strong> <?php echo e($employee->designation->designation_bn ?? '-'); ?> &nbsp; &nbsp; &nbsp; &nbsp; <strong>সেকশন/লাইন :-</strong> <?php echo e($employee->department->department_bn ?? '-'); ?> / <?php echo e(bnNumber($employee->line_name ?? '-')); ?><br>
                                        <strong>যোগদানের তারিখ- :-</strong> <?php echo e(bnNumber(date('d-m-Y', strtotime($employee->joining_date)))); ?> <br>
                                        <strong>বেতন:-</strong> <?php echo e(bnNumber(rtrim(rtrim(number_format($employee->determined_salary, 2), '0'), '.'))); ?>/- &nbsp; &nbsp; &nbsp; &nbsp; <strong> কার্ড নং :-</strong> <?php echo e(bnNumber(str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT))); ?><br>
                                        <!--<strong>বেতন:-</strong> <?php echo e(rtrim(number_format($employee->determined_salary ?? '-', 2), '0.')); ?>/- &nbsp; &nbsp; &nbsp; &nbsp; <strong> কার্ড নং :-</strong> <?php echo e(str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT)); ?><br>-->
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="vertical-align: bottom; height: 130px; font-size: 14px;"><br>
                                        <p><i>ইনচার্জ/ আই ই</i>&nbsp; &nbsp; &nbsp; &nbsp; <i>পিএম/কিউএম</i>&nbsp; &nbsp; &nbsp; &nbsp; <i>জিএম</i>&nbsp; &nbsp; &nbsp; &nbsp; <i>এডমিন</i></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: middle; font-size: 14px; padding-top: 6px;">
                                        <i>বিঃ দ্রঃ- যোগদানকারী শ্রমিককে অবশ্যই যোগদানের সময় জন্ম নিবন্ধন/জাতীয় পরিচয় পত্র ২ কপি, নাগরিকত্ব সনদ পত্র ১ কপি, শ্রমিকের পার্সপোট সাইজের ছবি ৫ কপি, নমিনী (মা/বাবা/ভাই/বোন/স্বামী/স্ত্রী) এর জাতীয় পরিচয় পত্র ০২ কপি, পাসপোর্ট সাইজের ছবি ২ কপি। সহ সকল প্রয়োজনীয় কাগজপত্র জমা দিয়ে এইচ আর বিভাগ থেকে আইডি কার্ড সংগ্রহ করতে হবে।</i>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: middle; font-size: 14px; padding-top: 6px;">
                                        <i> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;যে কোন সহযোগিতার / পরামর্শ  জন্য যোগাযোগ করুন। <br> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;এডমিন বিভাগ  +880 1840-818701</i>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <?php for($i = count($row); $i < 2; $i++): ?>
                        <td style="width: 50%;"></td>
                    <?php endfor; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>

        
        <div class="page-break"></div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <div style="text-align:center; font-size:14px; padding:30px;">
        No Applicants Found
    </div>
<?php endif; ?>
    
    </div>    
</body>
</html><?php /**PATH C:\laragon\www\garments_erp\Modules\HRIS\resources\views\report\applicant\applicantpdf.blade.php ENDPATH**/ ?>