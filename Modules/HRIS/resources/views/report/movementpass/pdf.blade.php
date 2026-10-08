
@extends('hris::components.layouts.pdf')
@section('title', 'Movement Pass Report')
@php
    $reportTitle = match ($title) {
        1 => 'Department-wise Monthly Movement Pass',
        2 => 'Designation-wise Monthly Movement Pass',
        3 => 'Department-wise Daily Movement Pass',
        4 => 'Designation-wise Daily Movement Pass',
        default => 'Movement Pass Report',
    };

    $reportSubTitle = in_array($title, [1, 2])
        ? 'Month: ' . ($months[$month] ?? '')
        : (in_array($title, [3, 4])
            ? 'Date Range: ' . date('d-m-Y', strtotime($start_date)) . ' To ' . date('d-m-Y', strtotime($end_date))
            : null);
@endphp
@section('content')
    @if($title == 1 || $title == 2 || $title == 3 || $title == 4)
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Date</th>
                    <th>Out Time | Actual</th>
                    <th>In Time | Actual</th>
                    <th>Duration</th>
                    <th>Purpose</th>
                    <th>Reason</th>
                    <th>Approved By</th>
                </tr>
            </thead>
            <tbody>
                @if(count($datas) > 0)
                    @foreach ($datas as $key => $data)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ str_pad($data->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $data->employee->name }}</td>
                            <td>{{ $data->department->department }}</td>
                            <td>{{ $data->designation->designation }}</td>
                            <td>{{ date('d-m-Y',strtotime($data->date)) }}</td>
                            <td style="padding: 3px 5px; vertical-align: middle; white-space: nowrap;">
                                {{ $data->start_time ? date('h:i A', strtotime($data->start_time)) : '-' }} |
                                <span style="{{ $data->start_time && $data->actual_out && strtotime($data->actual_out) < strtotime($data->start_time) ? 'color:#ff0000; font-weight:bold;' : '' }}">
                                    {{ $data->actual_out ? date('h:i A', strtotime($data->actual_out)) : '' }}
                                </span>
                            </td>
                            
                            <td style="padding: 3px 5px; vertical-align: middle; white-space: nowrap;">
                                {{ $data->end_time ? date('h:i A', strtotime($data->end_time)) : '-' }} |
                                <span style="{{ $data->end_time && $data->actual_in && strtotime($data->actual_in) > strtotime($data->end_time) ? 'color:#ff0000; font-weight:bold;' : '' }}">
                                    {{ $data->actual_in ? date('h:i A', strtotime($data->actual_in)) : '-' }}
                                </span>
                            </td>
                            <td>
                                @if($data->start_time && $data->end_time)
                                    {{ \Carbon\Carbon::parse($data->start_time)->diff(\Carbon\Carbon::parse($data->end_time))->format('%h:%I') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $data->purpose->purpose ?? '-' }}</td>
                            <td>{{ $data->reason->reason }}</td>
                            <td>{{ $data->approvedBy->name }}</td>
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
