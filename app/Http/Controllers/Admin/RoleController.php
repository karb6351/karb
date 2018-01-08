<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
