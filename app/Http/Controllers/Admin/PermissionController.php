<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Session;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadmin');
    }

    public function index(){
        $permissions = Permission::all();
        return view('partial.admin.permission_manage.index')->withPermissions($permissions);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:permissions'
        ]);

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();

        Session::flash('success','Create permission success');

        return redirect()->route('permission.index');
    }

    public function update(Request $request){
        $this->validate($request,[
            'permissionID' => "required"
        ]);

        $permission = Permission::findOrFail($request->permissionID);

        $this->validate($request,[
            'name' => 'required|unique:permissions'
        ]);

        $permission->name = $request->name;
        $permission->save();

        Session::flash('success','Edit Permission success');

        return redirect()->route('permission.index');
    }
}


