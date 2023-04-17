<?php

namespace App\Models\Traits;

use Illuminate\Validation\Rules\Password;

trait AuthValidationRulesTrait
{
    public static function registerRules()
    {
        return [
            'first_name'=>'required|min:3',
            'last_name'=>'required|min:3',
            'email'=>'required|min:5|unique:users,email',
            'password'=> [
                'required',
                (new Password(8))
                    ->mixedCase()
                    ->numbers()
                    ->uncompromised(5),
            ],
            'password_confirmation'=>'required|same:password',
            'phone'=>'required|regex:/^(\+20)?1[0125]\d{8}$/|min:10|unique:users,phone',
            'agree'=>'required|accepted'
        ];
    }

    public static function loginRules()
    {
        return[
            'email'=>'required|email|exists:users,email',
            'password'=>['required'],
        ];
    }

}
