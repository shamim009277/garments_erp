@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Shifting Report',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Report', 'url' => route('hris.index')],
                    ['label' => 'Shifting Report', 'url' => route('hris.report.shifting-report.index')],
                ],
            ])
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    @if($title == 1)
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Shift</h6>
                        <p class="ms-auto text-center">Date Range: {{ $startDate }} To {{ $endDate }}</p>
                    @elseif($title == 2)
                        <h6 class="my-0 text-primary text-center">Designation-wise Daily Shift</h6>
                        <p class="ms-auto text-center">Date Range: {{ $startDate }} To {{ $endDate }}</p>
                    @elseif($title == 3)
                        <h6 class="my-0 text-primary text-center">Department-wise Monthly Shift</h6>
                        <p class="ms-auto text-center">Month: {{ $months[$month] }} {{ $year }}</p>
                    @elseif($title == 4)
                        <h6 class="my-0 text-primary text-center">Designation-wise Monthly Shift</h6>
                        <p class="ms-auto text-center">Month: {{ $months[$month] }} {{ $year }}</p>
                    @endif
                </div>
                @if($title == 1 || $title == 2 || $title == 3 || $title == 4)
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
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
                                @foreach ($shifts as $shift)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $shift->employeeBasic->organization->short_name }}</td>
                                        <td class="text-center">{{ str_pad($shift->employee_id, 6, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $shift->employeeBasic->name }}</td>
                                        <td>{{ $shift->employeeBasic->department->department }}</td>
                                        <td>{{ $shift->employeeBasic->designation->designation??'' }}</td>
                                        <td class="text-center">{{ $shift->employeeBasic->designation->category_code??'' }}</td>
                                        <td class="text-center">{{ date('d-m-Y',strtotime($shift->date)) }}</td>
                                        <td class="text-center">{{ $shift->shift }}</td>
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
                'title': 'Employee Listing',
                'filename': 'Employee Listing',
                'className': 'btn btn-info btn-sm'
            }
        ]
    });
</script>
@endpush
