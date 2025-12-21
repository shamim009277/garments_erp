
@extends('hris::components.layouts.pdf')
@section('title', 'Movement Pass Report')
@php
    $reportTitle = match ($title) {
        1 => 'Department-wise Listing of Employees',
        2 => 'Designation-wise Listing of Employees',
        3 => 'Employees Joined Within Date Range',
        4 => 'Employees With Blood Group',
        default => 'Employee Listing Report',
    };

    $reportSubTitle = in_array($title, [1,2])
        ? null
        : (in_array($title, [3])
            ? "Date Range: {$start_date} To {$end_date}"
            : null);
@endphp
@section('content')
    @if($title == 1 || $title == 3 || $title == 4)
        <table style="width: 100%;">
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
                @if(count($employees) > 0)
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->department->department }}</td>
                            <td>{{ $employee->designation->designation }}</td>
                            <td>@if($employee->designation->category_code == 'O') Officer @elseif($employee->designation->category_code == 'M') Manager @elseif($employee->designation->category_code == 'S') Staff @elseif($employee->designation->category_code == 'W') Worker @endif</td>
                            <td>{{ date('d-m-Y', strtotime($employee->joining_date)) }}</td>
                            <td>{{ $employee->mdistrict->name ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="12" style="text-align: center; vertical-align: middle;color:#FF6C37">No Data Found <br> <small>Try to change the date range or filter</small></td>
                    </tr>
                @endif
            </tbody>
        </table>
    @elseif($title == 2)
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
                        <td colspan="8" style="text-align: center; color: #5156be;">{!! $designation->designation !!}</td>
                    </tr>
                    <?php $sl1 = 1; ?>
                    @foreach ($employees as $employee)
                    @if($employee->designation_id == $designation->id)
                        <tr>
                            <td>{{ $sl1 }}</td>
                            <td>{{ str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
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
    @endif
@endsection
