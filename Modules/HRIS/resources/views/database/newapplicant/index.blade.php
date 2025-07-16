@extends('layouts.app')
@section('title', 'HRIS')
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
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">New Applicant</h4>

                <!-- Search Input + Button in One Line -->
                <form class="d-flex order-0 order-md-1" style="max-width: 400px;" role="search">
                    <input class="form-control form-control-sm me-2" type="search" placeholder="Applicant Card No ..."
                        aria-label="Search">
                    <button class="btn btn-sm btn-primary d-flex align-items-center" type="submit">
                        <i data-feather="search" width="14" height="14" class="me-1"></i> Search
                    </button>
                </form>
            </div>
        </div>
        <div class="col-lg-4 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h5 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Pending Applicant List</h5>
                </div>
                <div class="card-body" style="min-height: 457px;max-height: 457px; overflow-y: auto;">
                    <ul class="nav-custom">
                        <!-- Department 1 -->
                        <li class="nav-custom-item">
                            <input type="checkbox" id="dept1">
                            <label class="nav-custom-link" for="dept1"><span class="nav-custom-caret"></span> HR Department (3)</label>
                            <ul class="nav-custom-content">
                                <!-- Date 1 -->
                                <li class="nav-custom-item">
                                    <input type="checkbox" id="dept1-date1">
                                    <label class="nav-custom-link" for="dept1-date1"><span class="nav-custom-caret"></span> 10-Jul-2025 (2)</label>
                                    <div class="nav-custom-content">
                                        <a href="#" class="employee-link">1625 : John Doe John Doe : 2025-07-10</a>
                                        <a href="#" class="employee-link">1626 : Jane Smith Jane Smith : 2025-07-10</a>
                                    </div>
                                </li>
                                <!-- Date 2 -->
                                <li class="nav-custom-item">
                                    <input type="checkbox" id="dept1-date2">
                                    <label class="nav-custom-link" for="dept1-date2"><span class="nav-custom-caret"></span> 12-Jul-2025 (1)</label>
                                    <div class="nav-custom-content">
                                        <a href="#" class="employee-link">103 : Mark Lee</a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <!-- Department 2 -->
                        <li class="nav-custom-item">
                            <input type="checkbox" id="dept2">
                            <label class="nav-custom-link" for="dept2"><span class="nav-custom-caret"></span> IT Department (1)</label>
                            <ul class="nav-custom-content">
                                <li class="nav-custom-item">
                                    <input type="checkbox" id="dept2-date1">
                                    <label class="nav-custom-link" for="dept2-date1"><span class="nav-custom-caret"></span> 11-Jul-2025 (1)</label>
                                    <div class="nav-custom-content">
                                        <a href="#" class="employee-link">104 : Alice Wong</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card alert-info alert-top-border">
                <div class="card-header d-flex justify-content-between align-items-center px-10 py-12">
                    <h5 class="my-0 text-primary"><i data-feather="list" width="18" height="18"></i> Input Parameters For New Applicant ...</h5>
                </div>
                <div class="card-body" style="min-height: 400px;max-height: 400px; overflow-y: auto;">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 pr-0">
                            <x-input-group name="name" label="Name" type="text" placeholder="Enter name" :value="old('name')" required />
                        </div>
                        <div class="col-lg-4 col-md-6 pr-0">
                            <x-input-group name="name_bangla" label="Name Bangla" type="text" placeholder="Enter name bangla" :value="old('name_bangla')" required />
                        </div>
                        <div class="col-lg-4 col-md-6 pr-0">
                            <x-input-group name="mobile" label="Mobile" type="text" pattern="(01)[0-9]{9}" maxlength="11" placeholder="Enter mobile" :value="old('mobile')" required />
                        </div>

                        <div class="col-lg-4 col-md-6 pr-0">
                            <x-select-search-input name="department_id" id="department_id" label="Department (Apply For)" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('department_id')" required />
                        </div>

                        <div class="col-lg-4 col-md-6 pr-0">
                            <x-select-search-input name="designation_id" id="designation_id" label="Designation (Apply For)" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('designation_id')" required />
                        </div>

                        <div class="col-lg-4 col-md-6 pr-0">
                            <x-select-search-input name="district_id" label="District" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('district_id')" required />
                        </div>

                        <div class="col-lg-4 col-md-6 pr-0">
                            <x-select-input-group name="identification_type" id="identification_type" label="Identification Type" :options="['1' => 'National ID', '2' => 'Birth Certificate']" :selected="old('identification_type')" required />
                        </div>

                        <div class="col-lg-4 col-md-6 pr-0" style="display: none;">
                            <x-input-group name="national_id" label="National ID" id="national_id" type="number" pattern="[0-9]{10,17}" minlength="10" maxlength="17" placeholder="Enter national id" :value="old('national_id')" required />
                        </div>

                        <div class="col-lg-4 col-md-6 pr-0" style="display: none;">
                            <x-input-group name="birth_certificate_no" label="Birth Certificate No" id="birth_certificate_no" type="number" pattern="[0-9]{10,30}" minlength="13" maxlength="30" placeholder="Enter birth certificate no" :value="old('birth_certificate_no')" required />
                        </div>

                        <div class="col-lg-4 col-md-6 pr-0">
                            <x-input-group name="interviewer_employee_id" label="Interviewer Employee ID" id="interviewer_employee_id" type="number" pattern="[0-9]{10,30}" minlength="6" maxlength="20" placeholder="Enter interviewer employee id" :value="old('interviewer_employee_id')" />
                        </div>

                        <div class="col-lg-4 col-md-6 pr-0">
                            <x-select-input-group name="interview_status" id="interview_status" label="Interview Status" :options="['Pending' => 'Pending', 'Selected' => 'Selected', 'Disqualify' => 'Disqualify', 'Not Recruit' => 'Not Recruit']" :selected="old('interview_status')" />
                        </div>

                        <div class="col-lg-4 col-md-6 pr-0">
                            <x-input-group name="joining_date" label="Joining Date" id="joining_date" type="date" pattern="[0-9]{10,30}" minlength="6" maxlength="20" placeholder="Enter joining date" :value="old('joining_date')" />
                        </div>

                        <div class="col-lg-4 col-md-6 pr-0">
                            <x-input-group name="proposed_salary" label="Proposed Salary" id="proposed_salary" type="number" pattern="[0-9]{10,30}" minlength="3000" maxlength="999999999" placeholder="Enter proposed salary" :value="old('proposed_salary')" />
                        </div>

                        <div class="col-lg-4 col-md-6 pr-0">
                            <x-input-group name="determined_salary" label="Determined Salary" id="determined_salary" type="number" pattern="[0-9]{10,30}" minlength="3000" maxlength="999999999" placeholder="Enter determined salary" :value="old('determined_salary')" />
                        </div>

                        <div class="col-lg-4 col-md-6 pr-0">
                            <x-input-group name="remarks" label="Remarks" id="remarks" type="text" placeholder="Enter remarks" :value="old('remarks')" />
                        </div>

                        <div class="col-lg-4 col-md-6 pr-0">
                            <div class="form-check" style="margin-top: 38px;">
                                <input class="form-check-input" type="checkbox" name="ipe_assessment_required" id="ipe_assessment_required" {{ old('ipe_assessment_required') ? 'checked' : '' }}>
                                <label class="form-check-label" for="ipe_assessment_required">IPE Assessment Required</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="padding:14px 20px;">
                    <x-primary-button class="float-start btn-sm submitBtn">Submit</x-primary-button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.sex-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.sex.toggle') }}',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong!');
                    }
                });
            });
        });

        $(document).ready(function () {
            let today = new Date().toISOString().split('T')[0];
            $('#joining_date').attr('min', today);
        });

        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true
            });
        });

        $(document).on('click', '.delete-sex', function(e) {
            e.preventDefault();
            let sexId = $(this).data('id');
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
                        url: '{{ route('hris.setup.sex.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: sexId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Sex has been deleted.',
                                'success'
                            );
                            $('#row-' + sexId).remove();
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                        }
                    });
                } else {
                    Swal.fire(
                        'Cancelled!',
                        'Sex has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
