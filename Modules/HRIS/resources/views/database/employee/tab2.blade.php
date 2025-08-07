<div class="card padding-card" style="margin-bottom: 0px !important;">
    <form action="{{ route('hris.database.employee.salary') }}" method="POST">
        @csrf
        <div class="card-body" style="min-height: 400px;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                            <table class="table table-striped mb-0" id="employeeTable" width="100%">
                                <tr>
                                    <input type="hidden" name="employee_id" id="employee_id" value="{{ $employee->employee_id ?? 0 }}">
                                    <input type="hidden" name="org_id" id="org_id" value="{{ $employee->org_id ?? 0 }}">
                                    <th width="40%" style="border: none;">Gross Salary </th>
                                    <td width="60%" style="border: none;"><x-text-input name="gross_salary" id="gross_salary" class="form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" value="{{ $employee_salary->gross_salary }}" placeholder="Gross Salary" required /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">Basic </th>
                                    <td width="60%" style="border: none;"><x-text-input name="basic" id="basic" class="form-control-sm" value="{{ $employee_salary->basic }}" placeholder="Basic" required readonly /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">House Rent </th>
                                    <td width="60%" style="border: none;"><x-text-input name="home_allowance" id="home_allowance" class="form-control-sm"  value="{{ $employee_salary->home_allowance }}" placeholder="House Rent" required readonly /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">Medical Allowance </th>
                                    <td width="60%" style="border: none;"><x-text-input name="medical_allowance" id="medical" class="form-control-sm" value="{{ $employee_salary->medical_allowance }}" placeholder="Medical Allowance" required  readonly/></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">Food Allowance </th>
                                    <td width="60%" style="border: none;"><x-text-input name="food_allowance" id="food" class="form-control-sm"  value="{{ $employee_salary->food_allowance }}" placeholder="Food Allowance" required readonly /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">Conveyance </th>
                                    <td width="60%" style="border: none;"><x-text-input name="conveyance" id="conveyance" type="text" class="form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" value="{{ $employee_salary->conveyance }}" placeholder="Conveyance" required readonly /></td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                            <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                                <tr>
                                    <th width="40%" style="border: none;">Other Allowance </th>
                                    <td width="60%" style="border: none;"><x-text-input name="other_allowance" id="other_allowance" type="text" class="form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" value="{{ $employee_salary->other_allowance }}" placeholder="Other Allowance" required /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">Attendance Bonus </th>
                                    <td width="60%" style="border: none;"><x-text-input name="attendance_bonus" id="attendance_bonus" type="text" class="form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" value="{{ $employee_salary->attendance_bonus }}" placeholder="Attendance Bonus" required /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">Overtime Payable </th>
                                    <td width="60%" style="border: none;"><x-select-input name="ot_payable" id="overtime_payable" label="Overtime Payable" class="select2" :options="['Y' => 'Yes', 'N' => 'No']" :selected="($employee_salary->ot_payable ?? 'N')" value="{{ old('ot_payable',$employee_salary->ot_payable) }}" required /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">Holiday Allowance </th>
                                    <td width="60%" style="border: none;"><x-select-input name="holiday_allowance" id="holiday_allowance" label="Holiday Allowance" class="select2" :options="['Y' => 'Yes', 'N' => 'No']" :selected="($employee_salary->holiday_allowance ?? 'N')" value="{{ old('holiday_allowance',$employee_salary->holiday_allowance) }}" required /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">Salary From Bank </th>
                                    <td width="60%" style="border: none;"><x-select-input name="salary_from_bank" id="salary_from_bank" label="Salary From Bank" class="select2" :options="['Y' => 'Yes', 'N' => 'No']" :selected="($employee_salary->salary_from_bank ?? 'N')" value="{{ old('salary_from_bank',$employee_salary->salary_from_bank) }}" required /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">Account No</th>
                                    <td width="60%" style="border: none;"><x-text-input name="account_no" id="account_no" type="text" class="form-control-sm" value="{{ $employee_salary->account_no }}" placeholder="Account No" /></td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-lg-4 col-md-12 pe-lg-0 pe-md-0">
                            <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                                <tr>
                                    <th width="40%" style="border: none;">Mobile Banking</th>
                                    <td width="60%" style="border: none;"><x-text-input name="mobile_banking" id="mobile_banking" type="text" class="form-control-sm" min="11" max="12" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ $employee_salary->mobile_banking }}" placeholder="Mobile Banking" /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">TIN</th>
                                    <td width="60%" style="border: none;"><x-text-input name="tin" id="tin" type="text" class="form-control-sm" value="{{ $employee_salary->tin }}" placeholder="TIN" /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">Tax</th>
                                    <td width="60%" style="border: none;"><x-text-input name="tax" id="tax" type="text" class="form-control-sm" value="{{ $employee_salary->tax }}" placeholder="Tax" /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">PF</th>
                                    <td width="60%" style="border: none;"><x-text-input name="pf" id="pf" type="text" class="form-control-sm" value="{{ $employee_salary->pf }}" placeholder="PF" /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">No. of Family Member</th>
                                    <td width="60%" style="border: none;"><x-text-input name="family_members" id="family_members" type="text" class="form-control-sm" value="{{ $employee_salary->family_members }}" placeholder="No. of Family Members" /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">No. of Dependants on You</th>
                                    <td width="60%" style="border: none;"><x-text-input name="dependants" id="dependants" type="text" class="form-control-sm" value="{{ $employee_salary->dependants }}" placeholder="No. of Dependants on You" /></td>
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
    let setting = @json($setting ?? []);

    $('#gross_salary').on('input', function () {
        let gross = parseFloat($(this).val()) || 0;

        let medical = parseFloat(setting.medical_allowance ?? 0);
        let food = parseFloat(setting.food_allowance ?? 0);
        let conveyance = parseFloat(setting.conveyance ?? 0);
        let hr_percent = parseFloat(setting.house_rant_percent_basic ?? 0);

        let total_allowance = medical + food + conveyance;
        let basic = Math.round((gross - total_allowance) / ((hr_percent + 100) / 100));
        let house_rent = Math.round((basic / 100) * hr_percent);
        console.log(basic, house_rent);
        $('#basic').val(isNaN(basic) ? 0 : basic);
        $('#home_allowance').val(isNaN(house_rent) ? 0 : house_rent);
    });
</script>
@endpush
