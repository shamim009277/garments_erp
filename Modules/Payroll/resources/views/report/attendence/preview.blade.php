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
                    @if ($title == 1)
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Attendance</h6>
                        <p class="ms-auto text-center">Date: {{ date('d-m-Y', strtotime($date)) }}</p>
                    @elseif($title == 2)
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Attendance</h6>
                        <p class="ms-auto text-center">Month: {{ $monthName }} <br> Year: {{ $year }}</p>
                    @elseif($title == 3)
                        <h6 class="my-0 text-primary text-center">Section Wise Daily Attendence Summary</h6>
                        <p class="ms-auto text-center">Date: {{ date('d-m-Y', strtotime($date)) }}</p>
                    @elseif($title == 4)
                        <h6 class="my-0 text-primary text-center">Department Wise Daily Attendence Summary</h6>
                        <p class="ms-auto text-center">Date: {{ date('d-m-Y', strtotime($date)) }}</p>
                    @elseif($title == 5)
                        <h6 class="my-0 text-primary text-center">Company Wise Daily Attendence Summary</h6>
                        <p class="ms-auto text-center">Date: {{ date('d-m-Y', strtotime($date)) }}</p>
                    @endif
                </div>
                @if ($title == 1)
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">SL</th>
                                        <th class="text-center" width="6%">Org</th>
                                        <th width="10%">Employee ID</th>
                                        <th width="15%">Employee Name</th>
                                        <th width="12%">Department</th>
                                        <th width="12%">Designation</th>
                                        <th width="6%">Category</th>
                                        <th class="text-center" width="10%">Date</th>
                                        <th width="10%">Start Punch</th>
                                        <th width="10%">End Punch</th>
                                        <th class="text-center" width="5%">Attn Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($uniqueDepartments as $key => $department)
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
                                            $overtimes = collect($datas)->where('department_id', $key)->all();
                                        @endphp
                                        @foreach ($overtimes as $overtime)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $overtime->short_name }}</td>
                                                <td>{{ str_pad($overtime->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $overtime->name }}</td>
                                                <td>{{ $overtime->department }}</td>
                                                <td>{{ $overtime->designation }}</td>
                                                <td>{{ $overtime->category_code }}</td>
                                                <td class="text-center">
                                                    {{ date('d-m-Y', strtotime($overtime->work_date)) }}</td>
                                                <td>{{ $overtime->start_punch }}</td>
                                                <td>{{ $overtime->end_punch }}</td>
                                                <td class="text-center">{{ $overtime->attn_type }}</td>
                                            </tr>
                                        @endforeach
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
                                        <th class="text-center" width="4%">SL</th>
                                        <th class="text-center" width="6%">Org</th>
                                        <th width="10%">Employee ID</th>
                                        <th width="15%">Employee Name</th>
                                        <th width="12%">Department</th>
                                        <th width="12%">Designation</th>
                                        <th width="6%">Category</th>
                                        <th class="text-center" width="10%">Date</th>
                                        <th width="10%">Start Punch</th>
                                        <th width="10%">End Punch</th>
                                        <th class="text-center" width="5%">Attn Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $key => $data)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $data->short_name }}</td>
                                            <td>{{ str_pad($data->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $data->name }}</td>
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
                @elseif($title == 3)
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">SL</th>
                                        <th class="text-center" width="10%">Org</th>
                                        <th width="10%">Section Name</th>
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
                                            <td class="text-center text-success fw-bold">{{ $present }}</td>
                                            <td class="text-center text-danger fw-bold">{{ $absent }}</td>
                                            <td class="text-center text-warning fw-bold">{{ $leave }}</td>
                                            <td class="text-center">{{ number_format($presentPercentage, 2) }}</td>
                                            <td class="text-center">{{ $otHours }}</td>
                                            <td></td>
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
                            </table>
                        </div>
                    </div>
                @elseif($title == 5)
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">SL</th>
                                        <th class="text-center" width="10%">Organization</th>
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
            'paging': false,
            'searching': false,
            'ordering': false,
            'dom': 'Bfrtip',
            'buttons': [{
                'extend': 'excelHtml5',
                'title': 'Employee Listing',
                'filename': 'Employee Listing',
                'className': 'btn btn-info btn-sm'
            }]
        });
    </script>
@endpush
