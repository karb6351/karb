<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['only'=> ['update','create','store']]);
        $this->middleware('role:superadmin|admin',['only'=> ['index','destroy']]);
    }

    public function index(){
        $posts = Post::all();
        return view('partial.admin.post.index')->withPosts($posts);
    }
}
