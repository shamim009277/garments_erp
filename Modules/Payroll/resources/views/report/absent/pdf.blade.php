@extends('payroll::components.layouts.pdf')
@section('title', 'Punch Report')
@php
    $reportTitle = match ($title) {
        '1' => 'Department-wise Daily Punch',
        '2' => 'Individual Card Wise Monthly Punch',
    };

    $reportSubTitle = in_array($title, [2])
        ? 'Month: '.($monthName . ' ' . $year  ?? '')
        : (in_array($title, [1,3,4,5])
            ? "Date: {$date}"
            : null);
@endphp
@section('content')
    @if($title == 1)
        
    @elseif($title == 2)
        
    @endif
@endsection