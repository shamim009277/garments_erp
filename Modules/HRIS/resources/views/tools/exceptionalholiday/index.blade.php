@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
@push('styles')
<style>
.table, tr, th, td {
    border: none !important;
    border-collapse: collapse;
}
</style>
@endpush
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Exceptional Holiday',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Tools', 'url' => route('hris.index')],
                    ['label' => 'Exceptional Holiday', 'url' => route('hris.tools.exceptional-holidays.index')],
                ],
            ])
        </div>
        <div class="col-lg-6 ps-lg-0" style="margin:0px auto;">
            <form action="{{ route('hris.tools.exceptional-holidays.store') }}" id="applicantForm" method="POST">
                @csrf
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Generate Exceptional Holiday</h6>
                </div>
                <div class="card border">
                    <div class="card-body" style="overflow-y: auto;">
                        <x-text-input name="year" class="form-control" type="text" value="{{ date('Y') }}" required readonly />
                    </div>
                </div>
                <div class="card-footer" style="padding:15px 16px;">
                    <x-primary-button id="submitBtn" class="btn-sm submitBtn float-end" type="submit">Generate</x-primary-button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>

</script>
@endpush
