
<div class="card padding-card" style="margin-bottom: 0px !important;">
    <div class="card-body" style="min-height: 300px;">
        <div class="row">
            <div class="col-lg-8 pe-lg-0 ps-lg-0">
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3">
                        <h6 class="my-0 text-primary">Academic Summary</h6>
                    </div>
                    <div class="card-body">
                        <div style="overflow-x: auto;">
                        <table class="table table-striped table-hover mb-0" width="100%">
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
                                 @foreach ($employee_education as $key => $education)
                                    <tr id="row-{{ $education->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $education->degree->degree }}</td>
                                        <td>
                                            {{ $education->institute }}<br>
                                            {{ $education->institute_bangla }}
                                        </td>
                                        <td>{{ $education->board }}</td>
                                        <td>{{ $education->result }}</td>
                                        <td>{{ $education->passing_year }}</td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $education->id }}"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-soft-danger waves-effect waves-light delete-education" data-id="{{ $education->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                        </td>
                                        <div id="editModal{{ $education->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="myModalLabel">Edit Employee Education</h6>
                                                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form id="editForm{{ $education->id }}" action="{{ route('hris.database.employee-education.update', $education->id) }}" method="POST">
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="employee_id" value="{{ $education->employee_id }}">
                                                            <x-select-input-group name="degree_id" label="Degree" id="degree" class="select2" :options="$degrees" selected="{{ $education->degree_id??old('degree_id') }}" required />
                                                            <x-input-group name="institute" label="Institute" type="text" class="form-control-sm" placeholder="Enter institute" :value="$education->institute" required />
                                                            <x-input-group name="institute_bangla" label="Institute Bangla" type="text" class="form-control-sm" placeholder="Enter institute bangla" :value="$education->institute_bangla" required />
                                                            <x-select-input-group name="board" label="Board" type="text" class="select2" :options="$boards" selected="{{ $education->board??old('board') }}" required />
                                                            <x-input-group name="passing_year" label="Passing Year" type="text" class="form-control-sm" placeholder="Enter passing year" :value="$education->passing_year" required />
                                                            <x-select-input-group name="result_type" id="result_type_{{ $education->id }}" label="Result Type" class="select2" :options="['D'=>'Degree/Division','C'=>'CGPA','G'=>'Grade']" selected="D" placeholder="Result Type" required />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                            <x-primary-button id="submitBtn" class="float-start btn-sm submitBtn">Save changes</x-primary-button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                 @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 pe-lg-0">
                <div class="card alert-info alert-top-border padding-card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3" >
                        <h6 class="my-0 text-primary">Input Parameters For New Academic Qualification</h6>
                    </div>
                    <form id="academicForm" action="{{ route('hris.database.employee-education.store') }}" method="POST">
                        @csrf
                    <div class="card-body" style="padding:10px 10px;">
                        <table class="table table-striped mb-0" id="academicTable" width="100%">
                            <tr>
                                <input type="hidden" name="employee_id" value="{{ $employee->employee_id }}">
                                <th width="40%" style="border: none;">Degree</th>
                                <td width="60%" style="border: none;"><x-select-input name="degree_id" id="degree" class="select2" label="" :options="$degrees"  placeholder="Academic Qualification" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Year of Passing</th>
                                <td width="60%" style="border: none;"><x-text-input name="passing_year" id="passing_year" label="" class="form-control-sm" placeholder="Year of Passing" required /></td>
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
                                <td width="60%" style="border: none;"><x-select-input name="board" id="board" label="" class="select2" :options="$boards" placeholder="Board" required /></td>
                            </tr>
                            <tr>
                                <th width="40%" style="border: none;">Result Type</th>
                                <td width="60%" style="border: none;"><x-select-input name="result_type" id="result_type" label="" class="select2" :options="['D'=>'Degree/Division','C'=>'CGPA','G'=>'Grade']" selected="D" placeholder="Result Type" required /></td>
                            </tr>
                            <tr id="degree_tr">
                                <th width="40%" style="border: none;">Obtain Degree</th>
                                <td width="60%" style="border: none;"><x-select-input name="obtain_degree" id="obtain_degree" label="" class="select2" :options="['First Class' => 'First Class', 'Second Class' => 'Second Class', 'Third Class' => 'Third Class', 'Passed' => 'Passed', 'Appeared' => 'Appeared', 'N/A' => 'N/A']" placeholder="Obtain Degree" /></td>
                            </tr>
                            <tr id="cgpa_tr">
                                <th width="40%" style="border: none;">Obtain CGPA</th>
                                <td width="60%" style="border: none;"><x-text-input type="number" name="obtain_cgpa" pattern="[0-9]+([\.,][0-9]+)?" class="form-control-sm" step="0.01" id="obtain_cgpa" label="" placeholder="Obtain CGPA" /></td>
                            </tr>
                            <tr id="grade_tr">
                                <th width="40%" style="border: none;">Obtain Grade</th>
                                <td width="60%" style="border: none;"><x-select-input name="obtain_grade" id="obtain_grade" label="" class="select2" :options="['Grade: A+' => 'Grade: A+', 'Grade: A' => 'Grade: A', 'Grade: A-' => 'Grade: A-','Grade: B+' => 'Grade: B+', 'Grade: B' => 'Grade: B', 'Grade: B-' => 'Grade: B-','Grade: C+' => 'Grade: C+', 'Grade: C' => 'Grade: C', 'Grade: C-' => 'Grade: C-', 'Grade: D+' => 'Grade: D+', 'Grade: D' => 'Grade: D', 'Grade: D-' => 'Grade: D-', 'Grade: F' => 'Grade: F']" placeholder="Obtain Grade"/></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer mb-4" style="padding:10px 10px;">
                        <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $('#result_type').on('change', function() {
            let result = $(this).val();
            if(result == 'D'){
                $('#degree_tr').show();
                $('#cgpa_tr').hide();
                $('#grade_tr').hide();

                $('#obtain_degree').attr('required', true);
                $('#obtain_cgpa').attr('required', false);
                $('#obtain_grade').attr('required', false);

            }else if(result == 'C'){
                $('#degree_tr').hide();
                $('#cgpa_tr').show();
                $('#grade_tr').hide();

                $('#obtain_degree').attr('required', false);
                $('#obtain_cgpa').attr('required', true);
                $('#obtain_grade').attr('required', false);
            }else if(result == 'G'){
                $('#degree_tr').hide();
                $('#cgpa_tr').hide();
                $('#grade_tr').show();

                $('#obtain_degree').attr('required', false);
                $('#obtain_cgpa').attr('required', false);
                $('#obtain_grade').attr('required', true);
            }
        });
        $('#result_type').trigger('change');
    });

    $(document).on('click', '.delete-education', function(e) {
        e.preventDefault();
        let educationId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('hris.database.employee-education.delete') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: educationId
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Education has been deleted.',
                            'success'
                        );
                        $('#row-' + educationId).remove();
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'Something went wrong.',
                            'error'
                        );
                    }
                });
            } else {
                Swal.fire(
                    'Cancelled!',
                    'Education has not been deleted.',
                    'error'
                );
            }
        });
    });
</script>
@endpush
