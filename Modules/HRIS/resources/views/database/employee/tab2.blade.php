<div class="card padding-card" style="margin-bottom: 0px !important;">
    <div class="card-body" style="min-height: 300px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <tr>
                                <th width="40%" style="border: none;">Gross Salary</th>
                                <td width="60%" style="border: none;"><x-text-input name="gross_salary" id="gross_salary" class="form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" placeholder="Gross Salary" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Basic</th>
                                <td width="60%" style="border: none;"><x-text-input name="basic" id="basic" class="form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" placeholder="Basic" required readonly /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">House Rent</th>
                                <td width="60%" style="border: none;"><x-text-input name="house_rent" id="house_rent" class="form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" placeholder="House Rent" required readonly /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Medical Allowance</th>
                                <td width="60%" style="border: none;"><x-text-input name="medical" id="medical" class="form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" placeholder="Medical Allowance" required  readonly/></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Food Allowance</th>
                                <td width="60%" style="border: none;"><x-text-input name="food" id="food" class="form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" placeholder="Food Allowance" required readonly /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Conveyance</th>
                                <td width="60%" style="border: none;"><x-text-input name="conveyance" id="conveyance" type="text" class="form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" placeholder="Conveyance" required readonly /></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th width="40%" style="border: none;">Other Allowance</th>
                                <td width="60%" style="border: none;"><x-text-input name="other_allowance" id="other_allowance" type="text" class="form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" value="00.00" placeholder="Other Allowance" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Attendance Bonus</th>
                                <td width="60%" style="border: none;"><x-text-input name="attendance_bonus" id="attendance_bonus" type="text" class="form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" value="00.00" placeholder="Attendance Bonus" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Overtime Payable?</th>
                                <td width="60%" style="border: none;"><x-select-input name="overtime_payable" id="overtime_payable" label="Overtime Payable" class="select2" :options="['1' => 'Yes', '2' => 'No']" :selected="2" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Holiday Allowance?</th>
                                <td width="60%" style="border: none;"><x-select-input name="holiday_allowance" id="holiday_allowance" label="Holiday Allowance" class="select2" :options="['1' => 'Yes', '2' => 'No']" :selected="2" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Salary From Bank?</th>
                                <td width="60%" style="border: none;"><x-select-input name="salary_from_bank" id="salary_from_bank" label="Salary From Bank" class="select2" :options="['1' => 'Yes', '2' => 'No']" :selected="2" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Account No</th>
                                <td width="60%" style="border: none;"><x-text-input name="account_no" id="account_no" type="text" class="form-control-sm" placeholder="Account No" /></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-4 col-md-12 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th width="40%" style="border: none;">Mobile Banking</th>
                                <td width="60%" style="border: none;"><x-text-input name="mobile_banking" id="mobile_banking" type="text" class="form-control-sm" min="11" max="12" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Mobile Banking" /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">TIN</th>
                                <td width="60%" style="border: none;"><x-text-input name="tin" id="tin" type="text" class="form-control-sm" placeholder="TIN" /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Tax</th>
                                <td width="60%" style="border: none;"><x-text-input name="tax" id="tax" type="text" class="form-control-sm" placeholder="Tax" value="00.00" /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">PF</th>
                                <td width="60%" style="border: none;"><x-text-input name="pf" id="pf" type="text" class="form-control-sm" placeholder="PF" value="00.00" /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">No. of Family Member</th>
                                <td width="60%" style="border: none;"><x-text-input name="family_members" id="family_members" type="text" class="form-control-sm" placeholder="No. of Family Members" value="0" /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">No. of Dependants on You</th>
                                <td width="60%" style="border: none;"><x-text-input name="dependants" id="dependants" type="text" class="form-control-sm" placeholder="No. of Dependants on You" value="0" /></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer" style="padding:10px 10px;">
        <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
    </div>
</div>
