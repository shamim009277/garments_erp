<div class="card padding-card" style="margin-bottom: 0px !important;">
    <form action="{{ route('hris.database.employee.personal') }}" method="POST">
        @csrf
    <div class="card-body" style="min-height: 300px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="row" style="border: 1px dotted #2f2f30; padding: 8px 0px;">
                    <div class="col-lg-3 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <tr>
                                <input type="hidden" name="employee_id" id="employee_id" value="{{ $employee->employee_id }}">
                                <input type="hidden" name="org_id" id="org_id" value="{{ $employee->org_id }}">
                                <th width="35%" style="border: none;">Date of Birth</th>
                                <td width="65%" style="border: none;"><x-text-input type="date" name="birth_date" id="birth_date" class="form-control-sm" value="{{ $employee_personal->birth_date??old('birth_date') }}" placeholder="Date of Birth" required /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Place of Birth</th>
                                <td width="65%" style="border: none;"><x-select-input name="birth_district_id" id="birth_district_id" class="select2" placeholder="Place of Birth" :options="$districts" selected="{{ $employee_personal->birth_district_id??old('birth_district_id') }}" value="{{ old('birth_district_id',$employee_personal->birth_district_id??'') }}" required/></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Sex</th>
                                <td width="65%" style="border: none;"><x-select-input name="sex_code" id="sex_code" class="select2" placeholder="Sex" required :options="$sex" selected="{{ $employee_personal->sex_code??old('sex_code') }}" value="{{ old('sex_code',$employee_personal->sex_code??'') }}" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Height</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="height" id="height" class="form-control-sm" placeholder="Height" value="{{ $employee_personal->height??old('height') }}" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Weight</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="weight" id="weight" class="form-control-sm" placeholder="Weight" value="{{ $employee_personal->weight??old('weight') }}"/></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-3 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th width="35%" style="border: none;">Blood Group</th>
                                <td width="65%" style="border: none;"><x-select-input name="blood_group" id="blood_group" label="Blood Group" class="select2" :options="['A+' => 'A+', 'B+' => 'B+', 'AB+' => 'AB+', 'O+' => 'O+', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-', 'O-' => 'O-', 'N/A' => 'N/A']" :selected="$employee_personal->blood_group ?? 'N/A'" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Highest Degree</th>
                                <td width="65%" style="border: none;"><x-select-input name="degree_id" id="degree_id" label="Highest Degree" class="select2" :options="$degrees" :selected="$employee_personal->degree_id ?? 'M'" required /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Religion</th>
                                <td width="65%" style="border: none;"><x-select-input name="religion_code" id="religion_code" label="Religion" class="select2" :options="$religions" :selected="$employee_personal->religion_code ?? 'M'" required /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Nationality</th>
                                <td width="65%" style="border: none;"><x-select-input name="nationality_code" id="nationality_code" label="Nationality" class="select2" :options="$nationalities" :selected="$employee_personal->nationality_code ?? 'B'" required /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Marital Status</th>
                                <td width="65%" style="border: none;"><x-select-input name="marital_status" id="marital_status" label="Marital Status" class="select2" :options="$marital_status" :selected="$employee_personal->marital_status ?? '2'" required /></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-3 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th width="35%" style="border: none;">Mobile Number</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="mobile" id="mobile" pattern="(01)[0-9]{9}" maxlength="11" class="form-control-sm" min="11" max="12" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ $employee_personal->mobile??old('mobile') }}" placeholder="Mobile Number" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">National ID</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="national_id" id="national_id" pattern="[0-9]{10,17}" minlength="10" maxlength="17" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ $employee_personal->national_id??old('national_id') }}" class="form-control-sm" placeholder="National ID" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Birth Certificate</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="birth_certificate" id="birth_certificate" class="form-control-sm" value="{{ $employee_personal->birth_certificate??old  ('birth_certificate') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Birth Certificate" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">No. of Son</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="no_of_son" id="no_of_son" class="form-control-sm" value="{{ $employee_personal->no_of_son??old('no_of_son') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="No. of Son" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">No. of Daughter</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="no_of_daughter" id="no_of_daughter" class="form-control-sm" value="{{ $employee_personal->no_of_daughter??old('no_of_daughter') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="No. of Daughter" /></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-3 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th width="35%" style="border: none;">Children Under 5</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="children_under_5_years" id="children_under_5_years" class="form-control-sm" min="11" max="12" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Children Under 5 Years" value="{{ $employee_personal->children_under_5_years??old('children_under_5_years') }}" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Service Book No</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="service_book_no" id="service_book_no" class="form-control-sm" value="{{ $employee_personal->service_book_no??old('service_book_no') }}" placeholder="Service Book No" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Service Book Date</th>
                                <td width="65%" style="border: none;"><x-text-input type="date" name="service_book_date" id="service_book_date" class="form-control-sm" value="{{ $employee_personal->service_book_date ?? $employee->joining_date }}" placeholder="Service Book Date" readonly /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Email</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="email" id="email" class="form-control-sm" placeholder="Email" value="{{ $employee_personal->email??old('email') }}" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Assessment ID</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="assessment_id" id="assessment_id" class="form-control-sm" placeholder="Assessment ID" value="{{ $employee_personal->assessment_id??old('assessment_id') }}" /></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-4" style="border: 1px dotted #2f2f30; padding: 8px 0px;">
                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <h6 class="text-primary">Nominee Information</h6>
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th width="35%" style="border: none;">Nominee Name</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="nominee_name" id="nominee_name" class="form-control-sm" placeholder="Nominee Name" value="{{ $employee_personal->nominee_name??old('nominee_name') }}" required/></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Relation</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="relation" id="relation" class="form-control-sm" placeholder="Relation" value="{{ $employee_personal->relation??old('relation') }}" required/></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Mobile Number</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="nominee_mobile" id="nominee_mobile" pattern="(01)[0-9]{9}" maxlength="11" class="form-control-sm" value="{{ $employee_personal->nominee_mobile??old('nominee_mobile') }}" placeholder="Mobile Number" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">NID Number</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="nominee_nid" id="nominee_nid" pattern="[0-9]{10,17}" minlength="10" maxlength="17" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control-sm" value="{{ $employee_personal->nominee_nid??old('nominee_nid') }}" placeholder="NID Number" /></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <h6 class="text-primary">Nominee Information</h6>
                            <tr>
                                <th width="35%" style="border: none;">District</th>
                                <td width="65%" style="border: none;"><x-select-input name="ndistrict_id" id="ndistrict_id" label="District" class="select2" :options="$districts" :selected="$employee_personal->ndistrict_id ?? ''" required /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Thana</th>
                                <td width="65%" style="border: none;"><x-select-input name="nthana_id" id="nthana_id" label="Thana" class="select2" :options="$thanas" :selected="$employee_personal->nthana_id ?? ''" required /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Post Office</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="npost_office" id="npost_office" class="form-control-sm" value="{{ $employee_personal->npost_office??old('npost_office') }}" placeholder="Post Office" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Address</th>
                                <td width="65%" style="border: none;"><x-text-input type="text" name="nvillage" id="nvillage" class="form-control-sm" value="{{ $employee_personal->nvillage??old('nvillage') }}" placeholder="Address" /></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer mb-4" style="padding:10px 10px;">
        <x-primary-button class="float-start btn-sm submitBtn">Update</x-primary-button>
    </div>
    </form>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        var today = new Date().toISOString().split('T')[0];
        $('#birth_date').attr('max', today);

        $('#ndistrict_id').on('change', function() {
            $('#nthana_id').empty();
            let districtId = $(this).val();
            if (districtId) {
                $.ajax({
                    url: '/hris/database/district/' + districtId,
                    type: 'GET',
                    success: function(data) {
                        $('#nthana_id').empty();
                        $('#nthana_id').append('<option value="">Select Thana</option>');
                        $.each(data, function(key, value) {
                            $('#nthana_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            }
        });

        //$('#ndistrict_id').trigger('change');
    });
</script>
@endpush
