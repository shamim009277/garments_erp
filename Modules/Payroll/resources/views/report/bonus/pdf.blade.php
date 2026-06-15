@extends('payroll::components.layouts.pdf')
@section('title', 'Bonus Report')
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
        '1' => 'Department-wise Bonus Report',
        '2' => 'Individual Card Wise Monthly Bonus Report',
        default => '',
    };

    $reportSubTitle = in_array($title, [2])
    ? ''
    : (in_array($title, [1])
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
                                <th class="text-center" width="4%">SL</th>
                                <th class="text-center" width="6%">Org</th>
                                <th class="text-center" width="6%">Year</th>
                                <th class="text-center" width="6%">Month</th>
                                <th width="10%">Employee ID</th>
                                <th width="15%">Name</th>
                                <th width="12%">Department</th>
                                <th width="12%">Designation</th>
                                <th width="6%">Category</th>
                                <th class="text-center" width="10%">Base Date</th>
                                <th width="10%">Basic Salary</th>
                                <th width="10%">Amount</th>
                                <th width="10%">Percentage</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $bonuses = collect($datas)->where('department_id', $key)->all();
                            @endphp
                            @foreach ($bonuses as $bonus)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $bonus->short_name }}</td>
                                    <td class="text-center">{{ $bonus->year }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::create()->month($bonus->month)->format('F') }}</td>
                                    <td>{{ str_pad($bonus->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $bonus->name }}</td>
                                    <td>{{ $bonus->department }}</td>
                                    <td>{{ $bonus->designation }}</td>
                                    <td class="text-center">{{ $bonus->category }}</td>
                                    <td class="text-center">{{ date('d-m-Y', strtotime($bonus->base_date)) }}</td>
                                    <td>{{ number_format($bonus->basic, 2) }}</td>
                                    <td>{{ number_format($bonus->amount, 2) }}</td>
                                    <td>{{ number_format($bonus->percentage, 2) }}</td>
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
    @elseif ($title == 2)
        @if($datas)
        <div class="card-body">
            <div style="overflow-x: auto;">
                <table style="width: 100%; text-align: center; font-weight: bold;">
                    <tr>
                        <td colspan="10" style="font-size:12px; text-align:center;">
                            Employee Name: {{ $datas->name }} <br>
                            Employee ID: {{ str_pad($datas->employee_id, 8, '0', STR_PAD_LEFT) }} <br>
                            Designation: {{ $datas->designation }} <br>
                            Department: {{ $datas->department }} <br>
                            Line: {{ $datas->line }} <br>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center" width="4%">SL</th>
                            <th class="text-center" width="6%">Org</th>
                            <th class="text-center" width="6%">Year</th>
                            <th class="text-center" width="6%">Month</th>
                            <th width="12%">Department</th>
                            <th width="12%">Designation</th>
                            <th width="6%">Category</th>
                            <th class="text-center" width="10%">Base Date</th>
                            <th width="10%">Basic Salary</th>
                            <th width="10%">Amount</th>
                            <th width="10%">Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">#</td>
                            <td class="text-center">{{ $datas->short_name }}</td>
                            <td class="text-center">{{ $datas->year }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::create()->month($datas->month)->format('F') }}</td>
                            <td>{{ $datas->department }}</td>
                            <td>{{ $datas->designation }}</td>
                            <td class="text-center">{{ $datas->category }}</td>
                            <td class="text-center">{{ date('d-m-Y', strtotime($datas->base_date)) }}</td>
                            <td>{{ number_format($datas->basic, 2) }}</td>
                            <td>{{ number_format($datas->amount, 2) }}</td>
                            <td>{{ number_format($datas->percentage, 2) }}</td>
                        </tr>
                    </tbody>
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
