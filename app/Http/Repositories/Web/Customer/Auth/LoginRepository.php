<?php

namespace App\Http\Repositories\Web\Customer\Auth;
use App\Http\Interfaces\Web\Customer\Auth\LoginInterface;
use Illuminate\Support\Facades\Auth;

class LoginRepository implements LoginInterface
{

    /**returns true on success or array contains error message*/
    public function login(\App\Http\Requests\Web\Customer\Auth\LoginRequest $request):bool|array
    {
        $credentials =$request->only(['email','password']);
        $credentials['role']='customer';
        $errors=['The email or password is wrong'];

        return Auth::attempt($credentials)?  true:$errors;
    }
}
