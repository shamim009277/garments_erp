@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
@push('styles')
<style>
.table, tr, th, td {
    border: none !important;
    border-collapse: collapse;
}
</style>
@endpush
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Calender',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Tools', 'url' => route('hris.index')],
                    ['label' => 'Calender', 'url' => route('hris.tools.calender.index')],
                ],
            ])
        </div>
        <div class="col-lg-8 col-md-8 ps-lg-1 ps-md-1" style="margin:0px auto;">
            <div class="card alert-primary alert-top-border">
                <div class="card-header" style="padding: 15px 16px;">
                    <h5 class="my-0 text-primary text-center"> Calender</h5>
                </div>
                <form action="{{ route('hris.tools.calender.store') }}" id="applicantForm" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="card border">
                        <div class="card-body" style="overflow-y: auto;">
                            <div class="row">
                                <div class="col-lg-8" style="margin:0px auto;">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td style="width: 70%;">
                                                    <x-text-input name="year" label="" class="form-control" type="text" value="{{ date('Y') }}" required readonly />
                                                </td>
                                                <td style="width: 30%;">
                                                    <x-primary-button id="submitBtn" class="btn-sm submitBtn" type="submit" style="width: 100%; padding: 8px 6px;">Generate</x-primary-button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8 col-md-8 ps-lg-1 ps-md-1" style="margin:0px auto;">
            <div class="card" style="overflow-y: auto;">
                <div class="card-header" style="padding: 15px 16px;">
                    <h6  class="my-0 text-primary"><i data-feather="list" width="16" height="16"></i> Calender List</h6>
                </div>
                <div class="card-body">
                    <table id="datacom" class="table table-striped" width="100%">
                        <thead class="table-light">
                            <tr>
                                <th width="10%">Date</th>
                                <th width="10%">Holiday?</th>
                                <th width="10%">Public Holiday?</th>
                                <th width="10%">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calender as $item)
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                <td>
                                    <input type="text" id="holiday_{{ $item->id }}" class="form-control form-control-sm" name="holiday" value="{{ $item->holiday }}">
                                </td>
                                <td>
                                    <input type="text" id="public_holiday_{{ $item->id }}" class="form-control form-control-sm" name="public_holiday" value="{{ $item->public_holiday }}">
                                </td>
                                <td>
                                    <input type="text" onblur="updateCalender({{ $item->id }})" id="note_{{ $item->id }}" class="form-control form-control-sm note" data-id="{{ $item->id }}" name="note" value="{{ $item->note }}">
                                </td>
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
    function updateCalender(id) {
        var note = $('#note_' + id).val();
        var holiday = $('#holiday_' + id).val();
        var public_holiday = $('#public_holiday_' + id).val();

        $.ajax({
            url: '{{ route("hris.tools.calender.update", ":id") }}'.replace(':id', id),
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                note: note,
                holiday: holiday,
                public_holiday: public_holiday
            },
            success: function(response) {
                if(response.success){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update',
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
    $('#datacom').DataTable({
        paging: false,
        lengthChange: false,
        searching: true,
        ordering: false,
        scrollY: "400px",
        scrollX: true,
        scrollCollapse: true,
        fixedHeader: true,

        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                className: 'btn btn-sm btn-success'
            },
            {
                extend: 'csv',
                className: 'btn btn-sm btn-info'
            }
        ]
    });
</script>
@endpush
