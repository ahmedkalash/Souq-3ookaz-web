<?php

namespace App\Http\Interfaces\Web\Auth;

interface RegisterInterface
{
    public function create(\App\Http\Requests\Web\Customer\Auth\RegisterRequest $request);
}
