@extends('payroll::components.layouts.pdf')
@section('title', 'Attendance Report')
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

    th, td {
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
        '1' => 'Department-wise Daily Attendance',
        '2' => 'Individual Card Wise Monthly Attendance',
        '3' => 'Section Wise Daily Attendance Summary',
        '4' => 'Department Wise Daily Attendance Summary',
        '5' => 'Company Wise Daily Attendance Summary',
        default => '',
    };

    $reportSubTitle = in_array($title, [2])
    ? 'Month: ' . ($monthName . ' ' . $year ?? '')
    : (in_array($title, [1, 3, 4, 5])
        ? 'Date: ' . \Carbon\Carbon::parse($date)->format('d-m-Y')
        : '');
@endphp

{{-- ================= CONTENT ================= --}}
@section('content')
    @if ($title == 1)
        @if($uniqueDepartments->count() > 0)
            @foreach ($uniqueDepartments as $key => $department)
                <div class="{{ !$loop->first ? 'page-break' : '' }}">
                    <div style="font-size:12px; font-weight:bold; margin-bottom:5px;">
                        Department: {{ $department }}
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">SL</th>
                                <th class="text-center">Org</th>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Category</th>
                                <th class="text-center">Date</th>
                                <th>Start Punch</th>
                                <th>End Punch</th>
                                <th class="text-center" width="5px">Attn Type</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $rows = collect($datas)->where('department_id', $key)->values();
                            @endphp
                            @foreach ($rows as $overtime)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $overtime->short_name }}</td>
                                    <td>{{ str_pad($overtime->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $overtime->name }}</td>
                                    <td>{{ $overtime->department }}</td>
                                    <td>{{ $overtime->designation }}</td>
                                    <td>{{ $overtime->category_code }}</td>
                                    <td class="text-center">
                                        {{ date('d-m-Y', strtotime($overtime->work_date)) }}
                                    </td>
                                    <td>{{ $overtime->start_punch }}</td>
                                    <td>{{ $overtime->end_punch }}</td>
                                    <td class="text-center">{{ $overtime->attn_type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        @else
            <div class="text-center mt-5" style="font-size:12px; font-weight:bold; color:red; margin-top:20px;">
                No data available for this data combination.
            </div>
        @endif
    {{-- ===== OTHER TITLES PLACEHOLDER ===== --}}
    @elseif ($title == 2)
        @if($datas->count() > 0)
            <div class="card-body">
                <div style="overflow-x: auto;">
                    @php
                        $sindata = $datas->first();
                        $department = $sindata->department;
                    @endphp
                    <div style="font-size:10px; font-weight:bold; margin-bottom:5px;">
                            Name: {{ $sindata->name }} <br>
                            Employee ID: {{ str_pad($sindata->employee_id, 8, '0', STR_PAD_LEFT) }} <br>
                            Department: {{ $department }}
                    </div>
                    <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">SL</th>
                                <th class="text-center">Org</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Category</th>
                                <th class="text-center">Date</th>
                                <th>Start Punch</th>
                                <th>End Punch</th>
                                <th class="text-center">Attn Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key => $data)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $data->short_name }}</td>
                                    <td>{{ $data->department }}</td>
                                    <td>{{ $data->designation }}</td>
                                    <td>{{ $data->category_code }}</td>
                                    <td class="text-center">{{ date('d-m-Y', strtotime($data->work_date)) }}</td>
                                    <td>{{ $data->start_punch }}</td>
                                    <td>{{ $data->end_punch }}</td>
                                    <td class="text-center">{{ $data->attn_type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="text-center mt-5" style="font-size:12px; font-weight:bold; color:red; margin-top:20px;">
                No data available for this data combination.
            </div>
        @endif
    @elseif ($title == 3)
        @if($datas->count() > 0)
            <div class="card-body">
                <div style="overflow-x: auto;">
                    <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center" width="4%">SL</th>
                                <th class="text-center" width="5%">Org</th>
                                <th width="16%">Section Name</th>
                                <th width="15%" class="text-center">Total Employee</th>
                                <th width="10%" class="text-center">Present</th>
                                <th width="10%" class="text-center">Absent</th>
                                <th width="10%" class="text-center">Leave</th>
                                <th class="text-center" width="10%">Present %</th>
                                <th class="text-center" width="10%">OT Hours</th>
                                <th class="text-center" width="10%">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($uniqueDepartments as $key => $department)
                                @php
                                    $employees = collect($datas)->where('department_id', $key);
                                    $totalEmployee = $employees->count();
                                    $present = $employees->where('attn_type', 'PR')->count();
                                    $absent = $employees->where('attn_type', 'AB')->count();
                                    $leave = $employees->whereIn('attn_type', ['SL', 'CL', 'EL'])->count();
                                    $presentPercentage = ($present / max($totalEmployee, 1)) * 100;
                                    $otHours = $employees->sum('ot_hours');
                                    $orgName = optional($employees->first())->short_name;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $orgName }}</td>
                                    <td>{{ $department }}</td>
                                    <td class="text-center">{{ $totalEmployee }}</td>
                                    <td class="text-center">{{ $present }}</td>
                                    <td class="text-center">{{ $absent }}</td>
                                    <td class="text-center">{{ $leave }}</td>
                                    <td class="text-center">{{ number_format($presentPercentage, 2) }}</td>
                                    <td class="text-center">{{ $otHours }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="background-color: #04386b; color: #fff;">
                                <td colspan="3" class="text-center">Summary</td>
                                <td class="text-center">{{ collect($datas)->count() }}</td>
                                <td class="text-center">{{ collect($datas)->where('attn_type', 'PR')->count() }}</td>
                                <td class="text-center">{{ collect($datas)->where('attn_type', 'AB')->count() }}</td>
                                <td class="text-center">{{ collect($datas)->whereIn('attn_type', ['SL', 'CL', 'EL'])->count() }}</td>
                                <td class="text-center">{{ number_format((collect($datas)->where('attn_type', 'PR')->count() / max(collect($datas)->count(), 1)) * 100, 2) }}</td>
                                <td class="text-center">{{ collect($datas)->sum('ot_hours') }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        @else
            <div class="text-center mt-5" style="font-size:12px; font-weight:bold; color:red; margin-top:20px;">
                No data available for this data combination.
            </div>
        @endif
    @elseif ($title == 4)
        @if(count($uniqueDepartments) > 0)
            <div class="card-body">
                <div style="overflow-x: auto;">
                    <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center" width="4%">SL</th>
                                <th class="text-center" width="10%">Org</th>
                                <th width="10%">Department Name</th>
                                <th width="10%" class="text-center">Total Employee</th>
                                <th width="10%" class="text-center">Present</th>
                                <th width="10%" class="text-center">Absent</th>
                                <th width="10%" class="text-center">Leave</th>
                                <th class="text-center" width="10%">Present %</th>
                                <th class="text-center" width="10%">OT Hours</th>
                                <th class="text-center" width="10%">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($uniqueDepartments as $key => $department)
                                @php
                                    $employees = collect($datas)->where('parent_department_id', $key);
                                    $totalEmployee = $employees->count();
                                    $present = $employees->where('attn_type', 'PR')->count();
                                    $absent = $employees->where('attn_type', 'AB')->count();
                                    $leave = $employees->whereIn('attn_type', ['SL', 'CL', 'EL'])->count();
                                    $presentPercentage = ($present / max($totalEmployee, 1)) * 100;
                                    $otHours = $employees->sum('ot_hours');
                                    $orgName = optional($employees->first())->short_name;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $orgName }}</td>
                                    <td>{{ $department }}</td>
                                    <td class="text-center">{{ $totalEmployee }}</td>
                                    <td class="text-center text-success fw-bold">{{ $present }}</td>
                                    <td class="text-center text-danger fw-bold">{{ $absent }}</td>
                                    <td class="text-center text-warning fw-bold">{{ $leave }}</td>
                                    <td class="text-center">{{ number_format($presentPercentage, 2) }}</td>
                                    <td class="text-center">{{ $otHours }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot >
                            <tr style="background-color: #04386b; color: #fff;">
                                <td colspan="3" class="text-center">Summary</td>
                                <td class="text-center">{{ collect($datas)->count() }}</td>
                                <td class="text-center">{{ collect($datas)->where('attn_type', 'PR')->count() }}</td>
                                <td class="text-center">{{ collect($datas)->where('attn_type', 'AB')->count() }}</td>
                                <td class="text-center">{{ collect($datas)->whereIn('attn_type', ['SL', 'CL', 'EL'])->count() }}</td>
                                <td class="text-center">{{ number_format((collect($datas)->where('attn_type', 'PR')->count() / max(collect($datas)->count(), 1)) * 100, 2) }}</td>
                                <td class="text-center">{{ collect($datas)->sum('ot_hours') }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @else
            <div class="text-center mt-5" style="font-size:12px; font-weight:bold; color:red; margin-top:20px;">
                No data available for this data combination.
            </div>
        @endif
    @elseif ($title == 5)
        @if($datas->count() > 0)
        <div class="card-body">
            <div style="overflow-x: auto;">
                <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center" width="4%">SL</th>
                            <th class="text-center" width="20%">Organization</th>
                            <th width="10%" class="text-center">Employee</th>
                            <th class="text-center">Present</th>
                            <th class="text-center">Absent</th>
                            <th class="text-center">Leave</th>
                            <th class="text-center">Present %</th>
                            <th class="text-center">OT Hours</th>
                            <th class="text-center">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($uniqueOrganization as $key => $organization)
                            @php
                                $employees = collect($datas)->where('org_id', $key);
                                $totalEmployee = $employees->count();
                                $present = $employees->where('attn_type', 'PR')->count();
                                $absent = $employees->where('attn_type', 'AB')->count();
                                $leave = $employees->whereIn('attn_type', ['SL', 'CL', 'EL'])->count();
                                $presentPercentage = ($present / max($totalEmployee, 1)) * 100;
                                $otHours = $employees->sum('ot_hours');
                                $orgName = optional($employees->first())->name;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $orgName }}</td>
                                <td class="text-center">{{ $totalEmployee }}</td>
                                <td class="text-center text-success fw-bold">{{ $present }}</td>
                                <td class="text-center text-danger fw-bold">{{ $absent }}</td>
                                <td class="text-center text-warning fw-bold">{{ $leave }}</td>
                                <td class="text-center">{{ number_format($presentPercentage, 2) }}</td>
                                <td class="text-center">{{ $otHours }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="background-color: #04386b; color: #fff;">
                            <td colspan="2" class="text-center">Summary</td>
                            <td class="text-center">{{ collect($datas)->count() }}</td>
                            <td class="text-center">{{ collect($datas)->where('attn_type', 'PR')->count() }}</td>
                            <td class="text-center">{{ collect($datas)->where('attn_type', 'AB')->count() }}</td>
                            <td class="text-center">{{ collect($datas)->whereIn('attn_type', ['SL', 'CL', 'EL'])->count() }}</td>
                            <td class="text-center">{{ number_format((collect($datas)->where('attn_type', 'PR')->count() / max(collect($datas)->count(), 1)) * 100, 2) }}</td>
                            <td class="text-center">{{ collect($datas)->sum('ot_hours') }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @else
            <div class="text-center mt-5" style="font-size:12px; font-weight:bold; color:red; margin-top:20px;">
                No data available for this data combination.
            </div>
        @endif
    @endif
@endsection
