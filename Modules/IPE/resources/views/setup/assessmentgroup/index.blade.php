@extends('layouts.app')
@section('title', 'IPE')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'IPE',
                'subtitle' => 'Assessment Group',
                'breadcrumbs' => [
                    ['label' => 'IPE', 'url' => route('ipe.index')],
                    ['label' => 'Setup', 'url' => route('ipe.index')],
                    ['label' => 'Assessment Group', 'url' => route('ipe.setup.assessment-groups.index')],
                ],
            ])
        </div>
        <div class="col-lg-8 pe-lg-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Assessment Group List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="20%">Group</th>
                                <th width="10%">Code</th>
                                <th width="45%">Designation</th>
                                <th width="10%">Is Active</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $key => $group)
                                <tr id="row-{{ $group->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $group->name }}</td>
                                    <td>{{ $group->code }}</td>
                                    <td>
                                        {{ $group->designations }}
                                    </td>
                                    <td>
                                        <x-toggle-switch :id="$group->id" :checked="$group->is_active" :data-id="$group->id"/>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $group->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-unit" data-id="{{ $group->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                    <div id="editModal{{ $group->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Unit</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="editForm{{ $group->id }}" action="{{ route('ipe.setup.assessment-groups.update', $group->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-input-group name="name" label="Name" type="text" placeholder="Enter name" :value="old('name', $group->name)" required />
                                                        <x-input-group name="code" label="Code" type="text" placeholder="Enter code" :value="old('code', $group->code)" required readonly />
                                                        <label for="line_id">Designation <span class="text-danger">*</span></label>
                                                        <x-select-multiple-input
                                                            name="designation_id[]"
                                                            id="designation_id_edit_"
                                                            class="select2 multiselect mb-2"
                                                            :options="$designations"
                                                            :selected="json_decode($group->designation_ids, true) ?? []"
                                                            multiple
                                                            required
                                                        />
                                                        <br><br>
                                                        <x-select-input-group
                                                            name="is_active"
                                                            class="mb-2"
                                                            label="Is Active?"
                                                            :options="['1' => 'Active', '0' => 'Inactive']"
                                                            :selected="old('is_active', '1')"
                                                            required
                                                        />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Group ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('ipe.setup.assessment-groups.store') }}" method="POST">
                        @csrf
                        <x-input-group name="name" label="Name" id="name" type="text" placeholder="Enter name" :value="old('name')" required />
                        <x-input-group name="code" label="Code" id="code" type="text" placeholder="Enter code" :value="old('code')" required readonly />
                        <label for="line_id">Designation <span class="text-danger">*</span></label>
                        <x-select-multiple-input
                            name="designation_id[]"
                            id="designation_id_add"
                            class="select2 multiselect mb-2"
                            :options="$designationswoexist"
                            :selected="old('designation_id', [])"
                            multiple
                            required
                        />
                        <br><br>
                        <x-select-input-group
                            name="is_active"
                            class="mb-2"
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
            function generateUniqueCode(name) {
                const matches = name.match(/\b[A-Za-z]/g);
                const prefix = matches ? matches.join('').toUpperCase() : 'CODE';
                const random = Math.floor(100 + Math.random() * 900);
                return prefix +' - '+ random;
            }

            let timeout = null;

            $('#name').on('keyup', function () {

                clearTimeout(timeout);
                let name = $(this).val();

                timeout = setTimeout(function () {
                    if (name.length > 0) {
                        let code = generateUniqueCode(name);
                        $('#code').val(code);
                    } else {
                        $('#code').val('');
                    }

                }, 500);

            });


            $('#line_id_add').select2({
                placeholder: 'Select Line',
                allowClear: true,
                multiple: true,
            });

            $('.select2.multiselect').each(function() {
                if (!$(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2();
                }
            });

            $('.group-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('ipe.setup.assessment-groups.toggle') }}',
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

        $(document).on('click', '.delete-unit', function(e) {
            e.preventDefault();
            let unitId = $(this).data('id');
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
                        url: '{{ route('ipe.setup.assessment-groups.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: unitId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Assessment group has been deleted.',
                                'success'
                            );
                            $('#row-' + unitId).remove();
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
                        'Assessment group has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
