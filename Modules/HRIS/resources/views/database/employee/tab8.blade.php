<div class="card padding-card" style="margin-bottom: 0px !important;">
    <div class="card-body" style="min-height: 450px;">
        <div class="row">
            <div class="col-lg-6 col-md-6 pe-lg-0 pe-md-0">
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3">
                        <h6 class="my-0 text-primary">Documents</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped mb-0" id="academicTable" width="100%">
                            <thead>
                                <tr>
                                    <th style="">SL#</th>
                                    <th style="">Document</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 pe-lg-0 pe-md-0">
                <form action="{{ route('hris.database.employee.document') }}" method="POST">
                    @csrf
                    <div class="card alert-info alert-top-border padding-card">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 py-3" >
                            <h6 class="my-0 text-primary">Input Parameters For New Document</h6>
                        </div>
                        <div class="card-body" style="padding:10px 10px;">
                            <table class="table table-striped mb-0" id="academicTable" width="100%">
                                <tr>
                                    <th width="40%" style="border: none; text-align: center;">Document</th>
                                    <td width="60%" style="border: none;">
                                        @foreach ($documents as $document)
                                        <div class="form-check">
                                            <input type="hidden" name="employee_id[]" value="{{ $employee->employee_id }}">
                                            <input class="form-check-input" type="checkbox" style="display: inline-block;" name="document_id[]" id="document_id" value="{{ $document->id }}">
                                            <label class="form-check-label" for="document_id">{{ $document->name }}</label>
                                        </div>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th width="40%" style="border: none; text-align: center;"></th>
                                    <td width="60%" style="border: none;">
                                        <button class="btn btn-sm btn-success" id="checkAll" style="margin-right: 10px;">Check All</button>
                                        <button class="btn btn-sm btn-danger" id="uncheckAll">Uncheck All</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer" style="padding:10px 10px;">
                            <x-primary-button class="float-start btn-sm submitBtn">Save</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $('#checkAll').click(function (e) {
            e.preventDefault();
            $('input[type="checkbox"][name="document_id[]"]').prop('checked', true);
        });

        $('#uncheckAll').click(function (e) {
            e.preventDefault();
            $('input[type="checkbox"][name="document_id[]"]').prop('checked', false);
        });
    });
</script>
@endpush
