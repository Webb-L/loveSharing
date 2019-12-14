<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\News;
use App\User;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "消息";
        $news = News::orderBy('id', 'desc')->paginate(8);
        return view('admin.info.index', compact('title', 'news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "发送消息";
        $user = User::all();
        return view('admin.info.add', compact('title', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:2|max:15',
            'description' => 'required|min:10|max:100',
            'user_id' => 'required',
            'type' => 'required',
        ]);
        $flight = new News;
        $flight->title = $request->get('title');
        $flight->description = $request->get('description');
        $flight->user_id = $request->get('user_id');
        $flight->type = $request->get('type');
        $flight->admin_id = \Auth::guard('admin')->user()->id;
        return $flight->save() ? back()->withErrors(1) : back()->withErrors(0);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filght = News::find($id);
        return $filght->delete() ? 1 : 0;
    }
}
