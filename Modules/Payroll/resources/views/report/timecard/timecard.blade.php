@extends('payroll::components.layouts.cardpdf')
@section('title', 'Time Card')
{{-- ================= CONTENT ================= --}}
@section('content')
    @foreach ($uniqueEmployee as $emp)
        @php
            $employeeRecords = collect($datas)->where('employee_id', $emp);
            $employee = $employeeRecords->first();
            // Pre-calculate counts once
            $presentCount = $employeeRecords->where('attn_type', 'PR')->count();
            $absentCount = $employeeRecords->where('attn_type', 'AB')->count();
            $holidayCount = $employeeRecords->where('attn_type', 'HD')->count();
            $casualCount = $employeeRecords->where('attn_type', 'CL')->count();
            $sickCount = $employeeRecords->where('attn_type', 'SL')->count();
            $earnCount = $employeeRecords->where('attn_type', 'EL')->count();
            $specialCount = $employeeRecords->where('attn_type', 'SP')->count();
            $lwopCount = $employeeRecords->where('attn_type', 'LWOP')->count();

            // Pre-calculate sums once
            $rwhSum = $employeeRecords->sum('rwh');
            $wwhSum = $employeeRecords->sum('wwh');
            $othSum = $employeeRecords->sum('ot_hours');
            $lateSum = $employeeRecords->sum('late_minutes');
        @endphp
        <!-- PDF Body -->
        @if ($title == 1)
            <p class="title">Time Card</p>
            <hr>
            <!-- Employee Info -->
            <table class="info-table">
                <tr>
                    <td><strong>Employee ID:</strong> {{ str_pad($employee->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                    <td><strong>Organization:</strong> {{ $employee->short_name }}</td>
                    <td><strong>Time Period:</strong> {{ $monthName }} {{ $year }}</td>
                </tr>
                <tr>
                    <td><strong>Name:</strong> {{ $employee->name }}</td>
                    <td><strong>Designation:</strong> {{ $employee->designation }}</td>
                    <td><strong>Joining Date:</strong> {{ date('d-m-Y', strtotime($employee->joining_date)) }}</td>
                </tr>
                <tr>
                    <td><strong>Department:</strong> {{ $employee->department }}</td>
                    <td><strong>Section:</strong> {{ $employee->section }}</td>
                    <td><strong>Line:</strong> {{ $employee->line }}</td>
                </tr>
            </table>
            <hr>

            <!-- Main Table -->
            <table>
                <thead>
                    <tr>
                        <th>Work Date</th>
                        <th>Week Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th style="text-align:center;">OTH</th>
                        <th style="text-align:center;">Shift</th>
                        <th style="text-align:center;">Is Late</th>
                        <th style="text-align:center;">Late Min</th>
                        <th style="text-align:center;">Attn Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employeeRecords as $record)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($record->work_date)) }}</td>
                            <td style="text-align:center; {{ $record->attn_type === 'HD' ? 'color:red;font-weight:700;' : '' }}">
                                {{ \Carbon\Carbon::parse($record->work_date)->format('l') }}
                            </td>
                            <td>{{ $record->start_punch ? \Carbon\Carbon::parse($record->start_punch)->format('h:i A') : '-' }}</td>
                            <td>{{ $record->end_punch ? \Carbon\Carbon::parse($record->end_punch)->format('h:i A') : '-' }}</td>
                            <td style="text-align:center;">{{ $record->ot_hours ?? '-' }}</td>
                            <td style="text-align:center;">{{ $record->shift ?? '-' }}</td>
                            <td style="text-align:center;">{{ $record->is_late }}</td>
                            <td style="text-align:center;">{{ $record->late_minutes }}</td>

                            {{-- Attn Type --}}
                            <td style="text-align:center; {{ $record->attn_type === 'HD' ? 'color:red;font-weight:700;' : '' }}">
                                {{ $record->attn_type }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="summary-header">Total</td>
                        <td class="summary-header"></td>
                        <td class="summary-header"></td>
                        <td class="summary-header">{{ $othSum }}</td>
                        <td class="summary-header"></td>
                        <td class="summary-header"></td>
                        <td class="summary-header">{{ $lateSum }}</td>
                        <td class="summary-header"></td>
                    </tr>
                </tfoot>
            </table>
            <hr>

            <!-- Summary Table -->
            <table class="summary-table">
                <tr>
                    <td colspan="2" class="summary-header">Time Card Summary</td>
                </tr>
                <tr>
                    <td>Present</td>
                    <td style="text-align:right;">{{ $presentCount }}</td>
                </tr>
                <tr>
                    <td>Absent</td>
                    <td style="text-align:right;">{{ $absentCount }}</td>
                </tr>
                <tr>
                    <td>Holiday</td>
                    <td style="text-align:right;">{{ $holidayCount }}</td>
                </tr>
                <tr>
                    <td>Casual Leave</td>
                    <td style="text-align:right;">{{ $casualCount }}</td>
                </tr>
                <tr>
                    <td>Sick Leave</td>
                    <td style="text-align:right;">{{ $sickCount }}</td>
                </tr>
                <tr>
                    <td>Earn Leave</td>
                    <td style="text-align:right;">{{ $earnCount }}</td>
                </tr>
                @if($specialCount > 0)
                <tr>
                    <td>Special Leave</td>
                    <td style="text-align:right;">{{ $specialCount }}</td>
                </tr>
                @endif
                @if($lwopCount > 0)
                    <tr>
                        <td>Leave Without Pay</td>
                        <td style="text-align:right;">{{ $lwopCount }}</td>
                    </tr>
                @endif
            </table>

            <table class="signature-section">
                <tr>
                    <td>
                            Prepared By <br><br>
                            <strong>{{ auth()->user()->name }}</strong><br><br>
                            <strong>ID : {{ str_pad(auth()->user()->employee_id, 8, '0', STR_PAD_LEFT) }}</strong>
                        <br>--------------------
                    </td>
                    <td>Checked By<br>--------------------</td>
                    <td>Approved By<br>--------------------</td>
                </tr>
            </table>
            @if(!$loop->last)
                <div style="page-break-after: always;"></div>
            @endif
        @endif
    @endforeach
@endsection
