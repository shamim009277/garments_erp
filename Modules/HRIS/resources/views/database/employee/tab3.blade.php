<div class="card padding-card" style="margin-bottom: 0px !important;">
    <div class="card-body" style="min-height: 300px;">
        <div class="row">
            <div class="col-lg-8 col-md-7 pe-lg-0 pe-md-0 ps-lg-0 ps-md-0">
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3">
                        <h6 class="my-0 text-primary">Academic Summary</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped mb-0" id="academicTable" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:4%;">SL#</th>
                                    <th style="width:20%;">Degree</th>
                                    <th style="width:34%;">Institute</th>
                                    <th style="width:20%;">Board/University</th>
                                    <th style="width:10%;">Result</th>
                                    <th style="width:6%;">Year</th>
                                    <th style="width:6%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-5 pe-lg-0 pe-md-0 ps-lg-0 ps-md-0">
                <div class="card alert-info alert-top-border padding-card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3" >
                        <h6 class="my-0 text-primary">Input Parameters For New Academic Qualification</h6>
                    </div>
                    <div class="card-body" style="padding:10px 10px;">
                        <table class="table table-striped mb-0" id="academicTable" width="100%">
                            <tr>
                                <th width="40%" style="border: none;">Degree</th>
                                <td width="60%" style="border: none;"><x-select-input name="degree" id="degree" class="select2" label="" :options="['SSC', 'HSC', 'Diploma', 'Bachelor', 'Master']" placeholder="Academic Qualification" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Year of Passing</th>
                                <td width="60%" style="border: none;"><x-text-input name="year" id="year" label="" class="form-control-sm" placeholder="Year of Passing" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Institute</th>
                                <td width="60%" style="border: none;"><x-text-input name="institute" id="institute" label="" class="form-control-sm" placeholder="Institute" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Institute Bangla</th>
                                <td width="60%" style="border: none;"><x-text-input name="institute_bangla" id="institute_bangla" label="" class="form-control-sm" placeholder="Institute Bangla" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Board</th>
                                <td width="60%" style="border: none;"><x-select-input name="board" id="board" label="" class="select2" placeholder="Board" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Result Type</th>
                                <td width="60%" style="border: none;"><x-select-input name="result_type" id="result_type" label="" class="select2" :options="['Degree/Division','CGPA','Grade']" placeholder="Result Type" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Obtain Degree</th>
                                <td width="60%" style="border: none;"><x-select-input name="obtain_degree" id="obtain_degree" label="" class="select2" :options="['Degree/Division','CGPA','Grade']" placeholder="Obtain Degree" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Obtain CGPA</th>
                                <td width="60%" style="border: none;"><x-select-input name="obtain_cgpa" id="obtain_cgpa" label="" class="select2" :options="['Degree/Division','CGPA','Grade']" placeholder="Obtain CGPA" required /></td>
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
