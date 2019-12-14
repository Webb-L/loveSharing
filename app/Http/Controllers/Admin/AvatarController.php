<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = '会员头像列表';
        $avatar_list = User::orderBy('id', 'desc')->paginate(12);
        return view('admin.avatar.index', compact('title', 'avatar_list'));
    }

    public function adminIndex()
    {
        $title = '管理员头像列表';
        $avatar_list = \App\Admin\User::orderBy('id', 'desc')->paginate(12);
        return view('admin.avatar.index', compact('title', 'avatar_list'));
    }
}
