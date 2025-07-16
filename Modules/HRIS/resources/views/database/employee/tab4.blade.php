<div class="card padding-card" style="margin-bottom: 0px !important;">
    <div class="card-body" style="min-height: 300px;">
        <div class="row">
            <div class="col-lg-8 col-md-7 pe-lg-0 pe-md-0 ps-lg-0 ps-md-0">
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3">
                        <h6 class="my-0 text-primary">Training Summary</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped mb-0" id="academicTable" width="100%">
                            <thead>
                                <tr>
                                    <th style="">SL#</th>
                                    <th style="">Training Name</th>
                                    <th style="">Organization</th>
                                    <th style="">Duration</th>
                                    <th style="">Description</th>
                                    <th style="">Action</th>
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
                        <h6 class="my-0 text-primary">Input Parameters For New Training Summary</h6>
                    </div>
                    <div class="card-body" style="padding:10px 10px;">
                        <table class="table table-striped mb-0" id="academicTable" width="100%">
                            <tr>
                                <th width="40%" style="border: none;">Training Name</th>
                                <td width="60%" style="border: none;"><x-text-input name="designation" id="designation" label="" class="form-control-sm" placeholder="Designation" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Organization</th>
                                <td width="60%" style="border: none;"><x-text-input name="organization" id="organization" label="" class="form-control-sm" placeholder="Organization" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Description</th>
                                <td width="60%" style="border: none;"><x-text-input name="description" id="description" label="" class="form-control-sm" placeholder="Description" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Duration</th>
                                <td width="60%" style="border: none;"><x-text-input name="duration" id="duration" label="" class="form-control-sm" placeholder="Duration" required /></td>
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
