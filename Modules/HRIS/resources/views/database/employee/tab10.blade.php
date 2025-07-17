<div class="card padding-card" style="margin-bottom: 0px !important;">
    <div class="card-body" style="min-height: 400px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="row" style="border: 1px dotted #2f2f30; padding: 8px 0px;">
                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <tr>
                                <th width="30%" style="border: none;">নাম</th>
                                <td width="70%" style="border: none;"><x-text-input name="name_bangla" id="name_bangla" class="form-control-sm" placeholder="নাম" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">পিতার নাম</th>
                                <td width="70%" style="border: none;"><x-text-input name="fname_bangla" id="fname_bangla" class="form-control-sm" placeholder="পিতার নাম" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">মাতার নাম</th>
                                <td width="70%" style="border: none;"><x-text-input name="mname_bangla" id="mname_bangla" class="form-control-sm" placeholder="মাতার নাম" required /></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th width="30%" style="border: none;">সনাক্ত করণ চিহ্ন</th>
                                <td width="70%" style="border: none;"><x-text-input name="identification" id="identification" class="form-control-sm" placeholder="সনাক্ত করণ চিহ্ন" /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">আচরণ</th>
                                <td width="70%" style="border: none;"><x-text-input name="conduct" id="conduct" class="form-control-sm" placeholder="আচরণ" /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">স্বামী/স্ত্রী</th>
                                <td width="70%" style="border: none;"><x-text-input name="spouse_name_bangla" id="spouse_name_bangla" class="form-control-sm" placeholder="স্বামী/স্ত্রী" /></td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                            <tr>
                                <th width="30%" style="border: none;">নমিনি</th>
                                <td width="70%" style="border: none;"><x-text-input name="nname_bangla" id="nname_bangla" class="form-control-sm" placeholder="নমিনি" /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">মোবাইল নাম্বার </th>
                                <td width="70%" style="border: none;"><x-text-input name="mobile_number" id="mobile_number" class="form-control-sm" placeholder="মোবাইল নাম্বার" /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">সম্পর্ক</th>
                                <td width="70%" style="border: none;"><x-text-input name="spouse_name_bangla" id="spouse_name_bangla" class="form-control-sm" placeholder="স্বামী/স্ত্রী" /></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-4" style="border: 1px dotted #2f2f30; padding: 8px 0px;">
                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <h5 class="text-primary font-weight-bold">বর্তমান ঠিকানা</h5>
                            <tr>
                                <th width="30%" style="border: none;">জেলা</th>
                                <td width="70%" style="border: none;"><x-select-input name="pdistrict_id_bangla" id="pdistrict_id_bangla" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">থানা</th>
                                <td width="70%" style="border: none;">
                                    <x-select-input name="pthana_id_bangla" id="pthana_id_bangla" class="select2" :options="['1' => 'HR', '2' => 'IT']" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">ডাকঘর</th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="ppost_office_bangla" id="ppost_office_bangla" class="form-control-sm" placeholder="ডাকঘর" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">বাড়ি নং/রাস্তা নং /গ্রাম</th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="pvillage_bangla" id="pvillage_bangla" class="form-control-sm" placeholder="বাড়ি নং/রাস্তা নং /গ্রাম" required />
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <h5 class="text-primary font-weight-bold">স্থায়ী ঠিকানা</h5>
                            <tr>
                                <th width="30%" style="border: none;">জেলা</th>
                                <td width="70%" style="border: none;"><x-select-input name="mdistrict_id_bangla" id="mdistrict_id_bangla" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">থানা</th>
                                <td width="70%" style="border: none;">
                                    <x-select-input name="mthana_id_bangla" id="mthana_id_bangla" class="select2" :options="['1' => 'HR', '2' => 'IT']" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">ডাকঘর</th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="mpost_office_bangla" id="mpost_office_bangla" class="form-control-sm" placeholder="ডাকঘর" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">বাড়ি নং/রাস্তা নং /গ্রাম</th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="mvillage_bangla" id="mvillage_bangla" class="form-control-sm" placeholder="বাড়ি নং/রাস্তা নং /গ্রাম" required />
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                        <table class="table table-striped mb-0" id="employeeTable" width="100%">
                            <h5 class="text-primary font-weight-bold">নমিনির ঠিকানা</h5>
                            <tr>
                                <th width="30%" style="border: none;">জেলা</th>
                                <td width="70%" style="border: none;"><x-select-input name="ndistrict_id_bangla" id="ndistrict_id_bangla" class="select2" :options="['1' => 'HR', '2' => 'IT']" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">থানা</th>
                                <td width="70%" style="border: none;">
                                    <x-select-input name="nthana_id_bangla" id="nthana_id_bangla" class="select2" :options="['1' => 'HR', '2' => 'IT']" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">ডাকঘর</th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="npost_office_bangla" id="npost_office_bangla" class="form-control-sm" placeholder="ডাকঘর" required />
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">বাড়ি নং/রাস্তা নং /গ্রাম</th>
                                <td width="70%" style="border: none;">
                                    <x-text-input name="nvillage_bangla" id="nvillage_bangla" class="form-control-sm" placeholder="বাড়ি নং/রাস্তা নং /গ্রাম" required />
                                </td>
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
