<div class="card padding-card" style="margin-bottom: 0px !important;">
    <form action="{{ route('hris.database.employee.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
    <div class="card-body" style="min-height: 400px;">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-6 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <tr>
                                <th width="30%" style="border: none;">Emp ID</th>
                                <td width="70%" style="border: none;"><x-text-input name="employee_id" id="employee_id" class="form-control-sm" value="{{ old('employee_id',$employee->employee_id) }}" placeholder="Employee ID" required readonly /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Department </th>
                                <td width="70%" style="border: none;"><x-select-input name="department_id" id="department_id" class="select2" :options="$departments" selected="{{ $employee->department_id }}" value="{{ old('department_id',$employee->department_id) }}" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Designation </th>
                                <td width="70%" style="border: none;"><x-select-input name="designation_id" id="designation_id" class="select2" :options="$designations" selected="{{ $employee->designation_id }}" value="{{ old('designation_id',$employee->designation_id) }}" required /></td>
                            </tr>
                            <tr>
                                <th style="border: none;">Joining Date </th>
                                <td style="border: none;">
                                    <x-text-input name="joining_date" id="joining_date" type="date" class="form-control-sm" placeholder="Joining Date" value="{{ old('joining_date',$employee->joining_date) }}" required />
                                </td>
                            </tr>
                            <tr>
                                <th style="border: none;">&nbsp; &nbsp;</th>
                                <td style="border: none;">&nbsp; &nbsp;</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-6 col-md-6 pe-lg-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th width="30%" style="border: none;">Unit </th>
                                <td width="70%" style="border: none;"><x-select-input name="unit" id="unit" class="select2" :options="$units" selected="{{ $employee->unit }}" value="{{ old('unit',$employee->unit) }}" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Line </th>
                                <td width="70%" style="border: none;">
                                    <x-select-input name="line" id="line" class="select2" :options="[]" selected="{{ $employee->line }}" value="{{ old('line',$employee->line) }}" required />
                                    <input type="hidden" name="line_id" id="line_id" value="{{ old('line_id',$employee->line) }}" />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Grade </th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="grade" id="grade" type="text" class="form-control-sm" value="{{ old('grade',$employee->grade) }}" placeholder="Grade" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Salaried </th>
                                <td width="70%" style="border: none;"><x-select-input name="salaried" id="salaried" label="Salaried" class="select2" :options="['Y' => 'Yes', 'N' => 'No']" selected="{{ $employee->salaried }}" value="{{ old('salaried',$employee->salaried) }}" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Confirm Date </th>
                                <td width="70%" style="border: none;"><x-text-input name="confirmation_date" id="confirmation_date" type="date" class="form-control-sm" placeholder="Confirm Date" value="{{ old('confirmation_date',$employee->confirmation_date) }}" required readonly /></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 pe-lg-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <tr>
                                <th colspan="2" style="border: none;"><span class="text-primary">Present Address</span> </th>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">District </th>
                                <td width="70%" style="border: none;"><x-select-input name="pdistrict_id" id="pdistrict_id" class="select2" :options="$districts" selected="{{ $employee->pdistrict_id }}" value="{{ old('pdistrict_id',$employee->pdistrict_id) }}" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Thana </th>
                                <td width="70%" style="border: none;">
                                    <x-select-input name="pthana_id" id="pthana_id" class="select2" :options="$thanas" selected="{{ $employee->pthana_id }}" value="{{ old('pthana_id',$employee->pthana_id) }}" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Post Office </th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="ppost_office" id="ppost_office" class="form-control-sm" value="{{ old('ppost_office',$employee->ppost_office) }}" placeholder="Post Office" value="{{ old('ppost_office',$employee->ppost_office) }}" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Address </th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="pvillage" id="pvillage" class="form-control-sm" value="{{ old('pvillage',$employee->pvillage) }}" placeholder="House No/Road No/Village ..." value="{{ old('pvillage',$employee->pvillage) }}" required />
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6 col-md-6 pe-lg-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th colspan="2" style="border: none;"><span class="text-primary">Mailing Address</span> </th>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">District </th>
                                <td width="70%" style="border: none;"><x-select-input name="mdistrict_id" id="mdistrict_id" class="select2" :options="$districts" selected="{{ $employee->mdistrict_id }}" value="{{ old('mdistrict_id',$employee->mdistrict_id) }}" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Thana </th>
                                <td width="70%" style="border: none;">
                                    <x-select-input name="mthana_id" id="mthana_id" class="select2" :options="$thanas" selected="{{ $employee->mthana_id }}" value="{{ old('mthana_id',$employee->mthana_id) }}" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Post Office </th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="mpost_office" id="mpost_office" class="form-control-sm" value="{{ old('mpost_office',$employee->mpost_office) }}" placeholder="Post Office" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Address </th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="mvillage" id="mvillage" class="form-control-sm" value="{{ old('mvillage',$employee->mvillage) }}" placeholder="House No/Road No/Village ..." required />
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pe-lg-0">
                <table class="table table-striped" id="employeeTable" width="100%">
                    <tr>
                        <th width="30%" style="border: none;">Organization </th>
                        <td width="70%" style="border: none;"><x-select-input name="org_id" id="org_id" class="select2" :options="$organizations" selected="{{ $employee->org_id }}" value="{{ old('org_id',$employee->org_id) }}" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Punch Category </th>
                        <td width="70%" style="border: none;"><x-select-input name="punch_category" id="punch_category" class="select2" :options="['1' => 'Single Punch', '2' => 'Double Punch', '3' => 'No Punch']" selected="{{ $employee->punch_category }}" value="{{ old('punch_category',$employee->punch_category) }}" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Shifting Duty? </th>
                        <td width="70%" style="border: none;"><x-select-input name="shifting_duty" id="shifting_duty" class="select2" :options="['Y' => 'Yes', 'N' => 'No']" selected="{{ $employee->shifting_duty??'N' }}" value="{{ old('shifting_duty',$employee->shifting_duty) }}" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Ref. Shift? </th>
                        <td width="70%" style="border: none;"><x-select-input name="refrerence_shift" id="refrerence_shift" class="select2" :options="$shifts" selected="{{ $employee->refrerence_shift??'G' }}" value="{{ old('refrerence_shift',$employee->refrerence_shift) }}" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Ref. Holiday? </th>
                        <td width="70%" style="border: none;"><x-select-input name="refrerence_holiday" id="refrerence_holiday" class="select2" :options="['Sunday'=>'Sunday','Monday'=>'Monday','Tuesday'=>'Tuesday','Wednesday'=>'Wednesday','Thursday'=>'Thursday','Friday'=>'Friday','Saturday'=>'Saturday']" selected="{{ $employee->refrerence_holiday??'Friday' }}" value="{{ old('refrerence_holiday',$employee->refrerence_holiday) }}" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Ref. Date </th>
                        <td width="70%" style="border: none;"><x-text-input name="refrerence_date" type="date" id="refrerence_date" class="form-control-sm" value="{{ old('refrerence_date',$employee->refrerence_date) }}" placeholder="Reference Date" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Name </th>
                        <td width="70%" style="border: none;"><x-text-input name="name" class="form-control-sm" id="name" placeholder="Name" value="{{ old('name',$employee->name) }}" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Father Name </th>
                        <td width="70%" style="border: none;"><x-text-input name="father_name" class="form-control-sm" id="father_name" placeholder="Father Name" value="{{ old('father_name',$employee->father_name) }}" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Mother Name </th>
                        <td width="70%" style="border: none;"><x-text-input name="mother_name" class="form-control-sm" id="mother_name" placeholder="Mother Name" value="{{ old('mother_name',$employee->mother_name) }}" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Spouse Name</th>
                        <td width="70%" style="border: none;"><x-text-input name="spouse_name" class="form-control-sm" id="spouse_name" placeholder="Spouse Name" value="{{ old('spouse_name',$employee->spouse_name) }}" /></td>
                    </tr>
                </table>
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
        $(document).ready(function () {
            let line = $('#line_id').val();
            let unit = $('#unit').val();

            $('#unit').on('change', function () {
                let unitcode = $(this).val();

                if (unitcode) {
                    $.ajax({
                        url: '/hris/database/unit/' + unitcode,
                        type: 'GET',
                        success: function (data) {
                            $('#line').html('<option value="">Select Line</option>');
                            $.each(data, function (key, value) {
                                $('#line').append('<option value="' + key + '">' + value + '</option>');
                            });
                            if (line) {
                                $('#line').val(line).trigger('change');
                            }
                        }
                    });
                } else {
                    $('#line').html('<option value="">Select Line</option>');
                }
            });
            if (unit) {
                $('#unit').val(unit).trigger('change');
            } else {
                $('#unit').trigger('change');
            }
        });

    </script>
@endpush
