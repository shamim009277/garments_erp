@extends('layouts.app')
@section('title', 'Payroll')
@section('content')
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
                        <p class="ms-auto text-center">Date Range: {{ date('d-m-Y', strtotime($start_date)) }} To {{ date('d-m-Y', strtotime($end_date)) }}</p>
                    @elseif($title == 2)
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Overtime</h6>
                        <p class="ms-auto text-center">Date: {{ date('d-m-Y', strtotime($date)) }}</p>
                    @elseif($title == 3)
                        <h6 class="my-0 text-primary text-center">Department-wise Monthly Total Overtime</h6>
                        <p class="ms-auto text-center">Date Range: {{ date('d-m-Y', strtotime($start_date)) }} To {{ date('d-m-Y', strtotime($end_date)) }}</p>
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
                                    <th width="10%">Org</th>
                                    <th width="10%">Employee ID</th>
                                    <th width="18%">Employee Name</th>
                                    <th width="18%">Department</th>
                                    <th width="15%">Designation</th>
                                    <th width="10%">Category</th>
                                    <th width="10%">Date</th>
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
                                    </tr>
                                    @php
                                        $overtimes = collect($datas)->where('employee.department_id', $key)->all();
                                    @endphp
                                    @foreach($overtimes as $overtime)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $overtime->organization?->short_name }}</td>
                                            <td>{{ str_pad($overtime->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $overtime->employee?->name }}</td>
                                            <td>{{ $overtime->employee?->department?->department }}</td>
                                            <td>{{ $overtime->employee?->designation?->designation }}</td>
                                            <td>{{ $overtime->employee?->designation?->category_code }}</td>
                                            <td>{{ date('d-m-Y', strtotime($overtime->work_date)) }}</td>
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
                                    <th width="10%">Org</th>
                                    <th width="10%">Employee ID</th>
                                    <th width="15%">Employee Name</th>
                                    <th width="15%">Department</th>
                                    <th width="15%">Designation</th>
                                    <th width="10%">Category</th>
                                    <th width="10%">Total OT Hour</th>
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
                                    </tr>
                                    @php
                                        $overtimes = collect($datas)->where('employee.department_id', $key)->all();
                                        $employeeids = collect($overtimes)->pluck('employee_id')->unique();

                                        $totalHours = collect($overtimes)->groupBy('employee_id')->map(function ($overtime) {
                                            return $overtime->sum('ot_hours');
                                        });
                                        $sl = 1;
                                    @endphp

                                    @foreach($employeeids as $key => $employeeid)
                                        @php
                                            $overtime = collect($overtimes)->where('employee_id', $employeeid)->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $sl++ }}</td>
                                            <td>{{ $overtime->short_name }}</td>
                                            <td>{{ str_pad($overtime->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $overtime->name }}</td>
                                            <td>{{ $overtime->department }}</td>
                                            <td>{{ $overtime->designation }}</td>
                                            <td>{{ $overtime->category_code }}</td>
                                            <td>{{ $totalHours[$employeeid] }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
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
