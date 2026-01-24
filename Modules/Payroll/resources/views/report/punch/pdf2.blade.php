@extends('payroll::components.layouts.pdf')
@section('title', 'Punch Report')
@php
    $reportTitle = match ($title) {
        '1' => 'Department-wise Daily Punch',
        '2' => 'Individual Card Wise Monthly Punch',
        '4' => 'Daily Late Arrival',
        '5' => 'Daily Early Departure',
        '6' => 'Daily Single Punch',
    };

    $reportSubTitle = in_array($title, [2])
        ? 'Month: '.($monthName . ' ' . $year  ?? '')
        : (in_array($title, [1,4,5,6])
            ? "Date: {$date}"
            : null);
@endphp
@section('content')
    @if($title == 1)
        @foreach($uniqueDepartments as $department)
            @php
                $departmentDatas = $datas->where('department', $department);
                $sl = 0;
            @endphp
            <div style="font-size: 12px; font-weight: bold; text-align: left;">Department: {{ $department }}</div>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center" width="4%">SL</th>
                        <th width="10%">Employee ID</th>
                        <th width="15%">Employee Name</th>
                        <th width="12%">Department</th>
                        <th width="12%">Designation</th>
                        <th width="6%">Category</th>
                        <th class="text-center" width="10%">Date</th>
                        <th width="10%">Start Punch</th>
                        <th width="10%">End Punch</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($departmentDatas) > 0)
                        @foreach($departmentDatas as $key => $data)
                            <tr>
                                <td class="text-center">{{ ++$sl }}</td>
                                <td>{{ str_pad($data->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->department }}</td>
                                <td>{{ $data->designation }}</td>
                                <td class="text-center">{{ $data->category_code }}</td>
                                <td class="text-center">{{ date('d-m-Y', strtotime($data->work_date)) }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->start_punch)->format('h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->end_punch)->format('h:i A') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center;" style="font-size: 12px; color: #e70909; text-align: center;">No Data Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <br>
        @endforeach
    @elseif($title == 2)
        <div class="card-body">
            <div style="overflow-x: auto;">
                <table style="width: 100%; text-align: center; font-weight: bold;">
                    <tr>
                        <td colspan="10" style="font-size: 11px; text-align: center;">
                            Employee Name: {{ $employee->name }} <br>
                            Employee ID: {{ str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT) }} <br>
                            Designation: {{ $employee->designation }} <br>
                            Department: {{ $employee->short_name }} <br>
                            Line: {{ $employee->line }} <br>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center" width="4%">SL</th>
                            <th class="text-center" width="6%">Org</th>
                            <th width="10%">Employee ID</th>
                            <th width="15%">Employee Name</th>
                            <th width="12%">Department</th>
                            <th width="12%">Designation</th>
                            <th class="text-center" width="6%">Category</th>
                            <th class="text-center" width="10%">Date</th>
                            <th width="10%">Start Punch</th>
                            <th width="10%">End Punch</th>
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
                                <td>{{ \Carbon\Carbon::parse($data->start_punch)->format('h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->end_punch)->format('h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif($title == 4)
       @foreach($uniqueDepartments as $department)
            @php
                $departmentDatas = $datas->where('department', $department);
                $sl = 0;
            @endphp
            <div style="font-size: 12px; font-weight: bold; text-align: left;">Department: {{ $department }}</div>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center" width="2%">SL</th>
                        <th width="5%">EmpID</th>
                        <th width="15%">Employee Name</th>
                        <th width="12%">Department</th>
                        <th width="12%">Designation</th>
                        <th width="4%">Category</th>
                        <th class="text-center" width="10%">Date</th>
                        <th width="10%">Start Punch</th>
                        <th width="10%">End Punch</th>
                        <th>Is Late</th>
                        <th>Late Minutes</th>
                        <th width="10%">Atten Type</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($departmentDatas) > 0)
                        @foreach($departmentDatas as $key => $data)
                            <tr>
                                <td class="text-center">{{ ++$sl }}</td>
                                <td>{{ str_pad($data->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->department }}</td>
                                <td>{{ $data->designation }}</td>
                                <td class="text-center">{{ $data->category_code }}</td>
                                <td class="text-center">{{ date('d-m-Y', strtotime($data->work_date)) }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->start_punch)->format('h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->end_punch)->format('h:i A') }}</td>
                                <td>{{ $data->is_late }}</td>
                                <td>{{ $data->late_minutes }}</td>
                                <td class="text-center">{{ $data->attn_type }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12" class="text-center;" style="font-size: 12px; color: #e70909; text-align: center;">No Data Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <br>
        @endforeach
    @elseif($title == 5)
       @foreach($uniqueDepartments as $department)
            @php
                $departmentDatas = $datas->where('department', $department);
                $sl = 0;
            @endphp
            <div style="font-size: 12px; font-weight: bold; text-align: left;">Department: {{ $department }}</div>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center" width="2%">SL</th>
                        <th width="5%">EmpID</th>
                        <th width="15%">Employee Name</th>
                        <th width="12%">Department</th>
                        <th width="12%">Designation</th>
                        <th width="4%">Category</th>
                        <th class="text-center" width="10%">Date</th>
                        <th width="10%">Start Punch</th>
                        <th width="10%">End Punch</th>
                        <th>Is Early</th>
                        <th>Late Minutes</th>
                        <th width="10%">Atten Type</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($departmentDatas) > 0)
                        @foreach($departmentDatas as $key => $data)
                            <tr>
                                <td class="text-center">{{ ++$sl }}</td>
                                <td>{{ str_pad($data->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->department }}</td>
                                <td>{{ $data->designation }}</td>
                                <td class="text-center">{{ $data->category_code }}</td>
                                <td class="text-center">{{ date('d-m-Y', strtotime($data->work_date)) }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->start_punch)->format('h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->end_punch)->format('h:i A') }}</td>
                                <td>{{ $data->is_early_leave }}</td>
                                <td>{{ $data->early_minutes }}</td>
                                <td class="text-center">{{ $data->attn_type }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12" class="text-center;" style="font-size: 12px; color: #e70909; text-align: center;">No Data Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <br>
        @endforeach
    @elseif($title == 6)
       @foreach($uniqueDepartments as $department)
            @php
                $departmentDatas = $datas->where('department', $department);
                $sl = 0;
            @endphp
            <div style="font-size: 12px; font-weight: bold; text-align: left;">Department: {{ $department }}</div>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center" width="2%">SL</th>
                        <th width="5%">EmpID</th>
                        <th width="15%">Employee Name</th>
                        <th width="12%">Department</th>
                        <th width="12%">Designation</th>
                        <th width="4%">Category</th>
                        <th class="text-center" width="10%">Date</th>
                        <th>Start Punch</th>
                        <th>End Punch</th>  
                        <th>Atten Type</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($departmentDatas) > 0)
                        @foreach($departmentDatas as $key => $data)
                            <tr>
                                <td class="text-center">{{ ++$sl }}</td>
                                <td>{{ str_pad($data->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->department }}</td>
                                <td>{{ $data->designation }}</td>
                                <td style="text-align: center;">{{ $data->category_code }}</td>
                                <td class="text-center">{{ date('d-m-Y', strtotime($data->work_date)) }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->start_punch)->format('h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->end_punch)->format('h:i A') }}</td>
                                <td style="text-align: center;">{{ $data->attn_type }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center;" style="font-size: 12px; color: #e70909; text-align: center;">No Data Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <br>
        @endforeach
    @endif
@endsection