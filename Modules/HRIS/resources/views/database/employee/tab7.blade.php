<div class="card padding-card" style="margin-bottom: 0px !important;">
    <div class="card-body" style="min-height: 450px;">
        <div class="row">
            <div class="col-lg-8 pe-lg-0 ps-lg-0">
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
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employee_references as $key => $reference)
                                    <tr id="row-{{ $reference->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $reference->reference_id }}</td>
                                        <td>
                                            {{ $reference->name }}<br>
                                            {{ $reference->email }}
                                        </td>
                                        <td>{{ $reference->mobile }}</td>
                                        <td>{{ $reference->know_about_company }}</td>
                                        <td style="text-align: center;">
                                            <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $reference->id }}"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-reference" data-id="{{ $reference->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <div id="editModal{{ $reference->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Employee Experience</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="editForm{{ $reference->id }}" action="{{ route('hris.database.employee-reference.update', $reference->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="employee_id" value="{{ $reference->employee_id }}">
                                                        <x-select-input-group name="know_about_company" id="know_about_company" label="How did you know about this organization?" :options="['From any employee' => 'From any employee', 'From any relative' => 'From any relative', 'From The Organization' => 'From The Organization', 'From The Website' => 'From The Website', 'From The Advertisement' => 'From The Advertisement','Other' => 'Other']" selected="{{ $reference->know_about_company }}" required />
                                                        <x-input-group name="reference_id" label="Reference Id" type="text" placeholder="Enter reference id" value="{{ $reference->reference_id }}" />
                                                        <x-input-group name="name" label="Name" type="text" placeholder="Enter name" value="{{ $reference->name }}" required />
                                                        <x-input-group name="mobile" id="mobile" type="text" label="Mobile" pattern="(01)[0-9]{9}" maxlength="11" value="{{ $reference->mobile }}" placeholder="Mobile Number" required/>
                                                        <x-input-group name="email" id="email" type="email" label="Email" value="{{ $reference->email }}" placeholder="Reference Email" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect btn-sm" data-bs-dismiss="modal">Close</button>
                                                        <x-primary-button id="submitBtn" class="float-start btn-sm submitBtn">Update</x-primary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 pe-lg-0">
                <form action="{{ route('hris.database.employee-reference.store') }}" method="POST">
                    @csrf
                    <div class="card alert-info alert-top-border padding-card">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3" >
                            <h6 class="my-0 text-primary">Input Parameters For New Reference</h6>
                        </div>
                        <div class="card-body" style="padding:10px 10px;">
                            <table class="table table-striped mb-0" id="academicTable" width="100%">
                                <tr>
                                    <input type="hidden" name="employee_id" value="{{ $employee->employee_id }}">
                                    <th width="40%" style="border: none;">How did you know about this organization?</th>
                                    <td width="60%" style="border: none;"><x-select-input name="know_about_company" id="know_about_company" label="" class="select2" :options="['From any employee' => 'From any employee', 'From any relative' => 'From any relative', 'From The Organization' => 'From The Organization', 'From The Website' => 'From The Website', 'From The Advertisement' => 'From The Advertisement','Other' => 'Other']" selected="From any employee" required /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">Reference Id</th>
                                    <td width="60%" style="border: none;"><x-text-input name="reference_id" type="text" id="reference_id" label="" class="form-control-sm" placeholder="Reference Id" /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">Reference Name</th>
                                    <td width="60%" style="border: none;"><x-text-input name="name" type="text" id="name" label="" class="form-control-sm" placeholder="Reference Name" required /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">Phone Number</th>
                                    <td width="60%" style="border: none;"><x-text-input name="mobile" id="mobile" type="text" pattern="(01)[0-9]{9}" maxlength="11" class="form-control-sm" value="{{ $employee_personal->mobile??old('mobile') }}" placeholder="Mobile Number" /></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none;">Email</th>
                                    <td width="60%" style="border: none;"><x-text-input name="email" id="email" type="email" label="" class="form-control-sm" placeholder="Reference Email" /></td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer" style="padding:10px 10px;">
                            <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).on('click', '.delete-reference', function(e) {
            e.preventDefault();
            let referenceId = $(this).data('id');
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
                        url: '{{ route('hris.database.employee-reference.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: referenceId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Reference has been deleted.',
                                'success'
                            );
                            $('#row-' + referenceId).remove();
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
                        'Reference has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush


