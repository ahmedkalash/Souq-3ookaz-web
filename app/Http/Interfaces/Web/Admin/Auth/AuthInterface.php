<?php

namespace App\Http\Interfaces\Web\Admin\Auth;

interface AuthInterface
{
    public function login($request);

    public function logout();
}
