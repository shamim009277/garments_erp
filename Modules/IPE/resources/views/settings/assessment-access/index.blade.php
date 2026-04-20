@extends('layouts.app')
@section('title', 'IPE')
@push('styles')
    <style>
        input[type="checkbox"] {
            display: inline-block !important;
            opacity: 1 !important;
        }
        .disabled-select {
            cursor: not-allowed !important;
            background-color: #dad9d9 !important;
        }
        .form-check-input:checked:disabled {
            background-color: #b7bbf5 !important;
            border: 1px solid #b7bbf5 !important;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'IPE',
                'subtitle' => 'Assessment Access',
                'breadcrumbs' => [
                    ['label' => 'IPE', 'url' => route('ipe.index')],
                    ['label' => 'Settings', 'url' => route('ipe.index')],
                    ['label' => 'Assessment Access'],
                ],
            ])
        </div>
        <div class="col-lg-8 pe-lg-0">
            <div class="card alert-info alert-top-border">
                <div class="card-header" style="padding: 12px 10px !important">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> User Access List</h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="35%">User</th>
                                <th width="30%">Department</th>
                                <th width="15%">Organization</th>
                                <th width="15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key => $data)
                                <tr id="row-{{ $data->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->user->name }} ({{ $data->user->employee_id ?? '-' }})</td>
                                    <td>{{ $data->department->department }}</td>
                                    <td>
                                        {{ $data->organization->short_name }}
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-data" data-id="{{ $data->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header py-2 px-3" style="padding: 12px 10px !important">
                    <div class="row w-100 align-items-center" style="margin:0 !important">
                        <h6 class="my-0 text-primary"><i data-feather="user-plus" width="16" height="16"></i>Input Parameters For User Access</h6>
                    </div>
                </div>

                <form id="user_form" action="{{ route('ipe.settings.assessment-access.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <table class="table table-sm" style="width: 100%; padding-bottom:0px; margin-bottom:0px;">
                            <tbody>
                                <tr>
                                    <td colspan="2" style="width: 100%">
                                        <x-select-input name="org_id" id="org_id" class="select2" :options="$organizations" :selected="old('org_id', '1')" placeholder="Select" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">
                                        <label class="m-0" for="user_id">Users</label>
                                    </td>
                                    <td width="65%" id="user_section">
                                        <x-select-input name="user_id" id="user_id" class="select2" :options="$activeUsers" placeholder="User ID" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 100%">
                                        <x-select-input name="type" id="type" class="select2" :options="['1' => 'Assessment Access']" :selected="old('type', '1')" placeholder="Select" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">
                                        <input type="checkbox" name="all_department" id="all_department">
                                        <label class="m-0" for="all_department">All Department</label>
                                    </td>
                                    <td width="65%" id="all_department_section">
                                        <x-select-input name="department_id" id="department_id" class="select2" :options="$departments" placeholder="Department ID" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 100%">
                                        <x-primary-button type="submit" id="add_user_button" class="btn btn-sm btn-primary float-end" >Add Access</x-primary-button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <div class="card alert-info alert-top-border">
                <div class="card-header" style="padding: 12px 10px !important">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For Replace User ...</h6>
                </div>

                <form id="user_form" action="{{ route('ipe.settings.assessment-access.replace') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <table class="table table-sm" style="width: 100%">
                            <thead>
                                <tr>
                                    <td colspan="2" style="width: 100%">
                                        <x-select-input name="org_id2" id="org_id2" class="select2" :options="$organizations" :selected="old('org_id2', '1')" placeholder="Select" required />
                                    </td>
                                </tr>
                                <tr>
                                    <th width="40%">
                                        <label class="m-0" for="existing_user">Existing User</label>
                                    </th>
                                    <td width="60%">
                                        <x-select-input name="existing_user" id="existing_user" class="select2" :options="$activeUsers" :selected="old('existing_user', '2')" placeholder="Select" required />
                                    </td>
                                </tr>
                                <tr>
                                    <th width="40%">
                                        <label class="m-0" for="replace_user">Replace User</label>
                                    </th>
                                    <td width="60%">
                                        <x-select-input name="replace_user" id="replace_user" class="select2" :options="$activeUsers" :selected="old('replace_user', '2')" placeholder="Select" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="category_id">Forward/Approve</label>
                                    </td>
                                    <td width="60%" id="forward_approve_section">
                                        <x-select-input name="type2" id="type2" class="select2" :options="['1' => 'Assessment Access']" :selected="old('type2', '1')" placeholder="Select" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 100%">
                                        <x-primary-button type="submit" id="add_user_button" class="btn btn-sm btn-primary float-end" >Replace User</x-primary-button>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#all_department').on('change', function () {
                handleToggle('#all_department', '#department_id', '#all_department_section');
            });

            function handleToggle(checkboxSelector, selectSelector, sectionSelector) {
                const isChecked = $(checkboxSelector).is(':checked');

                $(selectSelector)
                    .prop('disabled', isChecked)
                    .val(null).trigger('change');

                $(selectSelector).toggleClass('disabled-select', isChecked);
                $(sectionSelector).toggleClass('disabled-select', isChecked);
            }
        });

        $(document).on('click', '.delete-data', function(e) {
            e.preventDefault();
            let dataId = $(this).data('id');
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
                        url: '{{ route('ipe.settings.assessment-access.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: dataId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Degree has been deleted.',
                                'success'
                            );
                            $('#row-' + degreeId).remove();
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
                        'Degree has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush

