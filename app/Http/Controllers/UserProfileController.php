<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Session;

class UserProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['only' => 'show']);
    }

    public function show(Request $request,$id){
        $user = User::findOrFail($id);
        return view('partial.user.profile')->withUser($user);
    }

    public function edit(Request $request,$id){
        $this->validate($request,[
            "username" => "required|string|unique:users,id,".$id,
            "email" => "required|email|unique:users,id,".$id,
        ]);

        $user = User::findOrFail($id);
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->save();

        Session::flash('success','Edit user success');

        return redirect()->route('profile.show',$user->id);
    }
}
