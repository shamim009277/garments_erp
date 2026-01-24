@extends('layouts.app')
@section('title', 'Payroll')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Payroll',
                'subtitle' => 'Overtime',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Report', 'url' => route('payroll.index')],
                    ['label' => 'Overtime', 'url' => route('payroll.report.overtime-report.index')],
                ],
            ])
        </div>
        <div class="col-lg-12 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    @if ($title == 1)
                        <h6 class="my-0 text-primary text-center">Department-wise Daily Punch</h6>
                        <p class="ms-auto text-center">Date: </p>
                    @endif
                </div>
                @if ($title == 1)
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="4%">SL</th>
                                        <th class="text-center" width="6%">Org</th>
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
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

{{-- @push('scripts')
    <script>
        $('.table').DataTable({
            'paging': false,
            'searching': false,
            'ordering': false,
            'dom': 'Bfrtip',
            'buttons': [{
                'extend': 'excelHtml5',
                'title': 'Punch Report',
                'filename': 'Punch Report',
                'className': 'btn btn-info btn-sm'
            }]
        });
    </script>
@endpush --}}
