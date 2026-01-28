@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    @push('styles')
        <style>
            .table,
            tr,
            th,
            td {
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
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    Exceptional Holiday
                </h4>
            </div>
        </div>
        <div class="col-lg-6 ps-lg-0" style="margin:0px auto;">
            <form action="{{ route('hris.tools.exceptional-holidays.store') }}" id="applicantForm" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border">
                    <div class="card-header" style="padding: 15px 16px;">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Generate
                            Exceptional Holiday</h6>
                    </div>
                    <div class="card-body" style="overflow-y: auto;">
                        <x-select-input name="organization_id" id="organization_id" class="select2" :options="$organizations"
                            :selected="selected_org($organizations)" placeholder="Select Organization" />

                        <x-text-input name="year" class="form-control form-control-sm mt-2" type="text"
                            value="{{ date('Y') }}" required readonly />
                    </div>
                    <div class="card-footer" style="padding:15px 16px;">
                        <button type="submit" name="action" value="generate" class="btn btn-primary btn-sm float-end"id="generateBtn">
                            <!-- icon -->
                            <i data-feather="plus" style="width: 16px; height: 16px;" class="me-1"></i>
                            <!-- button text -->
                            <span>Generate</span>
                        </button>

                        <button type="submit" name="action" value="generate_for_new" class="btn btn-secondary btn-sm float-end me-2">
                            <i data-feather="plus" style="width: 16px; height: 16px;" class="me-1"></i>
                            <span>Generate For New</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush
