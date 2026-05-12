@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee Listing',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Report', 'url' => route('hris.index')],
                    ['label' => 'Employee Listing', 'url' => route('hris.report.employee-listings.index')],
                ],
            ])
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    @if($title == 1)
                        <h6 class="my-0 text-primary text-center">Department-wise Distribution of Employees</h6>
                    @elseif($title == 2)
                        <h6 class="my-0 text-primary text-center">Designation-wise Distribution of Employees</h6>
                    @elseif($title == 3)
                        <h6 class="my-0 text-primary text-center">Department-wise Attendance Summary</h6>
                    @elseif($title == 4)
                        <h6 class="my-0 text-primary text-center">Designation-wise Attendance Summary</h6>
                    @endif
                    <p class="ms-auto text-center">Date: {{ now()->format('Y-m-d') }}</p>
                </div>
                @if($title == 1)
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
                               
                                @foreach($uniqueDepartments as $department)
                                  <?php $deptEmployeeCount = $employees->where('department_id', $department->id)->count(); ?>
                                    <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                        <td></td>
                                        <td style="text-align: center; color: #5156be;">{!! $department->department !!}, Number of Employees - {!!  $deptEmployeeCount !!}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php $sl1 = 1; ?>
                                    @foreach ($employees as $employee)
                                    @if($employee->department_id == $department->id)
                                        <tr>
                                            <td>{{ $sl1 }}</td>
                                            <td>{{ str_pad($employee->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->department->department  ?? 'N/A' }}</td>
                                            <td>{{ $employee->designation->designation ?? 'N/A' }}</td>
                                            {{-- <td>@if($employee->designation->category_code == 'O') Officer @elseif($employee->designation->category_code == 'M') Manager @elseif($employee->designation->category_code == 'S') Staff @elseif($employee->designation->category_code == 'W') Worker @endif</td> --}}
                                            <td>
                                                @php
                                                    $categoryMap = ['O' => 'Officer', 'M' => 'Manager', 'S' => 'Staff', 'W' => 'Worker'];
                                                    $code = $employee->designation?->category_code;
                                                @endphp
                                                {{ $categoryMap[$code] ?? 'N/A' }}
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($employee->joining_date)) }}</td>
                                            <td>{{ $employee->mdistrict->name ?? 'N/A' }}</td>
                                        </tr>
                                        <?php $sl1++; ?>
                                    @endif
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
                                <?php $deptEmployeeCount = $employees->where('designation_id', $designation->id)->count(); ?>
                                    <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                                        <td></td>
                                        <td style="text-align: center; color: #5156be;">{!! $designation->designation !!}, Number of Employees - {!!  $deptEmployeeCount !!}</td>
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
                                            <td>{{ str_pad($employee->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->department->department }}</td>
                                            <td>{{ $employee->designation->designation }}</td>
                                            <td>@if($employee->designation->category_code == 'O') Officer @elseif($employee->designation->category_code == 'M') Manager @elseif($employee->designation->category_code == 'S') Staff @elseif($employee->designation->category_code == 'W') Worker @endif</td>
                                            <td>{{ date('d-m-Y', strtotime($employee->joining_date)) }}</td>
                                            <td>{{ $employee->mdistrict->name ?? 'N/A' }}</td>
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
                                        <td>{{ str_pad($employee->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->department->department }}</td>
                                        <td>{{ $employee->designation->designation }}</td>
                                        <td>@if($employee->designation->category_code == 'O') Officer @elseif($employee->designation->category_code == 'M') Manager @elseif($employee->designation->category_code == 'S') Staff @elseif($employee->designation->category_code == 'W') Worker @endif</td>
                                        <td>{{ date('d-m-Y', strtotime($employee->joining_date)) }}</td>
                                        <td>{{ $employee->mdistrict->name ?? 'N/A' }}</td>
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
                                        <td>{{ str_pad($employee->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->department->department }}</td>
                                        <td>{{ $employee->designation->designation }}</td>
                                        <td>@if($employee->designation->category_code == 'O') Officer @elseif($employee->designation->category_code == 'M') Manager @elseif($employee->designation->category_code == 'S') Staff @elseif($employee->designation->category_code == 'W') Worker @endif</td>
                                        <td>{{ $employee->employeePersonal->blood_group }}</td>
                                        <td>{{ $employee->mdistrict->name ?? 'N/A' }}</td>
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
