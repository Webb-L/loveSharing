<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetsMail;
use App\PasswordResets;
use App\User;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function email(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        if (User::where('email', $request->email)->first()) {
            $token = str_shuffle(md5(time()));
            $password = new PasswordResets();
            $password->email = $request->email;
            $password->token = $token;
            $password->created_at = date('Y-m-d h:i:s', time());
            if ($password->save()) {
                \Mail::to($request->email)->send(new PasswordResetsMail($token));
                return 1;
            } else {
                return back(422)->withErrors("服务器错误，请重试！");
            }
        } else {
            return;
        }
    }

    public function reset(Request $request, $token)
    {
        if ($request->method() === "POST") {
            $this->validate($request, [
                'domainName' => 'required',
                'password' => 'required|min:6|max:16'
            ]);
            if ($request->domainName !== config('app.url')) return back()->withErrors(config('app.name') . '域名错误，请输入正确域名！');
            $user = PasswordResets::where('token', $token)->first()->user()->first();
            if (empty($user)) return back()->withErrors("找到不到用户，请重试！");
            $user->password = bcrypt($request->password);
            return $user->save() ? redirect('/login') : back()->withErrors("修改失败，请重试！");
        }
        if (!$token) return back();
        return view('password.reset');
    }
}
