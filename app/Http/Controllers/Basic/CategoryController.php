<?php

namespace App\Http\Controllers\Basic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth' , ['except' => 'show']);
    }
    
    public function show($id){
        $category = Category::find($id);
        return view('partial.user.category_show')->withCategory($category);
    }

}
