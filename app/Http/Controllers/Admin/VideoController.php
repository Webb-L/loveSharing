<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "视频管理";
        $video_list = Video::orderBy('id', 'desc')->paginate(10);
        return view('admin.video.index', compact('title', 'video_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Video::where('id', $id)->first();
        $title = '编辑 - ' . $data->title;
        return view('admin.video.edit', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:2|max:25'
        ]);
        $filght = Video::find($id);
        $filght->title = $request->title;
        $filght->status = $request->status;
        if ($request->get('displaymap')) {
            $filght->displaymap = $request->get('displaymap');
        }
        if ($request->get('url')) {
            $filght->url = $request->get('url');
        }

        return $filght->save() ? back()->withErrors(1) : back()->withErrors("编辑失败，请重试！");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filght = Video::find($id);
        $filght->deleted_at = date('Y-m-d H:i:s');
        return $filght->save() ? 1 : 0;

    }
}
