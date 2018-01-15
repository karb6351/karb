<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin|superadmin' , ['except' => 'show']);
    }

    public function index(){
        $categories = Category::all();
        return view('partial.admin.category.index')->withCategories($categories);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        Session::flash('success','Create category success');

        return redirect()->route('admin.category.index');
    }
    
    public function show($id){
        $category = Category::find($id);
        $categories= Category::all();
        return view('partial.user.category_show')->withCategory($category)->withCategories($categories);
    }

    public function update(Request $request){
        $this->validate($request,[
            'id' => 'required',
            'name' => 'required|unique:categories',
        ]);
        $category = Category::findOrFail((int)($request->id));
        $category->name = $request->name;
        $category->save();

        Session::flash('success','Edit category success');

        return redirect()->route('admin.category.index');

    }


}
