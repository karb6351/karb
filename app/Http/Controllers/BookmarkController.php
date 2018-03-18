<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Bookmark;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;


class BookmarkController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['only' => [ 'getBookmark' , 'delete' ]]);
    }
    //ajax request and response
    public function setBookmark(Request $request){
        $userID = $request->user_id;
        $postID = $request->post_id;

        if (User::findOrFail($userID) == null){
            return response()->json(['message' => 'Cannot find user'] , 404);
        }
        if (Post::findOrFail($postID) == null){
            return response()->json(['message' => 'Cannot find post'] , 404);
        }

        if (Bookmark::where(['post_id' => $postID])->where(['user_id' => $userID])->count() > 0){
            return response()->json(['message' => 'You are already bookmark this post'] , 201);
        }

        $newBookmark = new Bookmark();
        $newBookmark->user_id = $userID;
        $newBookmark->post_id = $postID;
        $newBookmark->save();

        $response = [
            'message' => 'Bookmark post success',
            'post_id' => $newBookmark->post_id,
            'user_id' => $newBookmark->user_id ];

        return response()->json($response,200);
    }

    public function getBookmark(Request $request){
        $bookmarkPosts = null;
        if (Input::get('order') == 'bookmark'){
            $bookmarkPosts = Auth::user()->bookmarks()->orderBy('created_at', 'desc')->paginate(10);
        }else {
            $bookmarkPosts = Bookmark::join('posts', function($join){
                $join->on('posts.id', '=', 'bookmarks.post_id');
            })->orderBy('posts.created_at','desc')->select('bookmarks.*')->where('bookmarks.user_id',Auth::user()->id)->paginate(10);

        }
        return view('partial.user.bookmark_show')->withBookmarkPosts($bookmarkPosts);
    }

    public function delete(Request $request){
        $post_id = $request->post_id;
        if (Bookmark::where('user_id',Auth::user()->id)->where('post_id',$post_id) == null){
            Session::flash('fail','Cannot find the target post');
        }else{
            $bookmark = Bookmark::where('user_id',Auth::user()->id)->where('post_id',$post_id);
            $bookmark->delete();

            Session::flash('success','Delete bookmark\'s post success');
        }

        return back();


    }

}
