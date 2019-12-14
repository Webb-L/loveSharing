<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $title = '仪表盘';
        $count_user = \App\User::all()->count();
        $count_users = \App\Admin\User::all()->count();
        return view('admin.dashboard', compact('title', 'count_user', 'count_users'));
    }

    public function edit()
    {
        $data = \Auth::guard('admin')->user();
        $title = '编辑信息';
        $role_list = Role::get();
        return view('admin.users.edit', compact('title', 'data', 'role_list'));
    }
}

