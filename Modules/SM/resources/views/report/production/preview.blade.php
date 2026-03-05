@extends('layouts.app')
@section('title', 'Sample Production Report')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Sample Production Report',
                'subtitle' => 'Preview',
                'breadcrumbs' => [
                    ['label' => 'Sample Production Report', 'url' => route('sms.report.sample_production')],
                    ['label' => 'Preview', 'url' => route('sms.report.production.preview')],
                ],
            ])
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    @if($title == 1)
                        <h6 class="my-0 text-primary text-center">Daily Production Report</h6>
                    @else
                        <h6 class="my-0 text-primary text-center">Employees With Blood Group</h6>
                    @endif
                    <p class="ms-auto text-center">Date: {{ now()->format('Y-m-d') }}</p>
                </div>
                @if($title == 1)
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sampleProductions as $employee)
                                    <tr>
                                        <td>{{ $employee->id }}</td>
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                @else
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
                                    <th>Blood Group</th>
                                    <th>District</th>
                                </tr>
                            </thead>
                            <tbody>
                                
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
