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
.hanging-table {
    width: 100%;
    border-collapse: collapse;
}

.hanging-number {
    width: 35px; /* এখানে space adjust হবে */
    vertical-align: top;
    padding-top: 3px;
}

.hanging-text {
    text-align: justify;
    line-height: 1.2;
}
.hanging {
    padding-left: 45px;    /* পুরো ব্লক ডানদিকে */
    text-indent: -35px;    /* শুধু প্রথম লাইন বামে */
    line-height: 1.3;
}
.left-col {
    width: 140px; /* এখানে width fix করবেন */
    vertical-align: top;
    padding-top: 3px;
}

.right-col {
    text-align: justify;
    line-height: 1.2;
}
.nominee-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.nominee-table th,
.nominee-table td {
    border: 1px solid #000;
    padding: 5px;
    vertical-align: top;
    font-size: 12px;
}

.nominee-table th {
    text-align: center;
    font-weight: bold;
}

.signature-footer{
    position: fixed;
    bottom: 30px;   /* page bottom থেকে একটু উপরে */
    left: 40px;
    right: 40px;


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
            <td>তারিখ: {{ bnNumber(date('d-m-Y')) }}</td>
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


        <p class="font-body">তারিখঃ {{ bnNumber( date('d-m-Y', strtotime($employee->joining_date ?? '................................' )))}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; স্বাক্ষরঃ ____________________</p>
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
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>পিতার নাম : {{ $employee->fname_bangla }}</td>
            <td>মাতার নাম : {{ $employee->mname_bangla ?? '---------'}} </td>
            <td></td>
        </tr>
        <tr>
            <td>স্বামী/স্ত্রীর নাম : {{ $employee->relation_bangla ?? '---------'}} </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>বর্তমান ঠিকানা : গ্রাম : {{ $employee->pvillage_bangla }} থানা  : {{ $employee->thana_name_p }} <br> &emsp;&emsp;&emsp;&emsp; ডাকঘর :{{ $employee->ppost_office_bangla }} জেলা : {{ $employee->district_name_p }}</td>
            <td></td>
            <td></td>
        </tr>
         <tr>
            <td>স্থায়ী ঠিকানা : গ্রাম : {{ $employee->mvillage_bangla }} থানা  : {{ $employee->thana_name }} <br> &emsp;&emsp;&emsp;&emsp; ডাকঘর :{{ $employee->mpost_office_bangla }} জেলা : {{ $employee->district_name }}</td>
            <td></td>
            <td></td>
        </tr>
         <tr>
            <td>জাতীয় পরিচয়পত্র নং : {{ $employee->national_id ?? '---------'}} </td>
            <td>জন্ম নিবন্ধনপত্র নং : {{ $employee->birth_certificate ?? '---------'}}</td>
            <td></td>
        </tr>
        <tr>
            <td>সনাক্তকরণ চিহ্ন(যদি থাকে) : {{ $employee->identification ?? '---------'}} </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>জন্ম তারিখ : {{  bnNumber(date('d-m-Y', strtotime($employee->birth_date ?? '---------')) ) }} </td>
            <td> কাজে যোগদানের তারিখ : {{ $employee->joining_date ? bnNumber(date('d-m-Y', strtotime($employee->joining_date))) : '---------'}} </td>
            <td></td>
        </tr>
        <tr>
            <td>আপনার আবেদনের প্রেক্ষিতে আপনাকে {{  $employee->designation_name ?? '---------'}}  পদে </td>
            <td>নিয়োগ করা হইলো। গ্রেড নং {{ $employee->grade ?? '---------'}}</td>
            <td></td>
        </tr>
        <tr>
            <td>আপনার কার্ড নং : {{ bnNumber($employee->emp_id ?? '---------') }}</td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <br>

    <!-- Body Content -->
    <div class="section-title">নিয়োগের শর্তাবলি/নিয়মাবলি :</div>
    {{-- <p class="hanging">
      ১।   --}} {{-- আপনাকে জানানো যাচ্ছে যে, উপরোক্ত তথ্য বিবেচনায় আপনাকে {{ $employee->designation_name }} পদে নিয়োগ প্রদান করা হলো।
        আপনার যোগদান তারিখ {{ date('d/m/Y', strtotime($employee->joining_date)) }} খ্রি.।
        নিম্নে আপনার বেতন ও অন্যান্য শর্তাবলী প্রদান করা হলো: --}}
       
          {{--   {{ date('d/m/Y', strtotime($employee->joining_date)) }} ইং তারিখ হইতে এই নিয়োগ কার্যকর হইবে এবং পরবর্তী ৩ (তিন) মাস প্রবেশনারী পিরিয়ড হিসাবে গন্য হইবে । 
       আপনি যদি ০৩ (তিন) মাসে শিক্ষানবিশ কাল সফলভাবে শেষ করিতে না পারেন তবে আপনার শিক্ষানবিশ কাল আরও ০৩ (তিন) মাস পর্যন্ত বর্ধিত করা হতে পারে। বর্ধিত ০৩ (তিন) মাসেও 
       যদি আপনি কাজের দক্ষতা দেখাতে ব্যর্থ হন তবে কোন প্রকার নোটিশ ছাড়াই আপনাকে চাকুরী হতে অবসান করার অধিকার কর্তৃপক্ষ সংরক্ষণ করেন। সন্তোষজনকভাবে শিক্ষানবিশ কাল সমাপ্তির
        পর আপনি এই প্রতিষ্ঠানে একজন স্থায়ী শ্রমিক হিসাবে গণ্য হবেন তবে এই মর্মে কোন চিঠি প্রদান করা হবেনা । --}}
       
 {{--    </p> --}}
        <table class="hanging-table">
            <tr>
                <td class="hanging-number">১।</td>

                <td class="hanging-text">
                {{ $employee->joining_date ? bnNumber(date('d-m-Y', strtotime($employee->joining_date))) : '---------' }} ইং তারিখ হইতে এই নিয়োগ কার্যকর হইবে এবং পরবর্তী ৩ (তিন) মাস প্রবেশনারী পিরিয়ড হিসাবে গন্য হইবে । 
            আপনি যদি ০৩ (তিন) মাসে শিক্ষানবিশ কাল সফলভাবে শেষ করিতে না পারেন তবে আপনার শিক্ষানবিশ কাল আরও ০৩ (তিন) মাস পর্যন্ত বর্ধিত করা হতে পারে। বর্ধিত ০৩ (তিন) মাসেও 
            যদি আপনি কাজের দক্ষতা দেখাতে ব্যর্থ হন তবে কোন প্রকার নোটিশ ছাড়াই আপনাকে চাকুরী হতে অবসান করার অধিকার কর্তৃপক্ষ সংরক্ষণ করেন। সন্তোষজনকভাবে শিক্ষানবিশ কাল সমাপ্তির
                পর আপনি এই প্রতিষ্ঠানে একজন স্থায়ী শ্রমিক হিসাবে গণ্য হবেন তবে এই মর্মে কোন চিঠি প্রদান করা হবেনা ।
                </td>
            </tr>
        </table>


    <!-- Salary Section -->
    <div class="section-title hanging">২। বেতন :</div>

    <table width="80%" class="info-table hanging">
        <tr>
            <td>(ক) মূল বেতন :</td>
            <td>{{ bnNumber(number_format($employee->basic, 2)) }} টাকা</td>
        </tr>
        <tr>
            <td>(খ) বাড়িভাড়া (মূল বেতনের ৫০%) :</td>
            <td>{{ bnNumber(number_format($employee->basic * 0.5, 2)) }} টাকা</td>
        </tr>
        <tr>
            <td>(গ) চিকিৎসা ভাতা :</td>
            <td>{{ bnNumber(number_format($employee->medical_allowance, 2)) }} টাকা</td>
        </tr>
        <tr>
            <td>(ঘ) যাতায়াত ভাতা :</td>
            <td>{{ bnNumber(number_format($employee->conveyance, 2)) }} টাকা</td>
        </tr>
        <tr>
            <td>(ঙ) খাবার ভাতা :</td>
            <td>{{ bnNumber(number_format($employee->food_allowance, 2)) }} টাকা</td>
        </tr>
        <tr>
            <td class="font-body underline">মোট বেতন : </td>
            <td class="font-body underline">{{ bnNumber(number_format($employee->basic + $employee->home_allowance + $employee->medical_allowance + $employee->food_allowance + $employee->conveyance, 2)) }} টাকা</td>
        </tr>
    </table>

    {{-- <p>মোট বেতন : {{ number_format($employee->basic_salary * 1.5 + 750 + 450 + 1350, 2) }} টাকা</p> --}}
{{--     <p>মোট বেতন : {{ number_format($employee->basic + $employee->home_allowance + $employee->medical_allowance + $employee->food_allowance + $employee->conveyance, 2) }} টাকা</p> 
 --}}
    <!-- Other Sections -->
    <div class="section-title hanging">৩। কর্মঘন্টা ও ওভারটাইম :</div>
    <table width="100%" class="info-table hanging">
        <tr>
            <td>ক) দৈনিক কর্মঘন্টা :</td>
            <td> ৮ ঘন্টা (০৮:৩০ - ০৫:৩০ টা) । প্রতিদিন ০১ ঘন্টা লাঞ্চ বিরতি (০১:০০টা-০২:০০টা)।</td>
        </tr>
        @if($employee->ot_payable == "Y")
        <tr>
            <td>খ) ও.টি.হিসাব :</td>
            <td>মূল বেতনের দ্বিগুন হারে হিসাব করা হবে। হিসাব এইরূপ : মূল বেতন/২০৮*২= প্রতি ঘন্টার ওভারটাইম হার ।</td>
        </tr>
        <tr>
            <td class="left-col">গ) দৈনিক ও.টি. ঘন্টা :</td>
            <td class="right-col"> সর্বোচ্চ ০২ ঘন্টা (বাধ্যতামূলক নহে) । প্রতিদিন ০৮ ঘন্টার অতিরিক্ত (লাঞ্চ বিরতি ব্যতীত) ও সপ্তাহে ৪৮ ঘন্টার অতিরিক্ত সময় কাজকে ওভার টাইম হিসাবে গন্য করা হবে।</td>
        </tr>
        @endif
    </table>
     <div class="section-title hanging">৪। বেতন/পারিশ্রমিক প্রদানের তারিখ/সময় :</div>
    <table width="100%" class="info-table hanging">
        <tr>
            <td>প্রতি মাসের ৭ (সাত) কর্মদিবসের মধ্যে আপনার বেতন ও ওভারটাইম প্রদান করা হবে এবং তা কার্যদিবসের মধ্যে প্রদান করা হবে। </td>
        </tr>
    </table>
    <div class="section-title hanging">৫। অফিস সময়সূচী, ছুটি এবং বন্ধের দিনসমূহ :</div>
    <table width="100%" class="info-table hanging">
        <tr>
            <td>ক) ছুটি বা বন্ধের দিন সমূহ : <br>সাপ্তাহিক ছুটি :</td>
            <td>  <br>সপ্তাহে ১ (এক) দিন শুক্রবার অথবা নির্ধারিত কোনদিন।</td>
        </tr>
        <tr>
            <td>উৎসব ছুটি :</td>
            <td>১১ দিন (বেতন/পারিশ্রমিক সহ )</td>
        </tr>
        <tr>
            <td class="left-col">অর্জিত/বার্ষিক ছুটি :</td>
            <td class="right-col">বৎসরে প্রতি ১৮ দিন উপস্থিতির জন্য ১ দিন ছুটি (চাকুরীর মেয়াদ ১ বৎসর পূর্ন হওয়ার পর)। এ ছুটির জন্য কমপক্ষে ৭ দিন পূর্বে কর্তৃপক্ষের নিকট আবেদন করতে হবে। কর্তৃপক্ষের সুবিধা অনুসারে এ ছুটি মঞ্জুর করা হবে এই ছুটি জমা রেখে পরবর্তী বছরে উত্তরণ করা যাবে, তবে তা কখনোই ৪০ দিনের বেশি হবে না । </td>
        </tr>
        <tr>
            <td class="left-col">নৈমিত্তিক ছুটি/ঐচ্ছিক ছুটি :</td>
            <td class="right-col"> ১০ দিন ( বেতন/পারিশ্রমিক সহ )।</td>
        </tr>
        <tr>
            <td class="left-col">অসুস্থতাজনিত ছুটি :</td>
            <td class="right-col">১৪ দিন ( বেতন/পারিশ্রমিক সহ )।</td>
        </tr>
        <tr>
            <td class="left-col">মাতৃত্বজনিত ছুটি :</td>
            <td class="right-col">১৬ (ষোল) সপ্তাহ বা চার মাস। তবে শর্ত থাকে যে, যাদের চাকুরীর মেয়াদ ৬ (ছয়) মাস পূর্ন হবে তারা বেতন বা মজুরি সহ ছুটি পাবে এবং যাদের চাকুরীর মেয়াদ ৬ (ছয়) মাসের কম অথবা ২ (দুই) বা ততোধিক সন্তান জীবিত থাকলে তিনি বেতন বা মজুরী ছাড়া ছুটি পাবে। এখানে উল্লেখ্য যে, ছুটিতে যাওয়ার পূর্বে অবশ্যই প্রয়োজনীয় ডাক্তারী কাগজপত্র সংশিষ্ট কর্মকর্তার নিকট জমা দিতে হবে ।</td>
        </tr>
        <tr>
            <td>খ) ছুটির নিয়মাবলী :</td>
            <td>: কোন শ্রমিক/কর্মচারী ছুটি নিতে আগ্রহী হলে অবশ্যই নির্ধারিত আবেদন পত্র ফরম পূরন করে অফিসে জমা দিতেহবে। <br>
            : ছুটির আবেদনপত্র মঞ্জুর হলেই কেবল মাত্র শ্রমিক / কর্মচারী ছুটি ভোগ করতে পারবে। অন্যথায় অপরাধ হিসাবে গন্য হবে। <br>
            : যদি কোন শ্রমিক / কর্মচারী বিনা অনুমতিতে ১০ (দশ) দিনের বেশী কারখানায় অনুপস্থিত থাকে তবে তাহার বিরূদ্ধে আইনানুগ ব্যবস্থা গ্রহন করা যাইবে । তবে অসুস্থতার ক্ষেত্রে প্রয়োজনীয় চিকিৎসার কাগজ পত্র দাখিল করতে পারলে বিষয়টি বিবেচনা করা হবে ।</td>
        </tr>
    </table> <br> <br>
    <div class="section-title hanging">৬। চাকুরী ছাড়ার নিয়মাবলী :</div>
    <table width="100%" class="info-table hanging">
        <tr>
            <td> </td>
            <td>ক) স্থায়ী শ্রমিকদের চাকুরী ছাড়তে হলে বাংলাদেশের শ্রম আইন ২০০৬/২০১০ এর ২৭(১) ধারা অনুযায়ী চাকুরী ছাড়ার ২ মাস (৬০ দিন) এবং অস্থায়ী শ্রমিক ৩০ দিন আগে কর্তৃপক্ষকে লিখিত নোটিশ প্রদান করতে হবে অথবা বিনা নোটিশে যদি চাকুরী ছাড়তে চাহেন সে ক্ষেত্রে নোটিশ এর পরিবর্তে নোটিশ মেয়াদের জন্য মজুরীর সমপরিমান অর্থ মালিককে প্রদান করিতে হইবে।</td>
        </tr>
        <tr>
            <td> </td>
            <td>খ) অসুস্থতার কারনে চাকুরী ছেড়ে দিতে হলে মেডিকেল সার্টিফিকেট দাখিল করতে হবে। সেক্ষেত্রে নোটিশ প্রযোজ্য নয়।</td>
        </tr>
        <tr>
            <td> </td>
            <td>গ) চাকুরী ছাড়ার পর কোম্পানীর প্রদত্ত মালামাল অর্থাৎ ড্রেস, কাটার, টেপ বা অন্যান্য যন্ত্রপাতি ইত্যাদি দায়িত্বপ্রাপ্ত লোকের কাছে জমা দিয়ে কারখানা থেকে ক্লিয়ারেন্স নিতে হবে।</td>
        </tr>
    </table>
    <div class="section-title hanging">৭। কোম্পানী কর্তৃক চাকুরী চ্যুতি বা অবসান :</div>
    <table width="100%" class="info-table hanging">
        <tr>
            <td> </td>
            <td>ক) বাংলাদেশ শ্রম আইন ২০০৬ ধারা ২৬ অনুসারে স্থায়ী শ্রমিক এর চাকুরী অবসান করার জন্য ১২০ দিনের নোটিশ প্রদান করতে হবে। অথবা সমপরিমান বেতন/ভাতা প্রদান করতে হবে।</td>
        </tr>
        <tr>
            <td> </td>
            <td>খ) অসদাচরন এবং শাস্তিঃ যে কোন ধরনের অসদাচরনের (প্রমানীত হলে) জন্য শাস্তি প্রদানের ( আইনের আওতা ভুক্ত হলে) সর্বোচ্চ শাস্তি হতে পারে চাকুরী থেকে বরখাস্ত করন।</td>
        </tr>
    </table>
    <div class="section-title hanging">৮। সুবিধা সমূহ :</div>
    <table width="100%" class="info-table hanging">
        <tr>
            <td> </td>
            <td>ক) দুই (০২) ঈদে উৎসব বোনাস প্রদান করা হবে।</td>
        </tr>
        <tr>
            <td> </td>
            <td>খ) মাসের প্রতিটি কর্ম দিনে সঠিক সময়ে ফ্যাক্টরীতে উপস্থিত হলে ও কোন ছুটি ভোগ না করলে হাজিরা বোনাস প্রদান করা হবে।</td>
        </tr>
        <tr>
            <td> </td>
            <td>গ) বিনা খরচে ফ্যাক্টরীর ডাক্তার (এম.বি.বি.এস.) এবং প্যারাঃ ডাক্তার/নার্সের মাধ্যমে চিকিৎসা সুবিধা প্রদান করা হয়।</td>
        </tr>
        <tr>
            <td> </td>
            <td>ঘ) ৯% বাৎসরিক বর্ধিত বেতন (ইনক্রিমেন্ট) এর ব্যবস্থা আছে।</td>
        </tr>
    </table>
    <div class="section-title hanging">৯। বাংলাদেশের শ্রম আইন ২০০৬ মোতাবেক নিম্ন লিখিত কাজ বা ত্রুটি সমূহ অপরাধ হিসাবে গন্য হয়।</div>
    <table width="100%" class="info-table hanging">
        <tr>
            <td> </td>
            <td>ক) একাকি বা সংঘবদ্ধভাবে কোন ঊর্ধ্বতন কর্মকর্তার আইনানুগ বা যুক্তিসংগত আদেশ ইচ্ছাকৃতভাবে পালন না করা বা অবাধ্যতা করা;</td> 
        </tr>
        <tr>
            <td> </td>
            <td>খ) মালিকের ব্যবসা বা সম্পত্তি সংক্রান্ত ব্যাপারে চৌর্য, প্রতারনা বা অসাধুতা,</td>
        </tr>
        <tr>
            <td> </td>
            <td>গ) মালিকের অধীনে নিজের বা অন্য কোন শ্রমিকের চাকরির ব্যাপারে ঘুষ বা অবৈধ কোন পারিতোষিক গ্ৰহন বা প্রদান;</td>
        </tr>
        <tr>
            <td> </td>
            <td>ঘ) ছুটি ব্যাতিরেকে অভ্যাসগত অনুপস্থিতি বা ছুটি ব্যতিরেকে দশ দিনের বেশি অনুপস্থিতি;</td>
        </tr>
        <tr>
            <td> </td>
            <td>ঙ)অভ্যাসগতভাবে বিলম্বে উপস্থিতি;</td>
        </tr>
        <tr>
            <td> </td>
            <td>চ) শিল্প প্রতিষ্ঠানে হাঙ্গামামূলক বা উশৃঙ্খল আচরন অথবা নিয়মানুবর্তিতা ধ্বংসকারী কোন কাজ,</td>
        </tr>
        <tr>
            <td> </td>
             <td>ছ) শিল্প প্রতিষ্ঠানে প্রযোজ্য যে কোন আইন বা বিধান ভঙ্গ করার অভ্যাস;</td>
        </tr>
        <tr>
            <td> </td>
             <td>জ) কোন কাজ না করার অভ্যাস বা কাজে অবহেলা;</td>
        </tr>
        <tr>
            <td> </td>
               <td>ঝ) 'অবৈধ ধর্মঘট বা ধীরে কাজ করা” অথবা ধর্মঘট বা ধীরে কাজ করার জন্য অন্যদেরকে উল্কানি দেয়া;</td>
        </tr>
        <tr>
            <td> </td>
               <td>ঞ) মালিকের দলিল পত্র নষ্ট করা, ক্ষতি করা, বিকৃত বা মিথ্যা প্রতিপন্ন করা</td>
        </tr>
    </table>
    <div class="section-title hanging">১০। পরিচয়পত্র এবং পাঞ্চিং সিস্টেম।</div>
    <table width="100%" class="info-table hanging">
        <tr>
            <td> </td>
            <td>প্রত্যেক শ্রমিককে একটি করে পরিচয়পত্র দেয়া থাকবে । পরিচয়পত্র প্রদর্শন ব্যতীত কোন শ্রমিক কারখানায় প্রবেশ করিতে পারবে না । </td>
        </tr>
        <tr>
            <td> </td>
            <td>প্রত্যেক শ্রমিককে কারখানায় প্রবেশ এবং প্রস্থানের সময় অবশ্যই তার জন্য নির্ধারিত পাঞ্চিং মেশিনে আঙ্গুল পাঞ্চ করতে হবে।</td>
        </tr>
    </table>
    <div class="section-title hanging">১১। আপনার চাকুরীর অন্যান্য শর্তাবলী বাংলাদেশ শ্রম আইন ২০০৬ এবং সংশোধনী আইন ২০১০, ২০১৫, ২০১৮ ও ২০১৯ দ্বারা নিয়ন্ত্রিত হবে।</div>
    <table width="100%" class="info-table hanging">
        <tr>
            <td> </td>
            <td>আমি এই মর্মে ঘোষনা করছি যে, আমি কারও দ্বারা প্ররোচিত বা প্রলুব্ধ না হয়ে, কারও কোনরুপ জোর-জবরদস্তি ছাড়াই স্বজ্ঞানে ও স্বেচ্ছাই অত্র কারখানায় যোগদান করছি । আমি আরও অঙ্গিকার করছি যে, এই প্রতিষ্ঠানের সকল নিয়ম কানুন সর্বদা মেনে চলব।</td>
        </tr>
        <tr>
        <td> </td>
        <td>আমি  {{ $employee->name_bangla }} স্বজ্ঞানে ও স্বেচ্ছায় এই নিয়োগ পত্রের সকল শর্ত মেনে ও বুঝে স্বাক্ষর করলাম এবং এই নিয়োগ পত্রের এক কপি বুঝে পেলাম ৷
 </td>
        </tr>
        
    </table>


   {{--  <div class="section-title">৩। ছুটির নিয়মাবলী :</div>
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
    </p> --}}

   {{--  <div class="section-title">৫। চাকুরী ছাড়ার নিয়মাবলী :</div>
    <p>
        ক) স্থায়ী কর্মীর ক্ষেত্রে: বাংলাদেশ শ্রম আইন ২০০৬/২০১০ এর ২৭(১) ধারা মোতাবেক ২ (দুই) মাস (৬০ দিন) পূর্বে নোটিশ প্রদান করতে হবে। অস্থায়ী কর্মীর ক্ষেত্রে ৩০ (ত্রিশ) দিন পূর্বে নোটিশ প্রদান করতে হবে। নোটিশের বিনিময়ে নোটিশকালীন সময়ের বেতন/পারিশ্রমিকের সমপরিমাণ অর্থ মালিককে পরিশোধ করে চাকুরী ত্যাগ করতে পারবে।<br>
        খ) অসুস্থতার কারণে: অসুস্থতার কারণে চাকুরী ছাড়তে চাইলে চিকিৎসা সংক্রান্ত সনদপত্র দাখিল করতে হবে। এক্ষেত্রে নোটিশের প্রয়োজন হবে না।<br>
        গ) ক্লিয়ারেন্স: চাকুরী ত্যাগ করার পর কোম্পানির প্রদত্ত ড্রেস, কাটার, টেপ ইত্যাদি সংশ্লিষ্ট ব্যক্তির নিকট জমা দিয়ে কারখানা হতে ক্লিয়ারেন্স নিতে হবে।
    </p> --}}
    <br><br>

    <!-- Footer Signature -->
    <table width="100%">
        <tr>
            <td style="text-align:center;">
                <div class="underline"></div>
                বিভাগীয় প্রধান <br>
             মানব সম্পদ উন্নয়ন বিভাগ ।

            </td>
            <td style="text-align:center;">
                <div class="underline"></div>
                শ্রমিকের স্বাক্ষর
            </td>
        </tr>
    </table>
    @elseif($title == 3)
    <?php 

        $dob =  Carbon\Carbon::parse($employee->birth_date);
        $today =  Carbon\Carbon::today();

        $diff = $dob->diff($today);

        $years  = $diff->y;
        $months = $diff->m;
        $days   = $diff->d;

        $ageFull = bnNumber("{$days} দিন {$months} মাস {$years} বছর");


    ?>
        <div class="font-bold" style="text-align: center">
            মনোনয়ন ফরম – ৪১ <br>
            [ধারা-১৯, ১৩১(১)(ক), ১৫৫(২), ২৩৪, ২৬৪, ২৬৫ ও ২৭৩ এবং বিধি ১১৮(১), ১৩৬, ২৩২ (২), ২৬২(১), ২৮৯(১) ও ৩২১(১) দ্রষ্টব্য] 
        </div>
        <div class="title">
            (জমা ও বিভিন্নখাতে প্রাপ্য অর্থ পরিশোধের ঘোষনা ও মনোনয়ন ফরম)
        </div>

        <!-- Employee Info -->
        <table class="info-table">
            <tr>
                <td class="label">১। শ্রমিকের নাম ও ঠিকানা</td>
                <td class="value">: {{ $employee->name_bangla }}</td>
                <td class="label" style="text-align: right">লিঙ্গ</td>
                <td class="value">: @if($employee->sex_code == 'M') পুরুষ @else মহিলা @endif</td>
            </tr>
            <tr>
                <td></td>
                <td> গ্রাম : {{ $employee->pvillage_bangla }}</td>
                <td>ডাকঘর : {{ $employee->ppost_office_bangla }}</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td> থানা : {{ $employee->thana_name_p }}</td>
                <td>জেলা : {{ $employee->district_name_p }}</td>
            </tr>

            <tr>
                <td>২। পিতার নাম</td>
                <td>: {{ $employee->fname_bangla }}</td>
                <td>৩। স্বামী/স্ত্রীর নাম</td>
                <td>: {{ $employee->relation_bangla }}</td>
            </tr>
            <tr>
                <td>৪। মাতার নাম</td>
                <td>: {{ $employee->mname_bangla }}</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>৫। জন্ম তারিখ</td>
                <td>: {{ $employee->birth_date ? bnNumber(date('d-m-y', strtotime($employee->birth_date))) : '---------' }}</td>
                <td>বয়স</td>
                <td>: {{ $ageFull }}</td>
            </tr>
            <tr>
                <td>৬। সনাক্তকরণ চিহ্ন(যদি থাকে)</td>
                <td>: {{ $employee->identification ?? '---------'}}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>৭। স্থায়ী ঠিকানা</td>
                <td> গ্রাম : {{ $employee->mvillage_bangla }}</td>
                <td>ডাকঘর : {{ $employee->mpost_office_bangla }}</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td> থানা : {{ $employee->thana_name }}</td>
                <td>জেলা : {{ $employee->district_name }}</td>
            </tr>

            <tr>
                <td>৮। মোবাইল নম্বর</td>
                <td>: {{ $employee->mobile ?? '01XXXXXXXXX' }}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>৯। চাকুরীতে যোগদানের তারিখ</td>
                <td>: {{ $employee->joining_date ? bnNumber(date('d-m-Y', strtotime($employee->joining_date))) : '---------' }}</td>
                <td>১০। পদের নাম</td>
                <td>: {{ $employee->designation_name }}</td>
            </tr>
        </table>

        <!-- Declaration -->
        <div class="declaration">
        আমি {{ $employee->name_bangla }} এতদ্বারা ঘোষনা করিতেছি যে, আমার মৃত্যু হইলে বা আমার অবর্তমানে, আমার অনুকুলে জমা ও বিভিন্নখাতে <br>
        প্রাপ্য টাকা গ্রহনের জন্য আমি নিম্নবর্নিত ব্যক্তিকে / ব্যক্তিগনকে মনোনয়ন দান করিতেছি এবং নির্দেশ দিচ্ছি যে, উক্ত টাকা নিম্নবর্নিত পদ্ধতিতে মনোনীত <br>  
        ব্যক্তিদের মধ্যে বণ্টন করিতে হইবেঃ

        </div>

        <!-- Nominee Table -->
        <table class="nominee-table info-table">
            <tr>
                <td width="30%">মনোনীত ব্যক্তি/ব্যক্তিদের নাম, ঠিকানা ও ছবি <br>  (নমিনির ছবি ও স্বাক্ষর শ্রমিককর্তৃক সত্যায়িত) <br> এন আইডি নং</td>
                <td width="15%">সম্পর্ক</td>
                <td width="10%">বয়স</td>
                <td width="25%">প্রাপ্য অর্থের বিবরণ</td>
                <td width="10%">অংশ</td>
            </tr>
            <tr>
                <td width="30%" align="center">(১)</td>
                <td width="15%" align="center">(২)</td>
                <td width="10%" align="center">(৩)</td>
                <td width="25%" align="center">(৪)</td>
                <td width="10%" align="center">(৫)</td>
            </tr>

            <tr>
                <td class="font-bold">
                    নমিনির নাম : {{ $employee->nname_bangla }} <br>
                    পিতা/স্বামী : {{ $employee->name_bangla }} <br>
                    গ্রাম : {{ $employee->nvillage_bangla }} <br>
                    পোষ্ট : {{ $employee->npost_office_bangla }} <br>
                    থানা : {{ $employee->thana_name_n }} <br>
                    জেলা : {{ $employee->district_name_n }}<br>
                    এন আইডি : {{ $employee->national_id }} <br>
                    মোবাইল : {{ $employee->nmobile_number }}
                </td>
                <td align="center">Brother</td>
                <td align="center">২০ বছর</td>
                <td>
                    জমাপ্রাপ্ত <br>
                    বকেয়া মজুরী <br>
                    প্রভিডেন্ট ফান্ড <br>
                    বীমা <br>
                    দূর্ঘটনার ক্ষতিপূরন <br>
                    লভ্যাংশ <br>
                    অন্যান্য <br>
                    মোট
                </td>
                <td align="center">১০০%</td>
            </tr>
        </table>
        <table class="info-table">
            <tr>
                <td>প্রত্যায়ন করিতেছি যে, আমার উপস্থিতিতে জনাব/জনাবা</td>
                <td>: {{ $employee->nname_bangla ?? '' }}</td>
                <td></td>
                <td>লিপিবদ্ধ বিবরণসমূহ পাঠ করিবার পর</td>
            </tr>
            <tr>
                <td>উক্ত ঘোষনা স্বাক্ষর করিয়াছেন।</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>তারিখ সহ মনোনীত ব্যক্তির <br>স্বাক্ষর অথবা টিপসহি</td>
                <td></td>
                <td></td>
                <td>মনোনয়ন প্রদানকারীর শ্রমিকের স্বাক্ষর, টিপসহি ও <br> তারিখ :</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>(শ্রমিক কর্তৃক সত্যায়িত ছবি ) </td>
                <td></td>
                <td></td>
                <td>মালিকের বা প্রধিকারপ্রাপ্ত কর্মকর্তার স্বাক্ষর, টিপসহি ও <br> তারিখ :</td>
            </tr>
        </table>


        <!-- Signature -->
        {{-- <table class="signature-section">
            <tr>
                <td>
                    <div class="sign-line"></div>
                    তারিখ ও স্বাক্ষর<br>
                    শ্রমিক অথবা টিপসই
                </td>
                <td align="right">
                    <div class="sign-line"></div>
                    মনোনয়ন প্রদানকারী শ্রমিকের স্বাক্ষর, টিপসই ও তারিখ
                </td>
            </tr>
        </table> --}}
    @elseif($title == 4)
      {{--   <div class="font-bold" style="text-align: center">
            <table width="100%">
                <tr>
                    <td style="width: 20%"></td>
                    <td style="width: 20%"></td>
                    <td class="text-center" style="width: 60%">মনোনয়ন ফরম – ১৫</td>
                    
                </tr>
                 <tr>
                    <td style="width: 20%"></td>
                    <td style="width: 20%"></td>
                    <td class="text-center" style="width: 60%">
                        ফরম-১৫ [ধারা-৩৪,৩৬,৩৭ ও ২৭৭ এবং ৩৪ (১) ও ৩৬৬ (৪) দ্রষ্টব্য</td>
                </tr>
                 <tr>
                    <td style="width: 20%"></td>
                    <td style="width: 20%"></td>
                    <td class="text-center" style="width: 60%"> বয়স ও সক্ষমতার প্রত্যয়নপত্র</td>
                </tr>
            </table>

        </div> --}}
         {{-- <div class="font-bold" style="text-align: center">
            মনোনয়ন ফরম – ১৫ <br>
            ফরম-১৫ [ধারা-৩৪,৩৬,৩৭ ও ২৭৭ এবং ৩৪ (১) ও ৩৬৬ (৪) দ্রষ্টব্য <br>
             বয়স ও সক্ষমতার প্রত্যয়নপত্র
        </div> --}}
        {{-- <div class="title">
            (জমা ও বিভিন্নখাতে প্রাপ্য অর্থ পরিশোধের ঘোষনা ও মনোনয়ন ফরম)
        </div> --}}
        <table width="100%" style="margin-bottom: 10px;">
            <tr>
                <!-- Left / Center text -->
                <td style="text-align: center; vertical-align: middle;">
                    <div class="font-bold">
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp; মনোনয়ন ফরম – ১৫ <br>
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp; ফরম-১৫ [ধারা-৩৪,৩৬,৩৭ ও ২৭৭ এবং ৩৪ (১) ও ৩৬৬ (৪) দ্রষ্টব্য] <br>
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp; বয়স ও সক্ষমতার প্রত্যয়নপত্র
                    </div>
                </td>

                <!-- Right image -->
                <td style="width: 80px; text-align: right; vertical-align: middle;">
                    <img src="{{ public_path('backend/assets/images/logo-sm.svg') }}" width="120" height="80" alt="Logo">
                </td>
            </tr>
        </table>

        <table class="nominee-table info-table">
            <tr>
                <td>বয়স ও সক্ষমতার প্রত্যয়নপত্র</td>
                <td>বয়স ও সক্ষমতার প্রত্যয়নপত্র</td>
            </tr>
            <tr>
                <td>১. ক্রমিক নং : {{ $employee->employee_id }}</td>
                <td>১. ক্রমিক নং : {{ $employee->employee_id }}</td>
            </tr>
           <tr>
                <td>তারিখ : {{ $employee->joining_date ? bnNumber(date('d-m-Y', strtotime($employee->joining_date))) : '---------' }}</td>
                <td>তারিখ : {{ $employee->joining_date ? bnNumber(date('d-m-Y', strtotime($employee->joining_date))) : '---------' }}</td>
            </tr>
            <tr>
                <td>২। নাম : {{  $employee->name_bangla }}</td>
                <td  rowspan="3">আমি এই মর্মে প্রত্যয়ন করিতেছি যে,<br>
                    নাম : {{  $employee->name_bangla }} <br>
                    পিতার নাম : {{ $employee->fname_bangla }}<br>
                    মাতার নাম : {{ $employee->mname_bangla }}<br>
                    ঠিকানা : {{ $employee->mvillage_bangla }} <br>
                    কে আমি পরীক্ষা করিয়াছি।
                </td>
            </tr>
            <tr>
                <td>3। পিতার নাম : {{ $employee->fname_bangla }}</td>
                
            </tr>
            <tr>
                <td>৪। মাতার নাম : {{ $employee->mname_bangla }}</td>
                
            </tr>
            <tr>
                <td>৫। লিঙ্গ : @if($employee->sex_code == 'M') পুরুষ @else মহিলা @endif </td>
                <td>৫। লিঙ্গ : @if($employee->sex_code == 'M') পুরুষ @else মহিলা @endif </td>
            </tr>
            <tr>
                <td>৬। স্থায়ী/যোগাযোগের ঠিকানা : <br>
                    গ্রাম : {{ $employee->mvillage_bangla }} <br>
                    পোষ্ট : {{ $employee->mpost_office_bangla }} <br>
                    থানা : {{ $employee->thana_name }} <br>
                    জেলা : {{ $employee->district_name }}<br>
                </td>
                <td> তিনি প্রতিষ্ঠানে নিযুক্ত হইতে ইচ্ছুক, এবং আমার পরীক্ষা হইতে এইর <br> পাওয়া গিয়েছে যে, তাহার বয় ২৬ বৎসর এবং তিনি প্রতিষ্ঠানে <br> প্রাপ্তবয়স্ক/কিশোর হিসাবে নিযুক্ত হইবার যোগ্য । </td>
            </tr>
             <tr>
                <td>৭। অস্থায়ী/যোগাযোগের ঠিকানা : <br>
                    গ্রাম : {{ $employee->pvillage_bangla }} <br>
                    পোষ্ট : {{ $employee->ppost_office_bangla }} <br>
                    থানা : {{ $employee->thana_name_p }} <br>
                    জেলা : {{ $employee->district_name_p }}<br></td>
                <td> তাহার সনাক্তকরনের চিহ্ন :{{ $employee->identification ?? '--'}} </td>
            </tr>
            <tr>
                <td>৮। জন্ম সনদ/শিক্ষা সনদ অনুসারে বয়স/জন্ম তারিখ : {{ $employee->birth_date ? bnNumber(date('d-m-Y', strtotime($employee->birth_date))) : '---------' }}</td>
                <td></td>
            </tr>
            <tr>
                <td>৯। দৈহিক সক্ষমতা : {{ $employee->physical_capacity ?? '' }}</td>
                <td></td>
            </tr>
            <tr>
                <td>১০। সনাক্তকরনের চিহ্ন : {{ $employee->identification ?? '--'}}</td>
                <td></td>
            </tr>
            {{-- <tr>
                <td>
                    <table width="100%" border: 0; border-collapse: collapse;>
                        <tr>
                            <td style="text-align:left;">
                                সংশ্লিষ্ট ব্যক্তির <br> স্বাক্ষর/টিপসহি
                            </td>
                            <td style="text-align:right;">
                                রেজিস্টার্ড চিকিৎসকের <br> স্বাক্ষর
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" border: 0; border-collapse: collapse;>
                        <tr>
                            <td style="text-align:left;">
                                সংশ্লিষ্ট ব্যক্তির <br> স্বাক্ষর/টিপসহি
                            </td>
                            <td style="text-align:right;">
                                রেজিস্টার্ড চিকিৎসকের <br> স্বাক্ষর
                            </td>
                        </tr>
                    </table>
                </td>
            </tr> --}}
        </table>
        <div class="signature-footer">
        <table style="width: 100%;">
            <tr>
                <td><div><span>সংশিস্নষ্ট ব্যক্তির <br>  স্বাক্ষর/টিপসহি</span></div></td>
                <td><div><span style="text-align: right"> রেজিস্টার্ড চিকিৎসকের <br>স্বাক্ষর </span> </div></td>
                <td><div><span> &emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp; সংশিস্নষ্ট ব্যক্তির <br>&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp;  স্বাক্ষর/টিপসহি</span></div></td>
                <td><div><span style="text-align: right"> রেজিস্টার্ড চিকিৎসকের <br>স্বাক্ষর </span> </div></td>
            </tr>
            <tr>
                 <td></td>
                <td></td>
                 <td></td>
                <td></td>
            </tr>
        </table>
        </div>
    @elseif($title == 5)
        <table width="100%" style="margin-bottom: 10px;">
            <tr>
                <!-- Left / Center text -->
                <td style="text-align: center; vertical-align: middle;">
                    <div class="font-bold">
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp; Back Ground, History and Reference Check Format for security Purpose  <br>
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp; শ্রমিক / কর্মকর্তা / কর্মচারীদের জীবন বৃত্তান্তের সত্যায়িত তদন্ত প্রতিবেদন
                    </div>
                </td>

                <!-- Right image -->
                 {{-- <td style="width: 15%; border: 1px solid #000; height: 40px; vertical-align: top; padding: 5px;">সত্যায়িত</td> --}}
                 <td>
                    <table width="100%" style="margin-bottom: 10px;">
                        <tr>
                            <td style="text-align: center">আঙ্গলের ছাপ</td>
                        </tr>
                        <tr>
                            <td style="width: 50%; border-radius: 45px; border: 1px solid #000; height: 60px; vertical-align: top; padding: 5px;"></td>
                        </tr>
                    </table>
                 </td>
            </tr>
        </table>
        <table width="100%" style="margin-bottom: 10px;">
            <tr>
                <td>নাম : {{  $employee->name_bangla ?? '' }}</td>
                <td style="text-align: left">আইডি: {{ $employee->employee_id ?? '' }}</td>
            </tr>
            <tr>
                <td>তারিখ: {{ $employee->joining_date ? bnNumber(date('d-m-Y', strtotime($employee->joining_date))) : '' }}</td>
                <td style="text-align: left">পদবী: {{ $employee->designation_name ?? '' }}</td>
            </tr>
        </table>
        <table width="100%" style="margin-bottom: 10px;">
             <tr>
                <td colspan="1">নিরাপত্তার স্বার্থে এবং প্রতিটি শ্রমিক কর্মী ও কর্মকর্তা কর্মচারীর জীবন বৃত্তান্তের সত্যায়িত তদন্ত নীতিগত ভাবে প্রয়োজন। এই প্রয়োজনের কথা বিবেচনা 
                করিয়া, নিম্নের শুণ্য স্থান সমূহ পূরণ করা হলো।
                </td>
            </tr>
        </table>
        <table width="100%" style="margin-bottom: 10px;">
            <tr>
                <td>তথ্য দাতার বিবরন :</td>
                <td></td>
            </tr>
            <tr>
                <td>নাম: {{  $employee->name_bangla ?? '' }}</td>
                <td style="text-align: left">বয়স: {{ $ageFull ?? '' }}</td>
            </tr>
            <tr>
                <td>পিতার নাম: {{ $employee->fname_bangla ?? '' }}</td>
                <td style="text-align: left">পদবী: {{ $employee->designation_name ?? '' }}</td>
            </tr>
        </table>
        <table width="100%" style="margin-bottom: 10px;">
             <tr>
                <td style="width: 20%">বর্তমান ঠিকানা :</td>
                <td style="width: 80%; border: 1px solid #000; height: 60px; vertical-align: top; padding: 5px;"></td>
            </tr>
        </table>
         <table width="80%" style="margin-bottom: 10px;">
             <tr>
                <td>তথ্যদাতার সাথে শ্রমিক কর্মী ও কর্মকর্তা/কর্মচারীর সম্পর্ক :</td>
                <td style="text-align: left">সম্পর্ক :</td>
            </tr>
            <tr>
                <td>শ্রমিক কর্মী ও কর্মকর্তা/কর্মচারী কর্তৃক প্রদত্ত নাম ও ঠিকানা যাচাইকরণ :</td>
                <td></td>
            </tr>
        </table>
        <table width="100%" style="marge-bottom:10px;">
             <tr>
                <td>স্থায়ী/যোগাযোগের ঠিকানা :  গ্রাম : {{ $employee->mvillage_bangla }} </td>
                <td> থানা : {{ $employee->thana_name }}</td>
            </tr>
             <tr>
                <td>পোষ্ট : {{ $employee->mpost_office_bangla }} </td>
                <td> জেলা : {{ $employee->district_name }}</td>
            </tr>
            </table>
            <br>
        <table width="100%" style="marge-bottom:20px;">
            <tr>
                <td>অস্থায়ী/যোগাযোগের ঠিকানা : গ্রাম : {{ $employee->pvillage_bangla }} </td>
                <td>থানা : {{ $employee->thana_name_p }}</td>
            </tr>
            <tr>
                <td>পোষ্ট : {{ $employee->ppost_office_bangla }} </td>
                <td>  জেলা : {{ $employee->district_name_p }}</td>
            </tr>
        </table><br>
        <table width="100%" style="marge-bottom:20px;">
            <tr>
                <td>অন্যান্য যে সকল প্রশ্নের উত্তর প্রয়োজন :</td>
            </tr>
        </table>
        <table class="nominee-table info-table">
            <tr>
                <td>১. আপনি ব্যক্তিগত ভাবে তাকে কেমন জানেন ?
                </td>
                <td> ভাল
                </td>
                <td>তেমন কিছু জানি না
                </td>
                <td>মন্তব্য নাই
                </td>
            </tr>
            <tr>
                <td>২. অনাত্নীয় হলে কতদিন ধরে চেনেন ?
                </td>
                <td>অনেকদিন
                </td>
                <td>কয়েক দিন
                </td>
                <td>মন্তব্য নাই
                </td>
            </tr>
            <tr>
                <td>৩. আচরনে বা স্বভাবে কেমন ?
                </td>
                <td>ভাল
                </td>
                <td>তেমন কিছু জানি না
                </td>
                <td>মন্তব্য নাই
                </td>
            </tr>
            <tr>
                <td>৪. তিনি পরিবার যুক্ত সদস্য কিনা ?
                </td>
                <td>হ্যাঁ /না
                </td>
                <td>তেমন কিছু জানি না
                </td>
                <td>মন্তব্য নাই
                </td>
            </tr>
            <tr>
                <td>৫. পলাতক বা নাম পরিবর্তন করেছে কি না ?
                </td>
                <td>হ্যাঁ /না
                </td>
                <td>তেমন কিছু জানি না
                </td>
                <td>মন্তব্য নাই
                </td>
            </tr>
            <tr>
                <td>৬. তিনি যাদের সাথে চলাফেরা করেন তাদের চেনেন কিনা ?
                </td>
                <td>হ্যাঁ /না
                </td>
                <td>তেমন কিছু জানি না
                </td>
                <td>মন্তব্য নাই
                </td>
            </tr>
            <tr>
                <td>৭. তার পরিবারের আর কোন সদস্যকে চেনেন ?
                </td>
                <td>হ্যাঁ /না
                </td>
                <td>তেমন কিছু জানি না
                </td>
                <td>মন্তব্য নাই
                </td>
            </tr>
            <tr>
                <td>৮. তিনি কোন অপরাধী বা সন্ত্রাসী লোকের সাথে চলাফেরা করেন কিনা/ সম্পর্ক আছে কিনা ?
                </td>
                <td>হ্যাঁ /না
                </td>
                <td>তেমন কিছু জানি না
                </td>
                <td>মন্তব্য নাই
                </td>
            </tr>
        </table>
        <br>
        <table width="100%" style="marge-bottom:20px;">
            <tr>
                <td>Reference Check (প্রতিষ্ঠানের নিরাপত্তা কর্মী কর্তৃক যাচাইকৃত) ঃ আবেদনপত্রে উল্লেখিত বর্তমান ঠিকানা, স্থায়ী ঠিকানা, রেফারেন্সে প্রদত্ত <br>
                     ব্যক্তিবর্গের নাম পরিচয় সঠিক কিনা ? (হ্যাঁ /না)</td>
            </tr>
        </table>
        <br>
        <table width="100%" style="marge-bottom:20px;">
            <tr>
                <td>History/Employment History Check আবেদন পত্রে উল্লেখিত History / Employment History Check করা হয়েছে <br> কিনা? (হ্যাঁ / না) । প্রদত্ত তথ্য সঠিক কিনা? (হ্যাঁ /না)</td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <td>প্রশ্নকারীর গোপন কোড :</td>
                <td style="text-align: lerift;">ম্যানেজার, এইচ আর, এডমিন, কমপ্লায়েন্স</td>
            </tr>
        </table>


    @elseif($title == 6)
    @endif
</body>
</html>
