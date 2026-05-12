
@extends('hris::components.layouts.pdf')
@section('title', 'Shifting Report')
@php
    $reportTitle = match ($title) {
        '1' => 'Department-wise Daily Shift',
        '2' => 'Designation-wise Daily Shift',
        '3' => 'Department-wise Monthly Shift',
        '4' => 'Designation-wise Monthly Shift',
    };

    $reportSubTitle = in_array($title, [3,4])
        ? 'Month: '.($months[$month]  ?? '')
        : (in_array($title, [1,2])
            ? "Date Range: {$startDate} To {$endDate}"
            : null);
@endphp
@section('content')
    @if($title == 1 || $title == 2 || $title == 3 || $title == 4)
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>SL</th>
                    <th class="text-center">Organization</th>
                    <th class="text-center">Employee ID</th>
                    <th>Employee Name</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Shift</th>
                </tr>
            </thead>
            <tbody>
                @if(count($shifts) > 0)
                    @foreach ($shifts as $shift)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center"></td>
                            <td class="text-center">{{ str_pad($shift->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $shift->employeeBasic->name }}</td>
                            <td>{{ $shift->employeeBasic->department->department }}</td>
                            <td>{{ $shift->employeeBasic->designation->designation?? '' }}</td>
                            <td class="text-center">{{ $shift->employeeBasic->designation->category_code?? '' }}</td>
                            <td class="text-center">{{ date('d-m-Y',strtotime($shift->date)) }}</td>
                            <td class="text-center">{{ $shift->shift }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="12" style="text-align: center; vertical-align: middle;color:#FF6C37">No Data Found <br> <small>Try to change the date range or filter</small></td>
                    </tr>
                @endif
            </tbody>
        </table>
    @endif
@endsection
