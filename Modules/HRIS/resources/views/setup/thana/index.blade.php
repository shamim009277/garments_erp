@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Thana',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Setup', 'url' => route('hris.index')],
                    ['label' => 'Thana', 'url' => route('hris.setup.thanas.index')],
                ],
            ])
        </div>
        <div class="col-lg-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header py-2 px-3" style="padding: 12px 10px !important">
                    <div class="row w-100 align-items-center" style="margin:0 !important">
                        <!-- Title -->
                        <div class="col-12 col-md-4 mb-2 mb-md-0">
                            <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Thana List</h6>
                        </div>

                        <!-- Filters -->
                        <div class="col-12 col-md-8 d-flex flex-wrap justify-content-md-end gap-2">
                            <form method="GET" action="{{ route('hris.setup.thanas.index') }}" class="row" style="padding: 0px; margin:0px; width: 40%;">
                                <div class="d-flex align-items-center gap-2 flex-nowrap">
                                    <input type="text" name="search" class="form-control form-control-sm flex-grow-1" value="{{ request('search') }}" placeholder="Search by name, bangla or district...">
                                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- 📋 Table -->
                    <div class="">
                        <table class="table table-bordered table-striped table-hover dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th width="5%">SL</th>
                                    <th width="15%">Name</th>
                                    <th width="25%">Bangla</th>
                                    <th width="25%">District</th>
                                    <th width="15%">Is Active</th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($thanas as $key => $thana)
                                    <tr id="row-{{ $thana->id }}">
                                        <td>{{ $thanas->firstItem() + $key }}</td>
                                        <td>{{ $thana->name }}</td>
                                        <td>{{ $thana->bn_name }}</td>
                                        <td>{{ $thana->district->name }}</td>
                                        <td>
                                            <div class="square-switch" style="transform: scale(0.85); transform-origin: left center;">
                                                <input type="checkbox" id="square-switch3{{ $thana->id }}" class="thana-toggle" data-id="{{ $thana->id }}" switch="bool" {{ $thana->is_active ? 'checked' : '' }} />
                                                <label for="square-switch3{{ $thana->id }}" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-soft-success waves-effect waves-light" style="padding: 4px 6px; transform: scale(0.85);" data-bs-toggle="modal" data-bs-target="#editModal{{ $thana->id }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-thana" data-id="{{ $thana->id }}" style="padding: 4px 6px; transform: scale(0.85);">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>

                                        <!-- ✏️ Edit Modal -->
                                        <div id="editModal{{ $thana->id }}" class="modal fade" tabindex="-1"
                                            aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="myModalLabel">Edit Thana</h6>
                                                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form id="editForm{{ $thana->id }}" action="{{ route('hris.setup.thanas.update', $thana->id) }}" method="POST">
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('PUT')
                                                            <x-input-group name="name" label="Name" type="text" placeholder="Enter name" :value="$thana->name" required />
                                                            <x-input-group name="bn_name" label="Bangla" type="text" placeholder="Enter bangla" :value="$thana->bn_name" required />
                                                            <x-select-input-group name="district_id" label="District" :options="$districts" :selected="$thana->district_id" required />
                                                            <x-select-input-group name="is_active" label="Is Active" :options="['1' => 'Active', '0' => 'Inactive']" :selected="$thana->is_active" required />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                            <x-primary-button class="btn-sm">Save changes</x-primary-button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No data found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- 📄 Pagination -->
                        <div class="mt-2">
                            {{ $thanas->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Thana ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('hris.setup.thanas.store') }}" method="POST">
                        @csrf
                        <x-input-group name="name" label="Name" type="text" placeholder="Enter name"
                            :value="old('name')" required />
                        <x-input-group name="bn_name" label="Bangla" type="text" placeholder="Enter bangla"
                            :value="old('bn_name')" required />
                        <x-select-input-group name="district_id" label="District" :options="$districts" :selected="old('district_id')"
                            required />
                        <x-select-input-group name="is_active" label="Is Active?" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('is_active', '1')"
                            required />
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
            $('.thana-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('hris.setup.thanas.toggle') }}',
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

        $(document).on('click', '.delete-thana', function(e) {
            e.preventDefault();
            let thanaId = $(this).data('id');
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
                        url: '{{ route('hris.setup.thanas.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: thanaId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Thana has been deleted.',
                                'success'
                            );
                            $('#row-' + thanaId).remove();
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
                        'Thana has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
