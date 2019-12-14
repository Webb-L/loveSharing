<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Role;
use App\Admin\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "管理员列表";
        $user_list = User::orderBy('id', 'desc')->paginate(7);
        return view('admin.users.index', compact('title', 'user_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "添加管理员";
        $role_list = Role::get();
        return view('admin.users.add', compact('title', 'role_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session()->flash('name', $request->get('name'));
        session()->flash('email', $request->get('email'));
        session()->flash('password', $request->get('password'));
        $this->validate($request, [
            'name' => 'required|min:2|max:6',
            'email' => 'required|email|unique:users|max:100',
            'role_id' => 'required',
            'password' => 'required|min:6|max:16'
        ]);

        $filght = new User;
        $filght->name = $request->get('name');
        $filght->role_id = $request->get('role_id');
        $filght->email = $request->get('email');
        $filght->password = bcrypt($request->get('password'));
        if ($request->get('avatar')) {
            $filght->avatar = $request->get('avatar');
        }
        return $filght->save() ? back()->withErrors(1) : back()->withErrors("添加失败，请重试！");
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
        $data = User::where('id', $id)->first();
        $title = '编辑 - ' . $data->name;
        $role_list = Role::get();
        return view('admin.users.edit', compact('title', 'data', 'role_list'));
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
            'name' => 'required|min:2|max:10'
        ]);
        $filght = User::find($id);
        $filght->name = $request->get('name');
        if ($filght->role_id !== 0)  $filght->role_id = $request->get('role_id');
        if ($request->get('avatar')) {
            $filght->avatar = $request->get('avatar');
        }
        if ($request->get('password')) {
            $filght->password = bcrypt($request->get('password'));
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
        return User::find($id)->delete() ? 1 : 0;
    }
}
