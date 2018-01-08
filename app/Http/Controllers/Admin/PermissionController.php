<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superadmin');
    }

    public function index(){
        return view('partial.admin.permission_manage.index');
    }
}


