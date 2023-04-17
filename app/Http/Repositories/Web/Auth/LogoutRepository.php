<?php

namespace App\Http\Repositories\Web\Auth;
use App\Http\Interfaces\Web\Auth\LogoutInterface;
use Illuminate\Support\Facades\Auth;

class LogoutRepository implements LogoutInterface
{
    public function logout()
    {
       Auth::logout();
    }

}
