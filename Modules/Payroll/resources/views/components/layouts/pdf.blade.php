<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Report')</title>
    <link rel="shortcut icon" href="{{ public_path('backend/assets/images/logo-sm.svg') }}">
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
@php
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
@endphp

<body>
    <!-- Watermark -->
    <div class="watermark">
        {{ $orgname }} - {{ now()->format('Y') }}
    </div>
    <img src="{{ $logo }}" class="watermark-image" alt="watermark">
    <!-- Header -->
    <x-hris::reports.header
        :orgname="$orgname"
        :address="$address"
        :email="$email"
        :phone="$phone"
        :logo="$logo"
    />

    <!-- Footer -->
    <x-hris::reports.footer />

    <!-- PDF Body -->
    @if(!empty($reportTitle))
        <h3 style="text-align:center; font-size:12px; margin-top:-15px; padding:0px; margin-bottom:0px;">
            {{ $reportTitle }}
        </h3>
    @endif

    @if(!empty($reportSubTitle))
        <p style="text-align:center; font-size:10px; font-weight:bold; margin-top:-20px;">
            {{ $reportSubTitle }}
        </p>
    @endif

    @yield('content')

    <x-hris::reports.signature :orgname="$orgname" />
</body>
</html>
