<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

function getRole()
{
    return Auth::user()->role;
}

function calculateTotalHours($start_punch, $end_punch)
{
    if (empty($start_punch) || empty($end_punch)) {
        return 0;
    }
    try {
        $start = Carbon::parse($start_punch);
        $end = Carbon::parse($end_punch);
    } catch (\Exception $e) {
        return 0;
    }

    if ($end->lessThanOrEqualTo($start)) {
        return 0;
    }

    $workMinutes = $end->diffInMinutes($start);
    $hours = intdiv($workMinutes, 60);
    $minutes = $workMinutes % 60;
    if ($minutes >= 45) {
        $hours += 1;
    }

    return $hours;
}

function calculateActualHours($startPunch, $endPunch, $lunchStart = null, $lunchEnd = null)
{
    if (empty($startPunch) || empty($endPunch)) {
        return ['hours' => 0, 'minutes' => 0,'totalHours' => 0];
    }

    $start = Carbon::parse($startPunch);
    $end   = Carbon::parse($endPunch);

    if ($end->lte($start)) {
        return ['hours' => 0, 'minutes' => 0,'totalHours' => 0];
    }

    $workMinutes = ($end->timestamp - $start->timestamp) / 60;

    if ($lunchStart && $lunchEnd) {
        $lStart = Carbon::parse($lunchStart);
        $lEnd   = Carbon::parse($lunchEnd);

        // check overlap
        if ($start < $lEnd && $end > $lStart) {
            $overlapStart = $start > $lStart ? $start : $lStart;
            $overlapEnd   = $end < $lEnd ? $end : $lEnd;
            $overlapMinutes = ($overlapEnd->timestamp - $overlapStart->timestamp) / 60;
            $workMinutes -= $overlapMinutes;
        }
    }

    // Negative-proof
    $workMinutes = max(0, $workMinutes);

    // Hours and remaining minutes
    $hours = intdiv(floor($workMinutes), 60);
    $minutes = fmod($workMinutes, 60);

    // Fractional hours rounding
    $min = 0;
    $fracHour = 0;
    $totalHours = $hours;
    if ($minutes >= 45) {
        $hours += 1;
    } elseif ($minutes >= 25) {
        $min = $minutes;
        $fracHour = 0.5;
    }

    $totalHours = round($hours + $fracHour);

    return [
        'hours' => $hours,
        'minutes' => $min,
        'totalHours' => $totalHours
    ];
}

function calculateOtHours($start_punch, $end_punch)
{
    if (empty($start_punch) || empty($end_punch)) {
        return ['hours' => 0, 'minutes' => 0];
    }

    try {
        $start = Carbon::parse($start_punch);
        $end = Carbon::parse($end_punch);
    } catch (\Exception $e) {
        return ['hours' => 0, 'minutes' => 0];
    }

    // Negative-proof: যদি start>end, swap করে দাও
    if ($end->lessThan($start)) {
        [$start, $end] = [$end, $start];
    }

    // Work minutes (positive)
    $workMinutes = ($end->timestamp - $start->timestamp) / 60;
    $workMinutes = max(0, $workMinutes); // extra safety

    // Hours and leftover minutes
    $hours = intdiv(floor($workMinutes), 60);
    $minutes = $workMinutes % 60;

    // Round up if minutes >= 45
    if ($minutes >= 45) {
        $hours += 1;
        $minutes = 0;
    }

    return [
        'hours' => $hours,
        'minutes' => $minutes
    ];
}

function calculateLate($start_punch, $end_punch)
{
    if (empty($start_punch) || empty($end_punch)) {
        return 0;
    }

    try {
        $start = Carbon::parse($start_punch);
        $end = Carbon::parse($end_punch);
    } catch (\Exception $e) {
        return 0;
    }

    // Negative-proof: যদি start>end, swap করে দাও
    if ($end->lessThan($start)) {
        [$start, $end] = [$end, $start];
    }

    // Work minutes (positive)
    $workMinutes = ($end->timestamp - $start->timestamp) / 60;
    $workMinutes = max(0, $workMinutes);

    return $workMinutes;
}


