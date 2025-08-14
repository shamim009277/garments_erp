@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
@push('styles')
<style>

</style>
@endpush
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Designation Change',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Tools', 'url' => route('hris.index')],
                    ['label' => 'Designation Change', 'url' => route('hris.tools.designationchange.index')],
                ],
            ])
        </div>
        <div class="col-lg-3 col-md-3 pe-lg-1 pe-md-1">
            
        </div>

        <div class="col-lg-6 col-md-6 ps-lg-1 ps-md-1">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Designation Change
                    </h6>
                </div>
                <div class="card border border-info">
                    <form action="{{ route('hris.tools.designationchange.store') }}" id="designationChangeForm" method="POST">
                        @csrf 
                        @method('POST')
                    <div class="card-body" style="min-height: 550px;max-height: 550px; overflow-y: auto;">
                        <div class="row">
                            
                       
                        {{-- <x-input-group label="Applicant ID" id="applicant_id" name="applicant_id" type="text" placeholder="Applicant ID" readonly/>
                        <x-input-group label="Employee ID" id="employee_id" name="employee_id" type="text" placeholder="Employee ID" required/>
                        <x-select-input-group name="final_designation_id" id="final_designation_id" label="Final Designation" class="select2" :options="$designations" :selected="old('final_designation_id')" required />
                        <x-select-input-group name="recruitment_type" id="recruitment_type" label="Recruitment Type" :options="['N' => 'New', 'R' => 'Replacement']" :selected="old('final_designation_id')" required />
                        <x-input-group name="replace_id" id="replace_id" group_id="replace_id_group" label="Replacement ID" type="text" placeholder="Replacement ID"/> --}}
                        <table class="table table-striped" id="designationChangeTable" width="100%">
                            <tr>
                                <th width="30%" style="border: none;">Employee ID</th>
                                <td width="70%" style="border: none;"><x-input-group name="empId" id="empId" type="text" placeholder="Employee ID"></x-input-group></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Name</th>
                                <td width="70%" style="border: none;"><x-input-group name="empName" id="empName" type="text" placeholder="Employee Name" readonly></x-input-group></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Designation</th>
                                <td width="70%" style="border: none;"><x-input-group name="curDesig" id="curDesig" type="text" placeholder="Designation" readonly></x-input-group></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Department</th>
                                <td width="70%" style="border: none;"><x-input-group name="curDept" id="curDept" type="text" placeholder="Department" readonly></x-input-group></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Joining Date</th>
                                <td width="70%" style="border: none;"><x-input-group name="joinDate" id="joinDate" type="text" placeholder="Joining Date" readonly></x-input-group></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Organization</th>
                                <td width="70%" style="border: none;"><x-input-group name="org" id="org" type="text" placeholder="Organization" readonly></x-input-group></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">New Designation</th>
                                <td width="70%" style="border: none;"><x-select-input name="designation_id" id="designation_id" class="form-control" :options="$designations" :selected="old('designation_id')" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">New Department</th>
                                <td width="70%" style="border: none;"><x-select-input name="department_id" id="department_id" class="form-control" :options="$departments" :selected="old('department_id')" required /></td>
                            </tr>
                        </table>
                        </div>
                    </div>
                    </form>
                    <div class="card-footer" style="padding:10px 16px;">
                        <x-primary-button class="float-start btn-sm submitBtn">Assign</x-primary-button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 pe-lg-1 pe-md-1">
            
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Demo behaviour: auto-fill display fields when Employee ID loses focus
    $('#empId').on('blur', function () {
        // Fake data lookup – replace with AJAX in real app
        if (this.value.trim() === 'E001') {
            $('#empName').val('John Doe');
            $('#curDesig').val('Officer');
            $('#curDept').val('HR');
            $('#joinDate').val('2022-01-10');
            $('#org').val('Organization');
        } else {
            $('#empName, #curDesig, #curDept, #joinDate').val('');
            $('#org').val('');
        }
    });

    $('#btnSave').on('click', function () {
        // Very simple validation
        if (!$('#empId').val().trim() || !$('#newDesig').val() || !$('#newDept').val()) {
            alert('Please fill in all required fields.');
            return;
        }
        alert('Saved! (hook into your backend here)');
        // Example: post with $.ajax({url:'/designation-change', method:'POST', data:...})
    });
</script>

@endpush
