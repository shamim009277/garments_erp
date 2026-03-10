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
                         <p class="ms-auto text-center">Date: {{ now()->format('Y-m-d') }}</p>
                    @else
                        <h6 class="my-0 text-primary text-center">Production Report ( Date Range )</h6>
                        <p class="ms-auto text-center">({{ $startDate }} to {{ $endDate }})</p>
                    @endif
                    
                </div>
                @if($title == 1)
                <div class="card-body">
                    <div style="overflow-x: auto;">
                        <table class="table table-bordered table-hover table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Programme ID</th>
                                    <th>Order ID</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Sample Type</th>
                                    <th>Production Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                               @php
                                $sl = 1;
                               @endphp
                                @foreach ($sampleProductions as $employee)

                                
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ @$employee->programme->programme_code }}</td>
                                        <td>{{ @$employee->initialOrder->order_code }}</td>
                                        <td>{{ @$employee->color->color_name }}</td>
                                        <td>{{ @$employee->size->size_name }}</td>
                                        <td>{{ @$employee->sampleType->sample_type_name }}</td>
                                        <td>{{ @$employee->production_quantity }}</td>
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
                                    <th>Programme ID</th>
                                    <th>Order ID</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Sample Type</th>
                                    <th>Production Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sl = 1;
                               @endphp
                                @foreach ($sampleProductions as $employee)

                                
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ @$employee->programme->programme_code }}</td>
                                        <td>{{ @$employee->initialOrder->order_code }}</td>
                                        <td>{{ @$employee->color->color_name }}</td>
                                        <td>{{ @$employee->size->size_name }}</td>
                                        <td>{{ @$employee->sampleType->sample_type_name }}</td>
                                        <td>{{ @$employee->production_quantity }}</td>
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
