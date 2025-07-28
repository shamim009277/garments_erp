@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Designation',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Setup', 'url' => route('hris.index')],
                    ['label' => 'Designation', 'url' => route('hris.setup.designations.index')],
                ],
            ])
        </div>
        <div class="col-lg-8 pr-0">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Designation List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th width="">SL</th>
                                <th width="">Designation</th>
                                <th width="">Designation Bangla</th>
                                <th width="">Parent Designation</th>
                                <th width="">Grade</th>
                                <th width="">Category</th>
                                <th width="">Approved MP</th>
                                <th width="">Is Active</th>
                                <th width="">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($designations as $designation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $designation->designation }}</td>
                                    <td>{{ $designation->designation_bn }}</td>
                                    <td>{{ $designation->parentDesignation->designation }}</td>
                                    <td>{{ $designation->grade }}</td>
                                    <td>{{ $designation->category->category }}</td>
                                    <td>{{ $designation->approved_mp }}</td>
                                    <td>
                                        <div class="square-switch">
                                            <input type="checkbox" id="square-switch3{{ $designation->id }}" class="designation-toggle" data-id="{{ $designation->id }}" switch="bool" {{ $designation->is_active ? 'checked' : '' }} />
                                            <label for="square-switch3{{ $designation->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $designation->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-organization" data-id="{{ $designation->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>

                                    <div id="editModal{{ $designation->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="myModalLabel">Edit Designation</h6>
                                                    <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form id="editForm{{ $designation->id }}" action="{{ route('hris.setup.designations.update', $designation->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <x-input-group name="designation" label="Designation" type="text" placeholder="Enter designation" :value="old('designation', $designation->designation)" required />
                                                        <x-input-group name="designation_bn" label="Designation(Bangla)" placeholder="Enter designation(bangla)" :value="old('designation_bn', $designation->designation_bn)" />
                                                        <x-select-search-input name="parent_designation_id" label="Parent Designation" :options="$parentDesignations" :selected="old('parent_designation_id', $designation->parent_designation_id)" required />
                                                        <x-input-group name="grade" label="Grade" placeholder="Enter grade" :value="old('grade', $designation->grade)" required />
                                                        <x-select-search-input name="category_code" label="Category" :options="$categories" :selected="old('category_code', $designation->category_code)" required />
                                                        <x-input-group name="approved_mp" label="Approved MP" type="number" placeholder="Enter approved mp" :value="old('approved_mp', $designation->approved_mp)" required />
                                                        <x-select-input-group name="is_attn_bonus" label="Is Attn Bonus?" :options="['1' => 'Yes', '0' => 'No']" :selected="old('is_attn_bonus', $designation->is_attn_bonus)" required />
                                                        <x-input-group name="attendance_bonus" label="Attendance Bonus" type="number" placeholder="Enter attendance bonus" :value="old('attendance_bonus', $designation->attendance_bonus)" required />
                                                        <x-input-group name="tiffin_bill" label="Tiffin Bill" type="number" placeholder="Enter tiffin bill" :value="old('tiffin_bill', $designation->tiffin_bill)" required />
                                                        <x-input-group name="night_bill1" label="Night Bill" type="number" placeholder="Enter night bill" :value="old('night_bill', $designation->night_bill1)" required />
                                                        <x-select-input-group name="is_active" label="Is Active?" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('is_active', $designation->is_active)" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Designation ...
                    </h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('hris.setup.designations.store') }}" method="POST">
                        @csrf
                        <x-input-group name="designation" label="Designation" type="text" placeholder="Enter designation" :value="old('designation')" required />
                        <x-input-group name="designation_bn" label="Designation(Bangla)" placeholder="Enter designation(bangla)" :value="old('designation_bn')" />
                        <x-select-search-input name="parent_designation_id" label="Parent Designation" :options="$parentDesignations" :selected="old('parent_designation_id')" required />
                        <x-input-group name="grade" label="Grade" placeholder="Enter grade" :value="old('grade')" required />
                        <x-select-search-input name="category_code" label="Category" :options="$categories" :selected="old('category_code')" required />
                        <x-input-group name="approved_mp" label="Approved MP" type="number" placeholder="Enter approved mp" :value="old('approved_mp')" required />
                        <x-select-input-group name="is_attn_bonus" label="Is Attn Bonus?" :options="['1' => 'Yes', '0' => 'No']" :selected="old('is_attn_bonus', '1')" required />
                        <x-input-group name="attendance_bonus" label="Attendance Bonus" type="number" placeholder="Enter attendance bonus" :value="old('attendance_bonus')" required />
                        <x-input-group name="tiffin_bill" label="Tiffin Bill" type="number" placeholder="Enter tiffin bill" :value="old('tiffin_bill')" required />
                        <x-input-group name="night_bill1" label="Night Bill" type="number" placeholder="Enter night bill" :value="old('night_bill')" required />
                        <x-select-input-group name="is_active" label="Is Active?" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('is_active', '1')" required />
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
            $('.designation-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.designations.toggle') }}',
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

        $(document).on('click', '.delete-designation', function(e) {
            e.preventDefault();
            let designationId = $(this).data('id');
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
                        url: '{{ route('hris.setup.designations.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: designationId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Designation has been deleted.',
                                'success'
                            );
                            $('#row-' + designationId).remove();
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
                        'Designation has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
