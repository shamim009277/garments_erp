<div class="card padding-card" style="margin-bottom: 0px !important;">
    <div class="card-body" style="min-height: 300px;">
        <div class="row">
            <div class="col-lg-8 pe-lg-0 ps-lg-0">
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3">
                        <h6 class="my-0 text-primary">কর্মসংস্থান ইতিহাস</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped mb-0" width="100%">
                            <thead>
                                <tr>
                                    <th style="">সি.নং#</th>
                                    <th style="">পদবী</th>
                                    <th style="">প্রতিষ্ঠানের নাম</th>
                                    <th style="">যোগদানের তারিখ</th>
                                    <th style="">অবসানের তারিখ</th>
                                    <th style="">অবসানের কারন</th>
                                    <th style="text-align: center;">অ্যাকশন</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employee_service as $key => $service)
                                    <tr id="row-{{ $service->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $service->designation }}</td>
                                        <td>{{ $service->organization }}</td>
                                        <td>{{ $service->join_date }}</td>
                                        <td>{{ $service->leave_date }}</td>
                                        <td>{{ $service->leave_reason }}</td>
                                        <td style="text-align: center;">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $service->id }}"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-sm btn-soft-danger waves-effect waves-light delete-service" data-id="{{ $service->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <div id="editModal{{ $service->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Employee Service</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="editForm{{ $service->id }}" action="{{ route('hris.database.employee-service.update', $service->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <input type="hidden" name="employee_id" id="employee_id" value="{{ $service->employee_id }}">
                                                        <x-input-group name="designation" label="পদবী" type="text" class="form-control-sm" placeholder="পদবী" :value="$service->designation" required />
                                                        <x-input-group name="organization" label="প্রতিষ্ঠানের নাম" type="text" class="form-control-sm" placeholder="প্রতিষ্ঠানের নাম" :value="$service->organization" required />
                                                        <x-input-group name="join_date" label="যোগদানের তারিখ" type="date" class="form-control-sm" placeholder="যোগদানের তারিখ" :value="$service->join_date" required />
                                                        <x-input-group name="leave_date" label="অবসানের তারিখ" type="date" class="form-control-sm" placeholder="অবসানের তারিখ" :value="$service->leave_date" required />
                                                        <x-input-group name="leave_reason" label="অবসানের কারন" type="text" class="form-control-sm" placeholder="অবসানের কারন" :value="$service->leave_reason" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <x-primary-button id="submitBtn" class="float-start btn-sm submitBtn">Save changes</x-primary-button>
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
                <form action="{{ route('hris.database.employee-service.store') }}" method="post">
                    @csrf
                <div class="card alert-info alert-top-border padding-card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3" >
                        <h6 class="my-0 text-primary">নতুন কর্মসংস্থান পরিষেবার জন্য ইনপুট পরামিতি</h6>
                    </div>
                    <div class="card-body" style="padding:10px 10px;">
                        <table class="table table-striped mb-0" id="academicTable" width="100%">
                            <input type="hidden" name="employee_id" id="employee_id" value="{{ $employee->employee_id }}">
                            <tr>
                                <th width="30%" style="border: none;">পদবী</th>
                                <td width="70%" style="border: none;"><x-text-input name="designation" id="designation" label="" class="form-control-sm" placeholder="পদবী" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">প্রতিষ্ঠানের নাম</th>
                                <td width="70%" style="border: none;"><x-text-input name="organization" id="organization" label="" class="form-control-sm" placeholder="প্রতিষ্ঠানের নাম" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">যোগদানের তারিখ</th>
                                <td width="70%" style="border: none;"><x-text-input name="join_date" id="join_date" type="date" label="" class="form-control-sm" placeholder="যোগদানের তারিখ" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">অবসানের তারিখ</th>
                                <td width="70%" style="border: none;"><x-text-input name="leave_date" id="leave_date" type="date" label="" class="form-control-sm" placeholder="অবসানের তারিখ" required /></td>
                            </tr>
                            <tr>
                                <th width="30%" style="border: none;">অবসানের কারন</th>
                                <td width="70%" style="border: none;"><x-text-input name="leave_reason" id="leave_reason" label="" class="form-control-sm" placeholder="অবসানের কারন" /></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer" style="padding:8px 10px;">
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
    $(document).ready(function () {
        const today = new Date().toISOString().split('T')[0];
        $('#join_date, #leave_date').attr('max', today);

        $('#join_date').on('change', function () {
            let joinDate = $(this).val();
            if (joinDate) {
                $('#leave_date').attr('min', joinDate);
            } else {
                $('#leave_date').removeAttr('min');
            }
        });

        $('#leave_date').on('change', function () {
            let leaveDate = $(this).val();
            if (leaveDate) {
                $('#join_date').attr('max', leaveDate > today ? today : leaveDate);
            } else {
                $('#join_date').attr('max', today);
            }
        });

        $('#join_date, #leave_date').on('change', function () {
            let joinDate = $('#join_date').val();
            let leaveDate = $('#leave_date').val();
            let now = new Date().toISOString().split('T')[0];
            if (joinDate && joinDate >= now) {
                alert("Join Date must be before today.");
                $('#join_date').val('');
            }

            if (leaveDate && leaveDate >= now) {
                alert("Leave Date must be before today.");
                $('#leave_date').val('');
            }
            if (joinDate && leaveDate && new Date(leaveDate) < new Date(joinDate)) {
                alert("Leave Date cannot be before Join Date.");
                $('#leave_date').val('');
            }
        });
    });

    $(document).ready(function() {
        $(document).on('click', '.delete-service', function(e) {
            e.preventDefault();
            let serviceId = $(this).data('id');
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
                    url: '{{ route('hris.database.employee-service.delete') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: serviceId
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'Service has been deleted.',
                            'success'
                        );
                        $('#row-' + serviceId).remove();
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
                    'Service has not been deleted.',
                    'error'
                );
            }
        });
    });
    });
</script>
@endpush

