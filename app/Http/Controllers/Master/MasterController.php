<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\GeneralSetting;

class MasterController extends Controller
{
    public function index()
    {
        return view('master.dashboard');
    }
}
