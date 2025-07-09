@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Sex',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Setup', 'url' => route('hris.index')],
                    ['label' => 'Sex', 'url' => route('hris.setup.sex.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Sex List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="15%">Code</th>
                                <th width="25%">Sex</th>
                                <th width="25%">Sex Bangla</th>
                                <th width="15%">Is Active</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sexes as $key => $sex)
                                <tr id="row-{{ $sex->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $sex->sx_code }}</td>
                                    <td>{{ $sex->sex }}</td>
                                    <td>{{ $sex->sex_bangla }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $sex->id }}" class="sex-toggle" data-id="{{ $sex->id }}" switch="bool" {{ $sex->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $sex->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $sex->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-sex" data-id="{{ $sex->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                    <div id="editModal{{ $sex->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Sex</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="editForm{{ $sex->id }}" action="{{ route('hris.setup.sex.update', $sex->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-input-group name="sex" label="Sex" type="text" placeholder="Enter sex" :value="$sex->sex" required />
                                                        <x-input-group name="sx_code" label="Code" type="text" placeholder="Enter sx code" :value="$sex->sx_code" required />
                                                        <x-input-group name="sex_bangla" label="Sex Bangla" type="text" placeholder="Enter sex bangla" :value="$sex->sex_bangla" required />
                                                        <x-select-input-group name="is_active" label="Is Active" :options="['1' => 'Active', '0' => 'Inactive']" :selected="$sex->is_active" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Sex ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('hris.setup.sex.store') }}" method="POST">
                        @csrf
                        <x-input-group name="sex" label="Sex" type="text" placeholder="Enter sex" :value="old('sex')" required />

                        <x-input-group name="sx_code" label="Code" type="text" placeholder="Enter sx code" :value="old('sx_code')" required />

                        <x-input-group name="sex_bangla" label="Sex Bangla" type="text" placeholder="Enter sex bangla" :value="old('sex_bangla')" required />

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
            $('.sex-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.sex.toggle') }}',
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

        $(document).on('click', '.delete-sex', function(e) {
            e.preventDefault();
            let sexId = $(this).data('id');
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
                        url: '{{ route('hris.setup.sex.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: sexId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Sex has been deleted.',
                                'success'
                            );
                            $('#row-' + sexId).remove();
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
                        'Sex has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
