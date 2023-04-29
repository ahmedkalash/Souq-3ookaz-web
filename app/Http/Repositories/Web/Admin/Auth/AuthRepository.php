<?php

namespace App\Http\Repositories\Web\Admin\Auth;
use App\Http\Interfaces\Web\Admin\Auth\AuthInterface;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthInterface
{
    public static function loginRules()
    {
        return[
            'email'=>'required|email|exists:users,email',
            'password'=>['required'],
        ];
    }
    public function login($request){
        $loginInfo = $request->only('email','password');
        $loginInfo['role']='admin';
        $errors=['The email or password is wrong'];
        return Auth::attempt($loginInfo)?  true:$errors;
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
