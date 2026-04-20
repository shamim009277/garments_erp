<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Time Card</title>
    <link rel="shortcut icon" href="{{ public_path('backend/assets/images/logo-sm.svg') }}">
    <meta name="description" content="Garments ERP - Complete Solution for Garments Manufacturing and Management" />
    <meta name="author" content="ERP Team" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
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
            line-height: 0.6;
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
            font-size: 14px;
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
            width: 40%;
            float: right;
            margin-top: 10px;
            border: 1px solid #ccc;
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
        }

        footer div {
            display: flex;
            justify-content: space-between;
            font-size: 9px;
        }
    </style>
</head>
@php
    $orgdata = $ornizations_data->where('id', $orgid)->first();
    $orgname = $orgdata->name ?? ($general->full_name ?? 'A&G Group');
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

     @yield('content')
</body>
</html>
