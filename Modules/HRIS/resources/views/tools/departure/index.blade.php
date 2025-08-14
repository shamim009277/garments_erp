@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
@push('styles')
<style>
.table, tr, th, td {
    border: none !important;
    border-collapse: collapse;
}
</style>
@endpush
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Departure',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Tools', 'url' => route('hris.index')],
                    ['label' => 'Departure', 'url' => route('hris.tools.departure.index')],
                ],
            ])
        </div>
        <div class="col-lg-3 col-md-3 pe-lg-1 pe-md-1">
            
        </div>

        <div class="col-lg-6 col-md-6 ps-lg-1 ps-md-1">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Departure
                    </h6>
                </div>
                <div class="card border border-info">
                    
                    <div class="card-body" style="min-height: 550px;max-height: 550px; overflow-y: auto;">
                        <div class="row">
                            <div class="col-lg-7">
                                <table class="table table-striped mb-0" width="100%">
                                    <tr>
                                        <th width="35%">Employee ID</th>
                                        <td width="65%"><x-text-input name="employee_id" id="employee_id" class="form-control-sm" placeholder="Employee ID" /></td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td><x-text-input name="name" id="name" class="form-control-sm" placeholder="Employee Name" readonly /></td>
                                    </tr>
                                    <tr>
                                        <th>Designation</th>
                                        <td><x-text-input name="designation" id="designation" class="form-control-sm" placeholder="Designation" readonly /></td>
                                    </tr>
                                    <tr>
                                        <th>Department</th>
                                        <td><x-text-input name="department" id="department" class="form-control-sm" placeholder="Department" readonly /></td>
                                    </tr>
                                    <tr>
                                        <th>Joining Date</th>
                                        <td><x-text-input name="joining_date" id="joining_date" type="date" class="form-control-sm" placeholder="Joining Date" readonly /></td>
                                    </tr>
                                    <tr>
                                        <th>Tenure (Y/M/D)</th>
                                        <td>
                                            <div class="d-flex">
                                                <x-text-input name="tenure_year" class="form-control-sm me-1" placeholder="Year" style="width:80px;" readonly/>
                                                <x-text-input name="tenure_month" class="form-control-sm me-1" placeholder="Month" style="width:80px;" readonly/>
                                                <x-text-input name="tenure_day" class="form-control-sm" placeholder="Day" style="width:80px;" readonly/>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Advance Amount</th>
                                        <td><x-text-input name="advance_amount" class="form-control-sm" placeholder="Advance Amount" readonly/></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-5">
                                <table class="table table-striped mb-0" width="100%">
                                    <tr>
                                        <th width="40%">Salaried?</th>
                                        <td width="60%"><x-select-input name="salaried" class="select2" :options="['Y' => 'Yes', 'N' => 'No']" selected="N" /></td>
                                    </tr>
                                    <tr>
                                        <th>Reason</th>
                                        <td><x-select-input name="reason" class="select2" :options="$departurereasons" :selected="old('reason')" required /></td>
                                    </tr>
                                    <tr>
                                        <th>Leaving Date</th>
                                        <td><x-text-input name="leaving_date" type="date" class="form-control-sm" placeholder="YYYY-MM-DD" required /></td>
                                    </tr>
                                    <tr>
                                        <th>Notes</th>
                                        <td><textarea name="notes" class="form-control form-control-sm" rows="2" placeholder="Leaving Notes"></textarea></td>
                                    </tr>
                                    <tr>
                                        <th>Maternity End Date</th>
                                        <td><x-text-input name="maternity_end_date" type="date" class="form-control-sm" placeholder="YYYY-MM-DD" /></td>
                                    </tr>
                                    <tr>
                                        <th>Document</th>
                                        <td><input type="file" name="document" class="form-control form-control-sm" /></td>
                                    </tr>
                                </table>
                                <div class="text-center mt-3">
                                    <label class="text-primary fw-bold">Photo</label>
                                    <div class="border border-dark mx-auto" style="width:160px; height:160px;">
                                        <img id="photoPreview" src="{{ asset('images/placeholder.png') }}" style="width:160px;height:160px;object-fit:cover;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="padding:10px 16px;">
                        <x-primary-button class="float-start btn-sm submitBtn">Assign</x-primary-button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 pe-lg-1 pe-md-1">
            
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // Initialize Select2
        $('.select2').select2({
            placeholder: "Select an option",
            allowClear: true,
            width: '100%'
        });

        // Image preview
        $('input[name="document"]').on('change', function () {
            const [file] = this.files;
            if (file) {
                $('#photoPreview').attr('src', URL.createObjectURL(file));
            }
        });

       
    });
    $('#employee_id').on('blur', function () {
        // Fake data lookup – replace with AJAX in real app
        if (this.value.trim() === 'E001') {
            $('#name').val('John Doe');
            $('#designation').val('Officer');
            $('#department').val('HR');
            $('#joining_date').val('2022-01-10');
            $('#org').val('Organization');
        } else {
            $('#name, #designation, #department, #joining_date').val('');
            $('#org').val('');
        }
    });
</script>
@endpush
