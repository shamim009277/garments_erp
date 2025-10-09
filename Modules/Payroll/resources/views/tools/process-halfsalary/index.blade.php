@extends('layouts.app')
@section('title', 'Payroll')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'Payroll',
                'subtitle' => 'Process Half Salary',
                'breadcrumbs' => [
                    ['label' => 'Payroll', 'url' => route('payroll.index')],
                    ['label' => 'Tools', 'url' => route('payroll.index')],
                    ['label' => 'Process Half Salary', 'url' => route('payroll.tools.process-halfsalary.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Process Half Salary
                </h4>
            </div>
        </div>
        <div class="col-lg-6 ps-lg-0" style="margin:0px auto;">
            <form action="{{ route('payroll.tools.process-halfsalary.store') }}" id="applicantForm" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border">
                    <div class="card-header" style="padding: 15px 16px;">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Process Half Salary</h6>
                    </div>
                    <div class="card-body" style="overflow-y: auto;">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="title" value="1" id="title1" checked>
                                    <label class="form-check-label" for="title1">Process Half Salary</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="title" value="2" id="title2">
                                    <label class="form-check-label" for="title2">Undo / Revert Process Half Salary</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="title" value="3" id="title3">
                                    <label class="form-check-label" for="title3">Confirm Process Half Salary</label>
                                </div>
                            </div><br><br>

                            <div class="col-md-4 mb-3">
                                <x-select-input name="org_id" id="org_id" class="select2" :options="$organizations" :selected="old('org_id', '1')" placeholder="Select Organization" required />
                                <x-text-input name="date" id="date" type="date" class="form-control-sm" :value="date('Y-m-d')" placeholder="Cot Of Date" required />
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
