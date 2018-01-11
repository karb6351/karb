<?php

namespace App\Http\Controllers\Admin;

use App\UserActive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use Spatie\Permission\Models\Role;
use Mail;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin|superadmin');
    }

    public function search(Request $request){
        $this->validate($request,[
            'search_value' => 'required'
        ]);
        $target = User::where('id' , $request->search_value)
                    ->orWhere('username' ,'like', "%".$request->search_value."%")
                    ->orWhere('email' ,'like', "%".$request->search_value."%")->paginate(10);
        return view('partial.admin.user_manage.index')->withUsers($target);
    }

    public function index(){
        $users = User::paginate(10);
        return view('partial.admin.user_manage.index')->withUsers($users);
    }

    public function create(){
        $roles = Role::all();
        return view('partial.admin.user_manage.create')->withRoles($roles);
    }

    public function store(Request $request){
        $validator = [
            'username' => 'required|unique:users',
            'email' => 'required|unique:users'
            ];
        if (!$request->has('autoGenPW')){
            $validator['password'] = 'required|min:6|confirmed';
        }
        $this->validate($request, $validator);
        $password = (!$request->has('autoGenPW'))? $request->password : $request->username . "forum";

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($password);
        $user->gender = $request->gender;
        $user->save();

        $active = new UserActive();
        $active->token = md5(microtime());
        $active->isActive = true;
        $active->isBan = false;
        $active->user_id = $user->id;
        $active->save();

        Session::flash('success','User is created');
        return redirect()->route('user.index');
    }

    public function show($id){
        $user = User::findOrFail($id);
        return view('partial.admin.user_manage.show')->withUser($user);
    }

    public function edit($id){
        $roles = Role::all();
        $user = User::findOrFail($id);
        $this->authorize('update',$user);
        return view('partial.admin.user_manage.edit')->withUser($user)->withRoles($roles);
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $this->authorize('update',$user);

        $validator = [
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|unique:users,email,'.$id
        ];
        if ($request->pw_choice == 'manual'){
            $validator['password'] = 'required|min:6|confirmed';
        }
        $this->validate($request, $validator);



        if ($request->pw_choice == 'manual'){
            $password = bcrypt($request->password);
        }else if($request->pw_choice == 'auto'){
            $password = bcrypt($request->username . "forum" );
        }else{
            $password = $user->password;
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $password;
        $user->gender = $request->gender;
        $user->save();

        $role = Role::find($request->role);
        $user->syncRoles($role->name);

        Session::flash('success','User is updated');
        return redirect()->route('user.index');
    }


    public function block(Request $request){
        $this->validate($request,[
           'userID' => 'required'
        ]);
        $target = User::findOrFail($request->userID);
        $this->authorize('block',$target);
        $active = $target->userActive;
        $active->isBan = !$active->isBan;
        $active->save();
        Session::flash('success','User has ' . (($active->isBan)? 'blocked' : 'unblocked'));
        return redirect()->route('user.index');
    }
}
