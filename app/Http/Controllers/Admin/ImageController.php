<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index () {
        $title = '展示图管理';
        $image_list = Video::orderBy('id','desc')->paginate(12);
        return view('admin.image.index', compact('title', 'image_list'));
    }
}
