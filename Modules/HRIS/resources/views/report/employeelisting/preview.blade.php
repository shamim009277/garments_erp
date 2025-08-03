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
                    @if($title == 1)
                        <h6 class="my-0 text-primary text-center">Department-wise Listing of Employees</h6>
                    @elseif($title == 2)
                        <h6 class="my-0 text-primary text-center">Designation-wise Listing of Employees</h6>
                    @elseif($title == 3)
                        <h6 class="my-0 text-primary text-center">Employees Joined Within Date Range</h6>
                    @elseif($title == 4)
                        <h6 class="my-0 text-primary text-center">Employees With Blood Group</h6>
                    @endif
                    <p class="ms-auto text-center">Date: {{ now()->format('Y-m-d') }}</p>
                </div>
                <div class="card-body">
                    <div style="overflow-x: auto;">
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
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->employee_id }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->department->department }}</td>
                                        <td>{{ $employee->designation->designation }}</td>
                                        <td>{{ $employee->designation->category_code }}</td>
                                        <td>{{ date('d-m-Y', strtotime($employee->joining_date)) }}</td>
                                        <td>{{ $employee->mdistrict->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
