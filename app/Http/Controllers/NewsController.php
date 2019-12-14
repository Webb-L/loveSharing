<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return News::whereIn('user_id', [0, \Auth::guard('user')->user()->id])->get();
    }

    public function count()
    {
        return News::whereIn('user_id', [0, \Auth::guard('user')->user()->id])->get()->count();
    }

//    public function add(Request $request, News $news)
//    {
//        $news->title = $request->get('title');
//        $news->type = $request->get('type');
//        $news->description = $request->get('description');
//        $news->user_id = \Auth::guard('user')->user()->id;
//        return $news->save() ? 200 : 422;
//    }
}
