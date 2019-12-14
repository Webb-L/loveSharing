<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users|max:100',
            'name' => 'required|min:2|max:10',
            'password' => 'required|min:6|max:16|confirmed',
            'password_confirmation' => 'required|min:6|max:16',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        return $user->save()?"{status:200}":"{status:422}";

    }
}
