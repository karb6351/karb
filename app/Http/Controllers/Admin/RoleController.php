<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;
use Session;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadmin');
    }

    public function index(){
        $roles = Role::orderBy('id', 'desc')->get();
        $users = User::all();
        return view('partial.admin.role_manage.index')->withRoles($roles)->withUsers($users);
    }

    public function show($id){
        $role = Role::findOrFail($id);
        return view('partial.admin.role_manage.show')->withRole($role);
    }

    public function create(){
        $permissions = Permission::all();
        return view('partial.admin.role_manage.create')->withPermissions($permissions);
    }

    public function store(Request $request){
        $this->validate($request,[
            'selectedPermission' => 'required',
            'name' => 'required|unique:roles'
        ]);
        $permissionName = array();
        foreach($request->selectedPermission as $pid){
            array_push($permissionName ,Permission::find($pid)->name);
        }
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($permissionName);

        Session::flash('success','Create role success');

        return redirect()->route('role.show',$role->id);
    }

    public function edit($id){
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $selectedPermission = array();
        foreach($role->permissions as $permission){
            array_push($selectedPermission,($permission->id));
        }
        return view('partial.admin.role_manage.edit')->withRole($role)
                                                            ->withPermissions($permissions)
                                                            ->withSelectedPermission($selectedPermission);
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'selectedPermission' => 'required',
            'name' => 'required|unique:roles'
        ]);
        $permissionName = array();
        foreach($request->selectedPermission as $pid){
            array_push($permissionName ,Permission::find($pid)->name);
        }
        $role = Role::findOrFail($id);
        $role->syncPermissions($permissionName);
        $role->name = $request->name ;
        $role->save();

        Session::flash('success','Edit role success');

        return redirect()->route('role.show',$role->id);

    }

    public function assignRole(Request $request){
        $this->validate($request,[
            'role' => 'required',
            'users' => 'required'
        ]);
        $roleName = Role::findOrFail($request->role)->name;
        foreach($request->users as $userID){
            $user = User::findOrFail($userID);
            $user->syncRoles($roleName);
        }
        Session::flash('success','Assigning role success');
        return redirect()->route('role.index');
    }
}
