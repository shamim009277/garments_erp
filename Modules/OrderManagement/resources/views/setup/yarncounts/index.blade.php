@extends('layouts.app')
@section('title', 'INVENTORY')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'Yarn Counts',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Yarn Counts', 'url' => route('ordermanagement.setup.yarncounts.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Yarn Counts List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            {{-- $table->string('yarn_count_code', 20)->unique(); // Like YC001
                            $table->string('yarn_count_name', 100);
                            $table->string('yarn_count_description')->nullable();
                            $table->boolean('is_active')->default(true); --}}
                            <tr>
                                <th>#</th>
                                <th>Yarn Count Code</th>
                                <th>Yarn Count Name</th>
                                <th>Yarn Count Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($yarnCounts as $key => $yarnCount)
                                <tr id="row-{{ $yarnCount->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $yarnCount->yarn_count_code }}</td>
                                    <td>{{ $yarnCount->yarn_count_name }}</td>
                                    <td>{{ $yarnCount->yarn_count_description }}</td>
                                    <td class="text-center">
                                        <div class="square-switch">
                                            <input type="checkbox" id="yarn-count-switch-{{ $yarnCount->id }}"
                                                class="yarn-count-toggle" data-id="{{ $yarnCount->id }}"
                                                switch="bool" {{ $yarnCount->is_active ? 'checked' : '' }} />
                                            <label for="yarn-count-switch-{{ $yarnCount->id }}" data-on-label="Yes"
                                                data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $yarnCount->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-yarn-count"
                                            data-id="{{ $yarnCount->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $yarnCount->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $yarnCount->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $yarnCount->id }}">Edit
                                                    Yarn Count</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('ordermanagement.setup.yarncounts.update', $yarnCount->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')


                                                    <x-input-group name="yarn_count_name" label="Yarn Count Name"
                                                        :value="$yarnCount->yarn_count_name" required />
                                                    <x-input-group name="yarn_count_description"
                                                        label="Yarn Count Description" :value="$yarnCount->yarn_count_description" required />
                                                    <x-select-input-group name="is_active" label="Is Active?"
                                                        :options="['1' => 'Active', '0' => 'Inactive']" :selected="$yarnCount->is_active ? '1' : '0'" required />
                                                    <x-primary-button
                                                        class="float-start btn-sm submitBtn">Save</x-primary-button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Yarn Count ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('ordermanagement.setup.yarncounts.store') }}" method="POST">
                        @csrf
                        <x-input-group name="yarn_count_name" label="Yarn Count Name" placeholder="Enter yarn count name"
                            :value="old('yarn_count_name')" required />
                        <x-input-group name="yarn_count_description" label="Yarn Count Description"
                            placeholder="Enter yarn count description" :value="old('yarn_count_description')" required />
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
            $('.yarn-count-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('ordermanagement.setup.yarncounts.toggle') }}',
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

        $(document).on('click', '.delete-yarn-count', function(e) {
            e.preventDefault();
            let yarnCountId = $(this).data('id');
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
                        url: '{{ route('ordermanagement.setup.yarncounts.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: yarnCountId
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                $('#row-' + yarnCountId).remove();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    </script>
@endpush
