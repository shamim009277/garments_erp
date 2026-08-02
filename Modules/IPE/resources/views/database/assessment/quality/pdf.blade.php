<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Evaluation Report</title>
    <link rel="shortcut icon" href="{{ public_path('backend/assets/images/logo-sm.svg') }}">
    <meta name="description" content="Garments ERP - Complete Solution for Garments Manufacturing and Management" />
    <meta name="author" content="ERP Team" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        @page {
            margin: 110px 20px 50px 20px;
            counter-increment: page;
        }

        header {
            position: fixed;
            top: -95px;
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

        .page-number:after {
            content: counter(page);
        }

        table {
            width: 100%;
            border: none;
            margin-top: 10px;
        }

        th,
        td {
            padding: 5px 8px;
            border: none;
            text-align: left;
            vertical-align: middle;
            line-height: 1;
        }

        thead {
            background-color: #f2f2f2;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .title {
            text-align: center;
            font-size: 12px;
            font-weight: 700;
            margin-top: -10px;
            padding: 0px 0;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .info-table {
            width: 100%;
            margin-bottom: 8px;
            border-collapse: collapse;
        }

        .info-table td {
            border: none;
            padding: 3px 8px;
            font-size: 10px;
        }

        .company-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            line-height: 1.1;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 38px;
            font-weight: 700;
            color: rgba(0, 0, 0, 0.06);
            pointer-events: none;
            z-index: 0;
            white-space: nowrap;
        }

        .watermark-image {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.07;
            width: 250px;
            height: auto;
            pointer-events: none;
            z-index: 0;
        }

        hr {
            border: none;
            border-top: 0.5px dotted #777;
            margin: 4px 0;
        }

        .summary-table {
            width: 100%;
            float: right;
            margin-top: 10px;
            border: 1px solid #ccc;
            font-size: 12px;
        }

        .summary-table td {
            padding: 4px 8px;
            border: none;
            vertical-align: middle;
            font-weight: 600;
        }

        .summary-header {
            background-color: #f2f2f2;
            font-weight: 600;
            text-align: center;
        }

        .signature-section {
            margin-top: 180px;
            width: 100%;
        }

        .signature-section td {
            width: 33%;
            text-align: center;
            vertical-align: bottom;
            font-weight: 600;
        }

        footer div {
            display: flex;
            justify-content: space-between;
            font-size: 9px;
        }
    </style>
</head>
@php
    $orgdata = $ornizations_data->where('id', $assessment->org_id)->first();
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
@endphp
<body>
    <!-- Watermark -->
    <div class="watermark">
        {{ $orgname }} - {{ now()->format('Y') }}
    </div>
    <img src="{{ $logo }}" class="watermark-image" alt="watermark">

    <!-- Header -->
    <header>
        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
            <img src="{{ $logo }}" alt="Logo" style="width: 35px; height: 35px;">
            <div class="company-info">
                <div style="font-weight: bold; font-size: 13px;">{{ $orgname }}</div>
                <div style="font-size: 10px;">{{ $address }}</div>
                <div style="font-size: 10px;">Email: {{ $email }} | Phone: {{ $phone }}</div>
            </div>
        </div>
        <hr>
    </header>

    <!-- Footer -->
    <footer>
        <div>
            <span>Printed by {{ auth()->user()->name ?? 'System' }}</span>
            <span>Page <span class="page"></span> | Reporting Date: {{ now()->format('d-m-Y h:i A') }}</span>
        </div>
    </footer>


        <p class="title">Evaluation Report of Requirement Operations  </p>
        <hr>
        <!-- Employee Info -->
        <table class="info-table">
            <tr>
                <td><strong>Applicant ID:</strong> {{ $assessment->applicant_id }}</td>
                <td><strong>Grade:</strong> {{ $assessment->designation->grade ?? 'N/A' }}</td>
                <td><strong>Entry Date:</strong> {{ date('d-m-Y', strtotime($assessment->entry_date)) }}</td>
            </tr>
            <tr>
                <td><strong>Name:</strong> {{ $assessment->name }}</td>
                <td><strong>Apply For:</strong> {{ $assessment->designation->designation ?? 'N/A' }}</td>
                <td><strong>Assessment Date:</strong> {{ date('d-m-Y', strtotime($assessment->assessment_date)) }}</td>
            </tr>
            <tr>
                <td><strong>Department:</strong> {{ $assessment->department->department ?? 'N/A' }}</td>
                <td><strong>Age:</strong> {{ round(Carbon\Carbon::parse($assessment->applicant->birth_date)->diffInYears($assessment->entry_date)) }}</td>
                <td><strong>Assessment ID:</strong> {{ $assessment->id }}</td>
            </tr>
        </table>
        <hr>

        <div class="" style="width:100%; margin: 20px 0px; font-weight: 600; font-size: 12px;">
            <strong>Interviewed By:        <span style="margin-left: 100px;">----------------------------</span> <br><span style="margin-left: 220px; font-size: 10px;">I.E Officer</span></strong>
        </div>

        <div style="margin: 20px 0px; font-weight: 600; font-size: 12px;">
            <strong>Allocating Line:  {{ $assessment->line ?? 'N/A' }}</strong>
        </div>

        <div>
            <strong>Proposed Salary:</strong>
        </div>

        <!-- Main Table -->
        <table class="table table-bordered table-hover table-striped mb-0">
            <thead>
                <tr>
                    <td colspan="12" class="summary-header">Observation Details</td>
                </tr>
                <tr>
                    <th>Interview Operation</th>
                    <th>MC</th>
                    <th class="text-right">Declare</th>
                    <th class="text-right">1st</th>
                    <th class="text-right">2nd</th>
                    <th class="text-right">3rd</th>
                    <th class="text-right">4th</th>
                    <th class="text-right">5th</th>
                    <th class="text-right">Avg</th>
                    <th class="text-right">SMV</th>
                    <th class="text-right">Target</th>
                    <th class="text-right">Efficiency</th>
                </tr>
            </thead>
            <tbody>
                @if($assessment->details && count($assessment->details) > 0)
                    @php
                        $total = count($assessment->details)*3;
                        $getmarks = $assessment->details->where('status', 1)->count() * 3;
                        $efficiency = ($getmarks / $total) * 100;
                    @endphp
                    <tr>
                        <td>General Question</td>
                        <td>N/A</td>
                        <td>{{ $total }}</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>{{ $getmarks }}</td>
                        <td>N/A</td>
                        <td>N/A</td>
                        <td>{{ number_format($efficiency, 2) }} %</td>
                    </tr>
                @endif
                @if($assessment->detailsQuality && count($assessment->detailsQuality) > 0)
                    @php
                        $total1 = count($assessment->detailsQuality)*7;
                        $getmarks1 = $assessment->detailsQuality->where('status', 1)->count() * 7;
                        $efficiency1 = ($getmarks1 / $total1) * 100;
                    @endphp
                    <tr>
                        <td>Practical Question</td>
                        <td>N/A</td>
                        <td>{{ $total1 }}</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>{{ $getmarks1 }}</td>
                        <td>N/A</td>
                        <td>N/A</td>
                        <td>{{ number_format($efficiency1, 2) }} %</td>
                    </tr>
                @endif
                @php
                    $avgeff = ($efficiency + $efficiency1) / 2;
                @endphp
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="5" class="summary-header">Avg Efficiency</td>
                    <td class="summary-header"></td>
                    <td class="summary-header"></td>
                    <td class="summary-header"></td>
                    <td class="summary-header"></td>
                    <td class="summary-header"></td>
                    <td class="summary-header"></td>
                    <td class="summary-header">{{ number_format($avgeff, 2) }} %</td>
                </tr>
            </tfoot>
        </table>
        <hr>

        <!-- Summary Table -->
        <table class="summary-table">
            <tr>
                <td colspan="2" class="summary-header">Evaluation Summary</td>
            </tr>
            @php
                $ranges = ['30-40', '41-50', '51-60', '61-70', '71-80', '81-100'];
                $value = round($avgeff);
                $matchedRange = collect($ranges)->first(function ($range) use ($value) {
                    [$min, $max] = explode('-', $range);
                    return $value >= $min && $value <= $max;
                });
            @endphp
            <tr>
                <td>Approximate Efficiency</td>
                <td style="padding:0;">
                    <table style="width:100%; border-collapse:collapse; text-align:center;">
                        <tr>
                            @foreach ($ranges as $range)
                                <td style="width:25%;">
                                    <span style="
                                        display:inline-block;
                                        width:12px;
                                        height:12px;
                                        border:1px solid #000;
                                        background-color: {{ $matchedRange == $range ? '#000' : '#fff' }};
                                        margin-right:4px;
                                        vertical-align:middle;
                                    "></span>
                                    {{ $range }}
                                </td>
                            @endforeach
                        </tr>
                    </table>
                </td>
            </tr>
            @php
                $status = match (true) {
                $value >= 81 && $value <= 100 => 'Very Good',
                $value >= 61 && $value <= 80  => 'Good',
                $value >= 41 && $value <= 60  => 'Average',
                default                       => 'Poor',
            };
            @endphp
            <tr>
                <td>Quality Mgr/ASS</td>
                <td style="padding:0;">
                    <table style="width:100%; border-collapse:collapse; text-align:center;">
                        <tr>
                            @foreach (['Very Good', 'Good', 'Average', 'Poor'] as $grade)
                                <td style="width:25%;">
                                    <span style="
                                        display:inline-block;
                                        width:12px;
                                        height:12px;
                                        border:1px solid #000;
                                        background-color: {{ $status == $grade ? '#000' : '#fff' }};
                                        margin-right:4px;
                                        vertical-align:middle;
                                    "></span>
                                    {{ $grade }}
                                </td>
                            @endforeach
                        </tr>
                    </table>
                </td>
            </tr>
            @php
                $proposedGrade = match (true) {
                    $value >= 81 && $value <= 100 => 'A',
                    $value >= 61 && $value <= 80  => 'B',
                    $value >= 41 && $value <= 60  => 'C',
                    default                       => 'D',
                };
            @endphp
            <tr>
                <td>Proposed Grade</td>
                <td style="padding:0;">
                    <table style="width:100%; border-collapse:collapse; text-align:center;">
                        <tr>
                            @foreach (['A', 'B', 'C', 'D'] as $grade)
                                <td style="width:25%;">
                                    <span style="
                                        display:inline-block;
                                        width:12px;
                                        height:12px;
                                        border:1px solid #000;
                                        background-color: {{ $proposedGrade == $grade ? '#000' : '#fff' }};
                                        margin-right:4px;
                                        vertical-align:middle;
                                    "></span>
                                    {{ $grade }}
                                </td>
                            @endforeach
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="signature-section">
            <tr>
                <td>-------------------- <br> I.E Manager</td>
                <td>-------------------- <br> Line Chief</td>
                <td>------------------------------- <br> Production Manager</td>
            </tr>

            <!-- Gap Row -->
            <tr>
                <td colspan="3" style="height: 50px;"></td>
            </tr>

            <tr>
                <td>-------------------- <br> HR Manager</td>
                <td>-------------------- <br> General Chief</td>
                <td>------------------------------- <br> Executive Director</td>
            </tr>
        </table>


</body>
</html>
