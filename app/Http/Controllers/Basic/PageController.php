<?php

namespace App\Http\Controllers\Basic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class PageController extends Controller
{
    public function index(){
        Session::reflash();
        return redirect()->route('category.show',1);
    }
}
