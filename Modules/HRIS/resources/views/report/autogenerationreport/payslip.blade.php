<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="utf-8">
    <title>বেতন স্লিপ</title>
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

        .header {
            text-align: center;
            line-height: 1.4;
        }

        .company-name {
            color: #0047ba;
            font-size: 22px;
        }

        .font-body {
            font-size: 15px;
            letter-spacing: 0.3px;
            -webkit-text-stroke: 0.3px #000;
        }

        .company-address {
            color: #0047ba;
            font-size: 13px;
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
            width: 35px;
            /* এখানে space adjust হবে */
            vertical-align: top;
            padding-top: 3px;
        }

        .hanging-text {
            text-align: justify;
            line-height: 1.2;
        }

        .hanging {
            padding-left: 45px;
            /* পুরো ব্লক ডানদিকে */
            text-indent: -35px;
            /* শুধু প্রথম লাইন বামে */
            line-height: 1.3;
        }

        .left-col {
            width: 140px;
            /* এখানে width fix করবেন */
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
            font-size: 13px;
        }

        .nominee-table th {
            text-align: center;
            font-weight: bold;
        }


        .note {
            text-align: center;
            font-size: 13px;
            margin-top: 30px;
            solid #000;
            padding-top: 3px;
        }

        .border {
            border: 0.5px dotted #000;
        }
    </style>
</head>
@php
    $orgdata = $ornizations_data->where('id', $orgid)->first();
    $orgname = $orgdata->bn_name ?? '';
    $orgname_en = $orgdata->name ?? '';
    $address = $orgdata->address_bangla ?? '';
    $email = $orgdata->email ?? ('info@company.com' ?? 'info@company.com');
    $phone = $orgdata->phone ?? ('+880123456789' ?? '+880123456789');

    if (!empty($orgdata?->path)) {
        $logo = public_path('storage/' . $orgdata->path);
    } elseif (!empty($general?->full_name)) {
        $logo = public_path('storage/' . $general->logo_path);
    } else {
        $logo = public_path('backend/assets/images/logo-sm.svg');
    }
@endphp

<body>
    @if ($employeeChunk->count() > 0)
        @foreach (['Employee Copy', 'Office Copy'] as $copyType)
            <table width="100%" style="border-collapse: collapse; table-layout: fixed; font-size: 12px;">
                @foreach ($employeeChunk->chunk(2) as $row)
                    <tr>
                        @foreach ($row as $emp)
                            <td style="width: 50%; padding: 10px; vertical-align: top;">
                                {{-- প্রতিটি এমপ্লয়ীর মূল ব্লক --}}
                                <div
                                    style="border: 1px solid #000; padding: 8px; min-height: 500px; box-sizing: border-box;">
                                    <div class="header"
                                        style="border-bottom: 1px solid #ddd; margin-bottom: 8px; padding-bottom: 5px;">
                                        <table width="100%">
                                            <tr>
                                                <td style="width: 20%; text-align: left; vertical-align: middle;">
                                                    <img src="{{ $logo }}" style="width: 40px; height: 40px;" alt="Logo">
                                                </td>
                                                <td style="width: 80%; text-align: center; line-height: 1.0;">
                                                    <div style="font-size: 15px; font-weight: 900;">{{ $orgname }}</div>
                                                    <div style="font-size: 10px;">{{ $address }}</div>
                                                    <div style="font-size: 10px;">ইমেইল: {{ $email }} | ফোন:{{ $phone }}</div>
                                                </td>
                                            </tr>
                                        </table>
                                        <br>
                                    </div>

                                    <table width="100%" style="margin-bottom: 5px; font-size: 11px;">
                                        <tr>
                                            <td style="">বেতন/ওভারটাইম স্লিপ</td>
                                            <td style="text-align: right;">তারিখ: {{ bnNumber(date('d-m-Y')) }}</td>
                                        </tr>
                                    </table>

                                    <table width="100%"
                                        style="font-size: 10px; border-collapse: collapse; margin-bottom: 8px;">
                                        <tr>
                                            <td style="width:40%;">নাম: {{ $emp->name_bangla }}</td>
                                            <td style="width:30%;">কার্ড নং: {{ bnNumber($emp->emp_id) }}</td>
                                            <td style="width:30%; text-align:right;">লাইন নং:{{ bnNumber($emp->line) }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:40%;">পদবী: {{ $emp->designation_name }}</td>
                                            <td style="width:30%;">সেকশন: {{ $emp->department_name }}</td>
                                            <td style="width:30%; text-align:right;">গ্রেড:{{ bnNumber($emp->grade) }}</td>
                                        </tr>
                                    </table>
                                    <!-- Attendance Information -->
                                    <table width="100%"
                                        style="font-size: 10px; border-collapse: collapse; margin-bottom: 8px;">
                                        <tr>
                                            <td style="width:40%;">মোট কর্ম দিবস: {{ bnNumber($emp->days) }}</td>
                                            <td style="width:30%;">উপস্থিত দিবস: {{ bnNumber(($emp->days) - ($emp->absent_days)) }}</td>
                                            <td style="width:30%; text-align:right;">সাধারন ছুটি: {{ bnNumber($emp->general_holiday_days) }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width:40%;">অনুপস্থিত দিবস: {{ bnNumber($emp->absent_days) }}</td>
                                            <td style="width:30%;">বিলম্বে উপস্থিত: {{ bnNumber($emp->late_days) }}</td>
                                            <td style="width:30%; text-align:right;">ছুটি:{{ bnNumber($emp->weekend_days) }}</td>
                                        </tr>
                                    </table>

                                    <table width="100%"
                                        style="border-collapse: collapse; font-size: 10px; text-align: left;  ">
                                        <tr>
                                            <td width="60%" class="border" style="padding: 2px; " colspan="4">মূল বেতন</td>
                                            <td width="5%" class="border" style="text-align: center; ">:</td>
                                            <td width="35%" class="border" style="padding: 2px; text-align: right; ">{{ bnNumber(number_format($emp->basic)) }} টাকা</td>
                                        </tr>

                                        <tr>
                                            <td class="border" style="padding: 2px; ">বাড়ী ভাড়া</td>
                                            <td class="border" style="text-align: center; ">:</td>
                                            <td class="border" style="">{{ bnNumber(number_format($emp->home_allowance)) }} টাকা</td>

                                            <td class="border" style="padding: 2px; ">চিকিৎসা ভাতা</td>
                                            <td class="border" style="text-align: center; ">:</td>
                                            <td class="border" style="padding: 2px; text-align: right; ">{{ bnNumber(number_format($emp->medical_allowance)) }} টাকা</td>
                                        </tr>

                                        <tr>
                                            <td class="border" style="padding: 2px; ">যাতায়াত</td>
                                            <td class="border" style="text-align: center; ">:</td>
                                            <td class="border" style="">{{ bnNumber(number_format($emp->conveyance)) }} টাকা</td>

                                            <td class="border" style="padding: 2px; ">খাদ্য ভাতা</td>
                                            <td class="border" style="text-align: center; ">:</td>
                                            <td class="border" style="padding: 2px; text-align: right; ">{{ bnNumber(number_format($emp->food_allowance)) }} টাকা</td>
                                        </tr>
                                    </table>

                                    <table width="100%"
                                        style="border-collapse: collapse; font-size: 10px; text-align: left; ">
                                        <tr>
                                            <td width="60%" class="border" style="padding: 2px;">মোট বেতন</td>
                                            <td width="5%" class="border" style="text-align: center;">:</td>
                                            <td width="35%" class="border" style="padding: 2px; text-align: right;">
                                                {{ bnNumber(number_format($emp->basic + $emp->home_allowance + $emp->medical_allowance + $emp->conveyance + $emp->food_allowance)) }}
                                                টাকা</td>
                                        </tr>
                                        <tr>
                                            <td class="border" style="padding: 2px;">অনুপস্হিত বেতন কর্তন</td>
                                            <td class="border" style="text-align: center;">:</td>
                                            <td class="border" style="padding: 2px; text-align: right;">
                                                {{ bnNumber(number_format($emp->absent_deduction ?? 0)) }} টাকা</td>
                                        </tr>
                                        <tr>
                                            <td class="border" style="padding: 2px;">ভাতাদি সহ সর্বমোট বেতন</td>
                                            <td class="border" style="text-align: center;">:</td>
                                            <td class="border" style="padding: 2px; text-align: right;">
                                                {{ bnNumber(number_format($emp->basic + $emp->home_allowance + $emp->medical_allowance + $emp->conveyance + $emp->food_allowance)) }} টাকা</td>
                                        </tr>
                                    </table>

                                    <table width="100%"
                                        style="border-collapse: collapse; font-size: 10px; text-align: left; ">
                                        <tr style="background: #eef;">
                                            <td class="border" style="padding: 2px;">অতিঃ কাজ</td>
                                            <td class="border" style="text-align: center;">:</td>
                                            <td class="border" style="padding: 2px; text-align: right;">
                                                {{ bnNumber(number_format($emp->total_ot_hour ?? 0)) }} ঘণ্টা</td>
                                            <td class="border" style="padding: 2px;">প্রতি ঘণ্টার হার</td>
                                            <td class="border" style="text-align: center;">:</td>
                                            <td class="border" style="padding: 2px; text-align: right;">
                                                {{ bnNumber(number_format($emp->ot_rate ?? 0)) }} টাকা
                                            </td>
                                        </tr>
                                    </table>

                                    <table width="100%"
                                        style="border-collapse: collapse; font-size: 10px; text-align: left; ">
                                        <tr>
                                            <td class="border" width="60%" style="padding: 2px;">মোট অতিঃ
                                                কাজের মজুরী</td>
                                            <td class="border" width="5%" style="text-align: center;">:</td>
                                            <td class="border" style="padding: 2px; text-align: right;">
                                                {{ bnNumber(number_format($emp->total_ot_amount ?? 0)) }} টাকা</td>
                                        </tr>
                                        <tr>
                                            <td class="border">উপস্হিতি বোনাস</td>
                                            <td class="border" style="text-align: center;">:</td>
                                            <td class="border" style="padding: 2px; text-align: right;">
                                                {{ bnNumber(number_format($emp->attendance_bonus ?? 0)) }} টাকা</td>
                                        </tr>
                                        <tr>
                                            <td class="border">অগ্রীম কর্তন</td>
                                            <td class="border" style="text-align: center;">:</td>
                                            <td class="border" style="padding: 2px; text-align: right;">
                                                {{ bnNumber(number_format($emp->advance_refund ?? 0)) }} টাকা</td>
                                        </tr>
                                        <tr>
                                            <td class="border">মোট কৰ্তন</td>
                                            <td class="border" style="text-align: center;">:</td>
                                            <td class="border" style="padding: 2px; text-align: right;">
                                                {{ bnNumber(number_format($emp->total_deduction ?? 0)) }} টাকা</td>
                                        </tr>
                                        <tr>
                                            <td class="border">বকেয়া</td>
                                            <td class="border" style="text-align: center;">:</td>
                                            <td class="border" style="padding: 2px; text-align: right;">
                                                {{ bnNumber(number_format(0)) }} ঘণ্টা</td>
                                        </tr>
                                    </table>

                                    <table width="100%"
                                        style="border-collapse: collapse; font-size: 10px; text-align: left; ">
                                        <tr style="background: #eef;">
                                            <td class="border" style="padding: 0px;">নাইট :
                                                {{ bnNumber(number_format(0)) }}
                                            </td>
                                            <td class="border" style="padding: 0px;">টিফিন :
                                                {{ bnNumber(number_format(0)) }}
                                            </td>
                                            <td class="border" style="padding: 0px;">ইফতার :
                                                {{ bnNumber(number_format(0)) }}
                                            </td>
                                            <td class="border" style="padding: 0px;">ডিনার :
                                                {{ bnNumber(number_format(0)) }}
                                            </td>
                                            <td class="border" style="padding: 0px;">সা: ছুটি :
                                                {{ bnNumber(number_format(0)) }}
                                            </td>
                                            <td class="border" style="padding: 0px;">সর: ছুটি :
                                                {{ bnNumber(number_format(0)) }}
                                            </td>
                                        </tr>
                                    </table>

                                    <table width="100%"
                                        style="border-collapse: collapse; font-size: 10px; text-align: left; ">
                                        <tr>
                                            <td class="border" style="padding: 2px; text-align: middle;">সর্বমোট
                                                প্রদেয় বেতন</td>
                                            <td class="border" style="text-align: center;">:</td>
                                            <td class="border" style="padding: 2px; text-align: right;">
                                                {{ bnNumber(number_format($emp->total_net_payable ?? 0)) }}
                                                টাকা</td>
                                        </tr>
                                        <tr>
                                            <td class="border" style="padding: 2px; text-align: middle;">একাউন্ট
                                                নাম্বার</td>
                                            <td class="border" style="text-align: center;">:</td>
                                            <td class="border" style="padding: 2px; text-align: right;">
                                                {{ bnNumber($emp->account_no ?? '') }}
                                            </td>
                                        </tr>
                                    </table>



                                    <table width="100%" style="margin-top: 25px; font-size: 9px;">
                                        <tr>
                                            <td style="text-align: center; width: 45%;">
                                                <div style="border-top: 1px solid #000; padding-top: 2px;">
                                                    কর্তৃপক্ষের
                                                    স্বাক্ষর
                                                </div>
                                            </td>
                                            <td style="width: 10%;"></td>
                                            <td style="text-align: center; width: 45%;">
                                                <div style="border-top: 1px solid #000; padding-top: 2px;">শ্রমিকের
                                                    স্বাক্ষর
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        @endforeach
                        <br>
                        @if (count($row) < 2)
                            <td style="width: 50%;"></td>
                        @endif
                    </tr>
                @endforeach
            </table>
        @endforeach
    @endif
</body>

</html>
