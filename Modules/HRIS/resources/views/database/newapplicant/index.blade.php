@extends('layouts.app')
@section('title', 'HRIS')
@push('styles')
<style>
    .no-calendar {
        pointer-events: none;
        background-color: #848485;

    }
</style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'New Applicant',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'New Applicant', 'url' => route('hris.database.new-applicants.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                    {{ $unique_applicant ? "New Applicant || Applicant ID : $unique_applicant->id" : 'New Applicant' }}
                </h4>

                <!-- Search Input + Button in One Line -->
                <form action="{{ route('hris.database.new-applicants.search') }}" method="POST"
                    class="d-flex order-0 order-md-1 mb-2 mb-md-0 me-md-2" style="max-width: 400px;" role="search">
                    @csrf
                    <input class="form-control form-control-sm me-2" type="search" name="search"
                        placeholder="Applicant Card No ..." aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit"><i data-feather="search"
                            width="14" height="14" class="me-1"></i> Search</button>
                </form>
                @if ($unique_applicant)
                    <!-- Back Button -->
                    <a href="{{ route('hris.database.new-applicants.index') }}"
                        class="btn btn-sm btn-info d-flex align-items-center order-2 order-md-2"><i
                            data-feather="arrow-left" width="14" height="14" class="me-1"></i> Back </a>
                @endif
            </div>
        </div>
        <div class="col-lg-4 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Pending
                        Applicant List</h6>
                </div>
                <div class="card-body" style="min-height: 457px;max-height: 457px; overflow-y: auto;">
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
                                                    <a href="{{ route('hris.database.new-applicants.show', $applicant->id) }}" style="{{ $unique_applicant && $unique_applicant->id == $applicant->id ? 'color: #FF6C37; background-color: #EBF0F6;' : '' }}" class="employee-link">{{ $applicant->id }} :: {{ strtoupper($applicant->name) }}</a>
                                                @endforeach
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul> --}}
                    @php
                        $companyWise = collect($pending_applicants)->groupBy('org_id');
                    @endphp
                    <ul class="nav-custom">
                        @foreach ($companyWise as $companyId => $companyApplicants)
                            @php
                                $companyName = $companyApplicants->first()->Organization->short_name ?? 'N/A';
                                $departmentWise = $companyApplicants->groupBy('department_id');

                                // Check if selected applicant belongs to this company
                                $isCompanyActive = $unique_applicant && $unique_applicant->org_id == $companyId;
                            @endphp

                            {{-- ================= COMPANY LEVEL ================= --}}
                            <li class="nav-custom-item">
                                <input type="checkbox" id="company{{ $companyId }}" {{ $isCompanyActive ? 'checked' : '' }}>

                                <label class="nav-custom-link" for="company{{ $companyId }}" style="{{ $isCompanyActive ? 'background:#f2b14b; border-radius: 3px;' : '' }}">
                                    <span class="nav-custom-caret"></span>
                                    {{ $companyName }} ({{ $companyApplicants->count() }})
                                </label>

                                <ul class="nav-custom-content">

                                    {{-- ================= DEPARTMENT LEVEL ================= --}}
                                    @foreach ($departmentWise as $departmentId => $departmentApplicants)
                                        @php
                                            $departmentName = $departmentApplicants->first()->department->department ?? 'N/A';
                                            $dateWise = $departmentApplicants->groupBy('entry_date');

                                            // Check if selected applicant belongs to this department
                                            $isDepartmentActive = $unique_applicant
                                                && $unique_applicant->org_id == $companyId
                                                && $unique_applicant->department_id == $departmentId;
                                        @endphp

                                        <li class="nav-custom-item">
                                            <input type="checkbox" id="dept{{ $companyId }}-{{ $departmentId }}" {{ $isDepartmentActive ? 'checked' : '' }}>
                                            <label class="nav-custom-link" for="dept{{ $companyId }}-{{ $departmentId }}" style="{{ $isDepartmentActive ? 'background:#D75350; border-radius: 3px;' : '' }}">
                                                <span class="nav-custom-caret"></span>
                                                {{ $departmentName }} ({{ $departmentApplicants->count() }})
                                            </label>

                                            <ul class="nav-custom-content">

                                                {{-- ================= DATE LEVEL ================= --}}
                                                @foreach ($dateWise as $entryDate => $dateApplicants)
                                                    @php
                                                        // Check if selected applicant belongs to this date
                                                        $isDateActive = $unique_applicant
                                                            && $unique_applicant->org_id == $companyId
                                                            && $unique_applicant->department_id == $departmentId
                                                            && $unique_applicant->entry_date == $entryDate;
                                                    @endphp

                                                    <li class="nav-custom-item">
                                                        <input type="checkbox"
                                                            id="date{{ $companyId }}-{{ $departmentId }}-{{ $entryDate }}"
                                                            {{ $isDateActive ? 'checked' : '' }}>

                                                        <label class="nav-custom-link" for="date{{ $companyId }}-{{ $departmentId }}-{{ $entryDate }}" style="{{ $isDateActive ? 'background:#75bcf5; border-radius: 3px;' : '' }}">
                                                            <span class="nav-custom-caret"></span>
                                                            {{ \Carbon\Carbon::parse($entryDate)->format('d-M-Y') }}
                                                            ({{ $dateApplicants->count() }})
                                                        </label>

                                                        <div class="nav-custom-content">
                                                            @foreach ($dateApplicants as $applicant)
                                                                <a href="{{ route('hris.database.new-applicants.show', $applicant->id) }}"
                                                                    class="employee-link" style="{{ $unique_applicant && $unique_applicant->id == $applicant->id ? 'color: #ffffff; background:#4549A2; border-radius: 3px;' : '' }}">
                                                                    {{ $applicant->id }} :: {{ strtoupper($applicant->name) }}
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

        <div class="col-lg-8">
            <form
                action="{{ $unique_applicant ? route('hris.database.new-applicants.update', $unique_applicant->id) : route('hris.database.new-applicants.store') }}"
                id="applicantForm" method="POST">
                @csrf
                @if ($unique_applicant)
                    @method('PUT')
                @endif
                <div class="card alert-info alert-top-border">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap px-10 py-12"
                        style="padding: 16px 20px">
                        <h6 class="my-0 text-primary d-flex align-items-center gap-1"><i data-feather="list" width="18"
                                height="18"></i>
                            {{ $unique_applicant ? 'Edit Applicant Information' : 'Input Parameters For New Applicant ...' }}
                        </h6>

                        <div class="d-flex gap-2 mt-2 mt-md-0">
                            @if ($unique_applicant)
                                <a href="javascript:void(0);" data-id="{{ $unique_applicant->id }}"
                                    class="btn btn-danger btn-sm d-flex align-items-center delete-applicant"
                                    data-id="{{ $unique_applicant->id }}"><i data-feather="trash-2" width="16"
                                        height="16" class="me-1"></i> Delete</a>
                                <button class="btn btn-warning btn-sm d-flex align-items-center text-white"><i
                                        data-feather="star" width="16" height="16" class="me-1"></i>
                                    Sticker</button>
                            @else
                                <a href="javascript:void(0);" id="resetForm" class="btn btn-secondary btn-sm d-flex align-items-center"><i data-feather="rotate-ccw" width="16" height="16" class="me-1"></i> Reset</a>
                            @endif
                        </div>
                    </div>

                    <div class="card-body" style="min-height: 400px;max-height: 400px; overflow-y: auto;">
                        <div class="row">
                            @if ($unique_applicant)
                                <div class="col-lg-4 col-md-6 pr-0">
                                    <x-input-group name="entry_date "  label="Entry Date" type="date"
                                        placeholder="Enter entry date" :value="old(
                                            'entry_date',
                                            $unique_applicant ? $unique_applicant->entry_date : null,
                                        )" required readonly class="no-calendar" />
                                </div>
                            @endif
                            @php
                                $selectedOrg = old('org_id', $unique_applicant->org_id ?? ($organizations->count() === 1 ? $organizations->keys()->first() : 1));
                            @endphp
                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-select-search-input
                                    name="org_id"
                                    id="org_id"
                                    label="Organization"
                                    :options="$organizations"
                                    :selected="$selectedOrg"
                                    required
                                />
                            </div>
                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-input-group name="name" label="Name" type="text" placeholder="Enter name"
                                    :value="old('name', $unique_applicant ? $unique_applicant->name : null)" required />
                            </div>
                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-input-group name="birth_date" label="Birth Date" type="text" id="birth_date"
                                    placeholder="Enter birth date" :value="old(
                                        'birth_date',
                                        $unique_applicant
                                            ? \Carbon\Carbon::parse($unique_applicant->birth_date)->format('d-m-Y')
                                            : null,
                                    )" required />
                            </div>
                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-input-group name="name_bangla" label="Name Bangla" type="text"
                                    placeholder="Enter name bangla" :value="old(
                                        'name_bangla',
                                        $unique_applicant ? $unique_applicant->name_bangla : null,
                                    )" />
                            </div>

                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-input-group name="mobile" label="Mobile" type="text" pattern="(01)[0-9]{9}"
                                    maxlength="11" placeholder="Enter mobile" :value="old('mobile', $unique_applicant ? $unique_applicant->mobile : null)" required />
                            </div>

                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-select-search-input name="department_id" id="department_id"
                                    label="Department (Apply For)" :options="$departments" :selected="old(
                                        'department_id',
                                        $unique_applicant ? $unique_applicant->department_id : null,
                                    )" required />
                            </div>

                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-select-search-input name="designation_id" id="designation_id"
                                    label="Designation (Apply For)" :options="$designations" :selected="old(
                                        'designation_id',
                                        $unique_applicant ? $unique_applicant->designation_id : null,
                                    )" required />
                            </div>

                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-select-search-input name="line" id="line"
                                    label="Line (Apply For)" :options="$lines" :selected="old(
                                        'line',
                                        $unique_applicant ? $unique_applicant->line : null,
                                    )" />
                            </div>

                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-select-search-input name="district_id" label="District" :options="$districts"
                                    :selected="old(
                                        'district_id',
                                        $unique_applicant ? $unique_applicant->district_id : null,
                                    )" required />
                            </div>
                            <div class="col-lg-4 col-md-6 pr-0">
                                <x-select-input-group name="identification_type" id="identification_type"
                                    label="Identification Type" :options="['1' => 'National ID', '2' => 'Birth Certificate']" :selected="old(
                                        'identification_type',
                                        $unique_applicant ? $unique_applicant->identification_type : 1,
                                    )" required />
                            </div>

                            <div class="col-lg-4 col-md-6 pr-0" id="nid_section">
                                <x-input-group name="national_id" label="National ID" id="national_id" type="number"
                                    pattern="[0-9]{10,17}" minlength="10" maxlength="17" placeholder="Enter national id"
                                    :value="old(
                                        'national_id',
                                        $unique_applicant ? $unique_applicant->national_id : null,
                                    )" required />
                            </div>

                            <div class="col-lg-4 col-md-6 pr-0" id="birth_certificate_section">
                                <x-input-group name="birth_certificate_no" label="Birth Certificate No"
                                    id="birth_certificate_no" type="number" pattern="[0-9]{10,30}" minlength="13"
                                    maxlength="30" placeholder="Enter birth certificate no" :value="old(
                                        'birth_certificate_no',
                                        $unique_applicant ? $unique_applicant->birth_certificate_no : null,
                                    )" />
                            </div>

                            @if ($unique_applicant)
                                <div class="col-lg-4 col-md-6 pr-0">
                                    <x-input-group name="interviewer_employee_id" label="Interviewer Employee ID"
                                        id="interviewer_employee_id" type="number" pattern="[0-9]{10,30}"
                                        minlength="6" maxlength="20" placeholder="Enter interviewer employee id"
                                        :value="old(
                                            'interviewer_employee_id',
                                            $unique_applicant ? $unique_applicant->interviewer_employee_id : null,
                                        )" />
                                </div>

                                <div class="col-lg-4 col-md-6 pr-0">
                                    <x-select-input-group name="interview_status" id="interview_status"
                                        label="Interview Status" :options="[
                                            'Pending' => 'Pending',
                                            'Selected' => 'Selected',
                                            'Disqualify' => 'Disqualify',
                                            'Not Recruit' => 'Not Recruit',
                                        ]" :selected="old(
                                            'interview_status',
                                            $unique_applicant ? $unique_applicant->interview_status : 'Pending',
                                        )" />
                                </div>

                                <div class="col-lg-4 col-md-6 pr-0" id="final_designation_section">
                                    <x-select-search-input name="final_designation_id" id="final_designation_id"
                                        label="Final Designation" :options="$designations" :selected="old(
                                            'final_designation_id',
                                            $unique_applicant ? $unique_applicant->final_designation_id : null,
                                        )" />
                                </div>

                                <div class="col-lg-4 col-md-6 pr-0" id="joining_date_section">
                                    <x-input-group name="joining_date" label="Joining Date" id="joining_date"
                                        class="holiday-date" type="text" placeholder="Enter joining date"
                                        :value="old(
                                            'joining_date',
                                            $unique_applicant
                                                ? \Carbon\Carbon::parse($unique_applicant->joining_date)->format(
                                                    'd-m-Y',
                                                )
                                                : null,
                                        )" />
                                </div>

                                <div class="col-lg-4 col-md-6 pr-0" id="proposed_salary_section">
                                    <x-input-group name="proposed_salary" label="Proposed Salary" id="proposed_salary"
                                        type="number" pattern="[0-9]{10,30}" placeholder="Enter proposed salary"
                                        :value="old(
                                            'proposed_salary',
                                            $unique_applicant ? $unique_applicant->proposed_salary : null,
                                        )" />
                                </div>

                                <div class="col-lg-4 col-md-6 pr-0" id="determined_salary_section">
                                    <x-input-group name="determined_salary" label="Determined Salary"
                                        id="determined_salary" type="number" pattern="[0-9]{10,30}"
                                        placeholder="Enter determined salary" :value="old(
                                            'determined_salary',
                                            $unique_applicant ? $unique_applicant->determined_salary : null,
                                        )" />
                                </div>

                                <div class="col-lg-4 col-md-6 pr-0" id="remarks_section">
                                    <x-input-group name="remarks" label="Remarks" id="remarks" type="text"
                                        placeholder="Enter remarks" :value="old(
                                            'remarks',
                                            $unique_applicant ? $unique_applicant->remarks : null,
                                        )" />
                                </div>
                            @endif

                            <div class="col-lg-4 col-md-6 pr-0">
                                <div class="form-check" style="margin-top: 38px;">
                                    <input class="form-check-input" type="checkbox" style="display: inline-block;"
                                        name="ipe_assessment_required" id="ipe_assessment_required"
                                        :checked="{{ old('ipe_assessment_required', $unique_applicant ? $unique_applicant->ipe_assessment_required : null) ? 'checked' : '' }}">
                                    <label class="form-check-label" for="ipe_assessment_required">IPE Assessment
                                        Required</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding:14px 20px;">
                        <x-primary-button
                            class="float-start btn-sm submitBtn">{{ $unique_applicant ? 'Update' : 'Submit' }}</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let holidays = @json($holidays);
            flatpickr("#joining_date", {
                dateFormat: "d-m-Y",
                allowInput: false,
                minDate: "{{ $today }}",
                disable: holidays,
            });

            flatpickr("#birth_date", {
                dateFormat: "d-m-Y",
                maxDate: "{{ $maxDate }}",
                allowInput: false,
            });

            $('#birth_certificate_section').hide();
            $('#identification_type').on('change', function() {
                let identification_type = $(this).val();
                if (identification_type == 1) {
                    $('#nid_section').show();
                    $('#birth_certificate_section').hide();

                    $('#national_id').prop('required', true);
                    $('#birth_certificate_no').prop('required', false);
                } else {
                    $('#nid_section').hide();
                    $('#birth_certificate_section').show();

                    $('#national_id').prop('required', false);
                    $('#birth_certificate_no').prop('required', true);
                }
            });

            $('#interview_status').on('change', function() {
                let interview_status = $(this).val();

                if (interview_status === 'Selected') {
                    $('#final_designation_id').show();
                    $('#joining_date_section').show();
                    $('#proposed_salary_section').show();
                    $('#determined_salary_section').show();
                    $('#remarks_section').show();

                    $('#joining_date').prop('required', true);
                    $('#proposed_salary').prop('required', true);
                    $('#determined_salary').prop('required', true);
                    $('#remarks').prop('required', true);
                } else {
                    $('#final_designation_id').hide();
                    $('#joining_date_section').hide();
                    $('#proposed_salary_section').hide();
                    $('#determined_salary_section').hide();
                    $('#remarks_section').hide();

                    $('#joining_date').prop('required', false);
                    $('#proposed_salary').prop('required', false);
                    $('#determined_salary').prop('required', false);
                    $('#remarks').prop('required', false);
                }
            });

            //Page load এ value check করে trigger করানো
            $(document).ready(function() {
                $('#interview_status').trigger('change');
            });

            $(document).ready(function() {
                $('#identification_type').trigger('change');
            });
        });

        $(document).ready(function() {
            let today = new Date().toISOString().split('T')[0];
            $('#joining_date').attr('min', today);
        });

        $('#resetForm').on('click', function() {
            window.location.reload();
        });

        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true
            });
        });

        $(document).on('click', '.delete-applicant', function(e) {
            e.preventDefault();
            let applicantId = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('hris.database.new-applicants.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: applicantId
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Deleted!', 'Applicant has been deleted.', 'success');
                                location.href =
                                    '{{ route('hris.database.new-applicants.index') }}';
                            } else {
                                Swal.fire('Error!', response.message);
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                } else {
                    Swal.fire('Cancelled!', 'Applicant has not been deleted.', 'error');
                }
            });
        });
    </script>
@endpush
