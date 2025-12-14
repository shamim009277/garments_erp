@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
@push('styles')
<style>
.table, tr, th, td {
    border: none !important;
    border-collapse: collapse;
}
#photoPreview {
    width: 133px;
    height: 133px;
    display: block;
}
</style>
@endpush
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Designation Change',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Tools', 'url' => route('hris.index')],
                    ['label' => 'Designation Change', 'url' => route('hris.tools.designationchange.index')],
                ],
            ])
        </div>
        <div class="col-lg-8 col-md-8 ps-lg-1 ps-md-1" style="margin:0px auto;">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Designation Change</h6>
                </div>
                <form action="{{ route('hris.tools.designationchange.store') }}" id="applicantForm" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="card border">
                        <div class="card-body" style="overflow-y: auto;">
                            <div class="row">
                                <div class="col-lg-7 pe-lg-0">
                                    <table class="table table-striped mb-0" width="100%">
                                        <tr>
                                            <th width="35%">Employee ID</th>
                                            <td width="65%"><x-text-input name="employee_id" id="employee_id" class="form-control-sm" placeholder="Employee ID" /></td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td><x-text-input name="name" id="name" class="form-control-sm" placeholder="Employee Name" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th>Designation</th>
                                            <td>
                                                <input type="hidden" name="designation_id" id="designation_id">
                                                <input type="hidden" name="org_id" id="org_id">
                                                <x-text-input name="designation" id="designation" class="form-control-sm" placeholder="Designation" readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Department</th>
                                            <td>
                                                <input type="hidden" name="department_id" id="department_id">
                                                <x-text-input name="department" id="department" class="form-control-sm" placeholder="Department" readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Joining Date</th>
                                            <td><x-text-input name="join_date" id="join_date" type="text" class="form-control-sm" placeholder="Joining Date" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th>NID/Birth Certificate</th>
                                            <td><x-text-input name="nid" id="nid" class="form-control-sm" placeholder="NID/Birth Certificate" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th>Mobile</th>
                                            <td><x-text-input name="mobile" id="mobile" class="form-control-sm" placeholder="Mobile" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th>Tenure (Y/M/D)</th>
                                            <td>
                                                <div class="d-flex">
                                                    <x-text-input name="year" id="year" class="form-control-sm me-1" placeholder="Year" width="22%" readonly/>
                                                    <x-text-input name="month" id="month" class="form-control-sm me-1" placeholder="Month" width="21%" readonly/>
                                                    <x-text-input name="day" id="day" class="form-control-sm" placeholder="Day" width="22%" readonly/>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-5">
                                    <table class="table table-striped mb-0" width="100%">
                                        <tr>
                                            <th width="40%">New Designation</th>
                                            <td width="60%"><x-select-input name="new_designation_id" id="new_designation_id" class="select2" :options="$designations" :selected="old('reason')" required /></td>
                                        </tr>
                                        <tr>
                                            <th>New Department</th>
                                            <td><x-select-input name="new_department_id" id="new_department_id" class="select2" :options="$departments" :selected="old('reason')" required /></td>
                                        </tr>
                                        <tr>
                                            <th>New Organization</th>
                                            <td><x-select-input name="new_org_id" id="new_org_id" class="select2" :options="$organizations" :selected="selected_org($organizations)" required /></td>
                                        </tr>
                                        <tr>
                                            <th>Reason</th>
                                            <td>
                                                <x-text-input name="reason" id="reason" class="form-control-sm" value="{{ old('reason') }}" autocomplete="off" placeholder="Reason" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Photo</th>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <img id="photoPreview" src="{{ asset('backend/assets/images/demo.png') }}" alt="Photo Preview" class="img-fluid rounded shadow-sm">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="padding:10px 16px;">
                            <x-primary-button class="float-start btn-sm submitBtn">Save Changes</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // Initialize Select2
        $('.select2').select2({
            placeholder: "Select an option",
            allowClear: true,
            width: '100%'
        });

        // Image preview
        $('input[name="document"]').on('change', function () {
            const [file] = this.files;
            if (file) {
                $('#photoPreview').attr('src', URL.createObjectURL(file));
            }
        });

        $('#reason').on('change', function () {
            let reason = $(this).val();
            if (reason == 'Maternity Leave') {
                $('#mtreturn_date').prop('required', true);
            } else {
                $('#mtreturn_date').prop('required', false);
            }
        });
    });

    function employeeInfo() {
        let employeeId = $("#employee_id").val();

        if (employeeId.length >= 6) {
            $.ajax({
                url: "{{ route('hris.tools.departure.info') }}",
                type: "POST",
            data: {
                employee_id: employeeId
            },
            success: function (response) {
                $("#name").val('');
                $("#designation").val('');
                $("#department").val('');
                $("#join_date").val('');
                $("#designation_id").val('');
                $("#department_id").val('');

                if (response && Object.keys(response).length > 0) {
                    $("#name").val(response.name || '');
                    $("#designation").val(response.designation?.designation || '');
                    $("#department").val(response.department?.department || '');
                    $("#join_date").val(response.joining_date || '');

                    if(response.joining_date){
                        let start = new Date(response.joining_date);
                        let today = new Date();

                        let years = today.getFullYear() - start.getFullYear();
                        let months = today.getMonth() - start.getMonth();
                        let days = today.getDate() - start.getDate();

                        if (days < 0) {
                            days = 0;
                        }
                        if (months < 0) {
                            months = 0;
                        }

                        $("#year").val(years);
                        $("#month").val(months);
                        $("#day").val(days);
                    }
                    $("#designation_id").val(response.designation_id || '');
                    $("#department_id").val(response.department_id || '');
                    if(response.photo){
                        $('#photoPreview').attr('src', '/storage/' + response.photo);
                    }
                    if(response.employee_personal?.national_id){
                        $('#nid').val(response.employee_personal.national_id);
                    }
                    if(response.employee_personal?.birth_certificate){
                        $('#nid').val(response.employee_personal.birth_certificate);
                    }
                    if(response.employee_personal?.mobile){
                        $('#mobile').val(response.employee_personal.mobile);
                    }
                    $("#org_id").val(response.org_id || '').change();
                    $("#new_org_id").val(response.org_id || '').change();
                    $("#new_designation_id").val(response.designation_id || '').change();
                    $("#new_department_id").val(response.department_id || '').change();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load employee info.',
                    });
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
        }
    }

    employeeInfo();
    $("#employee_id").on("input", function () {
        employeeInfo();
    });
</script>
@endpush
