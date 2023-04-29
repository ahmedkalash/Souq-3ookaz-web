<?php

namespace App\Http\Controllers\Web\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\Customer\Auth\LogoutInterface;

class LogoutController extends Controller
{
    public function __construct(
        protected LogoutInterface $logoutRepository
    ){}

    public function logout(){
         $this->logoutRepository->logout();
         return redirect()->back();
    }
}
