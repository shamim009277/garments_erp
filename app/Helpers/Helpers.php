<?php

use Illuminate\Support\Facades\Auth;

function getRole()
{
    return Auth::user()->role;
}
