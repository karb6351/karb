<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Post;
use App\Rating;

class RatingController extends Controller
{

    public function add(){
        $userID = Input::get('user_id');
        $postID = Input::get('post_id');
        $rate = Input::get('rating');

        if (User::findOrFail($userID) == null){
            return response()->json(['message' => 'Cannot find user'] , 404);
        }
        if (Post::findOrFail($postID) == null){
            return response()->json(['message' => 'Cannot find post'] , 404);
        }

        if (Rating::where(['post_id' => $postID])->where(['user_id' => $userID])->count() > 0){
            return response()->json(['message' => 'You are already mark this post'] , 201);
        }

        $rating = new Rating();
        $rating->user_id = $userID;
        $rating->post_id = $postID;
        $rating->rating = ($rate == 1) ? true : false;
        $rating->save();

        return response()->json(['rating' => $rating, 'message' => 'Marking success'],200);

    }
}
