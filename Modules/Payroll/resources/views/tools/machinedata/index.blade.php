@extends('layouts.app')
@section('title', 'Payroll')
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
                'title' => 'Payroll',
                'subtitle' => 'Read Machine Data',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Tools', 'url' => route('payroll.index')],
                    ['label' => 'Read Machine Data', 'url' => route('payroll.tools.read-machinedata.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Read Machine Data
                </h4>
            </div>
        </div>
        <div class="col-lg-6 ps-lg-0" style="margin:0px auto;">
            <form action="{{ route('payroll.tools.read-machinedata.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card alert-primary alert-top-border">
                    <div class="card-header" style="padding: 15px 16px;">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Advance Process</h6>
                    </div>
                    <div class="card-body" style="overflow-y: auto;">
                        <div class="row">
                            <div class="col-md-8 mb-3" style="margin:0px auto;">
                                <table class="table table-sm" style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td width="40%">
                                                <input type="checkbox" name="all_department" id="all_department">
                                                <label class="m-0" for="all_department">Text File</label>
                                            </td>
                                            <td width="60%" id="all_department_section">
                                                <x-text-input name="file" id="file" accept=".txt" class="form-control-sm" type="file" autocomplete="off" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <label class="m-0" for="user_id">Start date</label>
                                            </td>
                                            <td width="60%" id="user_section">
                                                <x-text-input name="start_date" id="start_date" class="form-control-sm" type="date" autocomplete="off" placeholder="Start Date" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <label class="m-0" for="category_id">End Date</label>
                                            </td>
                                            <td width="60%" id="category_section">
                                                <x-input-group name="end_date" id="end_date" class="form-control-sm" type="date" autocomplete="off" placeholder="End Date" required />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding:15px 16px;">
                        <x-primary-button id="submitBtn" class="btn-sm submitBtn float-end" type="submit">Start Process</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
