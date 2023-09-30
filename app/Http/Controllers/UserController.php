<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:View User|create User|Edit User|Delete User', ['only' => ['index', 'store']]);
         $this->middleware('permission:Create User', ['only' => ['create','store']]);
         $this->middleware('permission:Edit User', ['only' => ['edit','update']]);
         $this->middleware('permission:Delete User', ['only' => ['destroy']]);
    }
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.views.user.index', ['users'=>$users]);
    }
    public function create()
    {
        $roles = Role::all();
        return view('admin.views.user.form', ['roles'=>$roles]);
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.views.user.form', ['roles'=>$roles, 'user'=>$user]);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password']=Hash::make('password');
        $user = User::create($data);
        $user->assignRole($request->role_id);
        session()->flash('success', 'Successfully User has been created');
        return redirect()->route('user.index');
    }
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $user->update($data);
        $user->removeRole($user->roleName());
        $user->assignRole($request->role_id);
        session()->flash('success', 'Successfully User has been updated');
        return redirect()->route('user.index');
    }
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'Successfully User has been deleted');
        return redirect()->route('user.index');
    }
}
