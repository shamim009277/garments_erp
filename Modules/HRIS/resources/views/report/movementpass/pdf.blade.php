<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Leave Report</title>
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
            padding-bottom: 10px;
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
    </style>
</head>
<body>
    <!-- Watermark -->
    <div class="watermark">
        {{ $general->full_name }} - {{ now()->format('Y') }}
    </div>
    <img src="{{ public_path('backend/assets/images/logo-sm.svg') }}" class="watermark-image" alt="watermark">
    <!-- Header -->
    <header>
        <div style="display: flex; align-items: center;">
            <!-- Logo -->
            <div>
                <img src="{{ public_path('backend/assets/images/logo-sm.svg') }}" alt="Logo" style="width: 40px; height: 40px;">
            </div>

            <!-- Company Info -->
            <div class="company-info">
                <div style="font-weight: bold; font-size: 14px; font-family: italic">{{ $general->full_name }}</div>
                <div style="font-size: 12px;font-weight: normal; font-family: italic">01, Hariken Road, Dawlotpur, National University, Gazipur</div>
                <div style="font-size: 12px;font-weight: normal; font-family: italic">Email: info@company.com | Phone: +880123456789</div>
            </div>
        </div>
        <hr style="border: 1px solid #ccc;">
    </header>

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

    <!-- PDF Body -->
    @if($title == 1)
    <h3 style="text-align:center; margin: 20px 0px;">Department-wise Daily Movement Pass</h3>
    @endif
    @if($title == 2)
    <h3 style="text-align:center; margin: 20px 0px;">Designation-wise Daily Movement Pass</h3>
    @endif
    @if($title == 3)
    <h3 style="text-align:center; margin: 20px 0px;">Department-wise Monthly Movement Pass</h3>
    @endif
    @if($title == 4)
    <h3 style="text-align:center; margin: 20px 0px;">Designation-wise Monthly Movement Pass</h3>
    @endif


    @if($title == 1)
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Category</th>
                    <th>Join Date</th>
                    <th>District</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $index => $employee)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $employee->employee_id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->department->department ?? '' }}</td>
                        <td>{{ $employee->designation->designation ?? '' }}</td>
                        <td>{{ $employee->designation->category_code ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($employee->joining_date)->format('d-m-Y') }}</td>
                        <td>{{ $employee->mdistrict->name ?? '' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @elseif($title == 2)
        <div class="card-body">
            <div style="overflow-x: auto;">
                <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Category</th>
                            <th>Joining Date</th>
                            <th>District</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($uniqueDesignations as $designation)
                            <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                <td></td>
                                <td style="text-align: center; color: #5156be;">{!! $designation->designation !!}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php $sl1 = 1; ?>
                            @foreach ($employees as $employee)
                            @if($employee->designation_id == $designation->id)
                                <tr>
                                    <td>{{ $sl1 }}</td>
                                    <td>{{ $employee->employee_id }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->department->department ?? '' }}</td>
                                    <td>{{ $employee->designation->designation ?? '' }}</td>
                                    <td>@if($employee->designation->category_code == 'O') Officer @elseif($employee->designation->category_code == 'M') Manager @elseif($employee->designation->category_code == 'S') Staff @endif</td>
                                    <td>{{ date('d-m-Y', strtotime($employee->joining_date)) }}</td>
                                    <td>{{ $employee->mdistrict->name ?? '' }}</td>
                                </tr>
                                <?php $sl1++; ?>
                            @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif($title == 3)
        <div class="card-body">
            <div style="overflow-x: auto;">
                <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Category</th>
                            <th>Joining Date</th>
                            <th>District</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->employee_id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->department->department }}</td>
                                <td>{{ $employee->designation->designation }}</td>
                                <td>@if($employee->designation->category_code == 'O') Officer @elseif($employee->designation->category_code == 'M') Manager @elseif($employee->designation->category_code == 'S') Staff @endif</td>
                                <td>{{ date('d-m-Y', strtotime($employee->joining_date)) }}</td>
                                <td>{{ $employee->mdistrict->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif($title == 4)
        <div class="card-body">
            <div style="overflow-x: auto;">
                <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Category</th>
                            <th>Blood Group</th>
                            <th>District</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->employee_id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->department->department }}</td>
                                <td>{{ $employee->designation->designation }}</td>
                                <td>@if($employee->designation->category_code == 'O') Officer @elseif($employee->designation->category_code == 'M') Manager @elseif($employee->designation->category_code == 'S') Staff @endif</td>
                                <td>{{ $employee->employeePersonal->blood_group }}</td>
                                <td>{{ $employee->mdistrict->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</body>
</html>
