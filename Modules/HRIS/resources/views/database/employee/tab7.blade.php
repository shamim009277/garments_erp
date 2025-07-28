<div class="card padding-card" style="margin-bottom: 0px !important;">
    <div class="card-body" style="min-height: 300px;">
        <div class="row">
            <div class="col-lg-8 col-md-7 pe-lg-0 pe-md-0">
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3">
                        <h6 class="my-0 text-primary">Reference</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped mb-0" id="academicTable" width="100%">
                            <thead>
                                <tr>
                                    <th style="">SL#</th>
                                    <th style="">Reference Id</th>
                                    <th style="">Reference Name</th>
                                    <th style="">Phone Number</th>
                                    <th style="">How did you know about this organization?</th>
                                    <th style="">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-5 pe-lg-0 pe-md-0">
                <div class="card alert-info alert-top-border padding-card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3" >
                        <h6 class="my-0 text-primary">Input Parameters For New Reference</h6>
                    </div>
                    <div class="card-body" style="padding:10px 10px;">
                        <table class="table table-striped mb-0" id="academicTable" width="100%">
                            <tr>
                                <th width="40%" style="border: none;">How did you know about this organization?</th>
                                <td width="60%" style="border: none;"><x-select-input name="designation" id="designation" label="" class="select2" :options="['1' => 'From any employee', '2' => 'From any relative', '3' => 'From The Organization', '4' => 'From The Website', '5' => 'From The Advertisement']" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Reference Id</th>
                                <td width="60%" style="border: none;"><x-text-input name="reference_id" id="reference_id" label="" class="form-control-sm" placeholder="Reference Id" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Reference Name</th>
                                <td width="60%" style="border: none;"><x-text-input name="reference_name" id="reference_name" label="" class="form-control-sm" placeholder="Reference Name" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Phone Number</th>
                                <td width="60%" style="border: none;"><x-text-input name="reference_phone" id="reference_phone" label="" class="form-control-sm" placeholder="Reference Phone" required /></td>
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
