@extends('layouts.app')
@section('title', 'ORDER MANAGEMENT')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'Compositions',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Compositions', 'url' => route('ordermanagement.setup.compositions.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Compositions List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            {{-- // $table->string('composition_code', 20)->unique(); // Like C001
                            //         $table->string('composition_name', 100);
                            //         $table->string('composition_description')->nullable();
                            //         $table->boolean('is_active')->default(true); --}}
                            <tr>
                                <th>#</th>
                                <th>Composition Code</th>
                                <th>Composition Name</th>
                                <th>Composition Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($compositions as $key => $composition)
                                <tr id="row-{{ $composition->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $composition->composition_code }}</td>
                                    <td>{{ $composition->composition_name }}</td>
                                    <td>{{ $composition->composition_description }}</td>
                                    <td class="text-center">
                                        <div class="square-switch">
                                            <input type="checkbox" id="composition-switch-{{ $composition->id }}"
                                                class="composition-toggle" data-id="{{ $composition->id }}"
                                                switch="bool" {{ $composition->is_active ? 'checked' : '' }} />
                                            <label for="composition-switch-{{ $composition->id }}" data-on-label="Yes"
                                                data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $composition->id }}"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-composition"
                                            data-id="{{ $composition->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $composition->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $composition->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $composition->id }}">Edit
                                                    Composition</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('ordermanagement.setup.compositions.update', $composition->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <x-input-group name="composition_code" label="Composition Code"
                                                        :value="$composition->composition_code" required />
                                                    <x-input-group name="composition_name" label="Composition Name" :value="$composition->composition_name"
                                                        required />
                                                    <x-input-group name="composition_description" label="Composition Description" :value="$composition->composition_description"
                                                        required />
                                                    <x-select-input-group name="is_active" label="Is Active?"
                                                        :options="['1' => 'Active', '0' => 'Inactive']" :selected="$composition->is_active ? '1' : '0'" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Composition ...</h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('ordermanagement.setup.compositions.store') }}" method="POST">
                        @csrf
                        <x-input-group name="composition_name" label="Composition Name" placeholder="Enter composition name"
                            :value="old('composition_name')" required />
                        <x-input-group name="composition_description" label="Composition Description" placeholder="Enter composition description"
                            :value="old('composition_description')" required />
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
        $(document).on('change', '.composition-toggle', function() {
            let id = $(this).data('id');
            let status = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: '{{ route('ordermanagement.setup.compositions.toggle') }}',
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

        $(document).on('click', '.delete-composition', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
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
                        url: '{{ route('ordermanagement.setup.compositions.destroy', ':id') }}'.replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                $('#row-' + id).remove();
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
