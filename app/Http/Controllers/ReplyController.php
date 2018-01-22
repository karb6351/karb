<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Reply;
use Session;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
        $this->validate($request,[
            'postID' => 'required',
            'content' => 'required',
        ]);

        $reply = new Reply();
        $reply->content = $request->input('content');
        $reply->user_id = Auth::user()->id;
        $reply->post_id = $request->postID;
        $reply->save();

        Session::flash('success','Reply post success');

        return redirect()->route('post.show',$reply->post_id);

    }

    public function update(Request $request){

    }
}
