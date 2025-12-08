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
        .employee-active {
            background-color: #4549A2;
            color: #FFFFFF;
        }
        .employee-active:hover {
            color: #000000;
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
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 pe-lg-1 ps-md-0">
                            <div class="card border border-primary">
                                <div class="card-header" style="padding:10px 16px;">
                                    <h6 class="my-0 text-primary">Pending Applicant List For EmployeeID</h6>
                                </div>
                                <div class="card-body" style="min-height: 450px;max-height: 450px; overflow-y: auto;">
                                    <div class="row">
                                        <div class="col-12">
                                            {{-- <ul class="nav-custom">
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
                                                                            <a href="javascript:void(0);" data-id="{{ $applicant->id }}" data-final_designation_id="{{ $applicant->final_designation_id }}" style="{{ $unique_applicant && $unique_applicant->id == $applicant->id ? 'color: #FF6C37; background-color: #EBF0F6;' : '' }}" class="employee-link employee-show">{{ $applicant->id }} :: {{ strtoupper($applicant->name) }}</a>
                                                                        @endforeach
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul> --}}
                                            <ul class="nav-custom">
                                                @foreach ($grouped_data as $org_id => $departments)
                                                    @php
                                                        $orgFirst = collect($pending_applicants)->where('org_id', $org_id)->first();
                                                        $orgName = $orgFirst && $orgFirst['organization'] ?? $orgFirst->organization ? ($orgFirst['organization']['short_name'] ?? ($orgFirst->organization->short_name ?? 'N/A')) : 'N/A';
                                                        $orgCount = collect($pending_applicants)->where('org_id', $org_id)->count();
                                                    @endphp

                                                    <li class="nav-custom-item">
                                                        <input type="checkbox" id="org{{ $org_id }}">
                                                        <label class="nav-custom-link" for="org{{ $org_id }}">
                                                            <span class="nav-custom-caret"></span>
                                                            {{ $orgName }} ({{ $orgCount }})
                                                        </label>

                                                        <ul class="nav-custom-content">
                                                            @foreach ($departments as $dept_id => $dates)
                                                                @php
                                                                    $deptFirst = collect($pending_applicants)
                                                                        ->where('department_id', $dept_id)
                                                                        ->where('org_id', $org_id)
                                                                        ->first();

                                                                    $deptName = $deptFirst && ($deptFirst['department'] ?? $deptFirst->department)
                                                                        ? ($deptFirst['department']['department'] ?? $deptFirst->department->department)
                                                                        : 'Unknown Dept';

                                                                    $deptCount = collect($pending_applicants)
                                                                        ->where('org_id', $org_id)
                                                                        ->where('department_id', $dept_id)
                                                                        ->count();
                                                                @endphp

                                                                <li class="nav-custom-item">
                                                                    <input type="checkbox" id="dept{{ $dept_id }}-org{{ $org_id }}">
                                                                    <label class="nav-custom-link" for="dept{{ $dept_id }}-org{{ $org_id }}">
                                                                        <span class="nav-custom-caret"></span>
                                                                        {{ $deptName }} ({{ $deptCount }})
                                                                    </label>

                                                                    <ul class="nav-custom-content">
                                                                        @foreach ($dates as $entry_date => $applicants)
                                                                            <li class="nav-custom-item">
                                                                                <input type="checkbox" id="dept{{ $dept_id }}-{{ $entry_date }}-org{{ $org_id }}">
                                                                                <label class="nav-custom-link" for="dept{{ $dept_id }}-{{ $entry_date }}-org{{ $org_id }}">
                                                                                    <span class="nav-custom-caret"></span>
                                                                                    {{ \Carbon\Carbon::parse($entry_date)->format('d-M-Y') }}
                                                                                    ({{ count($applicants) }})
                                                                                </label>

                                                                                <div class="nav-custom-content">
                                                                                    @foreach ($applicants as $applicant)
                                                                                        @php
                                                                                            $applicantId = is_array($applicant) ? ($applicant['id'] ?? null) : ($applicant->id ?? null);
                                                                                            $applicantName = is_array($applicant) ? ($applicant['name'] ?? '') : ($applicant->name ?? '');
                                                                                            $finalDesignationId = is_array($applicant) ? ($applicant['final_designation_id'] ?? null) : ($applicant->final_designation_id ?? null);

                                                                                            $uniqueApplicantId = isset($unique_applicant)
                                                                                                ? (is_array($unique_applicant) ? ($unique_applicant['id'] ?? null) : ($unique_applicant->id ?? null))
                                                                                                : null;

                                                                                            $activeStyle = ($uniqueApplicantId && $uniqueApplicantId == $applicantId)
                                                                                                ? 'color: #FF6C37; background-color: #EBF0F6;'
                                                                                                : '';
                                                                                        @endphp

                                                                                        <a href="javascript:void(0);"
                                                                                        data-id="{{ $applicantId }}"
                                                                                        data-ORG_id="{{ $applicant->org_id }}"
                                                                                        data-final_designation_id="{{ $finalDesignationId }}"
                                                                                        class="employee-link employee-show"
                                                                                        style="{{ $activeStyle }}">
                                                                                            {{ $applicantId }} :: {{ strtoupper($applicantName) }}
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
                                    {{-- <div class="row">
                                       <div class="col-4 pe-0">

                                       </div>
                                       <div class="col-8">

                                       </div>
                                    </div> --}}

                                    <input type="hidden" id="applicant_id" name="applicant_id">
                                    <x-input-group label="Applicant Name" id="applicant_name" name="applicant_name" type="text" placeholder="Applicant Name" readonly/>
                                    <x-input-group label="Employee ID" id="employee_id" name="employee_id" type="text" placeholder="Employee ID" pattern="^[0-9]{6}$" title="Employee ID must be exactly 6 digits" required/>

                                    <x-select-input-group name="org_id" id="org_id" label="Organization" class="select2" :options="$organizations" :selected="old('org_id')" required readonly />
                                    <x-select-input-group name="final_designation_id" id="final_designation_id" label="Final Designation" class="select2" :options="$designations" :selected="old('final_designation_id')" required />
                                    <x-select-input-group name="recruitment_type" id="recruitment_type" label="Recruitment Type" :options="['N' => 'New', 'R' => 'Replacement']" :selected="old('final_designation_id')" required />
                                    <x-input-group name="replace_id" id="replace_id" group_id="replace_id_group" label="Replacement ID" type="text" placeholder="Replacement ID"/>
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
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 pe-lg-1 ps-md-0">
                            <div class="card border border-primary">
                                <div class="card-header" style="padding:10px 16px;">
                                    <h6 class="my-0 text-primary">Applicant List For File Entry</h6>
                                </div>
                                <div class="card-body" style="min-height: 450px;max-height: 400px; overflow-y: auto;">
                                    {{-- <ul class="nav-custom">
                                        @foreach ($unique_selected_department as $selected_department)
                                            @php
                                                $applicant_date_wises = collect($selected_applicants)
                                                    ->where('department_id', $selected_department->department_id)
                                                    ->groupBy('entry_date')
                                                    ->all();
                                            @endphp
                                            <li class="nav-custom-item">
                                                <input type="checkbox" id="deptf{{ $selected_department->department_id }}" {{ $unique_applicant && $unique_applicant->department_id == $selected_department->department_id ? 'checked' : '' }}>
                                                <label class="nav-custom-link" for="deptf{{ $selected_department->department_id }}"><span class="nav-custom-caret"></span> {{ $selected_department->department->department }} ({{ collect($selected_applicants)->where('department_id', $selected_department->department_id)->count() }})</label>
                                                <ul class="nav-custom-content">
                                                    @foreach ($applicant_date_wises as $key => $applicants)
                                                        @php
                                                            $applicants_date_wises = collect($selected_applicants)
                                                                ->where('department_id', $selected_department->department_id)
                                                                ->where('entry_date', $key)
                                                                ->all();
                                                        @endphp
                                                        <li class="nav-custom-item">
                                                            <input type="checkbox" id="deptf{{ $selected_department->department_id }}-{{ $key }}" {{ $unique_applicant && $unique_applicant->entry_date == $key && $unique_applicant->department_id == $selected_department->department_id ? 'checked' : '' }}>
                                                            <label class="nav-custom-link" style="{{ $unique_applicant && $unique_applicant->entry_date == $key && $unique_applicant->department_id == $selected_department->department_id ? 'background-color: #EBF0F6;' : '' }}" for="deptf{{ $selected_department->department_id }}-{{ $key }}"><span class="nav-custom-caret"></span> {{ Carbon\Carbon::parse($key)->format('d-M-Y') }} ({{ collect($pending_applicants)->where('department_id', $selected_department->department_id)->where('entry_date', $key)->count() }})</label>
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
                                    </ul> --}}
                                    <ul class="nav-custom">
                                        @foreach ($grouped_selected_data as $org_id => $departments)
                                            @php
                                                $orgIdOuter = $org_id;
                                                $orgFirst = collect($selected_applicants)->where('org_id', $org_id)->first();
                                                $orgName = $orgFirst && ($orgFirst['organization'] ?? $orgFirst->organization)
                                                    ? ($orgFirst['organization']['short_name'] ?? $orgFirst->organization->short_name ?? 'N/A')
                                                    : 'N/A';
                                                $orgCount = collect($departments)
                                                    ->map(fn($dates) => collect($dates)->map(fn($apps) => count($apps))->sum())
                                                    ->sum();
                                            @endphp

                                            <li class="nav-custom-item">
                                                <input type="checkbox" id="org_{{ $orgIdOuter }}">
                                                <label class="nav-custom-link" for="org_{{ $orgIdOuter }}">
                                                    <span class="nav-custom-caret"></span>
                                                    {{ $orgName }} ({{ $orgCount }})
                                                </label>

                                                <ul class="nav-custom-content">
                                                    @foreach ($departments as $dept_id => $dates)
                                                        @php
                                                            $deptFirst = collect($selected_applicants)
                                                                ->where('department_id', $dept_id)
                                                                ->where('org_id', $orgIdOuter)
                                                                ->first();

                                                            $deptName = $deptFirst && ($deptFirst['department'] ?? $deptFirst->department)
                                                                ? ($deptFirst['department']['department'] ?? $deptFirst->department->department)
                                                                : 'Unknown Dept';

                                                            $deptCount = collect($dates)->map(fn($apps) => count($apps))->sum();
                                                        @endphp

                                                        <li class="nav-custom-item">
                                                            <input type="checkbox" id="dept_{{ $dept_id }}-org_{{ $orgIdOuter }}">
                                                            <label class="nav-custom-link" for="dept_{{ $dept_id }}-org_{{ $orgIdOuter }}">
                                                                <span class="nav-custom-caret"></span>
                                                                {{ $deptName }} ({{ $deptCount }})
                                                            </label>

                                                            <ul class="nav-custom-content">
                                                                @foreach ($dates as $entry_date => $applicants)
                                                                    @php
                                                                        $dateCount = count($applicants);
                                                                    @endphp

                                                                    <li class="nav-custom-item">
                                                                        <input type="checkbox" id="dept_{{ $dept_id }}-{{ $entry_date }}-org_{{ $orgIdOuter }}">
                                                                        <label class="nav-custom-link" for="dept_{{ $dept_id }}-{{ $entry_date }}-org_{{ $orgIdOuter }}">
                                                                            <span class="nav-custom-caret"></span>
                                                                            {{ \Carbon\Carbon::parse($entry_date)->format('d-M-Y') }} ({{ $dateCount }})
                                                                        </label>

                                                                        <div class="nav-custom-content">
                                                                            @foreach ($applicants as $applicant)
                                                                                @php
                                                                                    $applicantId = is_array($applicant) ? ($applicant['id'] ?? null) : ($applicant->id ?? null);
                                                                                    $applicantName = is_array($applicant) ? ($applicant['name'] ?? '') : ($applicant->name ?? '');
                                                                                    $finalDesignationId = is_array($applicant) ? ($applicant['final_designation_id'] ?? null) : ($applicant->final_designation_id ?? null);
                                                                                @endphp

                                                                                <a href="javascript:void(0);" data-id="{{ $applicantId }}" data-org-id="{{ $orgIdOuter }}" data-dept-id="{{ $dept_id }}" data-final-designation-id="{{ $finalDesignationId }}" class="employee-link employee-show">
                                                                                    {{ $applicantId }} :: {{ strtoupper($applicantName) }}
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
                width: '100%',
                allowClear: true
            });
        });

        $(document).on('click', '.employee-show', function(e) {
            e.preventDefault();
            $('.employee-show').removeClass('employee-active');
            $(this).addClass('employee-active');

            let applicantId = $(this).data('id');
            let orgId = $(this).data('org_id');
            let applicantName = $(this).text().trim();
            let finalDesignationId = $(this).data('final_designation_id');

            $('#applicant_id').val(applicantId);
            $('#applicant_name').val(applicantName);
            $('#org_id').val(orgId).change();
            $('#final_designation_id').val(finalDesignationId).change();
        });
    </script>
@endpush
