<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;

class ExamineController extends Controller
{
    public function index()
    {
        $title = "视频审核";
        $data = Video::all()->where('status', '1');
        return view('admin.examine.index', compact('title', 'data'));
    }

    public function success(Request $request, $id)
    {
        $flight = Video::find($id);
        $flight->status = 2;
        return $flight->save() ? 1 : 0;
    }

    public function delete($id)
    {
        $flight = Video::find($id);
        $flight->deleted_at = date('Y-m-d H:i:s');
        return $flight->save() ? 1 : 0;
    }
}
