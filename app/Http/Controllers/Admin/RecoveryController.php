<?php

namespace App\Http\Controllers\Admin;

use App\Admin\User;
use App\Http\Controllers\Controller;
use App\News;
use App\Video;
use Illuminate\Http\Request;

class RecoveryController extends Controller
{
    public function index()
    {
        $title = "回收站";
        $video = Video::onlyTrashed()->get();
        $admin_user = User::onlyTrashed()->get();
        $news = News::onlyTrashed()->get();
        return view('admin.recovery.index', compact('title', 'video', 'admin_user', 'news'));
    }

    public function recovery(Request $request, $id)
    {
        switch ($request->get('type')) {
            case 0:
                $flight = Video::onlyTrashed()->where('id', $id);
                return $flight->restore() ? 1 : 0;
                break;
            case 1:
                $flight = User::onlyTrashed()->where('id', $id);
                return $flight->restore() ? 1 : 0;
                break;
            case 2:
                $flight = News::onlyTrashed()->where('id', $id);
                return $flight->restore() ? 1 : 0;
                break;
            default:
                return 0;
        }
    }

    public function delete(Request $request,$id){
        switch ($request->get('type')) {
            case 0:
                $flight = Video::onlyTrashed()->where('id', $id);
                return $flight->delete() ? 1 : 0;
                break;
            case 1:
                $flight = User::onlyTrashed()->where('id', $id);
                return $flight->delete() ? 1 : 0;
                break;
            case 2:
                $flight = News::onlyTrashed()->where('id', $id);
                return $flight->delete() ? 1 : 0;
                break;
            default:
                return 0;
        }
    }
}
