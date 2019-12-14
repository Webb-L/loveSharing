<?php

namespace App\Http\Controllers;

use App\Mail\VerifyMail;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:100',
            'password' => 'required|min:6|max:16',
        ]);
        $user = User::where('email',$request->get('email'))->first();
        if($user) {
            if($user->status==4) return 4;
        }
        $data = $request->only('email', 'password');
        return \Auth::guard('user')->attempt($data, $request->check) ? 200 : 422;
    }

    function email()
    {
        $user = \Auth::guard('user')->user();
        \Mail::to($user)->send(new VerifyMail($user));
        return 200;
    }

    function confirmEmailToken($token){
        if(\Auth::guard('user')->user()->email_token==$token) {
           $data = User::where('email_token',$token)->first();
           if($data->email_verified_at) return redirect('/');
           $data->email_verified_at = date('Y-m-d H:i:s',time());
           return $data->save()?'验证成功<a href="/">点我回到首页</a>':'<a href="/">点我回到首页</a>';
        }else {
            return redirect('/');
        }
    }
}
