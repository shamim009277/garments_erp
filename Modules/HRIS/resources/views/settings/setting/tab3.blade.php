<form action="{{ route('hris.settings.setting.schedule') }}" method="post">
    @csrf
    <div class="card padding-card" style="margin-bottom: 0px !important;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-md-6" style="margin:0px auto">
                    <div class="card border border-primary padding-card" style="margin-bottom: 0px !important;">
                        <div class="card-header" style="padding:10px 10px; vertical-align: middle;">
                            <h6 class="card-title">Ramadan Schedule</h6>
                        </div>
                        <div class="card-body">
                            <x-input-group type="hidden" name="tab" value="3" />
                            <x-input-group type="hidden" name="id" value="{{ $schedule->id ?? '' }}" />
                            <x-input-group type="text" name="start_date" class="form-control-sm" id="start_date" label="Start Date" :value="old('start_date', date('d-m-Y', strtotime($schedule->start_date??''))) ?? ''" placeholder="Start Date" required />
                            <x-input-group type="text" name="end_date" class="form-control-sm" id="end_date" label="End Date" :value="old('end_date', date('d-m-Y', strtotime($schedule->end_date??''))) ?? ''" placeholder="End Date" required />
                        </div>
                        <div class="card-footer" style="padding:10px 10px;">
                            <x-primary-button class="float-start btn-sm submitBtn">Update</x-primary-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
