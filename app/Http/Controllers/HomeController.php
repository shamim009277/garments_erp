<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administration\Module;

class HomeController extends Controller
{
    public function dashboard(){
        $modules = Module::active()->select('id', 'name', 'url', 'image', 'slug')->get();
        return view('dashboard', compact('modules'));
    }

    public function home(){
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }
}
