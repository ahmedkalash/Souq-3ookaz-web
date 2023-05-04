<?php

namespace App\Http\Repositories\Web\Customer\Auth;
use App\Http\Interfaces\Web\Customer\Auth\LogoutInterface;
use Illuminate\Support\Facades\Auth;

class LogoutRepository implements LogoutInterface
{
    public function logout()
    {
       Auth::logout();
       request()->session()->invalidate();
       request()->session()->regenerateToken();
    }

}
