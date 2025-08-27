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
                    <div class="card-header">
                        <h6 class="my-0 text-primary"> <i data-feather="list" width="18" height="18"></i> Employee Increment</h6>
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
                                        <label class="m-0" for="increment_type">Increment Type</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <x-select-input name="increment_type" id="increment_type" class="select2" :options="['1' => 'Increment', '2' => 'Promotion', '3' => 'Increment & Promotion', '4' => 'Adjustment', '5' => 'Promotion & Adjustment', '6' => 'Designation Change', '7' => 'Reverse Amount']" :selected="old('increment_type', '1')" placeholder="Select" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="increment_date">Increment Date</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <x-text-input type="date" name="increment_date" id="increment_date" class="form-control form-control-sm" value="{{ $lastMonthStart }}" placeholder="Increment Date" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="effective_date">Effective Date</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <x-text-input type="date" name="effective_date" id="effective_date" class="form-control form-control-sm" value="{{ $lastMonthStart }}" placeholder="Effective Date" required />
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
                                        <x-select-input name="increment_source" id="increment_source" class="select2" :options="['B' => 'From Basic', 'G' => 'From Gross']" placeholder="Increment Source" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="increment_source">Increment Value</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <x-select-input name="increment_value" id="increment_value" class="select2" :options="['P' => 'Percentage', 'F' => 'Flat']" placeholder="Increment Value" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="amount">Amount (P/F)</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <input type="number" name="amount" id="amount" min="0" class="form-control form-control-sm" placeholder="Flat / Percentage Amount" required />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <label class="m-0" for="house_rent_basic">HR % Basic</label>
                                    </td>
                                    <td width="60%" id="category_section">
                                        <input type="text" name="house_rent_basic" id="house_rent_basic" class="form-control form-control-sm" value="{{ (int)$hroption->house_rant_percent_basic }} %"  placeholder="House Rant % Basic" required readonly/>
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
                        <button type="button" id="submitBtn" class="btn btn-sm btn-primary float-end" style="margin-right: 10px;"> <i data-feather="log-out" width="14" height="14"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>

</script>
@endpush
