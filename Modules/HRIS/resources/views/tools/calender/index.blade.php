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
            <div class="card alert-info alert-top-border">
                <div class="card-header">
                    <h5  class="my-0 text-primary text-center"> Calender</h5>
                </div>
                <form action="{{ route('hris.tools.calender.store') }}" id="applicantForm" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="card border">
                        <div class="card-body" style="overflow-y: auto;">
                            <div class="row">
                                <div class="col-6" style="margin:0px auto;">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td style="width: 80%;">
                                                    <x-text-input name="year" label="" type="text" value="{{ date('Y') }}" required readonly />
                                                </td>
                                                <td style="width: 20%;">
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
    </div>
@endsection

@push('scripts')
<script>

</script>
@endpush
