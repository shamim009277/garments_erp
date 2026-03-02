@extends('layouts.app')
@section('title', 'HRIS')
@section('content')
    <div class="row">
        <div class="col-12">
            @include('components.breadcrumb', [
                'title' => 'HRIS',
                'subtitle' => 'Employee Increment',
                'breadcrumbs' => [
                    ['label' => 'HRIS', 'url' => route('hris.index')],
                    ['label' => 'Database', 'url' => route('hris.index')],
                    ['label' => 'Employee Increment', 'url' => route('hris.database.employee-increment.index')],
                ],
            ])
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Centered Title -->
                <h4 class="text-center flex-grow-1 order-1 order-md-0 mb-2 mb-md-0">
                   Employee Increment
                </h4>
            </div>
        </div>
        <div class="col-lg-6" style="margin:0px auto">
            <form action="{{ route('hris.database.employee-increment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card alert-primary alert-top-border padding-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="my-0 text-primary mb-0">
                            <i data-feather="list" width="18" height="18"></i> Employee Increment
                        </h6>
                        <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal">
                            <i data-feather="download" width="16" height="16"></i> Export
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm" style="width: 100%">
                            <tbody>
                                <tr>
                                    <td colspan="2" style="width: 100%">
                                        <input type="file" name="file" id="file" class="form-control form-control-sm" accept=".xlsx, .xls,.csv" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="increment_type_id">Increment Type</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <x-select-input name="increment_type_id" id="increment_type_id" class="select2" :options="$incrementTypes" :selected="old('increment_type_id', '1')" placeholder="Select" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="increment_date">Increment Date</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <x-text-input type="date" name="increment_date" id="increment_date" class="form-control form-control-sm" value="{{ $lastMonthStart }}" placeholder="Increment Date" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="effective_date">Effective Date</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <x-text-input type="date" name="effective_date" id="effective_date" class="form-control form-control-sm" value="{{ $lastMonthStart }}" placeholder="Effective Date" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="arrear_upto_date">Arrear Upto Date</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <x-text-input type="date" name="arrear_upto_date" id="arrear_upto_date" class="form-control form-control-sm" placeholder="YYYY-MM-DD" />
                                    </td>
                                </tr>

                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="increment_source">Increment Source</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <x-select-input name="increment_source" id="increment_source" class="select2" :options="['B' => 'B || From Basic', 'G' => 'G || From Gross']" placeholder="Increment Source" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="increment_source">Increment Value</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <x-select-input name="increment_value" id="increment_value" class="select2" :options="['P' => 'P || Percentage', 'F' => 'F || Flat']" placeholder="Increment Value" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="amount">Amount (P/F)</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <input type="number" name="amount" id="amount" min="0" class="form-control form-control-sm" placeholder="Flat / Percentage Amount" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="house_rent_basic">HR % Basic</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <input type="text" name="house_rent_basic" id="house_rent_basic" class="form-control form-control-sm" value="{{ (int)$hroption->house_rant_percent_basic }} %"  placeholder="House Rant % Basic" readonly/>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="remarks">Remarks</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <textarea name="remarks" id="remarks" class="form-control form-control-sm" placeholder="Remarks"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer" style="padding:10px 20px;">
                        <button type="submit" id="submitBtn" class="btn btn-sm btn-primary float-end" style="margin-right: 10px;"> <i data-feather="log-out" width="14" height="14"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Download Sample Export File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center text-danger">Download the sample file to increment, update the data, then import the file.</h6>
                    <div class="text-center">
                        <a href="{{ route('hris.database.employee-increment.download-sample') }}" class="btn btn-sm btn-primary waves-effect waves-light">Download Sample</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
