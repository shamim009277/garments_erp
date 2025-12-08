<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="utf-8">
<title>চাকরিতে যোগদান পত্র</title>
<style>
     @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap');
    @font-face {
        font-family: 'NotoSansBengali';
        src: url('{{ public_path('fonts/NotoSansBengali.ttf') }}') format('truetype');
        font-weight: normal;
        font-style: normal;
    }
    body {
        font-family: 'NotoSansBengali';
        font-size: 14px;
        margin: 40px;
        color: #000;
    }
/*     .font-bold {
    font-size: 15px;
    letter-spacing: 0.3px;
    -webkit-text-stroke: 0.3px #000;
} */
    .header { text-align: center; line-height: 1.4; }
    .company-name {
        color: #0047ba;
        font-size: 22px;
        /* font-weight: bold; */
    }
    .font-body {
        font-size: 15px;
        letter-spacing: 0.3px;
        -webkit-text-stroke: 0.3px #000;
    }
    .company-address {
        color: #0047ba;
        font-size: 12px;
    }
    .title {
        text-align: center;
       /*  font-weight: bold; */
        margin: 25px 0;
        text-decoration: underline;
    }
    .content { margin-top: 20px; font-size: 14px; line-height: 1.6; }
    .footer { margin-top: 60px; }
    .sign-section { width: 100%; margin-top: 50px; }
    .sign-section td { width: 50%; text-align: center; vertical-align: top; }
    .underline { border-top: 1px solid #000; display: inline-block; width: 150px; margin-top: 20px; }
    .note { text-align: center; font-size: 12px; margin-top: 30px; solid #000; padding-top: 3px; }
</style>
</head>
<body>

    <div class="header">
        <table width="100%">
            <tr>
                <!-- Left: Logo -->
                <td style="width: 15%; text-align: left; vertical-align: middle;">
                    <img src="{{ public_path('backend/assets/images/logo-sm.svg') }}" width="50" height="50" alt="Logo">
                </td>

                <!-- Center: Company Name & Address -->
                <td style="width: 85%; text-align: center; line-height: 1.4;">
                    <div class="company-name">আয়েশা এন্ড গালিয়া ফ্যাশন্স লিমিটেড</div>
                    <div class="company-address">০১, হারিকেন রোড, দাউলতপুর, জাতীয় বিশ্ববিদ্যালয়, গাজীপুর।</div>
                </td>
            </tr>
        </table>
    </div>
    {{-- <?php //dd($title); ?> --}}
    @if($title == 1)
    <div class="title font-bold">চাকরিতে যোগদান পত্র</div>

    <table>
        <tr>
            <td>তারিখ: {{ date('d/m/Y') }}</td>
        </tr>
    </table>

    <div class="content">
        <p class="font-body">বরাবর,<br>
        ব্যবস্থাপনা পরিচালক, <br>
        আয়েশা এন্ড গালিয়া ফ্যাশন্স লিমিটেড<br>
        ০১, হারিকেন রোড, দাউলতপুর, জাতীয় বিশ্ববিদ্যালয়, গাজীপুর।</p>

        <div class="font-bold">বিষয়ঃ চাকরিতে যোগদান পত্র।</div>

        <p class="font-body">জনাব,<br>
        আমি - {{ $employee->name_bangla ?? '................................' }} <br>
        পিতা - {{ $employee->fname_bangla ?? '................................' }} <br>
        গ্রাম - {{ $employee->mvillage_bangla ?? '................................' }} <br>
        ডাকঘর - {{ $employee->mpost_office_bangla ?? '................................' }} <br>
        উপজেলা - {{ $employee->thana_name ?? '................................' }} <br>
        জেলা - {{ $employee->district_name ?? '................................' }} <br><br>

        নিয়োগ পত্রের সকল শর্ত মেনে নিয়ে আজকের তারিখ হতে চাকরিতে যোগদান করিলাম।</p>

        <p class="font-body">তারিখঃ {{ date('d-m-Y', strtotime($employee->joining_date ?? '................................' ))}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; স্বাক্ষরঃ ____________________</p>
    </div>

    <div class="footer">
        <table class="sign-section">
            <tr>
                <td>
                    <div>Sign</div>
                    <p class="font-body underline">অফিসার/এক্সিকিউটিভ/ম্যানেজার</p>
                </td>
                <td>
                    <div>Sign</div>
                    <p class="font-body underline">বিভাগীয় প্রধান</p>
                    <p class="font-body">মানব সম্পদ উন্নয়ন বিভাগ</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="note">
        যোগদান পত্র গ্রহণ করা হইল
    </div>
    @elseif($title == 2)
    {{-- নিয়োগ পত্র --}}
    <div class="title font-bold">নিয়োগ পত্র</div>
         <!-- Employee Basic Info -->
    <table class="info-table font-body">
        <tr>
            <td>নাম : {{ $employee->name_bangla }}</td>
            <td>পিতার নাম : {{ $employee->fname_bangla }}</td>
        </tr>
        <tr>
            <td>মাতার নাম : {{ $employee->mname_bangla ?? '---------'}} </td>
            <td>মোবাইল : {{ $employee->mobile ?? '---------'}} </td>
        </tr>
        <tr>
            <td>বর্তমান ঠিকানা : {{ $employee->mvillage_bangla }}, {{ $employee->mpost_office_bangla }}</td>
            <td>জেলা : {{ $employee->district_name }}</td>
        </tr>
        <tr>
            <td>যোগদান তারিখ : {{ date('d/m/Y', strtotime($employee->joining_date)) }}</td>
            <td>পদবী : {{ $employee->designation_name }}</td>
        </tr>
    </table>

    <br>

    <!-- Body Content -->
    <p>
        আপনাকে জানানো যাচ্ছে যে, উপরোক্ত তথ্য বিবেচনায় আপনাকে {{ $employee->designation_name }} পদে নিয়োগ প্রদান করা হলো।
        আপনার যোগদান তারিখ {{ date('d/m/Y', strtotime($employee->joining_date)) }} খ্রি.।
        নিম্নে আপনার বেতন ও অন্যান্য শর্তাবলী প্রদান করা হলো:
    </p>

    <!-- Salary Section -->
    <div class="section-title">১। বেতন :</div>

    <table width="80%" class="info-table">
        <tr>
            <td>(ক) মূল বেতন :</td>
            <td>{{ number_format($employee->basic, 2) }} টাকা</td>
        </tr>
        <tr>
            <td>(খ) বাড়িভাড়া (মূল বেতনের ৫০%) :</td>
            <td>{{ number_format($employee->basic * 0.5, 2) }} টাকা</td>
        </tr>
        <tr>
            <td>(গ) চিকিৎসা ভাতা :</td>
            <td>{{ number_format($employee->medical_allowance, 2) }} টাকা</td>
        </tr>
        <tr>
            <td>(ঘ) যাতায়াত ভাতা :</td>
            <td>{{ number_format($employee->conveyance, 2) }} টাকা</td>
        </tr>
        <tr>
            <td>(ঙ) খাবার ভাতা :</td>
            <td>{{ number_format($employee->food_allowance, 2) }} টাকা</td>
        </tr>
        <tr>
            <td class="font-body underline">মোট বেতন : </td>
            <td class="font-body underline">{{ number_format($employee->basic + $employee->home_allowance + $employee->medical_allowance + $employee->food_allowance + $employee->conveyance, 2) }} টাকা</td>
        </tr>
    </table>

    {{-- <p>মোট বেতন : {{ number_format($employee->basic_salary * 1.5 + 750 + 450 + 1350, 2) }} টাকা</p> --}}
{{--     <p>মোট বেতন : {{ number_format($employee->basic + $employee->home_allowance + $employee->medical_allowance + $employee->food_allowance + $employee->conveyance, 2) }} টাকা</p> 
 --}}
    <!-- Other Sections -->
    <div class="section-title">২। কর্মঘন্টা ও উপস্থিতি :</div>
    <p>
        ক) দৈনিক কর্মঘন্টা ৮ (আট) ঘণ্টা ...<br>
        খ) সপ্তাহে ৬ (ছয়) দিন কাজ ...<br>
    </p>

    <div class="section-title">৩। ছুটির নিয়মাবলী :</div>
    <p>
        ক) উৎসব ছুটি: ১১ (এগারো) দিন।<br>
        খ) অর্জিত/বার্ষিক ছুটি: ১ (এক) বছরের চাকুরীকালে ১৮ (আঠারো) দিনের জন্য ১ (এক) দিন হারে ছুটি প্রদান করা হবে। ৭ (সাত) দিন পূর্বে আবেদন করতে হবে। ছুটি মঞ্জুর করা না কর্তৃপক্ষের এখতিয়ারভুক্ত। ছুটি আগামী বছরের জন্য জমা রাখা যাবে তবে ৪০ (চল্লিশ) দিনের অধিক নয়।<br>
        গ) নৈমিত্তিক ছুটি/ঐচ্ছিক ছুটি: ১০ (দশ) দিন (বেতন/পারিশ্রমিকসহ)।<br>
        ঘ) অসুস্থতাজনিত ছুটি: ১৪ (চৌদ্দ) দিন (বেতন/পারিশ্রমিকসহ)।<br>
        ঙ) মাতৃত্বজনিত ছুটি: ১৬ (ষোল) সপ্তাহ বা ৪ (চার) মাস।<br>
        &nbsp;&nbsp;&nbsp;&nbsp;শর্ত: ৬ (ছয়) মাসের চাকুরী থাকলে বেতন/পারিশ্রমিকসহ ছুটি প্রদান করা হবে। ৬ (ছয়) মাসের কম চাকুরীকাল হলে অথবা ২ (দুই) বা ততোধিক জীবিত সন্তান থাকলে বেতন/পারিশ্রমিক ছাড়া ছুটি প্রদান করা হবে। ছুটি গ্রহণের পূর্বে সংশ্লিষ্ট কর্মকর্তার নিকট প্রয়োজনীয় চিকিৎসা সংক্রান্ত কাগজপত্র জমা দিতে হবে।
    </p>

    <div class="section-title">৪। ছুটির সাধারণ নিয়মাবলী :</div>
    <p>
        ক) যে সকল কর্মী ছুটি ভোগ করতে ইচ্ছুক, তাদেরকে নির্ধারিত ছুটির আবেদন ফরমে আবেদনপত্র পূরণ পূর্বক অফিসে জমা দিতে হবে।<br>
        খ) আবেদনপত্র অনুমোদন সাপেক্ষে ছুটি ভোগ করতে হবে। অন্যথায় তা অপরাধ বলে গণ্য হবে।<br>
        গ) অনুমতি ব্যতিরেকে কোন কর্মী যদি ১০ (দশ) দিনের অধিক কারখানা হতে অনুপস্থিত থাকে তবে তার বিরুদ্ধে আইনানুগ ব্যবস্থা নেওয়া হবে। তবে অসুস্থতার কারণে অনুপস্থিত থাকলে প্রয়োজনীয় চিকিৎসা সংক্রান্ত কাগজপত্র দাখিল করলে বিষয়টি বিবেচনা করা হবে।
    </p>

    <div class="section-title">৫। চাকুরী ছাড়ার নিয়মাবলী :</div>
    <p>
        ক) স্থায়ী কর্মীর ক্ষেত্রে: বাংলাদেশ শ্রম আইন ২০০৬/২০১০ এর ২৭(১) ধারা মোতাবেক ২ (দুই) মাস (৬০ দিন) পূর্বে নোটিশ প্রদান করতে হবে। অস্থায়ী কর্মীর ক্ষেত্রে ৩০ (ত্রিশ) দিন পূর্বে নোটিশ প্রদান করতে হবে। নোটিশের বিনিময়ে নোটিশকালীন সময়ের বেতন/পারিশ্রমিকের সমপরিমাণ অর্থ মালিককে পরিশোধ করে চাকুরী ত্যাগ করতে পারবে।<br>
        খ) অসুস্থতার কারণে: অসুস্থতার কারণে চাকুরী ছাড়তে চাইলে চিকিৎসা সংক্রান্ত সনদপত্র দাখিল করতে হবে। এক্ষেত্রে নোটিশের প্রয়োজন হবে না।<br>
        গ) ক্লিয়ারেন্স: চাকুরী ত্যাগ করার পর কোম্পানির প্রদত্ত ড্রেস, কাটার, টেপ ইত্যাদি সংশ্লিষ্ট ব্যক্তির নিকট জমা দিয়ে কারখানা হতে ক্লিয়ারেন্স নিতে হবে।
    </p>

    <div class="section-title">৬। কোম্পানী কর্তৃক চাকুরী চ্যুতি বা অবসান :</div>
    <p>
        ক) স্থায়ী কর্মীর ক্ষেত্রে: বাংলাদেশ শ্রম আইন ২০০৬ এর ২৬ ধারা মোতাবেক ১২০ (একশত বিশ) দিনের নোটিশ প্রদান করতে হবে অথবা সমপরিমাণ বেতন/ভাতা প্রদান করতে হবে।<br>
        খ) অসদাচরণ ও শাস্তি: কোন প্রমাণিত অসদাচরণের ক্ষেত্রে সর্বোচ্চ শাস্তি (আইনের আওতায়) চাকুরী চ্যুতিও হতে পারে।
    </p>

    <div class="section-title">৭। অন্যান্য শর্তাবলী :</div>
    <p>
        কোম্পানির নিয়মকানুন মেনে চলতে হবে এবং প্রযোজ্য সকল আইন-কানুন মেনে চলতে হবে।<br>
    </p>

    <br><br>

    <!-- Footer Signature -->
    <table width="100%">
        <tr>
            <td style="text-align:center;">
                <div class="underline"></div>
                শ্রমিকের স্বাক্ষর
            </td>
            <td style="text-align:center;">
                <div class="underline"></div>
                মানব সম্পদ উন্নয়ন বিভাগ
            </td>
        </tr>
    </table>
    @elseif($title == 3)
    @elseif($title == 4)
    @elseif($title == 5)
    @elseif($title == 6)
    @endif
</body>
</html>
