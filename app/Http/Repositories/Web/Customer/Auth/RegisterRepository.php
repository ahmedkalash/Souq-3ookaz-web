<?php

namespace App\Http\Repositories\Web\Customer\Auth;
use App\Http\Interfaces\Web\Customer\Auth\RegisterInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class RegisterRepository implements RegisterInterface
{

    /** @return Model $user */

    public function create(\App\Http\Requests\Web\Customer\Auth\RegisterRequest $request)
    {
        // create user
        return User::query()->create([
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'phone'=>$request->phone ,
        ]);
    }
}
