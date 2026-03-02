<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Applicant Report</title>
    <link rel="shortcut icon" href="{{ public_path('backend/assets/images/logo-sm.svg') }}">
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
        src: url('{{ public_path('fonts/NotoSansBengali.ttf') }}') format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    body body {
        font-family: 'notosansbengali';
        font-size: 13px;
    }
  /*       @font-face {
        font-family: 'NotoSansBengali';
        src: url('{{ public_path('fonts/NotoSansBengali.ttf') }}') format('truetype');
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
    {{-- <style>
        @import url(//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic);
        html,
        body {
            min-height: 100%;
            font-size: 14px;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-weight: 400;
            overflow-x: hidden;
            overflow-y: hidden;            
        }
        @page {
            margin-top: 30px;
            margin-bottom: 30px;
            margin-right: 35px;
            margin-left: 35px;
        }        
        .footer {
            width: 100%;
            text-align: center;
            position: fixed;
            height: 40px;
            bottom: 0px; 
            left: 0px; 
            right: 0px;
        }            
        table{ border-collapse: collapse;} 
        tr.border_top td { border: thin solid black; }
        tr.border_top2 td { border: thin dashed black; }
        tr.border_top_only td { border-top: thin solid black; }
        tr.border_top th { border: thin solid black; }
        .page-break { page-break-after: always; }
        /*.table{
            border: thin solid;
        }*/
    </style> --}}
</head>
<body>   
     <!-- Watermark -->
    {{-- <div class="watermark">
        {{ $general->full_name }} - {{ now()->format('Y') }}
    </div> --}}
   {{--  <img src="{{ public_path('backend/assets/images/logo-sm.svg') }}" class="watermark-image" alt="watermark"> --}}
    <!-- Header -->
   {{--  <header>
        <div style="display: flex; align-items: center;">
            <!-- Logo -->
            <div>
                <img src="{{ public_path('backend/assets/images/logo-sm.svg') }}" alt="Logo" style="width: 40px; height: 40px;">
            </div>

            <!-- Company Info -->
            <div class="company-info">
                <div style="font-weight: bold; font-size: 14px; font-family: italic; font-family: solaimanlipi;" >{{ $general->full_name }}</div>
                <div style="font-size: 12px;font-weight: normal; font-family: italic; font-family: solaimanlipi;">01, Hariken Road, Dawlotpur, National University, Gazipur</div>
                <div style="font-size: 12px;font-weight: normal; font-family: italic; font-family: solaimanlipi;">Email: info@company.com | Ph: +880123456789</div>
            </div>
        </div>
        <hr style="border: 1px solid #ccc;">
    </header> --}}

    <!-- Footer -->
    <footer>
        <div style="display: flex; justify-content: space-between; font-size: 10px;">
            <div>
                Printed by {{ auth()->user()->name ?? 'System' }}
            </div>
            <div>
                Page <span class="page"></span> | {{ now()->format('d-m-Y h:i A') }}
            </div>
        </div>
    </footer> 
    <div class="row">
         
        
           
@if(count($employees) > 0)
    @php
        // প্রতি পৃষ্ঠায় 4টা applicant দেখাবে
        $chunks = $employees->chunk(4);
    @endphp

    @foreach($chunks as $page)
        <table style="width: 100%; margin-top: 20px;">
            @foreach($page->chunk(2) as $row)
                <tr>
                    @foreach($row as $employee)
                        <td style="width: 50%; padding: 5px;" valign="top">
                            <table style=" width: 100%; border: 1px solid #000; line-height: 1.6em; font-size: 15px; height: 920px; min-height: 920px;">
                                 <tr>
                                    <td colspan="2" style="text-align: center;">
                                        {{-- <img src="{{ public_path('backend/assets/images/logo-sm.svg') }}" width="40" height="40" alt="Logo">
                                        <br> --}}
                                        <span style="font-size: 20px;">{{-- {{ $general->full_name }} --}} {{ $employee->org_bn_name ?? "আয়েশা এন্ড গালিয়া ফ্যাশন্স লিমিটেড"  }} 
                                    </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center; font-weight: bold; font-size: 18px; background: #faf7fc; color: #000;">
                                        সাময়িক গেট পাস
                                    </td>
                                </tr>
                                <tr>
                                    {{-- <td style="width: 40%;">
                                        <img src="{{ public_path('uploads/photos/default.png') }}" width="90" height="110" alt="Photo">
                                    </td> --}}
                                    <td colspan="2" style="width: 100%; vertical-align: top; font-size: 14px;">
                                        {{-- <strong>আইডি কার্ড নং :-</strong> {{ str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT) }}<br>
                                        <strong>নাম :-</strong> {{ $employee->name_bangla }}<br>
                                        <strong>সেকশন/লাইন :-</strong> {{ $employee->department_name ?? '-' }}<br>
                                        <strong>পদবী :-</strong> {{ $employee->designation_name ?? '-' }}<br>
                                        <strong>বেতন:-</strong> {{ $employee->basic_salary ?? '-' }}<br>
                                        <strong>যোগদানের তারিখ- :-</strong> {{ date('d-m-Y', strtotime($employee->joining_date)) }} --}}
                                        <strong>নাম :-</strong> {{ $employee->name_bangla }}<br>
                                        <strong>পদবী :-</strong> {{ $employee->designation->designation_bn ?? '-' }} &nbsp; &nbsp; &nbsp; &nbsp; <strong>সেকশন/লাইন :-</strong> {{ $employee->department->department_bn ?? '-' }} / {{ bnNumber($employee->line_name ?? '-') }}<br>
                                        <strong>যোগদানের তারিখ- :-</strong> {{ bnNumber(date('d-m-Y', strtotime($employee->joining_date))) }} <br>
                                        <strong>বেতন:-</strong> {{ bnNumber(rtrim(rtrim(number_format($employee->determined_salary, 2), '0'), '.')) }}/- &nbsp; &nbsp; &nbsp; &nbsp; <strong> কার্ড নং :-</strong> {{ bnNumber(str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT)) }}<br>
                                        <!--<strong>বেতন:-</strong> {{ rtrim(number_format($employee->determined_salary ?? '-', 2), '0.') }}/- &nbsp; &nbsp; &nbsp; &nbsp; <strong> কার্ড নং :-</strong> {{ str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT) }}<br>-->
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
                    @endforeach

                    {{-- যদি কোনো রোতে ২টার কম হয় --}}
                    @for($i = count($row); $i < 2; $i++)
                        <td style="width: 50%;"></td>
                    @endfor
                </tr>
            @endforeach
        </table>

        {{-- প্রতিটা পেজ শেষে নতুন পৃষ্ঠা --}}
        <div class="page-break"></div>
    @endforeach
@else
    <div style="text-align:center; font-size:14px; padding:30px;">
        No Applicants Found
    </div>
@endif
    
    </div>    
</body>
</html>