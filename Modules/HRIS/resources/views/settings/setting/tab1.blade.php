<form action="{{ route('hris.settings.hr-settings.store') }}" method="post">
    @csrf
    <div class="card padding-card" style="margin-bottom: 0px !important;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-md-6" style="margin:0px auto">
                    <div class="card border border-primary padding-card" style="margin-bottom: 0px !important;">
                        <div class="card-header" style="padding:10px 10px; vertical-align: middle;">
                            <h5 class="card-title">
                                Salary Options
                            </h5>
                        </div>
                        <div class="card-body">
                            <x-input-group type="hidden" name="tab" value="1" />
                            <x-input-group type="hidden" name="id" value="{{ $setting->id ?? '' }}" />
                            <x-input-group type="text" name="medical_allowance" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="8" class="form-control-sm" label="Medical Allowance" :value="old('medical_allowance', $setting->medical_allowance??'')" placeholder="Medical Allowance" required />
                            <x-input-group type="text" name="food_allowance" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="8" class="form-control-sm" label="Food Allowance" :value="old('food_allowance', $setting->food_allowance??'')" placeholder="Food Allowance" required />
                            <x-input-group type="text" name="conveyance" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="8" class="form-control-sm" label="Conveyance" :value="old('conveyance', $setting->conveyance??'')" placeholder="Conveyance" required />
                            <x-input-group type="text" name="house_rant_percent_basic" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="8" class="form-control-sm" label="HR % Basic" :value="old('house_rant_percent_basic', $setting->house_rant_percent_basic??'')" placeholder="House Rent Percent Basic" required />
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
