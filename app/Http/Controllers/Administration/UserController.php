<?php

namespace App\Http\Controllers\Administration;

use App\Models\User;
use App\Traits\ToggleStatus;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Modules\HRIS\Models\Setup\Organization;
use App\Http\Requests\Administration\UserRequest;

class UserController extends Controller
{
    use ToggleStatus;

    function __construct()
    {
        $this->middleware('permission:administration.user.view')->only('index');
        $this->middleware('permission:administration.user.add')->only('store');
        $this->middleware('permission:administration.user.edit')->only(['edit', 'update','toggleStatus']);
        $this->middleware('permission:administration.user.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('users.*')->with('organization');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($row) {
                    return $row->role->name ?? '-';
                })
                ->addColumn('employee_id', function ($row) {
                    if ($row->employee_id) {
                        return str_pad($row->employee_id, 6, '0', STR_PAD_LEFT);
                    }
                    return '-';
                })
                ->addColumn('access_label', function ($row) {
                    if ($row->access_id == 0) {
                        return 'All Organization';
                    } elseif ($row->access_id) {
                        return $row->organization->short_name;
                    } else {
                        return '-';
                    }
                })
                ->editColumn('is_active', function ($row) {
                    return '
                    <div class="square-switch">
                        <input type="checkbox" id="square-switch3' . $row->id . '"class="user-toggle" data-id="' . $row->id . '" switch="bool" ' . ($row->is_active ? 'checked' : '') . ' />
                        <label for="square-switch3' . $row->id . '" data-on-label="Yes" data-off-label="No" style="margin: 0px; vertical-align: middle;"></label>
                    </div>';
                })
                ->addColumn('action', function ($row) {
                    return '
                    <a href="#" class="btn btn-soft-success waves-effect waves-light edit-user" style="padding: 2px 4px;" data-bs-toggle="modal" data-bs-target="#editUserModal" data-id="' . $row->id . '">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-soft-danger waves-effect waves-light delete-user" data-id="' . $row->id . '" style="padding: 2px 4px;">
                        <i class="fas fa-trash"></i>
                    </a>';
                })
                ->rawColumns(['action', 'is_active'])
                ->orderColumn('role_name', function ($query, $order) {
                    $query->orderBy('roles.name', $order);
                })
                ->make(true);
        }

        $roles = Role::select('id', 'name')->get();
        $organizations = Organization::select('id', 'short_name')->orderBy('short_name', 'asc')->get();

        return view('administration.authorization.user.index', compact('roles','organizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                'employee_id' => $request->employee_id,
                'is_active' => $request->is_active,
            ]);
            // Role assign
            $role = Role::find($request->role_id);
            $user->assignRole($role->name);
            return redirect()->back()->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'access_id' => $request->access_id,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                'employee_id' => $request->employee_id,
                'is_active' => $request->is_active,
            ]);
            // Role assign
            $role = Role::find($request->role_id);
            $user->syncRoles($role->name);
            return redirect()->back()->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $user->syncRoles([]);
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'User deletion failed: ' . $th->getMessage());
        }
    }

    public function toggleStatus(Request $request)
    {
        return $this->ToggleStatusTrait($request, User::class);
    }
}
