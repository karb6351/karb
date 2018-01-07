<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware(['role:admin|superadmin']);
    }
    public function index(){
        return redirect()->route('admin.dashboard');
    }
    public function dashboard(){
        return view('partial.admin.dashboard');
    }
}
