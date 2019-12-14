<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Auth;
use App\Admin\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = '角色管理';
        $role_list = Role::orderBy('role_id', 'desc')->paginate(12);

        return view('admin.role.index', compact('title', 'role_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "创建角色";
        $auth = Auth::where('auth_pid', '0')->get();
        return view('admin.role.add', compact('title', 'auth'));
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
            'role_name' => 'required|min:2|max:10|unique:admin_role',
            'role_auth_ids' => 'required'
        ]);
        $flight = new Role;
        $flight->role_name = $request->get('role_name');
        $flight->role_auth_ids = implode(',', $request->get('role_auth_ids'));
        return $flight->save() ? back()->withErrors(1) : back()->withErrors("创建失败！");

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
        $data = Role::where('role_id', $id)->first();
        $title = '编辑 - ' . $data->role_name;
        $auth = Auth::where('auth_pid', '0')->get();
        return view('admin.role.edit', compact('title', 'data', 'auth'));
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
            'role_name' => 'required|min:2|max:10',
            'role_auth_ids' => 'required'
        ]);
        $flight = Role::find($id);
        $flight->role_name = $request->get('role_name');
        $flight->role_auth_ids = implode(',', $request->get('role_auth_ids'));
        return $flight->save() ? back()->withErrors(1) : back()->withErrors("更新失败！");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flight = Role::find($id)->delete();
        return $flight ? 1 : 0;
    }
}
