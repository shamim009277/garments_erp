@extends('payroll::components.layouts.pdf')
@section('title', 'Absent Report')
<style>
    body {
        font-size: 11px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        page-break-inside: auto;
    }

    thead {
        display: table-header-group;
    }

    tr {
        page-break-inside: avoid;
        page-break-after: auto;
    }

    th, td {
        border: 1px solid #000;
        padding: 4px;
        vertical-align: middle;
    }

    .text-center {
        text-align: center;
    }

    .page-break {
        page-break-before: always;
    }
</style>
@php
    $reportTitle = match ($title) {
        '1' => 'Department-wise Daily Absent Report',
        '2' => 'Department-wise Absent Report (Date Range)',
        '3' => 'Department-wise Daily Absent (Abnormal)',
        '4' => 'Department-wise Absent (Abnormal) (Date Range)',
        default => '',
    };

    $reportSubTitle = in_array($title, [2,4])
    ? 'Start Date: ' . \Carbon\Carbon::parse($start_date)->format('d-m-Y') . ' End Date: ' . \Carbon\Carbon::parse($end_date)->format('d-m-Y')
    : (in_array($title, [1, 3,])
        ? 'Date: ' . \Carbon\Carbon::parse($date)->format('d-m-Y')
        : '');
@endphp

{{-- ================= CONTENT ================= --}}
@section('content')
    @if ($title == 1 || $title == 2)
        @if($uniqueDepartments->count() > 0)
            @foreach ($uniqueDepartments as $key => $department)
                <div class="{{ !$loop->first ? 'page-break' : '' }}">
                    <div style="font-size:12px; font-weight:bold; margin-bottom:5px; margin-top:-10px;">
                        Department: {{ $department }}
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Line</th>
                                <th class="text-center">Date</th>
                                <th>Start Punch</th>
                                <th>End Punch</th>
                                <th>Shift</th>
                                <th class="text-center">Attn Type</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $rows = collect($datas)->where('department_id', $key)->values();
                            @endphp
                            @foreach ($rows as $absent)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ str_pad($absent->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $absent->name }}</td>
                                    <td>{{ $absent->department }}</td>
                                    <td>{{ $absent->designation }}</td>
                                    <td class="text-center">{{ $absent->category_code }}</td>
                                    <td class="text-center">{{ $absent->line }}</td>
                                    <td class="text-center">{{ date('d-m-Y', strtotime($absent->work_date)) }}</td>
                                    <td>{{ $absent->start_punch ? date('d-m-Y H:i', strtotime($absent->start_punch)) : '0000-00-00 00:00' }}</td>
                                    <td>{{ $absent->end_punch ? date('d-m-Y H:i', strtotime($absent->end_punch)) : '0000-00-00 00:00' }}</td>
                                    <td>{{ $absent->shift }}</td>
                                    <td class="text-center">{{ $absent->attn_type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        @else
            <div class="text-center mt-5" style="font-size:12px; font-weight:bold; color:red; margin-top:20px;">
                No data available for this data combination.
            </div>
        @endif
    {{-- ===== OTHER TITLES PLACEHOLDER ===== --}}
    @endif
@endsection
