<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['only'=> ['update','store']]);
        $this->middleware('role:superadmin|admin',['only'=> ['index','destroy']]);
    }

    public function index(){
        $posts = Post::paginate(10);
        $today = Carbon::today()->toDateString();
        $now = Carbon::now()->toDateString();
        $dayCount = Post::whereBetween(DB::raw('date(created_at)'),[$today,$now])->get()->count();
        $totalCount = Post::all()->count();
        return view('partial.admin.post.index')->withPosts($posts)->withPostDaily($dayCount)->withTotalCount($totalCount);
    }

    public function store(Request $request){
        $this->validate($request,[
            'topic' => 'required|unique:posts',
            'categoryID' => 'required',
            'content' => 'required'
        ]);
        $post = new Post();
        $post->topic = $request->topic;
        $post->content = $request->input('content');
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->categoryID;
        $post->save();

        Session::flash('success','Create post success');

        return redirect()->route('post.show',$post->id);

    }

    public function show($id){
        $post = Post::findOrFail($id);
        $replyCount = $post->replies->count();
        return view('partial.user.post_show')->withPost($post)->withReplyCount($replyCount);
    }
}
