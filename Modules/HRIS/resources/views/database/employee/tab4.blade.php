<div class="card padding-card" style="margin-bottom: 0px !important;">
    <div class="card-body" style="min-height: 450px;">
        <div class="row">
            <div class="col-lg-8 pe-lg-0 ps-lg-0">
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3">
                        <h6 class="my-0 text-primary">Training Summary</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover mb-0" width="100%">
                            <thead>
                                <tr>
                                    <th style="width:4%;">SL#</th>
                                    <th style="width:20%;">Training Name</th>
                                    <th style="width:20%;">Organization</th>
                                    <th style="width:10%;">Duration</th>
                                    <th style="width:26%;">Description</th>
                                    <th style="width:10%;text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employee_training as $key => $training)
                                    <tr id="row-{{ $training->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $training->training_name }}</td>
                                        <td>{{ $training->organization }}</td>
                                        <td>{{ $training->duration }}</td>
                                        <td>{{ $training->description }}</td>
                                        <td style="text-align: center;">
                                            <a href="#" class="btn btn-sm btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $training->id }}"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn-sm btn-soft-danger waves-effect waves-light delete-training" data-id="{{ $training->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                        </td>
                                        <div id="editModal{{ $training->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="myModalLabel">Edit Employee Training</h6>
                                                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form id="editForm{{ $training->id }}" action="{{ route('hris.database.employee-training.update', $training->id) }}" method="POST">
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="employee_id" value="{{ $training->employee_id }}">
                                                            <x-input-group name="training_name" label="Training Name" type="text" placeholder="Enter training name" :value="$training->training_name" required />
                                                            <x-input-group name="organization" label="Organization" type="text" placeholder="Enter organization" :value="$training->organization" required />
                                                            <x-input-group name="description" label="Description" type="text" placeholder="Enter description" :value="$training->description" />
                                                            <x-input-group name="duration" label="Duration" type="text" placeholder="Enter duration" :value="$training->duration" required />
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

            <div class="col-lg-4 pe-lg-0">
                <div class="card alert-info alert-top-border padding-card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3" >
                        <h6 class="my-0 text-primary">Input Parameters For New Training Summary</h6>
                    </div>
                    <form id="trainingForm" action="{{ route('hris.database.employee-training.store') }}" method="POST">
                        @csrf
                    <div class="card-body" style="padding:10px 10px;">
                        <table class="table table-striped mb-0" id="academicTable" width="100%">
                            <input type="hidden" name="employee_id" value="{{ $employee->employee_id }}">
                            <tr>
                                <th width="30%" style="border: none;">Training Name</th>
                                <td width="70%" style="border: none;"><x-text-input name="training_name" id="training_name" label="" class="form-control-sm" placeholder="Training Name" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Organization</th>
                                <td width="70%" style="border: none;"><x-text-input name="organization" id="organization" label="" class="form-control-sm" placeholder="Organization" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Description</th>
                                <td width="70%" style="border: none;"><x-text-input name="description" id="description" label="" class="form-control-sm" placeholder="Description" /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">Duration</th>
                                <td width="70%" style="border: none;"><x-text-input name="duration" id="duration" label="" class="form-control-sm" placeholder="Duration" required /></td>
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
@push('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.delete-training', function(e) {
            e.preventDefault();
            let trainingId = $(this).data('id');
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
                    url: '{{ route('hris.database.employee-training.delete') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: trainingId
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Training has been deleted.',
                            'success'
                        );
                        $('#row-' + trainingId).remove();
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
                    'Training has not been deleted.',
                    'error'
                );
            }
        });
    });
    });
</script>
@endpush
