<div class="card padding-card" style="margin-bottom: 0px !important;">
    <div class="card-body" style="min-height: 450px;">
        <div class="row">
            <div class="col-lg-6 col-md-6 pe-lg-0 pe-md-0">
                <form action="{{ route('hris.database.employee.permission') }}" method="POST">
                    @csrf
                    <div class="card alert-primary alert-top-border padding-card">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3">
                            <h6 class="my-0 text-primary">Leave Forward & Approve</h6>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="employee_id" value="{{ $employee->employee_id }}">
                            <input type="hidden" name="org_id" value="{{ $employee->org_id }}">
                            <label for="line_id">Leave Forward Users <span class="text-danger">*</span></label>
                            <x-select-multiple-input
                                name="lforward_id[]"
                                id="lforward_id"
                                class="select2 multiselect mb-2"
                                :options="$activeUsers"
                                :selected="json_decode($lforusers, true) ?? []"
                                multiple
                                required
                            />
                            <br>
                            <br>

                            <label for="line_id">Leave Approve Users <span class="text-danger">*</span></label>
                            <x-select-multiple-input
                                name="lapprove_id[]"
                                id="lapprove_id"
                                class="select2 multiselect mb-2"
                                :options="$activeUsers"
                                :selected="json_decode($lappusers, true) ?? []"
                                multiple
                                required
                            />
                            <br>
                        </div>
                        <div class="card-footer" style="padding:10px 10px;">
                            <x-primary-button class="float-start btn-sm submitBtn">Update</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-6 col-md-6 pe-lg-0 pe-md-0">
                <form action="{{ route('hris.database.employee.permission') }}" method="POST">
                    @csrf
                    <div class="card alert-info alert-top-border padding-card">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3" >
                            <h6 class="my-0 text-primary">Movement Forward & Approve</h6>
                        </div>
                        <div class="card-body" style="padding:10px 10px;">
                            <input type="hidden" name="employee_id" value="{{ $employee->employee_id }}">
                            <input type="hidden" name="org_id" value="{{ $employee->org_id }}">
                            <label for="line_id">Forward & Approve Users <span class="text-danger">*</span></label>
                            <x-select-multiple-input
                                name="mapprove_id[]"
                                id="mapprove_id"
                                class="select2 multiselect mb-2"
                                :options="$activeUsers??[]"
                                :selected="json_decode($movusers, true) ?? []"
                                multiple
                                required
                            />
                            <br>
                        </div>
                        <div class="card-footer" style="padding:10px 10px;">
                            <x-primary-button class="float-start btn-sm submitBtn">Update</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush
