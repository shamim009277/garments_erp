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
                'subtitle' => 'Process Attendence',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Tools', 'url' => route('payroll.index')],
                    ['label' => 'Process Attendence', 'url' => route('payroll.tools.process-attendence.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Process Attendence
                </h4>
            </div>
        </div>
        <div class="col-lg-6 ps-lg-0" style="margin:0px auto;">
            <form action="{{ route('payroll.tools.process-attendence.store') }}" id="applicantForm" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border">
                    <div class="card-header" style="padding: 15px 16px;">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Process Attendence</h6>
                    </div>
                    <div class="card-body" style="overflow-y: auto;">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="title" value="1" id="title1" checked>
                                    <label class="form-check-label" for="title1">Pre Process Attendence</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="title" value="2" id="title2">
                                    <label class="form-check-label" for="title2">Undo / Revert Process Attendence</label>
                                </div><br>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="title" value="3" id="title3">
                                    <label class="form-check-label" for="title1">Process Attendence</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="title" value="4" id="title4">
                                    <label class="form-check-label" for="title2">Undo / Revert Process Attendence</label>
                                </div>
                            </div><br><br>

                            <div class="col-md-4 mb-3">
                                <x-select-input name="org_id" id="org_id" class="select2" :options="$organizations" :selected="old('org_id', '1')" placeholder="Select Organization" required />
                                <x-input-group type="date" name="date" value="{{ $date }}" class="form-control-sm"/>
                                <x-select-input name="month" id="month" class="select2" :options="['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December']" :selected="$month" placeholder="Select Month" required />
                                <x-select-input name="year" id="year" class="select2" :options="$yearlist" :selected="date('Y')" placeholder="Select Year" required />
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
