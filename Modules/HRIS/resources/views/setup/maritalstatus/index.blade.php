@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Marital Status',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Setup', 'url' => route('hris.index')],
                    ['label' => 'Marital Status', 'url' => route('hris.setup.maritalstatus.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Marital Status List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="15%">Code</th>
                                <th width="25%">Marital Status</th>
                                <th width="25%">Marital Status Bangla</th>
                                <th width="15%">Is Active</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($maritalStatuses as $key => $maritalStatus)
                                <tr id="row-{{ $maritalStatus->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $maritalStatus->ms_code }}</td>
                                    <td>{{ $maritalStatus->maritalstatus }}</td>
                                    <td>{{ $maritalStatus->maritalstatus_bangla }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $maritalStatus->id }}" class="maritalstatus-toggle" data-id="{{ $maritalStatus->id }}" switch="bool" {{ $maritalStatus->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $maritalStatus->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $maritalStatus->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-maritalstatus" data-id="{{ $maritalStatus->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                    <div id="editModal{{ $maritalStatus->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Marital Status</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="editForm{{ $maritalStatus->id }}" action="{{ route('hris.setup.maritalstatus.update', $maritalStatus->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-input-group name="maritalstatus" label="Marital Status" type="text" placeholder="Enter marital status" :value="$maritalStatus->maritalstatus" required />
                                                        <x-input-group name="ms_code" label="Code" type="text" placeholder="Enter marital status code" :value="$maritalStatus->ms_code" required />
                                                        <x-input-group name="maritalstatus_bangla" label="Marital Status Bangla" type="text" placeholder="Enter marital status bangla" :value="$maritalStatus->maritalstatus_bangla" required />
                                                        <x-select-input-group name="is_active" label="Is Active" :options="['1' => 'Active', '0' => 'Inactive']" :selected="$maritalStatus->is_active" required />
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

        <div class="col-md-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Marital Status ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('hris.setup.maritalstatus.store') }}" method="POST">
                        @csrf
                        <x-input-group name="maritalstatus" label="Marital Status" type="text" placeholder="Enter marital status" :value="old('maritalstatus')" required />
                        <x-input-group name="ms_code" label="Code" type="text" placeholder="Enter marital status code" :value="old('ms_code')" required />
                        <x-input-group name="maritalstatus_bangla" label="Marital Status Bangla" type="text" placeholder="Enter marital status bangla" :value="old('maritalstatus_bangla')" required />
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
            $('.maritalstatus-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.maritalstatus.toggle') }}',
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
        });

        $(document).on('click', '.delete-maritalstatus', function(e) {
            e.preventDefault();
            let maritalStatusId = $(this).data('id');
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
                        url: '{{ route('hris.setup.maritalstatus.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: maritalStatusId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Marital Status has been deleted.',
                                'success'
                            );
                            $('#row-' + maritalStatusId).remove();
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
                        'Marital Status has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
