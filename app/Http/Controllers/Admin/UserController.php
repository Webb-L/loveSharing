<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ThrottlesLogins;

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "会员列表";
        $user_list = User::orderBy('id', 'desc')->paginate(7);
        return view('admin.user.index', compact('title', 'user_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "添加会员";
        return view('admin.user.add',compact('title'));
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
        $this->validate($request,[
            'name' => 'required|min:2|max:6',
            'email' => 'required|email|unique:users|max:100',
            'status' => 'required',
            'password' => 'required|min:6|max:16'
        ]);

        $filght = new User;
        $filght->name = $request->get('name');
        $filght->status = $request->get('status');
        $filght->email = $request->get('email');
        if ($request->get('avatar')) {
            $filght->avatar = $request->get('avatar');
        }
        if ($request->get('password')) {
            $filght->password = bcrypt($request->get('password'));
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
        return view('admin.user.edit', compact('title', 'data'));
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
        $filght->status = $request->get('status');
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

    public function login(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }
        if ($request->method() === "GET") return view('admin.user.login');
        session()->flash('email', $request->get('email'));
        $this->validate($request, [
            'email' => 'required|email|max:100',
            'password' => 'required|min:6|max:16',
        ]);
        $this->incrementLoginAttempts($request);
        if (\Auth::guard('admin')->attempt($request->only('email', 'password'), $request->get('check'))) {
            return redirect(route('admin'));
        } else {
            return back()->withErrors("账号或者密码错误！");
        }

    }
}
