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
                        <th class="text-center" width="4%" style="text-align: center;">SL</th>
                        <th width="8%" style="text-align: center;">Emp ID</th>
                        <th width="18%">Employee Name</th>
                        <th width="12%">Department</th>
                        <th width="14%">Designation</th>
                        <th width="6%">Category</th>
                        <th class="text-center" width="9%" style="text-align: center;">Date</th>
                        <th width="9%" style="text-align: center;">Start Punch</th>
                        <th width="9%" style="text-align: center;">End Punch</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($departmentDatas) > 0)
                        @foreach($departmentDatas as $key => $data)
                            <tr>
                                <td class="text-center" style="text-align: center;">{{ ++$sl }}</td>
                                <td style="text-align: center;">{{ str_pad($data->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->department }}</td>
                                <td>{{ $data->designation }}</td>
                                <td class="text-center" style="text-align: center;">{{ $data->category_code }}</td>
                                <td class="text-center" style="text-align: center;">{{ date('d-m-Y', strtotime($data->work_date)) }}</td>
                                <td style="text-align: center;">{{ \Carbon\Carbon::parse($data->start_punch)->format('h:i A') }}</td>
                                <td style="text-align: center;">{{ \Carbon\Carbon::parse($data->end_punch)->format('h:i A') }}</td>
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
            @if($datas->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; text-align: center; font-weight: bold;">
                        <tr>
                            <td colspan="10" style="font-size: 11px; text-align: center;">
                                Employee Name: {{ $employee->name }} <br>
                                Employee ID: {{ str_pad($employee->employee_id, 8, '0', STR_PAD_LEFT) }} <br>
                                Designation: {{ $employee->designation }} <br>
                                Department: {{ $employee->department }} <br>
                                Line: {{ $employee->line }} <br>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                 <th class="text-center" width="4%" style="text-align: center;">SL</th>
                                <th width="8%" style="text-align: center;">Emp ID</th>
                                <th width="18%">Employee Name</th>
                                <th width="12%">Department</th>
                                <th width="14%">Designation</th>
                                <th width="6%">Category</th>
                                <th class="text-center" width="9%" style="text-align: center;">Date</th>
                                <th width="9%" style="text-align: center;">Start Punch</th>
                                <th width="9%" style="text-align: center;">End Punch</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key => $data)
                                <tr>
                                    <td class="text-center" style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td style="text-align: center;">{{ str_pad($data->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->department }}</td>
                                    <td>{{ $data->designation }}</td>
                                    <td style="text-align: center;">{{ $data->category_code }}</td>
                                    <td class="text-center" style="text-align: center;">{{ date('d-m-Y', strtotime($data->work_date)) }}</td>
                                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($data->start_punch)->format('h:i A') }}</td>
                                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($data->end_punch)->format('h:i A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center" style="font-size: 12px; color: #e70909; text-align: center; margin-top: 40px; font-style: italic;">No Data Found For This Input Date Range</p>
            @endif
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
                        <th width="5%" style="text-align: center;">EmpID</th>
                        <th width="15%">Employee Name</th>
                        <th width="12%">Department</th>
                        <th width="12%">Designation</th>
                        <th width="4%" style="text-align: center;">Category</th>
                        <th class="text-center" width="8%">Date</th>
                        <th width="10%">Start Punch</th>
                        <th width="10%">End Punch</th>
                        <th width="6%">Is Early</th>
                        <th width="6%">Late Min</th>
                        <th width="10%" style="text-align: center;">Atten Type</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($departmentDatas) > 0)
                        @foreach($departmentDatas as $key => $data)
                            <tr>
                                <td class="text-center">{{ ++$sl }}</td>
                                <td style="text-align: center;">{{ str_pad($data->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->department }}</td>
                                <td>{{ $data->designation }}</td>
                                <td class="text-center" style="text-align: center;">{{ $data->category_code }}</td>
                                <td class="text-center" style="text-align: center;">{{ date('d-m-Y', strtotime($data->work_date)) }}</td>
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
                        <th width="5%" style="text-align: center;">EmpID</th>
                        <th width="15%">Employee Name</th>
                        <th width="12%">Department</th>
                        <th width="12%">Designation</th>
                        <th width="4%" style="text-align: center;">Category</th>
                        <th class="text-center" width="8%">Date</th>
                        <th width="10%">Start Punch</th>
                        <th width="10%">End Punch</th>
                        <th width="6%">Is Early</th>
                        <th width="6%">Late Min</th>
                        <th width="10%" style="text-align: center;">Atten Type</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($departmentDatas) > 0)
                        @foreach($departmentDatas as $key => $data)
                            <tr>
                                <td class="text-center">{{ ++$sl }}</td>
                                <td style="text-align: center;">{{ str_pad($data->employee_id, 8, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->department }}</td>
                                <td>{{ $data->designation }}</td>
                                <td class="text-center" style="text-align: center;">{{ $data->category_code }}</td>
                                <td class="text-center">{{ date('d-m-Y', strtotime($data->work_date)) }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->start_punch)->format('h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->end_punch)->format('h:i A') }}</td>
                                <td>{{ $data->is_early_leave }}</td>
                                <td>{{ $data->early_minutes }}</td>
                                <td class="text-center" style="text-align: center;">{{ $data->attn_type }}</td>
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
