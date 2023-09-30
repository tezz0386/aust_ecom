<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:View Role|create Role|Edit Role|Delete Role', ['only' => ['index', 'store']]);
         $this->middleware('permission:Create Role', ['only' => ['create','store']]);
         $this->middleware('permission:Edit Role', ['only' => ['edit','update']]);
         $this->middleware('permission:Delete Role', ['only' => ['destroy']]);
    }
    public function index()
    {
        $roles = Role::all();
        return view('admin.views.role.index', ['roles'=>$roles]);
    }
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.views.role.form', ['permissions'=>collect($permissions)->groupBy('col_name')]);
    }
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.views.role.form', ['permissions'=>collect($permissions)->groupBy('col_name'), 'role'=>$role]);
    }
    public function store(Request $request)
    {
        $role = Role::create([
            'name'=>$request->name,
            'guard_name'=>'web',
        ]);
        $role->syncPermissions($request->role_id);
        session()->flash('success', 'Successfully Role has been updated');
        return redirect()->route('role.index');
    }
    public function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->role_id);
        session()->flash('success', 'Successfully Role has been updated');
        return redirect()->route('role.index');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('success', 'Successfully Role has been deleted');
        return redirect()->route('role.index');
    }
}
