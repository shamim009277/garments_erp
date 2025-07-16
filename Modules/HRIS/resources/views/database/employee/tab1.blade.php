<div class="card padding-card" style="margin-bottom: 0px !important;">
    <div class="card-body" style="min-height: 400px;">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-6 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <tr>
                                <th width="30%" style="border: none;">Emp ID</th>
                                <td width="70%" style="border: none;"><x-text-input name="employee_id" id="employee_id" class="form-control-sm" placeholder="Employee ID" required readonly /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Department</th>
                                <td width="70%" style="border: none;"><x-select-input name="department_id" id="department_id" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Designation</th>
                                <td width="70%" style="border: none;"><x-select-input name="designation_id" id="designation_id" class="select2" :options="['1' => 'John Doe', '2' => 'Jane Smith']" required /></td>
                            </tr>
                            <tr>
                                <th style="border: none;">Joining Date</th>
                                <td style="border: none;">
                                    <x-text-input name="joining_date" id="joining_date" type="date" class="form-control-sm" placeholder="Joining Date" required />
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
                                <th width="30%" style="border: none;">Line</th>
                                <td width="70%" style="border: none;"><x-text-input name="line" id="line" type="text" class="form-control-sm" placeholder="Line" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Grade</th>
                                <td width="70%" style="border: none;"><x-text-input name="grade" id="grade" type="text" class="form-control-sm" placeholder="Grade" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Salaried?</th>
                                <td width="70%" style="border: none;"><x-select-input name="salaried" id="salaried" label="Salaried" class="select2" :options="['1' => 'Yes', '2' => 'No']" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Confirm Date</th>
                                <td width="70%" style="border: none;"><x-text-input name="confirm_date" id="confirm_date" type="date" class="form-control-sm" placeholder="Confirm Date" required /></td>
                            </tr>
                            <tr>
                                <th style="border: none;">&nbsp; &nbsp;</th>
                                <td style="border: none;">&nbsp; &nbsp;</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 pe-lg-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <h6 class="text-primary font-weight-bold">Present Address</h6>
                            <tr>
                                <th width="30%" style="border: none;">District</th>
                                <td width="70%" style="border: none;"><x-select-input name="pdistrict_id" id="pdistrict_id" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Thana</th>
                                <td width="70%" style="border: none;">
                                    <x-select-input name="pthana_id" id="pthana_id" class="select2" :options="['1' => 'HR', '2' => 'IT']" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Post Office</th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="ppost_office" id="ppost_office" class="form-control-sm" placeholder="Post Office" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Address</th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="pvillage" id="pvillage" class="form-control-sm" placeholder="House No/Road No/Village ..." required />
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6 col-md-6 pe-lg-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <h6 class="text-primary font-weight-bold">Mailing Address</h6>
                            <tr>
                                <th width="30%" style="border: none;">District</th>
                                <td width="70%" style="border: none;"><x-select-input name="mdistrict_id" id="mdistrict_id" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Thana</th>
                                <td width="70%" style="border: none;">
                                    <x-select-input name="mthana_id" id="mthana_id" class="select2" :options="['1' => 'HR', '2' => 'IT']" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Post Office</th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="mpost_office" id="mpost_office" class="form-control-sm" placeholder="Post Office" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Address</th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="mvillage" id="mvillage" class="form-control-sm" placeholder="House No/Road No/Village ..." required />
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pe-lg-0">
                <table class="table table-striped" id="employeeTable" width="100%">
                    <tr>
                        <th width="30%" style="border: none;">Punch Category</th>
                        <td width="70%" style="border: none;"><x-select-input name="punch_category" id="punch_category" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Shifting Duty?</th>
                        <td width="70%" style="border: none;"><x-select-input name="shifting_duty" id="shifting_duty" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Reference Shift?</th>
                        <td width="70%" style="border: none;"><x-select-input name="reference_shift" id="reference_shift" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Reference Date</th>
                        <td width="70%" style="border: none;"><x-text-input name="reference_date" type="date" id="reference_date" class="form-control-sm" placeholder="Reference Date" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Name</th>
                        <td width="70%" style="border: none;"><x-text-input name="name" class="form-control-sm" placeholder="Name" :value="old('name')" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Father Name</th>
                        <td width="70%" style="border: none;"><x-text-input name="nameD" class="form-control-sm" placeholder="Father Name" :value="old('nameD')" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Mother Name</th>
                        <td width="70%" style="border: none;"><x-text-input name="nameD" class="form-control-sm" placeholder="Mother Name" :value="old('nameD')" required /></td>
                    </tr>
                    <tr>
                        <th width="30%" style="border: none;">Spouse Name</th>
                        <td width="70%" style="border: none;"><x-text-input name="nameD" class="form-control-sm" placeholder="Spouse Name" :value="old('nameD')" /></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="card-footer" style="padding:10px 10px;">
        <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
    </div>
</div>
