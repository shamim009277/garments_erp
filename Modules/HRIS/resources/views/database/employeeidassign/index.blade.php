@extends('layouts.app')
@section('title', 'HRIS')
@push('styles')
    <style>
        .select2-selection{
            height: 35px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            height: 32px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            height: 32px !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee ID Assign',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Employee ID Assign', 'url' => route('hris.database.employee-idassign.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">Applicant Employee ID Assign</h4>

                <!-- Search Input + Button in One Line -->
                <form class="d-flex order-0 order-md-1" style="max-width: 400px;" role="search">
                    <input class="form-control form-control-sm me-2" type="search" placeholder="Applicant Card No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit">
                        <i data-feather="search" width="14" height="14" class="me-1"></i> Search
                    </button>
                </form>
            </div>
        </div>
        <div class="col-lg-8 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card" >
                <div class="card-header" style="padding:14px 20px;">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Applicant For EmployeeID</h6>
                </div>
                <div class="card-body" style="min-height: 500px;max-height: 500px; overflow-y: auto;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 pe-lg-1 ps-md-0">
                            <div class="card border border-primary">
                                <div class="card-header" style="padding:10px 16px;">
                                    <h6 class="my-0 text-primary">Pending Applicant List For EmployeeID (1)</h6>
                                </div>
                                <div class="card-body" style="min-height: 450px;max-height: 450px; overflow-y: auto;">
                                    <div class="row">
                                        <div class="col-12">
                                            <ul class="nav-custom">
                                                @foreach ($unique_department as $department)
                                                    @php
                                                        $applicant_date_wises = collect($pending_applicants)
                                                            ->where('department_id', $department->department_id)
                                                            ->groupBy('entry_date')
                                                            ->all();
                                                    @endphp
                                                    <li class="nav-custom-item">
                                                        <input type="checkbox" id="dept{{ $department->department_id }}" {{ $unique_applicant && $unique_applicant->department_id == $department->department_id ? 'checked' : '' }}>
                                                        <label class="nav-custom-link" for="dept{{ $department->department_id }}"><span class="nav-custom-caret"></span> {{ $department->department->department }} ({{ collect($pending_applicants)->where('department_id', $department->department_id)->count() }})</label>
                                                        <ul class="nav-custom-content">
                                                            @foreach ($applicant_date_wises as $key => $applicants)
                                                                @php
                                                                    $applicants_date_wises = collect($pending_applicants)
                                                                        ->where('department_id', $department->department_id)
                                                                        ->where('entry_date', $key)
                                                                        ->all();
                                                                @endphp
                                                                <li class="nav-custom-item">
                                                                    <input type="checkbox" id="dept{{ $department->department_id }}-{{ $key }}" {{ $unique_applicant && $unique_applicant->entry_date == $key && $unique_applicant->department_id == $department->department_id ? 'checked' : '' }}>
                                                                    <label class="nav-custom-link" style="{{ $unique_applicant && $unique_applicant->entry_date == $key && $unique_applicant->department_id == $department->department_id ? 'background-color: #EBF0F6;' : '' }}" for="dept{{ $department->department_id }}-{{ $key }}"><span class="nav-custom-caret"></span> {{ Carbon\Carbon::parse($key)->format('d-M-Y') }} ({{ collect($pending_applicants)->where('department_id', $department->department_id)->where('entry_date', $key)->count() }})</label>
                                                                    <div class="nav-custom-content">
                                                                        @foreach ($applicants_date_wises as $applicant)
                                                                            <a href="javascript:void(0);" data-id="{{ $applicant->id }}" data-final_designation_id="{{ $applicant->final_designation_id }}" style="{{ $unique_applicant && $unique_applicant->id == $applicant->id ? 'color: #FF6C37; background-color: #EBF0F6;' : '' }}" class="employee-link">{{ $applicant->id }} :: {{ strtoupper($applicant->name) }}</a>
                                                                        @endforeach
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 ps-lg-1 ps-md-1">
                            <form action="{{ route('hris.database.employee-idassign.store') }}" method="post">
                                @csrf
                            <div class="card border border-info">
                                <div class="card-header" style="padding:10px 16px;">
                                    <h6 class="my-0 text-primary">Input Parameters For EmployeeID</h6>
                                </div>
                                <div class="card-body" style="min-height: 400px;max-height: 400px; overflow-y: auto;">
                                    <x-input-group label="Applicant ID" name="applicant_id" type="text" placeholder="Applicant ID" readonly/>
                                    <x-input-group label="Employee ID" name="employee_id" type="text" placeholder="Employee ID" required/>
                                    <x-select-input-group name="final_designation_id" id="final_designation_id" label="Final Designation" class="select2" :options="$designations" :selected="old('final_designation_id')" required />
                                    <x-select-input-group name="recruitment_type" id="recruitment_type" label="Recruitment Type" :options="['N' => 'New', 'R' => 'Replacement']" :selected="old('final_designation_id')" required />
                                    <x-input-group name="replace_id" id="replace_id" label="Replacement ID" type="text" placeholder="Replacement ID"/>
                                </div>
                                <div class="card-footer" style="padding:10px 16px;">
                                    <x-primary-button class="float-start btn-sm submitBtn">Assign</x-primary-button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header" style="padding:14px 20px;">
                    <h6 class="my-0 text-primary"><i data-feather="list" width="18" height="18"></i> Applicant For File Entry</h6>
                </div>
                <div class="card-body" style="min-height: 500px;max-height: 500px; overflow-y: auto;">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 pe-lg-1 ps-md-0">
                            <div class="card border border-primary">
                                <div class="card-header" style="padding:10px 16px;">
                                    <h6 class="my-0 text-primary">Applicant List For File Entry</h6>
                                </div>
                                <div class="card-body" style="min-height: 450px;max-height: 400px; overflow-y: auto;">
                                    <ul class="nav-custom">
                                        @foreach ($unique_selected_department as $selected_department)
                                            @php
                                                $applicant_date_wises = collect($selected_applicants)
                                                    ->where('department_id', $selected_department->department_id)
                                                    ->groupBy('entry_date')
                                                    ->all();
                                            @endphp
                                            <li class="nav-custom-item">
                                                <input type="checkbox" id="dept{{ $selected_department->department_id }}" {{ $unique_applicant && $unique_applicant->department_id == $selected_department->department_id ? 'checked' : '' }}>
                                                <label class="nav-custom-link" for="dept{{ $selected_department->department_id }}"><span class="nav-custom-caret"></span> {{ $selected_department->department->department }} ({{ collect($selected_applicants)->where('department_id', $selected_department->department_id)->count() }})</label>
                                                <ul class="nav-custom-content">
                                                    @foreach ($applicant_date_wises as $key => $applicants)
                                                        @php
                                                            $applicants_date_wises = collect($selected_applicants)
                                                                ->where('department_id', $selected_department->department_id)
                                                                ->where('entry_date', $key)
                                                                ->all();
                                                        @endphp
                                                        <li class="nav-custom-item">
                                                            <input type="checkbox" id="dept{{ $selected_department->department_id }}-{{ $key }}" {{ $unique_applicant && $unique_applicant->entry_date == $key && $unique_applicant->department_id == $selected_department->department_id ? 'checked' : '' }}>
                                                            <label class="nav-custom-link" style="{{ $unique_applicant && $unique_applicant->entry_date == $key && $unique_applicant->department_id == $selected_department->department_id ? 'background-color: #EBF0F6;' : '' }}" for="dept{{ $selected_department->department_id }}-{{ $key }}"><span class="nav-custom-caret"></span> {{ Carbon\Carbon::parse($key)->format('d-M-Y') }} ({{ collect($pending_applicants)->where('department_id', $selected_department->department_id)->where('entry_date', $key)->count() }})</label>
                                                            <div class="nav-custom-content">
                                                                @foreach ($applicants_date_wises as $applicant)
                                                                    <a href="javascript:void(0);" data-id="{{ $applicant->id }}" data-final_designation_id="{{ $applicant->final_designation_id }}" style="{{ $unique_applicant && $unique_applicant->id == $applicant->id ? 'color: #FF6C37; background-color: #EBF0F6;' : '' }}" class="employee-link">{{ $applicant->id }} :: {{ $applicant->employee_id }} :: {{ strtoupper($applicant->name) }}</a>
                                                                @endforeach
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#replace_id_group').hide();
            $('#recruitment_type').on('change', function() {
                let recruitment_type = $(this).val();
                if (recruitment_type == 'R') {
                    $('#replace_id_group').show();
                    $('#replace_id').prop('required', true);
                } else {
                    $('#replace_id_group').hide();
                    $('#replace_id').prop('required', false);
                }
            });

            $(document).ready(function() {
                $('#recruitment_type').trigger('change');
            });
        });

        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true
            });
        });

        $(document).on('click', '.employee-link', function(e) {
            e.preventDefault();
            let applicantId = $(this).data('id');
            let finalDesignationId = $(this).data('final_designation_id');
            let recruitmentType = $(this).data('recruitment_type');
            $('#applicant_id').val(applicantId);
            $('#final_designation_id').val(finalDesignationId).change();
        });
    </script>
@endpush
