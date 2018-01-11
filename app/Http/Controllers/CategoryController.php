<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth' , ['except' => 'show']);
    }
    
    public function show($id){
        $category = Category::find($id);
        $categories= Category::all();
        $posts = $category->posts()->paginate(10);
        return view('partial.user.category_show')->withCategory($category)->withCategories($categories)->withPosts($posts);
    }

}
