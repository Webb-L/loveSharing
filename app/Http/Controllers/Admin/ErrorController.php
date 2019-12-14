<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function index() {
        $title = "错误";
        return view('admin.error',compact('title'));
    }
}
