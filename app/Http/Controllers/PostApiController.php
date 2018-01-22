<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Post;

class PostApiController extends Controller
{
    public function replyList($id){
        $page = Input::get('page');
        $number = Input::get('number');
        $post = post::findOrFail($id);
        $replyList = $post->replies()->paginate($number);
        $contentList = array();
        foreach($replyList as $item){
            $temp = [
                'userID' => $item->user->id,
                'username' => $item->user->username,
                'gender' => $item->user->gender,
                'content' => $item->content,
                'created_at' => $item->created_at,
            ];
            array_push($contentList,$temp);
        }
        return response()->json(['reply_list' => $contentList, 'page' => $page],200);

    }
}
