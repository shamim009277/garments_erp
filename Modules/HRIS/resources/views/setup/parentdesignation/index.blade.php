@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Parent Designation',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Setup', 'url' => route('hris.index')],
                    ['label' => 'Parent Designation', 'url' => route('hris.setup.parentdesignations.index')],
                ],
            ])
        </div>
        <div class="col-lg-8 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Parent Designation List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="30%">Parent Designation</th>
                                <th width="30%">Parent Designation Bangla</th>
                                <th width="10%">Approved MP</th>
                                <th width="10%">Is Active</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parentDesignations as $key => $parentDesignation)
                                <tr id="row-{{ $parentDesignation->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $parentDesignation->parent_designation }}</td>
                                    <td>{{ $parentDesignation->parent_designation_bn }}</td>
                                    <td>{{ $parentDesignation->approved_mp }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $parentDesignation->id }}" class="parentdesignation-toggle" data-id="{{ $parentDesignation->id }}" switch="bool" {{ $parentDesignation->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $parentDesignation->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $parentDesignation->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-parentdesignation" data-id="{{ $parentDesignation->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                    <div id="editModal{{ $parentDesignation->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Parent Designation</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="editForm{{ $parentDesignation->id }}" action="{{ route('hris.setup.parentdesignations.update', $parentDesignation->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-input-group name="parent_designation" label="Parent Designation" type="text" placeholder="Enter parent designation" :value="$parentDesignation->parent_designation" required />
                                                        <x-input-group name="parent_designation_bn" label="Parent Designation(Bangla)" type="text" placeholder="Enter parent designation(bangla)" :value="$parentDesignation->parent_designation_bn" required />
                                                        <x-input-group name="approved_mp" label="Approved MP" type="number" placeholder="Enter approved mp" :value="$parentDesignation->approved_mp" required />
                                                        <x-select-input-group name="is_active" label="Is Active" :options="['1' => 'Active', '0' => 'Inactive']" :selected="$parentDesignation->is_active" required />
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

        <div class="col-lg-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Parent Designation ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('hris.setup.parentdesignations.store') }}" method="POST">
                        @csrf
                        <x-input-group name="parent_designation" label="Parent Designation" type="text" placeholder="Enter parent designation" :value="old('parent_designation')" required />
                        <x-input-group name="parent_designation_bn" label="Parent Designation(Bangla)" type="text" placeholder="Enter parent designation(bangla)" :value="old('parent_designation_bn')" required />
                        <x-input-group name="approved_mp" label="Approved MP" type="number" placeholder="Enter approved mp" :value="old('approved_mp')" required />
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
            $('.parentdesignation-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.parentdesignations.toggle') }}',
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

        $(document).on('click', '.delete-parentdesignation', function(e) {
            e.preventDefault();
            let parentdesignationId = $(this).data('id');
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
                        url: '{{ route('hris.setup.parentdesignations.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: parentdesignationId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Parent Designation has been deleted.',
                                'success'
                            );
                            $('#row-' + parentdesignationId).remove();
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
                        'Parent Designation has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
