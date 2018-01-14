<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin|superadmin' , ['except' => 'show']);
    }

    public function index(){
        $categories = Category::all();
        return view('partial.admin.category.index')->withCategories($categories);
    }
    
    public function show($id){
        $category = Category::find($id);
        $categories= Category::all();
        return view('partial.user.category_show')->withCategory($category)->withCategories($categories);
    }

}
