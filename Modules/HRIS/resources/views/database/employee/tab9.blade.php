<div class="card padding-card" style="margin-bottom: 0px !important;">
    <div class="card-body" style="min-height: 300px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <tr>
                                <th width="35%" style="border: none;">Date of Birth</th>
                                <td width="65%" style="border: none;"><x-text-input name="birth_date" id="birth_date" class="form-control-sm" type="date" placeholder="Date of Birth" required /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Place of Birth</th>
                                <td width="65%" style="border: none;"><x-select-input name="birth_place" id="birth_place" class="select2" placeholder="Place of Birth"  required/></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Sex</th>
                                <td width="65%" style="border: none;"><x-select-input name="sex" id="sex" class="select2" placeholder="Sex" required :options="['1' => 'Male', '2' => 'Female']" :selected="2" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Height</th>
                                <td width="65%" style="border: none;"><x-text-input name="height" id="height" class="form-control-sm" placeholder="Height" required/></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Weight</th>
                                <td width="65%" style="border: none;"><x-text-input name="weight" id="weight" class="form-control-sm" placeholder="Weight" required/></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-3 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th width="35%" style="border: none;">Blood Group</th>
                                <td width="65%" style="border: none;"><x-text-input name="blood_group" id="blood_group" type="text" class="form-control-sm" placeholder="Blood Group" required /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Height Degree</th>
                                <td width="65%" style="border: none;"><x-select-input name="height_degree" id="height_degree" label="Height Degree" class="select2" :options="['1' => 'Yes', '2' => 'No']" :selected="2" required /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Religion</th>
                                <td width="65%" style="border: none;"><x-select-input name="religion" id="religion" label="Religion" class="select2" :options="['1' => 'Yes', '2' => 'No']" :selected="2" required /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Nationality</th>
                                <td width="65%" style="border: none;"><x-select-input name="nationality" id="nationality" label="Nationality" class="select2" :options="['1' => 'Yes', '2' => 'No']" :selected="2" required /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Marital Status</th>
                                <td width="65%" style="border: none;"><x-select-input name="marital_status" id="marital_status" label="Marital Status" class="select2" :options="['1' => 'Yes', '2' => 'No']" :selected="2" required /></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-3 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th width="35%" style="border: none;">Mobile Number</th>
                                <td width="65%" style="border: none;"><x-text-input name="mobile_number" id="mobile_number" type="text" class="form-control-sm" min="11" max="12" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Mobile Number" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">National ID</th>
                                <td width="65%" style="border: none;"><x-text-input name="national_id" id="national_id" type="text" class="form-control-sm" placeholder="National ID" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Birth Certificate</th>
                                <td width="65%" style="border: none;"><x-text-input name="birth_certificate" id="birth_certificate" type="text" class="form-control-sm" placeholder="Birth Certificate" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">No. of Son</th>
                                <td width="65%" style="border: none;"><x-text-input name="no_of_son" id="no_of_son" type="text" class="form-control-sm" value="0" placeholder="No. of Son" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">No. of Daughter</th>
                                <td width="65%" style="border: none;"><x-text-input name="no_of_daughter" id="no_of_daughter" type="text" class="form-control-sm" value="0" placeholder="No. of Daughter" /></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-3 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th width="35%" style="border: none;">Children Under 5 Years</th>
                                <td width="65%" style="border: none;"><x-text-input name="children_under_5_years" id="children_under_5_years" type="text" class="form-control-sm" min="11" max="12" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Children Under 5 Years" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Service Book Date</th>
                                <td width="65%" style="border: none;"><x-text-input name="service_book_date" id="service_book_on_date" type="text" class="form-control-sm" placeholder="Service Book On Date" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Email</th>
                                <td width="65%" style="border: none;"><x-text-input name="email" id="email" type="text" class="form-control-sm" placeholder="Email" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Assessment ID</th>
                                <td width="65%" style="border: none;"><x-text-input name="assessment_id" id="assessment_id" type="text" class="form-control-sm" placeholder="Assessment ID" /></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <h6 class="text-primary">Nominee Information</h6>
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th width="35%" style="border: none;">Nominee</th>
                                <td width="65%" style="border: none;"><x-text-input name="nominee" id="nominee" type="text" class="form-control-sm" placeholder="Nominee" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Relation</th>
                                <td width="65%" style="border: none;"><x-text-input name="relation" id="relation" type="text" class="form-control-sm" placeholder="Relation" /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Mobile Number</th>
                                <td width="65%" style="border: none;"><x-text-input name="mobile_number" id="mobile_number" type="text" class="form-control-sm" placeholder="Mobile Number" /></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <h6 class="text-primary">Nominee Information</h6>
                            <tr>
                                <th width="35%" style="border: none;">District</th>
                                <td width="65%" style="border: none;"><x-select-input name="district_id" id="district_id" label="District" class="select2" :options="['1' => 'Yes', '2' => 'No']" :selected="2" required /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Thana</th>
                                <td width="65%" style="border: none;"><x-select-input name="thana_id" id="thana_id" label="Thana" class="select2" :options="['1' => 'Yes', '2' => 'No']" :selected="2" required /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Post Office</th>
                                <td width="65%" style="border: none;"><x-select-input name="post_office_id" id="post_office_id" label="Post Office" class="select2" :options="['1' => 'Yes', '2' => 'No']" :selected="2" required /></td>
                            </tr>
                            <tr>
                                <th width="35%" style="border: none;">Address</th>
                                <td width="65%" style="border: none;"><x-text-input name="address" id="address" type="text" class="form-control-sm" placeholder="Address" /></td>
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
