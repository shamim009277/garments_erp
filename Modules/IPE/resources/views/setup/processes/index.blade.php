@extends('layouts.app')
@section('title', 'IPE')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'IPE',
                'subtitle' => 'Process List',
                'breadcrumbs' => [
                    ['label' => 'IPE', 'url' => route('ipe.index')],
                    ['label' => 'Setup', 'url' => route('ipe.index')],
                    ['label' => 'Process List', 'url' => route('ipe.setup.processes.index')],
                ],
            ])
        </div>
        <div class="col-lg-12">
            <div class="card alert-info alert-top-border">
                <div class="card-header" style="padding: 12px 10px !important">
                    <h6 class="my-0 text-primary"> <i class="mdi mdi-list"></i> Process List</h6>
                </div>
                <form id="moduleForm" action="{{ route('ipe.setup.processes.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100" width="100%">
                            <thead>
                                <tr>
                                    <th width="2%">SL</th>
                                    <th width="7%">Process</th>
                                    <th width="8%">Code</th>
                                    <th width="12%">Item</th>
                                    <th width="">Process Name</th>
                                    <th width="">Process Bangla</th>

                                    <th width="8%">Std. Capacity</th>
                                    <th width="8%">Std. Time</th>
                                    <th width="5%">Status</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <select name="process" id="process"
                                            class="form-control form-control-sm @error('process') is-invalid @enderror"
                                            required>
                                            <option value="Numbering">Numbering</option>
                                            <option value="Bundeling">Bundeling</option>
                                            <option value="Folding">Folding</option>
                                            <option value="Poly">Poly</option>
                                            <option value="Hang Tag">Hang Tag</option>
                                            <option value="Scissor">Scissor</option>
                                            <option value="Recut">Recut</option>
                                            <option value="Auto Spreading">Auto Spreading</option>
                                            <option value="Manual Spreading">Manual Spreading</option>
                                            <option value="Heat Seal">Heat Seal</option>
                                        </select>
                                        @error('process')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="process_code"
                                            class="form-control form-control-sm @error('process_code') is-invalid @enderror"
                                            placeholder="i.e. Process Code" required readonly>
                                        @error('process_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="item"
                                            class="form-control form-control-sm @error('item') is-invalid @enderror"
                                            placeholder="i.e. Item" required>
                                        @error('item')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="process_name" id="process_name"
                                            class="form-control form-control-sm @error('process_name') is-invalid @enderror"
                                            placeholder="i.e. Process Name" required>
                                        @error('process_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="process_name_bn"
                                            class="form-control form-control-sm @error('process_name_bn') is-invalid @enderror"
                                            placeholder="i.e. Process Name Bangla" required>
                                        @error('process_name_bn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>

                                    <td>
                                        <input type="text" name="capacity"
                                            class="form-control form-control-sm @error('capacity') is-invalid @enderror"
                                            placeholder="i.e. Capacity" pattern="[0-9]+" inputmode="numeric"
                                            oninput="this.value = this.value.replace(/[^0-9]/g,'')" required>
                                        @error('capacity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="text" name="time"
                                            class="form-control form-control-sm @error('time') is-invalid @enderror"
                                            placeholder="i.e. Time" required readonly>
                                        @error('time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                    <td>
                                        <select name="is_active" id="is_active" class="form-control form-control-sm">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
                                    </td>
                                </tr>
                </form>
                @foreach ($processes as $process)
                    <tr id="row-{{ $process->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $process->process }}</td>
                        <td>{{ $process->process_code }}</td>
                        <td>{{ $process->item }}</td>
                        <td>{{ $process->process_name }}</td>
                        <td>{{ $process->process_name_bn }}</td>
                        <td class="text-center">{{ $process->capacity }}</td>
                        <td class="text-center">{{ $process->time }}</td>
                        <td class="text-center">
                            <div class="square-switch">
                                <input type="checkbox" id="square-switch3{{ $process->id }}" class="process-toggle"
                                    data-id="{{ $process->id }}" switch="bool"
                                    {{ $process->is_active ? 'checked' : '' }} />
                                <label for="square-switch3{{ $process->id }}" data-on-label="Yes" data-off-label="No"
                                    style="margin: 0px; vertical-align: middle;"></label>
                            </div>
                        </td>
                        <td class="text-center">
                            <a href="#" class="btn btn-soft-success waves-effect waves-light"
                                style="padding: 4px 6px;" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $process->id }}"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-process"
                                data-id="{{ $process->id }}" style="padding: 4px 6px;"><i class="fas fa-trash"></i></a>
                        </td>

                        <div id="editModal{{ $process->id }}" class="modal fade" tabindex="-1"
                            aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="myModalLabel">Edit Process</h6>
                                        <button type="button" class="btn-close btn btn-sm" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form id="editForm{{ $process->id }}"
                                        action="{{ route('ipe.setup.processes.update', $process->id) }}" method="POST">
                                        <div class="modal-body">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-2">
                                                <label>Process</label>
                                                <select name="process" class="form-control form-control-sm" required>
                                                    <option value="Numbering"
                                                        {{ $process->process == 'Numbering' ? 'selected' : '' }}>Numbering
                                                    </option>
                                                    <option value="Bundeling"
                                                        {{ $process->process == 'Bundeling' ? 'selected' : '' }}>Bundeling
                                                    </option>
                                                    <option value="Folding"
                                                        {{ $process->process == 'Folding' ? 'selected' : '' }}>Folding
                                                    </option>
                                                    <option value="Poly"
                                                        {{ $process->process == 'Poly' ? 'selected' : '' }}>Poly</option>
                                                    <option value="Hang Tag"
                                                        {{ $process->process == 'Hang Tag' ? 'selected' : '' }}>Hang Tag
                                                    </option>
                                                    <option value="Scissor"
                                                        {{ $process->process == 'Scissor' ? 'selected' : '' }}>Scissor
                                                    </option>
                                                    <option value="Recut"
                                                        {{ $process->process == 'Recut' ? 'selected' : '' }}>Recut</option>
                                                    <option value="Auto Spreading"
                                                        {{ $process->process == 'Auto Spreading' ? 'selected' : '' }}>Auto
                                                        Spreading</option>
                                                    <option value="Manual Spreading"
                                                        {{ $process->process == 'Manual Spreading' ? 'selected' : '' }}>
                                                        Manual Spreading</option>
                                                    <option value="Heat Seal"
                                                        {{ $process->process == 'Heat Seal' ? 'selected' : '' }}>Heat Seal
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-2">
                                                <label>Process Code</label>
                                                <input type="text" name="process_code"
                                                    class="form-control form-control-sm"
                                                    value="{{ $process->process_code }}" readonly>
                                            </div>

                                            <div class="mb-2">
                                                <label>Item</label>
                                                <input type="text" name="item" class="form-control form-control-sm"
                                                    value="{{ $process->item }}" required>
                                            </div>

                                            <div class="mb-2">
                                                <label>Process Name</label>
                                                <input type="text" name="process_name"
                                                    class="form-control form-control-sm"
                                                    value="{{ $process->process_name }}" required>
                                            </div>

                                            <div class="mb-2">
                                                <label>Process Name Bangla</label>
                                                <input type="text" name="process_name_bn"
                                                    class="form-control form-control-sm"
                                                    value="{{ $process->process_name_bn }}" required>
                                            </div>

                                            <div class="mb-2">
                                                <label>Capacity</label>
                                                <input type="text" name="capacity"
                                                    class="form-control form-control-sm" value="{{ $process->capacity }}"
                                                    pattern="[0-9]+" inputmode="numeric"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g,'')" required>
                                            </div>

                                            <div class="mb-2">
                                                <label>Time</label>
                                                <input type="text" name="time" class="form-control form-control-sm"
                                                    value="{{ $process->time }}" readonly>
                                            </div>

                                            <div class="mb-2">
                                                <label>Status</label>
                                                <select name="is_active" class="form-control form-control-sm">
                                                    <option value="1"
                                                        {{ $process->is_active == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0"
                                                        {{ $process->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect btn-sm"
                                                data-bs-dismiss="modal">Close</button>
                                            <x-primary-button id="submitBtn" class="float-start btn-sm submitBtn">Save
                                                changes</x-primary-button>
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
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('input[name="capacity"]').on('keyup change', function() {
                let capacity = parseFloat($(this).val());

                if (!isNaN(capacity) && capacity > 0) {

                    let time = 60 / capacity; // Time in minutes for one item

                    $('input[name="time"]').val(time.toFixed(3));

                } else {

                    $('input[name="time"]').val('0.000');
                }
            });

            function generateUniqueCode(name) {
                const matches = name.match(/\b[A-Za-z]/g);
                const prefix = matches ? matches.join('').toUpperCase() : 'CODE';
                const random = Math.floor(100 + Math.random() * 900);
                return prefix + '-' + random;
            }

            let timeout = null;

            $('#process_name').on('keyup', function() {
                clearTimeout(timeout);
                let name = $(this).val();

                timeout = setTimeout(function() {
                    if (name.length > 0) {
                        let code = generateUniqueCode(name);
                        $('input[name="process_code"]').val(code);
                    } else {
                        $('input[name="process_code"]').val('');
                    }
                }, 500);
            });
        });


        $(document).ready(function() {
            $('.process-toggle').on('change', function() {
                let id = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('ipe.setup.helperquestions.toggle') }}',
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

        $(document).on('click', '.delete-process', function(e) {
            e.preventDefault();
            let processId = $(this).data('id');
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
                        url: '{{ route('ipe.setup.processes.delete') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: processId
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Process has been deleted.',
                                'success'
                            );
                            $('#row-' + processId).remove();
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
                        'Process has not been deleted.',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush
