<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administration\Module;
use App\Models\Administration\Menu;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdministrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = [
            'total'    => Module::count(),
            'active'   => Module::active()->count(),
            'inactive' => Module::inactive()->count(),
        ];

        $menus = [
            'total'    => Menu::count(),
            'active'   => Menu::active()->count(),
            'inactive' => Menu::inactive()->count(),
        ];

        $users = [
            'total'    => User::count(),
            'active'   => User::active()->count(),
            'inactive' => User::where('is_active', '!=', 1)->count(),
        ];

        $roles = [
            'total'    => Role::count(),
            'active'   => Role::where('is_active', true)->count(),
            'inactive' => Role::where('is_active', false)->count(),
        ];

        return view('administration.dashboard', compact('modules', 'menus', 'users', 'roles'));
    }
}
