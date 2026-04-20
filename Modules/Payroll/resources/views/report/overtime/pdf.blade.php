@extends('payroll::components.layouts.pdf')
@section('title', 'Overtime Report')
<style>
    body {
        font-size: 11px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        page-break-inside: auto;
    }

    thead {
        display: table-header-group;
    }

    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 4px;
        vertical-align: middle;
    }

    .text-center {
        text-align: center;
    }

    .page-break {
        page-break-before: always;
    }
</style>
@php
    $reportTitle = match ($title) {
        '1' => 'Department-wise Daily Basis Monthly Overtime',
        '2' => 'Department-wise Daily Overtime',
        default => '',
    };

    $reportSubTitle = in_array($title, [1])
        ? 'Month: ' . ($monthName . ' ' . $year ?? '')
        : (in_array($title, [2])
            ? 'Date: ' . \Carbon\Carbon::parse($date)->format('d-m-Y')
            : '');
@endphp

{{-- ================= CONTENT ================= --}}
@section('content')
    @if ($title == 1)
        @if ($datas->count() > 0)
            @foreach ($uniqueSection as $section)
                @php
                    $departmentDatas = $datas->groupBy(function ($item) {
                        return optional($item->employee->department->parentDepartment)->department;
                    });
                    $depTotal = 0;
                @endphp

                @foreach ($departmentDatas as $department => $groupedData)
                    @php
                        $SectionDatas = $groupedData->groupBy(function ($item) {
                            return optional($item->employee->department)->department;
                        });
                    @endphp

                    @foreach ($SectionDatas as $section => $groupedData)
                        @php
                            $groupedDatas = $groupedData->groupBy('employee_id');
                        @endphp
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th> <span style="font-size: 12px; color: rgb(22, 2, 94);">Department : </span>
                                        {{ $department }} <span style="font-size: 12px; color: rgb(22, 2, 94);"> Section :
                                        </span> {{ $section }}</th>
                                </tr>
                            </thead>
                        </table>
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Employee ID</th>
                                    <th>Name</th>

                                    @foreach ($dates as $date)
                                        <th class="text-center">{{ date('d', strtotime($date)) }}</th>
                                    @endforeach
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupedDatas as $index => $records)
                                    @php
                                        $employee = $records->first()->employee;
                                        $organization = $records->first()->organization;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ str_pad($employee->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $employee->name }}</td>

                                        @foreach ($dates as $date)
                                            @php
                                                $entry = $records->firstWhere('work_date', $date);
                                            @endphp
                                            <td class="text-center">{{ $entry->ot_hours ?? '-' }}</td>
                                        @endforeach
                                        <td class="text-center">{{ $records->sum('ot_hours') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                @endforeach
            @endforeach
        @else
            <div class="text-center mt-5" style="font-size:12px; font-weight:bold; color:red; margin-top:20px;">
                No data available for this data combination.
            </div>
        @endif
    @elseif($title == 2)
        @if ($datas->count() > 0)
            @php
                $departmentDatas = $datas->groupBy(function ($item) {
                    return optional($item->employee->department->parentDepartment)->department;
                });
            @endphp
            @foreach ($departmentDatas as $department => $departmentGroup)
                @php
                    $sectionDatas = $departmentGroup->groupBy(function ($item) {
                        return optional($item->employee->department)->department;
                    });

                    $departmentTotalOt = 0;
                    $departmentEmployees = collect();
                @endphp

                @foreach ($sectionDatas as $section => $sectionGroup)
                    @php
                        $employeeGroups = $sectionGroup->groupBy('employee_id');

                        $sectionTotalOt = $sectionGroup->sum('ot_hours');
                        $sectionEmployees = $sectionGroup->pluck('employee_id')->unique();

                        // Department accumulate
                        $departmentTotalOt += $sectionTotalOt;
                        $departmentEmployees = $departmentEmployees->merge($sectionEmployees);
                    @endphp

                    {{-- Header --}}
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    Department: {{ $department }} |
                                    Section: {{ $section }}
                                </th>
                            </tr>
                        </thead>
                    </table>

                    {{-- Employee Table --}}
                    <table class="table table-bordered" style="margin-top: 0px;">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Emp ID</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>In</th>
                                <th>Out</th>
                                <th>OT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeeGroups as $records)
                                @php
                                    $employee = $records->first()->employee;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ str_pad($employee->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ optional($employee->designation)->designation }}</td>
                                    <td>{{ optional($employee->designation)->category_code }}</td>
                                    <td>{{ date('d-m-Y', strtotime($records->first()->work_date)) }}</td>
                                    <td>{{ date('h:i A', strtotime($records->first()->start_punch)) }}</td>
                                    <td>{{ date('h:i A', strtotime($records->first()->end_punch)) }}</td>
                                    <td class="text-center">{{ $records->sum('ot_hours') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- ✅ Section Summary --}}
                    <table style="margin-top: 0px;">
                        <tr style="background:#160144;color:white;">
                            <td colspan="8" class="text-right">
                                Section Summary =>
                                Total Employees: {{ $sectionEmployees->count() }}
                            </td>
                            <td class="text-center" width="30">
                                {{ $sectionTotalOt }}
                            </td>
                        </tr>
                    </table>
                @endforeach

                {{-- ✅ Department Summary --}}
                <table style="margin-top: 0px;">
                    <tr style="background:#ecb119;color:black;">
                        <td colspan="8" class="text-right">
                            Department Summary =>
                            Total Employees: {{ $departmentEmployees->unique()->count() }}
                        </td>
                        <td class="text-center" width="30">
                            {{ $departmentTotalOt }}
                        </td>
                    </tr>
                </table>
            @endforeach
            <table style="margin-top: 0px;">
                <tr style="background:#025793;color:white;">
                    <td colspan="8" class="text-right">
                        Overall Summary =>
                        Total Employees: {{ $datas->unique()->count() }}
                    </td>
                    <td class="text-center" width="30">
                        {{ $datas->sum('ot_hours') }}
                    </td>
                </tr>
                </>
            @else
                <div class="text-center mt-5 text-danger">
                    No data available
                </div>
        @endif
    @elseif($title == 3)
        @if ($datas->count() > 0)

            @php
                $grandTotal = 0;
                $grandEmployees = collect();
            @endphp

            @foreach ($sectionGrouped as $section => $overtimes)
                @php
                    $sectionDepartment = $overtimes->groupBy('department');
                    $sectionTotal = 0;
                    $sectionEmployees = collect();
                @endphp

                @foreach ($sectionDepartment as $department => $deptData)
                    @php
                        $deptTotal = $deptData->sum('total_ot');
                        $sectionTotal += $deptTotal;

                        $deptEmployees = $deptData->pluck('employee_id')->unique();
                        $sectionEmployees = $sectionEmployees->merge($deptEmployees);

                        $grandTotal += $deptTotal;
                        $grandEmployees = $grandEmployees->merge($deptEmployees);
                    @endphp

                    {{-- Header --}}
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    Department: {{ $section }} |
                                    Section: {{ $department }}
                                </th>
                            </tr>
                        </thead>
                    </table>

                    {{-- Employee Table --}}
                    <table class="table table-bordered" style="margin-top:0;">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th class="text-center">Employee ID</th>
                                <th width="20%">Employee Name</th>
                                <th class="text-center">Department</th>
                                <th width="20%" class="text-center">Designation</th>
                                <th class="text-center">Category</th>
                                <th class="text-center" width="15%">Total OT Hour</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($deptData as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ str_pad($data->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td class="text-center">{{ $data->department }}</td>
                                    <td class="text-center">{{ $data->designation }}</td>
                                    <td class="text-center">{{ $data->category_code }}</td>
                                    <td class="text-center" width="10%">{{ $data->total_ot }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Department Summary --}}
                    <table style="margin-top:0;">
                        <tr style="background:#ecb119;color:black;">
                            <td colspan="6" class="text-right">
                                Section Summary ({{ $department }}) =>
                                Total Employees: {{ $deptEmployees->count() }}
                            </td>
                            <td class="text-center" width="15%">
                                {{ $deptTotal }}
                            </td>
                        </tr>
                    </table>
                @endforeach

                {{-- Section Summary --}}
                <table style="margin-top:0;">
                    <tr style="background:#160144;color:white;">
                        <td colspan="6" class="text-right">
                            Department Summary ({{ $section }}) =>
                            Total Employees: {{ $sectionEmployees->unique()->count() }}
                        </td>
                        <td class="text-center" width="15%">
                            {{ $sectionTotal }}
                        </td>
                    </tr>
                </table>
            @endforeach

            {{-- Overall Summary --}}
            <table style="margin-top:0;">
                <tr style="background:#025793;color:white;">
                    <td colspan="6" class="text-right">
                        Overall Summary =>
                        Total Employees: {{ $grandEmployees->unique()->count() }}
                    </td>
                    <td class="text-center" width="15%">
                        {{ $grandTotal }}
                    </td>
                </tr>
            </table>
        @else
            <div class="text-center mt-5 text-danger">
                No data available
            </div>
        @endif

    @endif
@endsection
