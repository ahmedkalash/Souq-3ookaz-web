<?php

namespace App\Http\Interfaces\Web\Auth;

interface LoginInterface
{
    /** returns true on success or array contains error message */
    public function login(\App\Http\Requests\Web\Customer\Auth\LoginRequest $request);
}
