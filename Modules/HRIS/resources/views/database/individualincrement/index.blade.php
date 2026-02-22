@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Leave Application',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Employee Increment', 'url' => route('hris.database.individual-increment.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Employee Individual Increment
                </h4>
            </div>
        </div>
        <div class="col-lg-10 pe-lg-0" style="margin: 0 auto;">
            <form action="{{ route('hris.database.individual-increment.store') }}" method="POST">
                @csrf
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Input Parameters For Employee Increment</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 pe-lg-0 pe-md-0">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%">Employee ID</th>
                                            <td style="width: 70%">
                                                <x-text-input name="employee_id" id="employee_id" label="" class="form-control-sm" placeholder="Employee ID" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Increment Type</th>
                                            <td style="width: 70%">
                                                <x-select-input name="increment_type_id" id="increment_type_id" class="select2" :options="$types" required />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">
                                                <label class="m-0" for="increment_date">Increment Date</label>
                                            </td>
                                            <td width="70%">
                                                <x-text-input type="date" name="increment_date" id="increment_date" class="form-control form-control-sm" value="{{ $lastMonthStart }}" placeholder="Increment Date" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">
                                                <label class="m-0" for="effective_date">Effective Date</label>
                                            </td>
                                            <td width="70%">
                                                <x-text-input type="date" name="effective_date" id="effective_date" class="form-control form-control-sm" value="{{ $lastMonthStart }}" placeholder="Effective Date" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="30%">
                                                <label class="m-0" for="arrear_upto_date">Arrear Upto Date</label>
                                            </td>
                                            <td width="70%">
                                                <x-text-input type="date" name="arrear_upto_date" id="arrear_upto_date" class="form-control form-control-sm" placeholder="YYYY-MM-DD" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="30%">New Designation</th>
                                            <td width="70%"><x-select-input name="new_designation_id" id="new_designation_id" class="select2" :options="$designations" :selected="old('reason')" /></td>
                                        </tr>
                                        <tr>
                                            <th>New Department</th>
                                            <td><x-select-input name="new_department_id" id="new_department_id" class="select2" :options="$departments" :selected="old('reason')" /></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">
                                                <label class="m-0" for="arrear_upto_date">Increment Amount</label>
                                            </td>
                                            <td width="70%">
                                                <x-text-input type="number" name="increment_amount" id="increment_amount" class="form-control form-control-sm" min="0" placeholder="Increment Amount" required />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-5 col-md-6 pe-lg-0 pe-md-0">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%">Organization</th>
                                            <td style="width: 70%">
                                                <x-text-input name="Org_name" id="Org_name" label="" class="form-control-sm" placeholder="Organization Name" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Name</th>
                                            <td style="width: 70%">
                                                <x-text-input name="name" id="name" label="" class="form-control-sm" placeholder="Name" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Designation</th>
                                            <td style="width: 70%">
                                                <input type="hidden" name="designation_id" id="designation_id" class="form-control-sm" placeholder="Designation" required readonly/>
                                                <x-text-input name="designation" id="designation" label="" class="form-control-sm" placeholder="Designation" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Department</th>
                                            <td style="width: 70%">
                                                <input type="hidden" name="department_id" id="department_id" class="form-control-sm" placeholder="Department" required readonly/>
                                                <x-text-input name="department" id="department" label="" class="form-control-sm" placeholder="Department" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Employee Type</th>
                                            <td style="width: 70%">
                                                <input type="hidden" name="employee_type_id" id="employee_type_id" class="form-control-sm" placeholder="Employee Type" required readonly/>
                                                <x-text-input name="employee_type" id="employee_type" label="" class="form-control-sm" placeholder="Employee Type" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Join Date</th>
                                            <td style="width: 70%">
                                                <x-text-input name="join_date" type="text" id="join_date" label="" class="form-control-sm" placeholder="Join Date" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Current Salary</th>
                                            <td style="width: 70%">
                                                <x-text-input name="current_salary" type="text" id="current_salary" label="" class="form-control-sm" placeholder="Current Salary" required readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 30%">Remarks</th>
                                            <td style="width: 70%">
                                                <x-text-input name="remarks" id="remarks" label="" class="form-control-sm" placeholder="Remarks" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-2" style="padding:0px;">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 100%;text-align: center">Photo</th>
                                        </tr>
                                        <tr>
                                            <td style="display: flex; justify-content: center; align-items: center;">
                                                <img src="{{ asset('backend/assets/images/demo.png') }}" alt="Photo" id="photo" class="img-fluid" style="width: 160px; height: 219px; object-fit: cover; padding: 2px;">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer px-3 py-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <p id="message" class="mb-0" style="color:#FF6C37;font-weight:semi-bold"></p>
                            <x-primary-button id="submitBtn" type="submit" class="btn btn-sm btn-primary submitBtn">Submit</x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            function employeeInfo() {
                let employeeId = $("#employee_id").val();

                if (employeeId.length >= 8) {
                    $.ajax({
                        url: "{{ route('hris.database.individual-increment.info') }}",
                        type: "POST",
                        data: {
                            employee_id: employeeId
                          },
                        success: function (response) {
                            console.log(response);
                            $("#message").text('');
                            $("#name").val('');
                            $("#designation").val('');
                            $("#department").val('');
                            $("#join_date").val('');
                            $("#mobile").val('');
                            $("#nid_birth_certificate").val('');
                            $("#designation_id").val('');
                            $("#department_id").val('');
                            $("#current_salary").val(response.employee.employee_salary?.gross_salary || '');
                            $("#Org_name").val();
                            $("#employee_type").val();
                            $("#new_designation_id").val('');
                            $("#new_department_id").val('');

                            if (response.employee && Object.keys(response.employee).length > 0) {
                                $("#Org_name").val(response.employee.organization?.short_name || '');
                                $("#name").val(response.employee.name || '');
                                $("#designation").val(response.employee.designation?.designation || '');
                                $("#department").val(response.employee.department?.department || '');
                                $("#join_date").val(response.employee.joining_date || '');
                                $("#mobile").val(response.employee.employee_personal?.mobile || '');
                                $("#designation_id").val(response.employee.designation_id || '');
                                $("#department_id").val(response.employee.department_id || '');
                                $("#current_salary").val(response.employee.employee_salary?.gross_salary || '');
                                $("#employee_type").val(response.employee.designation?.category_code || '');

                                $("#new_designation_id").val(response.employee.designation_id || '').trigger('change');
                                $("#new_department_id").val(response.employee.department_id || '').trigger('change');

                                if (response.employee.photo) {
                                    $('#photo').attr('src', '/storage/' + response.employee.photo);
                                }
                            } else {
                                
                            }
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to load employee info.',
                            });
                        }
                    });
                }else{
                    $("#name").val('');
                    $("#designation").val('');
                    $("#department").val('');
                    $("#join_date").val('');
                    $("#mobile").val('');
                    $("#nid_birth_certificate").val('');
                    $("#designation_id").val('');
                    $("#department_id").val('');
                    $("#current_salary").val('');
                    $("#Org_name").val('');
                    $("#employee_type").val('');
                    $('#photo').attr('src', "{{ asset('backend/assets/images/demo.png') }}");
                    $("#new_designation_id").val('');
                    $("#new_department_id").val('');

                    $("#message").text('Employee ID must be exactly 8 digits');
                }
            }


            employeeInfo();
            $("#employee_id").on("input", function () {
                employeeInfo();
            });
        });
    </script>
@endpush
