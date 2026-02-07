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
                    @if ($title == 1)
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Absent Report</h6>
                        <p class="ms-auto text-center">Date: {{ date('d-m-Y', strtotime($date)) }}</p>
                    @elseif($title == 2)
                        <h6 class="my-0 text-primary text-center">Department-wise Absent Report (Date Range)</h6>
                        <p class="ms-auto text-center">Date Range: {{ date('d-m-Y', strtotime($start_date)) }} To {{ date('d-m-Y', strtotime($end_date)) }}</p>
                    @elseif($title == 3)
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Absent (Abnormal)</h6>
                        <p class="ms-auto text-center">Date: {{ date('d-m-Y', strtotime($date)) }}</p>
                    @elseif($title == 4)
                        <h6 class="my-0 text-primary text-center">Department-wise Absent (Abnormal) (Date Range)</h6>
                        <p class="ms-auto text-center">Date Range: {{ date('d-m-Y', strtotime($start_date)) }} To {{ date('d-m-Y', strtotime($end_date)) }}</p>
                    @endif

                </div>
                @if ($title == 1 || $title == 2)
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
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
                                            <td></td>
                                        </tr>
                                        @php
                                            $absents = collect($datas)->where('department_id', $key)->all();
                                        @endphp
                                        @foreach ($absents as $absent)
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
