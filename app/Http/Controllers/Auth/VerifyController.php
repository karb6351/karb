<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserActive;
use App\Mail\VerifyUser;
use Session;
use Mail;

class VerifyController extends Controller
{

    public function getVerifyForm(){
        return view('auth.verify.verifyEmailForm');
    }

    public function reSendVerifyEmail(Request $request){
        $success = ['isSuccess' => false , 'message' => ''];
        $user =  User::where('email',$request->email)->first();
        if (isset($user) && !empty($user)){
            $active = $user->userActive;
            //only the non-active member can send the verify mail
            if (!$active->isActive){
                //create a new token
                $newToken = md5(microtime());
                $active->token = $newToken;
                $active->save();
                //send the verify email
                $this->sendVerifyEmail($user,$active);
                $success = true;
            }else{
                $success['message'] = "Your account is already active! You cannot active again";
            }
        }else {
            $success['message'] = "Cannot find account. Please try again";
        }
        Session::flash(($success['isSuccess'])? 'success':'error' , $success['message']);
        return redirect()->route('home');
    }

    public function sendVerifyEmail($user,$active){
        Mail::to($user->email)->queue(new VerifyUser($active));
    }

    public function verifyUser($token){
        $success = ['isSuccess' => false , 'message' => ''];
        $userActive = UserActive::where('token',$token)->first();
        if (isset($userActive) && !empty($userActive)){
            if (!$userActive->isActive){
                $userActive->isActive = true;
                $userActive->save();
                $success['isSuccess'] = true;
                $success['message'] = 'Your account is active';
            }else{
                $success['message'] = "Your account is already active! You cannot active again";
            }
        }else{
            $success['message'] = "Cannot find account. Please request a new verify email";
        }
        Session::flash(($success['isSuccess'])? 'success':'error' , $success['message']);

        return redirect()->route('home');
    }
}
