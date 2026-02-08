@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Ramadan Shift',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Ramadan Shift', 'url' => route('hris.setup.companywise-ramadan-shifts.index')],
                ],
            ])
        </div>
        <div class="col-lg-9 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Ramadan Shift List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="3%">SL</th>
                                <th width="5%">Org</th>
                                <th width="5%">Shift</th>
                                <th width="10%">Shift Start</th>
                                <th width="10%">Shift End</th>
                                <th width="10%">Break Start</th>
                                <th width="10%">Break End</th>
                                <th width="10%">Break Duration</th>
                                <th width="10%">Break Type</th>
                                <th width="10%">Late After Minutes</th>
                                <th width="7%">Is Active</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shifts as $key => $shift)
                                <tr id="row-{{ $shift->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $shift->company->short_name }}</td>
                                    <td>{{ $shift->shift }}</td>
                                    <td>{{ $shift->shift_start }}</td>
                                    <td>{{ $shift->shift_end }}</td>
                                    <td>{{ $shift->break_start }}</td>
                                    <td>{{ $shift->break_end }}</td>
                                    <td>{{ $shift->break_duration }}</td>
                                    <td>
                                        @if ($shift->break_duration_type == 1)
                                            Hour
                                        @else
                                            Minute
                                        @endif
                                    </td>
                                    <td>{{ $shift->late_after_minutes }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $shift->id }}" class="shift-toggle" data-id="{{ $shift->id }}" switch="bool" {{ $shift->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $shift->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $shift->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-shift" data-id="{{ $shift->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                    <div id="editModal{{ $shift->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Company Wise Shift</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="editForm{{ $shift->id }}" action="{{ route('hris.setup.companywise-ramadan-shifts.update', $shift->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-select-input-group name="org_id" label="Company" :options="$orgList" :selected="$shift->org_id" required />
                                                        <x-input-group name="shift" label="Shift" type="text" placeholder="Enter shift" :value="$shift->shift" required />
                                                        <x-input-group name="shift_start" label="Shift Start" type="time" placeholder="Enter shift start" :value="$shift->shift_start" required />
                                                        <x-input-group name="shift_end" label="Shift End" type="time" placeholder="Enter shift end" :value="$shift->shift_end" required />
                                                        <x-input-group name="break_start" label="Break Start" type="time" placeholder="Enter break start" :value="$shift->break_start" required />
                                                        <x-input-group name="break_end" label="Break End" type="time" placeholder="Enter break end" :value="$shift->break_end" required />
                                                        <x-input-group name="break_duration" label="Break Duration" type="text" placeholder="Enter break duration" :value="$shift->break_duration" required />
                                                        <x-select-input-group name="break_duration_type" label="Break Duration Type" :options="['1' => 'Hour', '2' => 'Minute']" :selected="$shift->break_duration_type" required />
                                                        <x-input-group name="late_after_minutes" label="Late After Minutes" type="number" placeholder="Enter late after minutes" :value="$shift->late_after_minutes" required />
                                                        <x-select-input-group name="is_active" label="Is Active" :options="['1' => 'Active', '0' => 'Inactive']" :selected="$shift->is_active" required />
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

        <div class="col-lg-3">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Shift ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('hris.setup.companywise-ramadan-shifts.store') }}" method="POST">
                        @csrf
                        <x-select-input-group name="org_id" label="Organization" :options="$orgList" :selected="old('org_id', 1)" required />
                        <x-select-input-group name="shift" id="shift" label="Shift" :options="$shiftList" :selected="old('shift')" required />
                        <x-input-group name="shift_start" id="shift_start" label="Shift Start" type="time" placeholder="Enter shift start" :value="old('shift_start')" required />
                        <x-input-group name="shift_end" id="shift_end" label="Shift End" type="time" placeholder="Enter shift end" :value="old('shift_end')" required />
                        <x-input-group name="break_start" id="break_start" label="Break Start" type="time" placeholder="Enter break start" :value="old('break_start')" required />
                        <x-input-group name="break_end" id="break_end" label="Break End" type="time" placeholder="Enter break end" :value="old('break_end')" required />
                        <x-input-group name="break_duration" id="break_duration" label="Break Duration" type="text" placeholder="Enter break duration" :value="old('break_duration')" required />
                        <x-select-input-group name="break_duration_type" id="break_duration_type" label="Break Duration Type" :options="['1' => 'Hour', '2' => 'Minute']" :selected="old('break_duration_type', '1')" required />
                        <x-input-group name="late_after_minutes" id="late_after_minutes" label="Late After Minutes" type="number" placeholder="Enter late after minutes" :value="old('late_after_minutes')" required />
                        <x-select-input-group
                            name="is_active"
                            label="Is Active?"
                            :options="['1' => 'Active', '0' => 'Inactive']"
                            :selected="old('is_active', '1')"
                            required
                        />

                        <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.shift-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.companywise-shifts.toggle') }}',
                    type: 'POST',
                    data: {
                        id: id,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong!');
                    }
                });
            });

            $('#shift').on('change', function() {
                let shiftId = $(this).val();
                $.ajax({
                    url: '{{ route('hris.setup.companywise-shifts.shift-details') }}',
                    type: 'POST',
                    data: {
                        shift: shiftId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            $('#shift_start').val(response.data.shift_start);
                            $('#shift_end').val(response.data.shift_end);
                            $('#break_start').val(response.data.break_start);
                            $('#break_end').val(response.data.break_end);
                            $('#break_duration').val(response.data.break_duration);
                            $('#break_duration_type').val(response.data.break_duration_type);
                            $('#late_after_minutes').val(response.data.late_after_minutes);
                            $('#is_active').val(response.data.is_active);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong!');
                    }
                });
            });
        });

        $(document).on('click', '.delete-shift', function(e) {
            e.preventDefault();
            let shiftId = $(this).data('id');
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
                        url: '{{ route('hris.setup.companywise-shifts.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: shiftId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'shift has been deleted.',
                                'success'
                            );
                            $('#row-' + shiftId).remove();
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                            $('#row-' + shiftId).remove();
                        }
                    });
                } else {
                    Swal.fire(
                        'Cancelled!',
                        'Shift has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
