@extends('layouts.app')
@section('title', 'ORDER MANAGEMENT')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'Wash Types',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Wash Types', 'url' => route('ordermanagement.setup.washtypes.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Wash Types List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Wash Type Code</th>
                                <th>Wash Type Name</th>
                                <th>Wash Type Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($washtypes as $key => $washtype)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $washtype->wash_type_code }}</td>
                                    <td>{{ $washtype->wash_type_name }}</td>
                                    <td>{{ $washtype->wash_type_description }}</td>
                                    <td>{{ $washtype->is_active ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $washtype->id }}"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('ordermanagement.setup.washtypes.destroy', $washtype->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this wash type?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $washtype->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $washtype->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $washtype->id }}">Edit
                                                    Wash Type</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('ordermanagement.setup.washtypes.update', $washtype->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <x-input-group name="wash_type_name" label="Wash Type Name"
                                                        :value="$washtype->wash_type_name" required />
                                                    <x-input-group name="wash_type_description"
                                                        label="Wash Type Description" :value="$washtype->wash_type_description" required />
                                                    <x-select-input-group name="is_active" label="Is Active?"
                                                        :options="['1' => 'Active', '0' => 'Inactive']" :selected="$washtype->is_active ? '1' : '0'" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Wash Type ...
                    </h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('ordermanagement.setup.washtypes.store') }}" method="POST">
                        @csrf
                        <x-input-group name="wash_type_name" label="Wash Type Name" placeholder="Enter wash type name"
                            :value="old('wash_type_name')" required />
                        <x-input-group name="wash_type_description" label="Wash Type Description"
                            placeholder="Enter wash type description" :value="old('wash_type_description')" required />
                        <x-select-input-group name="is_active" label="Is Active?" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('is_active', '1')"
                            required />
                        <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
