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
                {{ date('d/m/Y', strtotime($employee->joining_date)) }} ইং তারিখ হইতে এই নিয়োগ কার্যকর হইবে এবং পরবর্তী ৩ (তিন) মাস প্রবেশনারী পিরিয়ড হিসাবে গন্য হইবে । 
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
    <div class="section-title hanging">৩। কর্মঘন্টা ও ওভারটাইম :</div>
    <table width="100%" class="info-table hanging">
        <tr>
            <td>ক) ও.টি.হিসাব :</td>
            <td>মূল বেতনের দ্বিগুন হারে হিসাব করা হবে। হিসাব এইরূপ : মূল বেতন/২০৮*২= প্রতি ঘন্টার ওভারটাইম হার ।</td>
        </tr>
        <tr>
            <td>খ) দৈনিক কর্মঘন্টা :</td>
            <td> ৮ ঘন্টা (০৮:৩০ - ০৫:৩০ টা) । প্রতিদিন ০১ ঘন্টা লাঞ্চ বিরতি (০১:০০টা-০২:০০টা)।</td>
        </tr>
        <tr>
            <td class="left-col">গ) দৈনিক ও.টি. ঘন্টা :</td>
            <td class="right-col"> সর্বোচ্চ ০২ ঘন্টা (বাধ্যতামূলক নহে) । প্রতিদিন ০৮ ঘন্টার অতিরিক্ত (লাঞ্চ বিরতি ব্যতীত) ও সপ্তাহে ৪৮ ঘন্টার অতিরিক্ত সময় কাজকে ওভার টাইম হিসাবে গন্য করা হবে।</td>
        </tr>
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
    @elseif($title == 4)
    @elseif($title == 5)
    @elseif($title == 6)
    @endif
</body>
</html>
