
@extends('hris::components.layouts.pdf')
@section('title', 'Movement Pass Report')
@php
    $reportTitle = match ($title) {
        1 => 'Department-wise Listing of Employees',
        2 => 'Designation-wise Listing of Employees',
        3 => 'Employees Joined Within Date Range',
        4 => 'Employees With Blood Group',
        5 => 'Employees Joining Report',
        6 => 'Employees Resignation Report',
        7 => 'Employees Long Absence Report',
        default => 'Employee Listing Report',
    };

    $reportSubTitle = in_array($title, [1,2])
        ? null
        : (in_array($title, [3,5,6,7])
            ? "Date Range: {$start_date} To {$end_date}"
            : null);
@endphp
<style>
    .page-break {
        page-break-after: always;
    }

    @media print {
        .page-break {
            page-break-after: always;
        }
    }
</style>
@section('content')
    @if($title == 1 || $title == 3 || $title == 4)
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    {{-- <th>Department</th> --}}
                    <th>Designation</th>
                    <th>Category</th>
                    @if($title == 4)
                    <th>Blood Group</th>
                    @endif
                    <th>Joining Date</th>
                    <th>District</th>
                    <th>Gross Salary</th>
                    <th>Basic Salary</th>
                </tr>
            </thead>
            <tbody>
                    {{--  <tbody>
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
                        </tbody> --}}
                @foreach($uniqueDepartments as $departmentId => $department)
                    <tr style="height: 40px; font-weight: bold; --bs-table-bg:#babcd8 !important;">
                        <td></td>
                        <td style="text-align: center; color: #5156be;">{!! $department->department !!}</td>
                        <td></td>
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
                            <td>{{ str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $employee->name }}</td>
                            {{-- <td>{{ $employee->department->department }}</td> --}}
                            <td>{{ $employee->designation->designation }}</td>
                            <td>@if($employee->designation->category_code == 'O') Officer @elseif($employee->designation->category_code == 'M') Manager @elseif($employee->designation->category_code == 'S') Staff @elseif($employee->designation->category_code == 'W') Worker @endif</td>
                            @if($title == 4)
                            <td>{{ $employee->employeePersonal->blood_group ?? 'N/A' }}</td>
                            @endif
                            <td>{{ date('d-m-Y', strtotime($employee->joining_date)) }}</td>
                            <td>{{ $employee->mdistrict->name ?? 'N/A' }}</td>
                            <td>{{ $employee->employeeSalary->gross_salary ?? 'N/A' }}</td>
                            <td>{{ $employee->employeeSalary->basic ?? 'N/A' }}</td>
                        </tr>
                        <?php $sl1++; ?>
                    @endif
                    @endforeach
                @endforeach
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
                                <td>{{ $employee?->department?->department ?? '' }}</td>
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
    @elseif($title == 5 || $title == 6 || $title == 7)
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Designation</th>
                    <th>Category</th>
                    <th>Joining Date</th>
                    <th>
                        {{ $title == 5 ? "Birth Date" : "Leaving Date" }}
                    </th>
                    <th>Gross Salary</th>
                </tr>
            </thead>
            <tbody>
                @if($employees->count() > 0)
                    @foreach ($uniqueSection as $section)
                        @php
                            $uniqueDepartment = $employees
                                ->filter(function ($emp) use ($section) {
                                    $parentId = optional(optional($emp->department)->parentDepartment)->id;
                                    return $parentId == $section['parent_department_id'];
                                })
                                ->groupBy('department_id')
                                ->map(function ($group) {
                                    return [
                                        'id' => $group->first()->department_id,
                                        'name' => optional($group->first()->department)->department,
                                    ];
                                })
                                ->values();
                            $depTotal = 0;
                        @endphp

                        @foreach ($uniqueDepartment as $department)
                            @php
                                $datas = $employees
                                    ->filter(fn($emp) =>
                                        $parentId = optional(optional($emp->department)->parentDepartment)->id == $section['parent_department_id'] &&
                                        $emp->department_id == $department['id']
                                    )
                                    ->values();
                            @endphp
                            <tr>
                                <td colspan="8" style="background-color: #a5abf5;">
                                    <span style="font-weight: bold;">Department</span> : {{ $section['parent_department_name']  }} &nbsp;&nbsp;
                                    <span style="font-weight: bold;">Section</span> : {{ $department['name'] }}
                                </td>
                            </tr>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ str_pad($data->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->designation->designation }}</td>
                                    <td>@if($data->designation->category_code == 'O') Officer @elseif($data->designation->category_code == 'M') Manager @elseif($data->designation->category_code == 'S') Staff @elseif($data->designation->category_code == 'W') Worker @endif</td>
                                    <td>{{ date('d-m-Y', strtotime($data->joining_date)) }}</td>
                                    <td>{{ $title == 5 ? '' : date('d-m-Y', strtotime($data->leaving_date)) }}</td>
                                    <td>{{ $data->employeeSalary->gross_salary }}</td>
                                </tr>
                                <?php $depTotal++; ?>
                            @endforeach
                            <tr>
                                <td colspan="8" style="background-color: #f3ba1c;">
                                    <span style="font-weight: bold;">Section Wise Summary => Section {{ $department['name'] }} : Total Employees</span> : {{ $datas->count() }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="8" style="background-color: #f7b1f7;">
                                <span style="font-weight: bold;">Department Wise Summary => Department {{ $section['parent_department_name'] }} : Total Employees</span> : {{ $depTotal }}
                            </td>
                        </tr>
                        <tr class="page-break">
                            <td colspan="8"></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" style="text-align: center; vertical-align: middle;color:#FF6C37">No Data Found <br> <small>Try to change the date range or filter</small></td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" style="text-align: left;  vertical-align: middle;color:#FFFFFF; background-color: #090c3f;">Overall Summary Total Employees : {{ $employees->count() }}</td>
                </tr>
            </tfoot>
        </table>
    @endif
@endsection
