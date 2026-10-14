@extends('layouts.app')
@section('title', 'Payroll')
@section('content')
    <style>
        .subtotal td {
            background-color: #cbdefa !important;
        }

        .subtotal2 td {
            background-color: #d1fae6 !important;
        }

        .grand-total td {
            background-color: #fac6b3 !important;
        }

        .friday-column {
            background-color: #f8d7da !important;
            color: #842029 !important;
        }

        .table-header {
            background-color: #4549A2 !important;
            color: #fff !important;
        }

        .table-header th {
            background-color: #4549A2 !important;
            color: #fff !important;
        }
    </style>
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Payroll',
                'subtitle' => 'Overtime',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Report', 'url' => route('payroll.index')],
                    ['label' => 'Overtime', 'url' => route('payroll.report.overtime-report.index')],
                ],
            ])
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    @if($title == 1)
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Basis Monthly Overtime</h6>
                        <p class="ms-auto text-center">Month: {{ $monthName }}, {{ $year }}</p>
                    @elseif($title == 2)
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Overtime</h6>
                        <p class="ms-auto text-center">Date: {{ date('d-m-Y', strtotime($date)) }}</p>
                    @elseif($title == 3)
                        <h6 class="my-0 text-primary text-center">Department-wise Monthly Total Overtime</h6>
                        <p class="ms-auto text-center">Month: {{ $monthName }}, {{ $year }}</p>
                    @elseif($title == 4)
                        <h6 class="my-0 text-primary text-center">Section-wise Monthly Overtime Summary</h6>
                        <p class="ms-auto text-center font-bold">Organization: {{ $organization }}</p>
                        <p class="ms-auto text-center">Month: {{ $monthName }}, {{ $year }}</p>
                    @endif
                </div>
                @if($title == 1)
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Org</th>
                                    <th>Employee ID</th>
                                    <th>Name</th>

                                    @foreach($dates as $date)
                                        <th class="text-center">{{ date('d', strtotime($date)) }}</th>
                                    @endforeach
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grouped as $index => $records)
                                    @php
                                        $employee = $records->first()->employee;
                                        $organization = $records->first()->organization;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $organization->short_name }}</td>
                                        <td>{{ str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
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
                    </div>
                </div>
                @elseif($title == 2)
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="6%">Org</th>
                                    <th width="10%">Employee ID</th>
                                    <th width="10%">Employee Name</th>
                                    <th width="10%">Department</th>
                                    <th width="15%">Designation</th>
                                    <th width="10%">Category</th>
                                    <th width="10%">Date</th>
                                    <th width="10%">In Time</th>
                                    <th width="10%">Out Time</th>
                                    <th width="4%">OT Hour</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($uniqueDepartments as $key=>$department)
                                    <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="color: #5156be;">{{ $department }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @php
                                        $overtimes = collect($datas)->where('employee.department_id', $key)->all();
                                    @endphp
                                    @foreach($overtimes as $overtime)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $overtime->organization?->short_name }}</td>
                                            <td>{{ str_pad($overtime->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $overtime->employee?->name }}</td>
                                            <td>{{ $overtime->employee?->department?->department }}</td>
                                            <td>{{ $overtime->employee?->designation?->designation }}</td>
                                            <td>{{ $overtime->employee?->designation?->category_code }}</td>
                                            <td>{{ date('d-m-Y', strtotime($overtime->work_date)) }}</td>
                                            <td>{{ $overtime->start_punch ? \Carbon\Carbon::parse($overtime->start_punch)->format('H:i:s A') : '-' }}</td>
                                            <td>{{ $overtime->end_punch ? \Carbon\Carbon::parse($overtime->end_punch)->format('H:i:s A') : '-' }}</td>
                                            <td class="text-center">{{ $overtime->ot_hours }}</td>
                                        </tr>
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
                                    <th width="5%">SL</th>
                                    <th width="10%">Employee ID</th>
                                    <th width="15%">Employee Name</th>
                                    <th width="15%">Department</th>
                                    <th width="15%">Designation</th>
                                    <th width="10%" class="text-center">Category</th>
                                    <th width="10%" class="text-center">Total OT Hour</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sectionGrouped as $section => $overtimes)
                                    <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="color: #5156be;">Department: {{ $section }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @foreach ($overtimes as $overtime)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ str_pad($overtime->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $overtime->name }}</td>
                                            <td>{{ $overtime->department }}</td>
                                            <td>{{ $overtime->designation }}</td>
                                            <td class="text-center">{{ $overtime->category_code }}</td>
                                            <td class="text-center">{{ $overtime->total_ot }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @elseif($title == 4)
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead class="table-header">
                                <tr>
                                    <th width="12%">Date</th>
                                    @foreach($dates as $date)
                                        @php
                                            $isFriday = date('N', strtotime($date)) == 5;
                                        @endphp
                                        <th class="text-center {{ $isFriday ? 'friday-column' : '' }}">{{ date('d', strtotime($date)) }}</th>
                                    @endforeach
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $grandTotals = collect($dates)->mapWithKeys(fn ($date) => [$date => 0]);
                                    $grandTotal = 0;
                                @endphp

                                @foreach($groupedData as $parentdep)
                                    @foreach($parentdep['departments'] as $department)

                                        @php
                                            $departmentTotals = collect($dates)->mapWithKeys(fn ($date) => [$date => 0]);
                                            $departmentTotal = 0;
                                        @endphp

                                        @if(isset($department['units']))
                                            @foreach($department['units'] as $unit)

                                                @php
                                                    $unitTotals = collect($dates)->mapWithKeys(fn ($date) => [$date => 0]);
                                                    $unitTotal = 0;
                                                @endphp

                                                @if(isset($unit['lines']))

                                                    @foreach($unit['lines'] as $line)

                                                        <tr>
                                                            <td>Line-{{ $line['line_name'] }}
                                                            </td>

                                                            @foreach($dates as $date)

                                                                @php
                                                                    $value = $line['dates']->get($date, 0);

                                                                    $unitTotals[$date] += $value;
                                                                    $departmentTotals[$date] += $value;
                                                                    $grandTotals[$date] += $value;

                                                                    $unitTotal += $value;
                                                                    $departmentTotal += $value;
                                                                    $grandTotal += $value;

                                                                    $isFriday = \Carbon\Carbon::parse($date)->isFriday();
                                                                @endphp

                                                                <td class="text-center {{ $isFriday ? 'friday-column' : '' }}">
                                                                    {{ $value }}
                                                                </td>

                                                            @endforeach

                                                            <td class="text-center">
                                                                {{ $line['dates']->sum() }}
                                                            </td>
                                                        </tr>

                                                    @endforeach

                                                    <tr class="fw-bold subtotal2">
                                                        <td>
                                                           Unit-{{ $unit['unit_name'] }} Sub Total
                                                        </td>

                                                        @foreach($dates as $date)

                                                            @php
                                                                $isFriday = \Carbon\Carbon::parse($date)->isFriday();
                                                            @endphp

                                                            <td class="text-center {{ $isFriday ? 'friday-column' : '' }}">
                                                                {{ $unitTotals[$date] }}
                                                            </td>

                                                        @endforeach

                                                        <td class="text-center">
                                                            {{ $unitTotal }}
                                                        </td>
                                                    </tr>

                                                @else

                                                    <tr>
                                                        <td>
                                                            {{ $department['department_name'] }}::Unit-{{ $unit['unit_name'] }}
                                                        </td>

                                                        @foreach($dates as $date)

                                                            @php
                                                                $value = $unit['dates']->get($date, 0);

                                                                $unitTotals[$date] += $value;
                                                                $departmentTotals[$date] += $value;
                                                                $grandTotals[$date] += $value;

                                                                $unitTotal += $value;
                                                                $departmentTotal += $value;
                                                                $grandTotal += $value;

                                                                $isFriday = \Carbon\Carbon::parse($date)->isFriday();
                                                            @endphp

                                                            <td class="text-center {{ $isFriday ? 'friday-column' : '' }}">
                                                                {{ $value }}
                                                            </td>

                                                        @endforeach

                                                        <td class="text-center">
                                                            {{ $unit['dates']->sum() }}
                                                        </td>
                                                    </tr>

                                                    <tr class="fw-bold subtotal2">
                                                        <td>
                                                            Unit-{{ $unit['unit_name'] }} Sub Total
                                                        </td>

                                                        @foreach($dates as $date)

                                                            @php
                                                                $isFriday = \Carbon\Carbon::parse($date)->isFriday();
                                                            @endphp

                                                            <td class="text-center {{ $isFriday ? 'friday-column' : '' }}">
                                                                {{ $unitTotals[$date] }}
                                                            </td>

                                                        @endforeach

                                                        <td class="text-center">
                                                            {{ $unitTotal }}
                                                        </td>
                                                    </tr>

                                                @endif

                                            @endforeach

                                            @if(isset($department['lines']))

                                                @foreach($department['lines'] as $line)

                                                    <tr>
                                                        <td>
                                                            {{ $department['department_name'] }} :: Line - {{ $line['line_name'] }}
                                                        </td>

                                                        @foreach($dates as $date)

                                                            @php
                                                                $value = $line['dates']->get($date, 0);

                                                                $departmentTotals[$date] += $value;
                                                                $grandTotals[$date] += $value;

                                                                $departmentTotal += $value;
                                                                $grandTotal += $value;

                                                                $isFriday = \Carbon\Carbon::parse($date)->isFriday();
                                                            @endphp

                                                            <td class="text-center {{ $isFriday ? 'friday-column' : '' }}"> {{ $value }}</td>

                                                        @endforeach

                                                        <td class="text-center"> {{ $line['dates']->sum() }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                            <tr class="fw-bold subtotal">
                                                <td> {{ $department['department_name'] }} Sub Total </td>

                                                @foreach($dates as $date)
                                                    @php
                                                        $isFriday = \Carbon\Carbon::parse($date)->isFriday();
                                                    @endphp

                                                    <td class="text-center {{ $isFriday ? 'friday-column' : '' }}"> {{ $departmentTotals[$date] }}</td>
                                                @endforeach

                                                <td class="text-center">
                                                    {{ $departmentTotal }}
                                                </td>
                                            </tr>

                                        @elseif(isset($department['lines']))

                                            @foreach($department['lines'] as $line)

                                                <tr>
                                                    <td>
                                                        {{ $department['department_name'] }} :: Line - {{ $line['line_name'] }}
                                                    </td>

                                                    @foreach($dates as $date)

                                                        @php
                                                            $value = $line['dates']->get($date, 0);

                                                            $departmentTotals[$date] += $value;
                                                            $grandTotals[$date] += $value;

                                                            $departmentTotal += $value;
                                                            $grandTotal += $value;

                                                            $isFriday = \Carbon\Carbon::parse($date)->isFriday();
                                                        @endphp

                                                        <td class="text-center {{ $isFriday ? 'friday-column' : '' }}"> {{ $value }}</td>

                                                    @endforeach

                                                    <td class="text-center"> {{ $line['dates']->sum() }}</td>
                                                </tr>

                                            @endforeach

                                            <tr class="fw-bold subtotal">
                                                <td> {{ $department['department_name'] }} Sub Total </td>
                                                @foreach($dates as $date)
                                                    @php
                                                        $isFriday = \Carbon\Carbon::parse($date)->isFriday();
                                                    @endphp
                                                    <td class="text-center {{ $isFriday ? 'friday-column' : '' }}"> {{ $departmentTotals[$date] }}</td>
                                                @endforeach
                                                <td class="text-center">
                                                    {{ $departmentTotal }}
                                                </td>
                                            </tr>

                                        @else

                                            <tr>
                                                <td>
                                                    {{ $department['department_name'] }}
                                                </td>

                                                @foreach($dates as $date)

                                                    @php
                                                        $value = $department['dates']->get($date, 0);

                                                        $grandTotals[$date] += $value;

                                                        $departmentTotal += $value;
                                                        $grandTotal += $value;

                                                        $isFriday = \Carbon\Carbon::parse($date)->isFriday();
                                                    @endphp

                                                    <td class="text-center {{ $isFriday ? 'friday-column' : '' }}"> {{ $value }}</td>

                                                @endforeach
                                                <td class="text-center"> {{ $departmentTotal }}</td>
                                            </tr>

                                            <tr class="fw-bold subtotal">
                                                <td> {{ $department['department_name'] }} Sub Total </td>
                                                @foreach($dates as $date)
                                                    @php
                                                        $isFriday = \Carbon\Carbon::parse($date)->isFriday();
                                                    @endphp
                                                    <td class="text-center {{ $isFriday ? 'friday-column' : '' }}"> {{ $department['dates']->get($date, 0) }}</td>
                                                @endforeach
                                                <td class="text-center"> {{ $departmentTotal }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach

                                <tr class="fw-bold grand-total">
                                    <td> Grand Total </td>

                                    @foreach($dates as $date)

                                        @php
                                            $isFriday = \Carbon\Carbon::parse($date)->isFriday();
                                        @endphp

                                        <td class="text-center {{ $isFriday ? 'friday-column' : '' }}"> {{ $grandTotals[$date] }}</td>
                                    @endforeach

                                    <td class="text-center"> {{ $grandTotal }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $('.table').DataTable({
        'paging'      : false,
        'searching'   : false,
        'ordering'    : false,
        'dom': 'Bfrtip',
        'buttons': [
            {
                'extend': 'excelHtml5',
                'title': 'Employee Listing',
                'filename': 'Employee Listing',
                'className': 'btn btn-info btn-sm'
            }
        ]
    });
</script>
@endpush
