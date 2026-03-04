    <table width="100%" style="border-collapse: collapse; table-layout: fixed; font-size: 11px;">
        @foreach($employeeChunk->chunk(2) as $row)
            <tr>
                @foreach($row as $emp)
                    <td style="width: 50%; padding: 5px; vertical-align: top;">
                        {{-- প্রতিটি এমপ্লয়ীর মূল ব্লক --}}
                        <div style="border: 1px solid #000; padding: 8px; min-height: 500px; box-sizing: border-box;">
                            
                            <div class="header" style="border-bottom: 1px solid #ddd; margin-bottom: 8px; padding-bottom: 5px;">
                                <table width="100%">
                                    <tr>
                                        <td style="width: 20%; text-align: left; vertical-align: middle;">
                                            <img src="{{ public_path('backend/assets/images/logo-sm.svg') }}" width="40" height="40" alt="Logo">
                                        </td>
                                        <td style="width: 80%; text-align: center; line-height: 1.2;">
                                            <div style="font-size: 13px;">আয়েশা এন্ড গালিয়া ফ্যাশন্স লিমিটেড</div>
                                            <div style="font-size: 9px;">০১, হারিকেন রোড, দাউলতপুর, জাতীয় বিশ্ববিদ্যালয়, গাজীপুর।</div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <table width="100%" style="margin-bottom: 5px; font-size: 11px;">
                                <tr>
                                    <td style="">SL 1</td>
                                    <td style="">বেতন/ওভারটাইম স্লিপ</td>
                                    <td style="text-align: right;">তারিখ: {{ bnNumber(date('d-m-Y')) }}</td>
                                </tr>
                            </table>

                            <table width="100%" style="font-size: 10px; margin-bottom: 8px; border-collapse: collapse;">
                                <tr>
                                    <td style="width: 30%;">নাম: {{ $emp->name_bangla }}</td>
                                    <td>কার্ড নং: {{ bnNumber($emp->emp_id) }}</td>
                                    <td>লাইন নং: {{ bnNumber($emp->line) }}</td>
                                </tr>
                                 <tr>
                                    <td>পদবী: {{ $emp->designation_name }}</td>
                                    <td>সেকশন : {{ $emp->department_name }}</td>
                                    <td>গ্রেড: {{ bnNumber($emp->grade) }}</td>
                                </tr>
                               {{--  <tr>
                                    <td>মাস:</td>
                                    <td>:</td>
                                    <td>{{ $month ?? 'December' }} {{ bnNumber($year ?? '2025') }}</td>
                                </tr> --}}
                            </table>
                            <!-- Attendance Information -->
                        <table class="info-table" style="margin-bottom: 20px;">
                            <tr>
                                <td style="width: 33%;">মোট কর্ম দিবস: {{ $attendance->total_days ?? 26 }}</td>
                                <td style="width: 33%;">সা: ছুটি দিন: {{ $attendance->total_days ?? 26 }}</td>
                                <td style="width: 33%;">বিলম্বে উপস্থিতি: {{ $attendance->late_days ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td style="width: 33%;">ছুটি: {{ $attendance->leave_days ?? 0 }}</td>
                                <td style="width: 33%;">ছুটি: {{ $attendance->leave_days ?? 0 }}</td>
                                <td style="width: 33%;">অনুপস্হিত দিবস: {{ $attendance->absent_days ?? 0 }}</td>
                            </tr>
                        </table>        

                            <table width="100%" border="1" style="border-collapse: collapse; font-size: 10px; text-align: left;">
                                {{-- <tr style="background: #f8f8f8;">
                                    <td colspan="5" style="padding: 3px;">বিবরণ</td>
                                    <td style="padding: 3px; text-align: right;">টাকা</td>
                                </tr> --}}
                                <tr>
                                    <td style="padding: 2px;">মূল বেতন</td>
                                    <td>:</td>
                                    <td colspan="2"></td>
                                    <td>:</td>
                                    <td style="padding: 2px; text-align: right;">{{ bnNumber(number_format($emp->basic)) }} টাকা</td>
                                </tr>
                                <tr>
                                    <td style="padding: 2px;">বাড়ী ভাড়া </td>
                                    <td>:</td>
                                    <td>{{ bnNumber(number_format($emp->home_allowance)) }} টাকা</td>
                                    <td> চিকিৎসা ভাতা</td>
                                    <td>:</td>
                                    <td style="padding: 2px; text-align: right;">{{ bnNumber(number_format($emp->medical_allowance)) }} টাকা</td>
                                </tr>
                                <tr>
                                    <td style="padding: 2px;">যাতায়াত</td>
                                    <td>:</td>
                                    <td> {{ bnNumber(number_format($emp->conveyance)) }} টাকা</td>
                                    <td>খাদ্য ভাতা</td>
                                    <td>:</td>
                                    <td style="padding: 2px; text-align: right;">{{ bnNumber(number_format($emp->food_allowance)) }} টাকা</td>
                                </tr>
                                {{-- <tr>
                                    <td colspan="3" style="padding: 2px;">মোট বেতন</td>
                                    <td>:</td>
                                    <td colspan="2"> {{ bnNumber(number_format($emp->basic + $emp->home_allowance + $emp->medical_allowance + $emp->conveyance + $emp->food_allowance)) }} টাকা</td>
                                </tr>
                                <tr>
                                    <td style="padding: 2px;">চিকিৎসা/যাতায়াত/খাদ্য</td>
                                    <td>:</td>
                                    <td style="padding: 2px; text-align: right;">{{ bnNumber(number_format($emp->medical_allowance + $emp->conveyance + $emp->food_allowance)) }}</td>
                                    <td></td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="padding: 2px;">অতিরিক্ত কাজ (ওভারটাইম)</td>
                                    <td>:</td>
                                    <td style="padding: 2px; text-align: right;">{{ bnNumber(number_format(($overtime->hours ?? 0) * ($overtime->hourly_rate ?? 0))) }}</td>
                                    <td></td>
                                    <td>:</td>
                                    <td></td>
                                </tr>
                                <tr style="background: #eef;">
                                    <td style="padding: 3px;">মোট প্রদেয়</td>
                                    <td></td>
                                    <td style="padding: 3px; text-align: right;">{{ bnNumber(number_format($net_salary ?? 0)) }} টাকা</td>
                                    <td></td>
                                    <td>:</td>
                                    <td></td>
                                </tr> --}}
                            </table>
                            <table width="100%" border="1" style="border-collapse: collapse; font-size: 10px; text-align: left;">
                               <tr>
                                    <td>মোট বেতন</td>
                                    <td>:</td>
                                    <td>{{ bnNumber(number_format($emp->basic + $emp->home_allowance + $emp->medical_allowance + $emp->conveyance + $emp->food_allowance)) }} টাকা</td>
                               </tr>
                               <tr>
                                    <td>অনুপস্হিত বেতন কর্তন</td>
                                    <td>:</td>
                                    <td>{{ bnNumber(number_format($emp->basic + $emp->home_allowance + $emp->medical_allowance + $emp->conveyance + $emp->food_allowance)) }} টাকা</td>
                               </tr>
                               <tr>
                                    <td>ভাতাদি সহ সর্বমোট বেতন</td>
                                    <td>:</td>
                                    <td>{{ bnNumber(number_format($emp->basic + $emp->home_allowance + $emp->medical_allowance + $emp->conveyance + $emp->food_allowance)) }} টাকা</td>
                               </tr>
                            </table>
                             <table width="100%" border="1" style="border-collapse: collapse; font-size: 10px; text-align: left;">
                               <tr style="background: #eef;">
                                    <td style="padding: 3px;">অতিঃ কাজ</td>
                                    <td>:</td>
                                    <td style="padding: 3px; text-align: right;">{{ bnNumber(number_format($overtime->hours ?? 0)) }} ঘণ্টা</td>
                                    <td>প্রতি ঘণ্টার হার</td>
                                    <td>:</td>
                                    <td style="padding: 3px; text-align: right;">{{ bnNumber(number_format($overtime->hourly_rate ?? 0)) }} টাকা</td>
                                </tr>
                            </table>
                            <table width="100%" border="1" style="border-collapse: collapse; font-size: 10px; text-align: left;">
                                <tr>
                                    <td>মোট অতিঃ কাজের মজুরী</td>
                                    <td style="width: 10px; padding: 2px;">:</td>
                                    <td style="padding: 3px; text-align: middle;">{{ bnNumber(number_format($overtime->hours ?? 0)) }} ঘণ্টা</td>
                                </tr>
                                <tr>
                                    <td>উপস্হিতি বোনাস</td>
                                    <td style="width: 10px; padding: 2px;">:</td>
                                    <td style="padding: 3px; text-align: middle;">{{ bnNumber(number_format($overtime->hours ?? 0)) }} ঘণ্টা</td>
                                </tr>
                                <tr>
                                    <td>অগ্রীম কর্তন</td>
                                    <td style="width: 10px; padding: 2px;">:</td>
                                    <td style="padding: 3px; text-align: middle;">{{ bnNumber(number_format($overtime->hours ?? 0)) }} ঘণ্টা</td>
                                </tr>
                                <tr>
                                    <td>মোট কৰ্তন</td>
                                    <td style="width: 10px; padding: 2px;">:</td>
                                    <td style="padding: 3px; text-align: middle;">{{ bnNumber(number_format($overtime->hours ?? 0)) }} ঘণ্টা</td>
                                </tr>
                                <tr>
                                    <td>বকেয়া</td>
                                    <td style="width: 10px; padding: 2px;">:</td>
                                    <td style="padding: 3px; text-align: middle;">{{ bnNumber(number_format($overtime->hours ?? 0)) }} ঘণ্টা</td>
                                </tr>
                            </table>
                             <table width="100%" border="1" style="border-collapse: collapse; font-size: 10px; text-align: left;">
                               <tr style="background: #eef;">
                                    <td style="padding: 0px;">নাইট : {{ bnNumber(number_format($emp->basic + $emp->home_allowance + $emp->medical_allowance + $emp->conveyance + $emp->food_allowance)) }}</td>
                                    <td style="padding: 0px;">টিফিন : {{ bnNumber(number_format($emp->basic + $emp->home_allowance + $emp->medical_allowance + $emp->conveyance + $emp->food_allowance)) }}</td>
                                    <td style="padding: 0px;">ইফতার : {{ bnNumber(number_format($emp->basic + $emp->home_allowance + $emp->medical_allowance + $emp->conveyance + $emp->food_allowance)) }}</td>
                                    <td style="padding: 0px;">ডিনার : {{ bnNumber(number_format($emp->basic + $emp->home_allowance + $emp->medical_allowance + $emp->conveyance + $emp->food_allowance)) }}</td>
                                    <td style="padding: 0px;">সা: ছুটি : {{ bnNumber(number_format($emp->basic + $emp->home_allowance + $emp->medical_allowance + $emp->conveyance + $emp->food_allowance)) }}</td>
                                    <td style="padding: 0px;">সর: ছুটি : {{ bnNumber(number_format($emp->basic + $emp->home_allowance + $emp->medical_allowance + $emp->conveyance + $emp->food_allowance)) }}</td>
                                </tr>
                            </table>
                             <table width="100%" border="1" style="border-collapse: collapse; font-size: 10px; text-align: left;">
                               <tr>
                                    <td style="padding: 3px; text-align: middle;">সর্বমোট প্রদেয় বেতন</td>
                                    <td>:</td>
                                    <td style="padding: 3px; text-align: middle;">{{ bnNumber(number_format($emp->basic + $emp->home_allowance + $emp->medical_allowance + $emp->conveyance + $emp->food_allowance)) }} টাকা</td>
                               </tr>
                               <tr>
                                    <td style="padding: 3px; text-align: middle;">একাউন্ট নাম্বার</td>
                                    <td>:</td>
                                    <td style="padding: 3px; text-align: middle;">01</td>
                               </tr>
                            </table>

                            <table width="100%" style="margin-top: 25px; font-size: 9px;">
                                <tr>
                                    <td style="text-align: center; width: 45%;">
                                        <div style="border-top: 1px solid #000; padding-top: 2px;">কর্তৃপক্ষের স্বাক্ষর</div>
                                    </td>
                                    <td style="width: 10%;"></td>
                                    <td style="text-align: center; width: 45%;">
                                        <div style="border-top: 1px solid #000; padding-top: 2px;">শ্রমিকের স্বাক্ষর</div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                @endforeach
                <br>
                @if(count($row) < 2)
                    <td style="width: 50%;"></td>
                @endif
            </tr>
        @endforeach
    </table>