<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Post;

class CategoryApiController extends Controller
{
    public function show($id){
        $page = Input::get('page');
        $number = Input::get('number');
        $list = Category::find($id)->posts()->latest()->paginate($number);
        $content = [];
        foreach($list as $item){
            $temp = [
                'id' => $item->id ,
                'topic' => $item->topic ,
                'created_at' => $item->created_at,
                'username' => $item->user->username,
                'userid' => $item->user->id,
                'gender' => $item->user->gender,
                'category_name' => $item->category->name,
            ];
            array_push($content,$temp);
        }
        return response()->json([
            'post_list' => $content,
            'page' => $page
        ],200);
    }
}
