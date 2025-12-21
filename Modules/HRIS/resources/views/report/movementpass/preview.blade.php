@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee Movement Pass',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Report', 'url' => route('hris.index')],
                    ['label' => 'Employee Movement Pass', 'url' => route('hris.report.movement-pass.index')],
                ],
            ])
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    @if($title == 1)
                        <h6 class="my-0 text-primary text-center">Department-wise Monthly Movement Pass</h6>
                        <p class="ms-auto text-center">Month: {{ $months[$month] }}</p>
                    @elseif($title == 2)
                        <h6 class="my-0 text-primary text-center">Designation-wise Monthly Movement Pass</h6>
                        <p class="ms-auto text-center">Month: {{ $months[$month] }}</p>
                    @elseif($title == 3)
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Movement Pass</h6>
                        <p class="ms-auto text-center">Date Range: {{ $start_date }} To {{ $end_date }}</p>
                    @elseif($title == 4)
                        <h6 class="my-0 text-primary text-center">Designation-wise Daily Movement Pass</h6>
                        <p class="ms-auto text-center">Date Range: {{ $start_date }} To {{ $end_date }}</p>
                    @endif
                </div>

                @if($title == 1 || $title == 2 || $title == 3 || $title == 4)
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
                                        <th>Date</th>
                                        <th>In Time</th>
                                        <th>Out Time</th>
                                        <th>Duration</th>
                                        <th>Purpose</th>
                                        <th>Reason</th>
                                        <th>Approved By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($datas as $key => $data)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ str_pad($data->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $data->employee->name }}</td>
                                            <td>{{ $data->department->department }}</td>
                                            <td>{{ $data->designation->designation }}</td>
                                            <td>{{ $data->date }}</td>
                                            <td>{{ date('h:i A', strtotime($data->start_time)) }}</td>
                                            <td>{{ date('h:i A', strtotime($data->end_time)) }}</td>

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
                'title': 'Employee Movement Pass Report',
                'filename': 'Employee_Movement_Pass_Report',
                'className': 'btn btn-info btn-sm'
            }
        ]
    });
</script>
@endpush
