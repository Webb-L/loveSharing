<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        $title = '权限管理';
        $auth_pid = Auth::where('auth_pid','0')->get();
        $auth_data = Auth::where('auth_pid','!=','0')->get();
        return view('admin.auth.index',compact('title','auth_pid','auth_data'));
    }
}
