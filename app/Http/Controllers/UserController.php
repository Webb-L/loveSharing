<?php

namespace App\Http\Controllers;

use App\User;
use App\Video;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->get('id')) {
            $user = User::find($request->get('id'));
            $status = ['正确', '禁止评论', '禁止发布视频', '禁止登录'];
            $data[] = $user->name;
            $data[] = $user->avatar ? $user->avatar : 'https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png';
            $data[] = true;
            $data[] = $status[$user->status - 1];
            $data[] = $user->id;
            return $data;
        } else {
            $user = \Auth::guard('user');
            $status = ['正确', '禁止评论', '禁止发布视频', '禁止登录'];
            if ($user->check()) {
                $data[] = $user->user()->name;
                $data[] = $user->user()->avatar ? $user->user()->avatar : 'https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png';
                $data[] = $user->user()->email_verified_at ? true : false;
                $data[] = $status[$user->user()->status - 1];
                $data[] = $user->user()->id;
                return $data;
            } else {
                return 0;
            }
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, User $user)
    {
        $auth = \Auth::guard('user');
        if ($auth->check()) {
            if ($user->where('id', $id)->first()->id !== $auth->user()->id) return back()->withErrors("参数错误！");
            $this->validate($request, [
                'name' => 'required|min:2|max:10',
            ]);
            $data = $user->where('id', $id)->first();
            $data->avatar = $request->get('image');
            $data->name = $request->get('name');
            return $data->save() ? 200 : 422;
        } else {
            return back()->withErrors("请登录后再使用！");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function videoList(Request $request)
    {
        if (!\Auth::guard('user')->check()) return redirect('/');
        if ($request->get('id')) {
            $id = $request->get('id');
        } else {
            $id = \Auth::guard('user')->user()->id;
        }
        return Video::orderBy('id', 'desc')->where('status', '2')->where('users_id', $id)->get()->toArray();
    }
}
