@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Applicant Report',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Report', 'url' => route('hris.index')],
                    ['label' => 'Applicant Report', 'url' => route('hris.report.applicant-report.index')],
                ],
            ])
        </div>
        <div class="col-lg-12 pr-0">
            @if(isset($message))
                <div style="text-align:center; padding:50px; font-size:20px; color:red; font-weight:bold;">
                    {{ $message }}
                </div>
            @endif
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
