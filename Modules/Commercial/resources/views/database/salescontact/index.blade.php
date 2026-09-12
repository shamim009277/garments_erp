@extends('layouts.app')
@section('title', 'Commercial')
@section('styles')
    <style>
        .table,
        tr,
        th,
        td {
            border: none !important;
            border-collapse: collapse;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @include('components.breadcrumb', [
                'title' => 'Commercial',
                'subtitle' => 'Sales Contact',
                'breadcrumbs' => [
                    ['label' => 'Commercial', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('commercial.index')],
                    ['label' => 'Sales Contact', 'url' => route('commercial.database.sales-contacts.index')],
                ],
            ])
        </div>

        <div class="col-lg-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">Sales Contact</h4>
                <form action="#" method="POST" class="d-flex order-0 order-md-1" style="max-width: 400px;" role="search">
                    @csrf
                    <input class="form-control form-control-sm me-2" type="search" name="search" placeholder="Sales Contact No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"> <i data-feather="search" width="14" height="14" class="me-1"></i> Search </button>
                </form>
            </div>
        </div>

        <div class="col-lg-3 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Sales Contact List</h6>
                </div>
                <div class="card-body" style="min-height: 477px;max-height: 477px; overflow-y: auto;">
                    {{-- @php
                        $companyWise = collect($applicants)->groupBy('org_id');
                    @endphp

                    <ul class="nav-custom">
                        @foreach ($companyWise as $companyId => $companyApplicants)
                            @php
                                $companyName = $companyApplicants->first()->Organization->short_name ?? 'N/A';
                                $departmentWise = $companyApplicants->groupBy('department_id');
                            @endphp

                            <li class="nav-custom-item">
                                <input type="checkbox" id="company{{ $companyId }}">
                                <label class="nav-custom-link" for="company{{ $companyId }}">
                                    <span class="nav-custom-caret"></span>
                                    {{ $companyName }} ({{ $companyApplicants->count() }})
                                </label>

                                <ul class="nav-custom-content">
                                    @foreach ($departmentWise as $departmentId => $deptApplicants)
                                        @php
                                            $departmentName = $deptApplicants->first()->department->department ?? 'N/A';
                                            $dateWise = $deptApplicants->groupBy('entry_date');
                                        @endphp

                                        <li class="nav-custom-item">
                                            <input type="checkbox" id="dept{{ $companyId }}-{{ $departmentId }}">
                                            <label class="nav-custom-link"
                                                for="dept{{ $companyId }}-{{ $departmentId }}">
                                                <span class="nav-custom-caret"></span>
                                                {{ $departmentName }} ({{ $deptApplicants->count() }})
                                            </label>

                                            <ul class="nav-custom-content">
                                                @foreach ($dateWise as $entryDate => $dateApplicants)
                                                    @php
                                                        $dateLabel = \Carbon\Carbon::parse($entryDate)->format('d-M-Y');
                                                    @endphp
                                                    <li class="nav-custom-item">
                                                        <input type="checkbox"
                                                            id="date{{ $companyId }}-{{ $departmentId }}-{{ $entryDate }}">
                                                        <label class="nav-custom-link"
                                                            for="date{{ $companyId }}-{{ $departmentId }}-{{ $entryDate }}">
                                                            <span class="nav-custom-caret"></span>
                                                            {{ $dateLabel }} ({{ $dateApplicants->count() }})
                                                        </label>

                                                        <div class="nav-custom-content">
                                                            @foreach ($dateApplicants as $applicant)
                                                                <a href="javascript:void(0);" class="employee-link"
                                                                    data-line="{{ $applicant->line }}"
                                                                    data-unit="{{ $applicant->unit }}"
                                                                    data-org_id="{{ $applicant->org_id }}"
                                                                    data-id="{{ $applicant->employee_id }}"
                                                                    data-applicant_id="{{ $applicant->id }}"
                                                                    data-department_id="{{ $applicant->department_id }}"
                                                                    data-final_designation_id="{{ $applicant->designation_id }}"
                                                                    data-district_id="{{ $applicant->district_id }}"
                                                                    data-joining_date="{{ $applicant->joining_date }}"
                                                                    data-name="{{ $applicant->name }}">
                                                                    {{ $applicant->id }} :: {{ $applicant->employee_id }}
                                                                    :: {{ strtoupper($applicant->name) }}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul> --}}
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <form action="#" id="salesContactForm" method="POST">
                @csrf
                <div class="card alert-info alert-top-border">
                    <div class="card-header d-flex justify-content-between align-items-center px-10 py-12">
                        <h6 class="my-0 text-primary"><i data-feather="list" width="18" height="18"></i> Input
                            Parameters For New Sales Contact ...</h6>
                    </div>
                    <div class="card-body" style="min-height: 400px;">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 pe-lg-0 pe-md-0">
                                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                                            <tr>
                                                <th width="35%" style="border: none;">Contact No</th>
                                                <td width="65%" style="border: none;"><x-text-input name="contact_no" id="contact_no" class="form-control-sm" placeholder="Contact No" required  /></td>
                                            </tr>
                                            <tr>
                                                <th width="35%" style="border: none;">Date</th>
                                                <td width="65%" style="border: none;"><x-text-input name="date" type="date" id="date" class="form-control-sm" placeholder="Date" required  /></td>
                                            </tr>
                                            <tr>
                                                <th width="35%" style="border: none;">Revised Date </th>
                                                <td width="65%" style="border: none;"><x-text-input name="revised_date" id="revised_date" type="date" class="form-control-sm" placeholder="Revised Date"  /></td>
                                            </tr>
                                            <tr>
                                                <th width="35%" style="border: none;">Buyer </th>
                                                <td width="65%" style="border: none;"><x-select-input name="buyer_id" id="buyer_id" class="select2" :options="[]" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="35%" style="border: none;">Supplier </th>
                                                <td width="65%" style="border: none;"><x-select-input name="supplier_id" id="supplier_id" class="select2" :options="[]" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="35%" style="border: none;">Supplier Address </th>
                                                <td width="65%" style="border: none;">
                                                     <textarea name="supplier_address" id="supplier_address" class="form-control form-control-sm" placeholder="Supplier Address"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="35%" style="border: none;">Supplier Bank </th>
                                                <td width="65%" style="border: none;">
                                                     <textarea name="supplier_address" id="supplier_address" class="form-control form-control-sm" placeholder="Supplier Address"></textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-lg-6 col-md-6 pe-lg-0">
                                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                                            <tr>
                                                <th width="35%" style="border: none;">Tolerance </th>
                                                <td width="65%" style="border: none;"><x-text-input name="tolerance" id="tolerance" type="number" min="0" max="40" step="any" class="form-control-sm"  placeholder="Tolerance" required /></td>
                                            </tr>

                                            <tr>
                                                <th width="35%" style="border: none;">Agent Commission </th>
                                                <td width="65%" style="border: none;"><x-text-input name="agent_commission" id="agent_commission" type="number" min="0" max="40" step="any" class="form-control-sm"  placeholder="Agent Commission" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="35%" style="border: none;">Shipment Mode </th>
                                                <td width="65%" style="border: none;"><x-select-input name="shipment_mode_id" id="shipment_mode_id" class="select2" :options="[]" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="35%" style="border: none;">Payment Terms </th>
                                                <td width="65%" style="border: none;"><x-select-input name="payment_terms_id" id="payment_terms_id" class="select2" :options="[]" required /></td>
                                            </tr>
                                            <tr>
                                                <th width="35%" style="border: none;">Delivery Terms </th>
                                                <td width="65%" style="border: none;"><x-select-input name="delivery_terms_id" id="delivery_terms_id" class="select2" :options="[]" required /></td>
                                            </tr>
                                            
                                            <tr>
                                                <th width="35%" style="border: none;">Buyer Address </th>
                                                <td width="65%" style="border: none;">
                                                     <textarea name="buyer_address" id="buyer_address" class="form-control form-control-sm" placeholder="Buyer Address"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="35%" style="border: none;">Buyer Bank </th>
                                                <td width="65%" style="border: none;">
                                                     <textarea name="buyer_bank" id="buyer_bank" class="form-control form-control-sm" placeholder="Buyer Bank"></textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 pe-lg-0">
                                <table class="table table-striped" id="employeeTable" width="100%">
                                    <tr>
                                        <th width="35%" style="border: none;">Consignee </th>
                                        <td width="65%" style="border: none;"><x-select-input name="consignee_id" id="consignee_id" class="select2" :options="[]" /></td>
                                    </tr>
                                    <tr>
                                        <th width="35%" style="border: none;">Payment Method </th>
                                        <td width="65%" style="border: none;"><x-select-input name="payment_method_id"
                                                id="payment_method_id" class="select2" :options="[]" required /></td>
                                    </tr>
                                    <tr>
                                        <th width="35%" style="border: none;">Additional Terms </th>
                                        <td width="65%" style="border: none;"><x-text-input name="additional_terms" id="additional_terms" type="text" class="form-control-sm"  placeholder="Additional Terms" /></td>
                                    </tr>
                                    <tr>
                                        <th width="35%" style="border: none;">Expiry Date </th>
                                        <td width="65%" style="border: none;"><x-text-input name="expiry_date" id="expiry_date" type="date" class="form-control-sm" placeholder="Expiry Date"  /></td>
                                    </tr>
                                    <tr>
                                        <th width="35%" style="border: none;">Consignee Address </th>
                                        <td width="65%" style="border: none;">
                                                <textarea name="consignee_address" id="consignee_address" class="form-control form-control-sm" placeholder="Consignee Address"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="35%" style="border: none;">Consignee Bank </th>
                                        <td width="65%" style="border: none;">
                                                <textarea name="consignee_bank" id="consignee_bank" class="form-control form-control-sm" placeholder="Consignee Bank"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="35%" style="border: none;">Remarks</th>
                                        <td width="65%" style="border: none;">
                                                <textarea name="remarks" id="remarks" class="form-control form-control-sm" placeholder="Remarks"></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding:14px 20px;">
                        <x-primary-button class="float-start btn-sm submitBtn">Save And Go</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Date restriction
            let today = new Date().toISOString().split('T')[0];
            $('#joining_date,#refrerence_date').attr('min', today);

            // Initialize Select2
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endpush
