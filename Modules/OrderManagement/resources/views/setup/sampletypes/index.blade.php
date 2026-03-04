@extends('layouts.app')
@section('title', 'ORDER MANAGEMENT')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'ORDER MANAGEMENT',
                'subtitle' => 'Sample Types',
                'breadcrumbs' => [
                    ['label' => 'ORDER MANAGEMENT', 'url' => route('ordermanagement.index')],
                    ['label' => 'Setup', 'url' => route('ordermanagement.index')],
                    ['label' => 'Sample Types', 'url' => route('ordermanagement.setup.sampletypes.index')],
                ],
            ])
        </div>
        <div class="col-md-8">
            <div class="card alert-primary alert-top-border padding-card">
                <div class="card-header">
                    <h6 class="my-0 text-primary"> <i data-feather="list" width="16" height="16"></i> Sample Types List
                    </h6>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sample Type Code</th>
                                <th>Sample Type Name</th>
                                <th>Sample Type Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sampletypes as $key => $sampletype)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $sampletype->sample_type_code }}</td>
                                    <td>{{ $sampletype->sample_type_name }}</td>
                                    <td>{{ $sampletype->sample_type_description }}</td>
                                    <td>{{ $sampletype->is_active ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                            style="padding: 4px 6px;" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $sampletype->id }}"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="{{ route('ordermanagement.setup.sampletypes.destroy', $sampletype->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this sample type?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                {{-- load edit modal --}}
                                <div class="modal fade" id="editModal{{ $sampletype->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $sampletype->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $sampletype->id }}">Edit
                                                    Sample Type</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="moduleForm"
                                                    action="{{ route('ordermanagement.setup.sampletypes.update', $sampletype->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <x-input-group name="sample_type_name" label="Sample Type Name"
                                                        :value="$sampletype->sample_type_name" required />
                                                    <x-input-group name="sample_type_description"
                                                        label="Sample Type Description" :value="$sampletype->sample_type_description" required />
                                                    <x-select-input-group name="is_active" label="Is Active?"
                                                        :options="['1' => 'Active', '0' => 'Inactive']" :selected="$sampletype->is_active ? '1' : '0'" required />
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
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Input Parameters For New Sample Type ...
                    </h6>
                </div>
                <div class="card-body">
                    <form id="moduleForm" action="{{ route('ordermanagement.setup.sampletypes.store') }}" method="POST">
                        @csrf
                        <x-input-group name="sample_type_name" label="Sample Type Name" placeholder="Enter sample type name"
                            :value="old('sample_type_name')" required />
                        <x-input-group name="sample_type_description" label="Sample Type Description"
                            placeholder="Enter sample type description" :value="old('sample_type_description')" required />
                        <x-select-input-group name="is_active" label="Is Active?" :options="['1' => 'Active', '0' => 'Inactive']" :selected="old('is_active', '1')"
                            required />
                        <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
