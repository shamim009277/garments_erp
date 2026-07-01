<div class="card padding-card" style="margin-bottom: 0px !important;">
    <form action="{{ route('hris.database.employee.bangla') }}" method="POST">
        @csrf
        <div class="card-body" style="min-height: 400px;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row" style="border: 1px dotted #2f2f30; padding: 8px 0px;">
                        <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                            <table class="table table-striped mb-0" id="employeeTable" width="100%">
                                <input type="hidden" name="employee_id" id="employee_id"
                                    value="{{ $employee->employee_id }}">
                                <input type="hidden" name="org_id" id="org_id" value="{{ $employee->org_id }}">
                                <tr>
                                    <th width="30%" style="border: none;">নাম </th>
                                    <td width="70%" style="border: none;"><x-text-input name="name_bangla"
                                            id="name_bangla" class="form-control-sm"
                                            value="{{ $employee_bangla->name_bangla ?? old('name_bangla') }}"
                                            placeholder="নাম" required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">পিতার নাম </th>
                                    <td width="70%" style="border: none;"><x-text-input name="fname_bangla"
                                            id="fname_bangla" class="form-control-sm"
                                            value="{{ $employee_bangla->fname_bangla ?? old('fname_bangla') }}"
                                            placeholder="পিতার নাম" required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">মাতার নাম </th>
                                    <td width="70%" style="border: none;"><x-text-input name="mname_bangla"
                                            id="mname_bangla" class="form-control-sm"
                                            value="{{ $employee_bangla->mname_bangla ?? old('mname_bangla') }}"
                                            placeholder="মাতার নাম" required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">স্বামী/স্ত্রী</th>
                                    <td width="70%" style="border: none;"><x-text-input name="spouse_name_bangla"
                                            id="spouse_name_bangla" class="form-control-sm" placeholder="স্বামী/স্ত্রী"
                                            value="{{ old('spouse_name_bangla', $employee_bangla->spouse_name_bangla ?? old('spouse_name_bangla')) }}" />
                                    </td>
                                </tr>
                                <tr>
                                    <th style="border: none;">&nbsp; &nbsp;</th>
                                    <td style="border: none;">&nbsp; &nbsp;</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                            <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                                <tr>
                                    <th width="30%" style="border: none;">সনাক্ত করণ চিহ্ন</th>
                                    <td width="70%" style="border: none;"><x-text-input name="identification"
                                            id="identification" class="form-control-sm" placeholder="সনাক্ত করণ চিহ্ন"
                                            value="{{ old('identification', $employee_bangla->identification ?? old('identification')) }}" />
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">আচরণ</th>
                                    <td width="70%" style="border: none;"><x-text-input name="conduct" id="conduct"
                                            class="form-control-sm" placeholder="আচরণ"
                                            value="{{ old('conduct', $employee_bangla->conduct ?? old('conduct')) }}" />
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">নমিনির নাম </th>
                                    <td width="70%" style="border: none;"><x-text-input name="nname_bangla"
                                            id="nname_bangla" class="form-control-sm" placeholder="নমিনির নাম"
                                            value="{{ old('nname_bangla', $employee_bangla->nname_bangla ?? old('nname_bangla')) }}"
                                            required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">মোবাইল নাম্বার </th>
                                    <td width="70%" style="border: none;"><x-text-input name="nmobile_number"
                                            id="mobile_number" pattern="[0-9]{11}"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                                            class="form-control-sm" placeholder="নমিনির মোবাইল নাম্বার"
                                            value="{{ old('nmobile_number', $employee_bangla->nmobile_number ?? old('nmobile_number')) }}"
                                            required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">সম্পর্ক </th>
                                    <td width="70%" style="border: none;"><x-text-input name="nominee_relation"
                                            id="nominee_relation" class="form-control-sm"
                                            placeholder="নমিনির সম্পর্ক"
                                            value="{{ old('nominee_relation', $employee_bangla->nominee_relation ?? old('nominee_relation')) }}"
                                            required /></td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                            <table class="table table-striped mb-0" id="presentAddressTable" width="100%">
                                <h5 class="text-primary font-weight-bold">জরুরী যোগাযোগ</h5>
                                <tr>
                                    <th width="30%" style="border: none;">নাম</th>
                                    <td width="70%" style="border: none;"><x-text-input type="text"
                                            name="emergency_name" id="emergency_name" class="form-control-sm"
                                            value="{{ $employee_bangla->emergency_name ?? old('emergency_name') }}"
                                            placeholder="নাম" /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">মোবাইল নাম্বার</th>
                                    <td width="70%" style="border: none;"><x-text-input type="text"
                                            name="emergency_mobile" id="emergency_mobile" pattern="(01)[0-9]{9}"
                                            maxlength="11" oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                            class="form-control-sm"
                                            value="{{ $employee_bangla->emergency_mobile ?? old('emergency_mobile') }}"
                                            placeholder="মোবাইল নাম্বার" /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">সম্পর্ক</th>
                                    <td width="70%" style="border: none;"><x-text-input type="text"
                                            name="emergency_relation" id="emergency_relation" class="form-control-sm"
                                            value="{{ $employee_bangla->emergency_relation ?? old('emergency_relation') }}"
                                            placeholder="সম্পর্ক" /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">ঠিকানা</th>
                                    <td width="70%" style="border: none;"><x-text-input type="text"
                                            name="emergency_address" id="emergency_address" class="form-control-sm"
                                            value="{{ $employee_bangla->emergency_address ?? old('emergency_address') }}"
                                            placeholder="ঠিকানা" /></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4" style="border: 1px dotted #2f2f30; padding: 8px 0px;">
                        <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                            <table class="table table-striped mb-0" id="employeeTable" width="100%">
                                <h5 class="text-primary font-weight-bold">বর্তমান ঠিকানা</h5>
                                <tr>
                                    <th width="30%" style="border: none;">জেলা </th>
                                    <td width="70%" style="border: none;"><x-select-input
                                            name="pdistrict_id_bangla" id="pdistrict_id_bangla" class="select2"
                                            :options="$districts"
                                            selected="{{ $employee_bangla->pdistrict_id_bangla ?? old('pdistrict_id_bangla') }}"
                                            value="{{ old('pdistrict_id_bangla', $employee_bangla->pdistrict_id_bangla) }}"
                                            required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">থানা </th>
                                    <td width="70%" style="border: none;">
                                        <x-select-input name="pthana_id_bangla" id="pthana_id_bangla" class="select2"
                                            :options="$thanas"
                                            selected="{{ $employee_bangla->pthana_id_bangla ?? old('pthana_id_bangla') }}"
                                            value="{{ old('pthana_id_bangla', $employee_bangla->pthana_id_bangla ?? old('pthana_id_bangla')) }}"
                                            required />
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">ডাকঘর </th>
                                    <td width="70%" style="border: none;">
                                        <x-text-input name="ppost_office_bangla" id="ppost_office_bangla"
                                            class="form-control-sm"
                                            value="{{ $employee_bangla->ppost_office_bangla ?? old('ppost_office_bangla') }}"
                                            placeholder="ডাকঘর" required />
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">বাড়ি নং/রাস্তা নং /গ্রাম </th>
                                    <td width="70%" style="border: none;">
                                        <x-text-input name="pvillage_bangla" id="pvillage_bangla"
                                            class="form-control-sm"
                                            value="{{ $employee_bangla->pvillage_bangla ?? old('pvillage_bangla') }}"
                                            placeholder="বাড়ি নং/রাস্তা নং /গ্রাম" required />
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                            <table class="table table-striped mb-0" id="employeeTable" width="100%">
                                <h5 class="text-primary font-weight-bold">স্থায়ী ঠিকানা</h5>
                                <tr>
                                    <th width="30%" style="border: none;">জেলা </th>
                                    <td width="70%" style="border: none;"><x-select-input
                                            name="mdistrict_id_bangla" id="mdistrict_id_bangla" class="select2"
                                            :options="$districts"
                                            selected="{{ $employee_bangla->mdistrict_id_bangla ?? old('mdistrict_id_bangla') }}"
                                            value="{{ old('mdistrict_id_bangla', $employee_bangla->mdistrict_id_bangla ?? old('mdistrict_id_bangla')) }}"
                                            required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">থানা </th>
                                    <td width="70%" style="border: none;">
                                        <x-select-input name="mthana_id_bangla" id="mthana_id_bangla" class="select2"
                                            :options="$thanas"
                                            selected="{{ $employee_bangla->mthana_id_bangla ?? old('mthana_id_bangla') }}"
                                            value="{{ old('mthana_id_bangla', $employee_bangla->mthana_id_bangla ?? old('mthana_id_bangla')) }}"
                                            required />
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">ডাকঘর </th>
                                    <td width="70%" style="border: none;">
                                        <x-text-input name="mpost_office_bangla" id="mpost_office_bangla"
                                            class="form-control-sm"
                                            value="{{ $employee_bangla->mpost_office_bangla ?? old('mpost_office_bangla') }}"
                                            placeholder="ডাকঘর" required />
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">বাড়ি নং/রাস্তা নং /গ্রাম </th>
                                    <td width="70%" style="border: none;">
                                        <x-text-input name="mvillage_bangla" id="mvillage_bangla"
                                            class="form-control-sm"
                                            value="{{ $employee_bangla->mvillage_bangla ?? old('mvillage_bangla') }}"
                                            placeholder="বাড়ি নং/রাস্তা নং /গ্রাম" required />
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-lg-4 col-md-6 pe-lg-0 pe-md-0">
                            <table class="table table-striped mb-0" id="employeeTable" width="100%">
                                <h5 class="text-primary font-weight-bold">
                                    নমিনির ঠিকানা &ensp;&ensp;
                                    <input class="form-check-input" type="checkbox" style="display: inline-block;"
                                        name="same_as_nominee" id="same_as_nominee">
                                    <label class="form-check-label" for="same_as_nominee">একই রকম</label>
                                </h5>
                                <tr>
                                    <th width="30%" style="border: none;">জেলা </th>
                                    <td width="70%" style="border: none;"><x-select-input
                                            name="ndistrict_id_bangla" id="ndistrict_id_bangla" class="select2"
                                            :options="$districts"
                                            selected="{{ $employee_bangla->ndistrict_id_bangla ?? old('ndistrict_id_bangla') }}"
                                            value="{{ old('ndistrict_id_bangla', $employee_bangla->ndistrict_id_bangla ?? old('ndistrict_id_bangla')) }}"
                                            required /></td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">থানা </th>
                                    <td width="70%" style="border: none;">
                                        <x-select-input name="nthana_id_bangla" id="nthana_id_bangla" class="select2"
                                            :options="$thanas"
                                            selected="{{ $employee_bangla->nthana_id_bangla ?? old('nthana_id_bangla') }}"
                                            value="{{ old('nthana_id_bangla', $employee_bangla->nthana_id_bangla ?? old('nthana_id_bangla')) }}"
                                            required />
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">ডাকঘর </th>
                                    <td width="70%" style="border: none;">
                                        <x-text-input name="npost_office_bangla" id="npost_office_bangla"
                                            class="form-control-sm"
                                            value="{{ $employee_bangla->npost_office_bangla ?? old('npost_office_bangla') }}"
                                            placeholder="ডাকঘর" />
                                    </td>
                                </tr>
                                <tr>
                                    <th width="30%" style="border: none;">বাড়ি নং/রাস্তা নং /গ্রাম </th>
                                    <td width="70%" style="border: none;">
                                        <x-text-input name="nvillage_bangla" id="nvillage_bangla"
                                            class="form-control-sm"
                                            value="{{ $employee_bangla->nvillage_bangla ?? old('nvillage_bangla') }}"
                                            placeholder="বাড়ি নং/রাস্তা নং /গ্রাম" />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer mb-4" style="padding:10px 10px;">
            <x-primary-button
                class="float-start btn-sm submitBtn">{{ $employee_bangla->employee_id ?? '' ? 'Update' : 'Save' }}</x-primary-button>
        </div>
    </form>
</div>

@push('scripts')
    <script>
         $(document).ready(function() {
            function cleanText(text) {
                if (!text) return '';
                text = text.trim().replace(/\s+/g, ' ');
                if (text === 'Select an option') return '';
                return text;
            }
            function generateAddress() {
                let district = cleanText($('#ndistrict_id_bangla option:selected').text());
                let thana = cleanText($('#nthana_id_bangla option:selected').text());
                let postOffice = cleanText($('#npost_office_bangla').val());
                let village = cleanText($('#nvillage_bangla').val());

                let parts = [village, postOffice, thana, district].filter(Boolean);
                let address = parts.join(', ');
                $('#emergency_address').val(address);
            }

            $('#same_as_nominee').on('change', function() {
                if ($(this).is(':checked')) {
                    generateAddress();
                } else {
                    $('#emergency_address').val('');
                }
            });
        });
    </script>
@endpush
