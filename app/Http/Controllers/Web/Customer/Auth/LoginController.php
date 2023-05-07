<?php

namespace App\Http\Controllers\Web\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\Customer\Auth\LoginInterface;
use App\Http\Interfaces\Web\Customer\CategoryInterface;
use App\Http\Requests\Web\Customer\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\View\ViewPath;


class LoginController extends Controller
{
    public function __construct(
        protected loginInterface $loginRepository,
        protected CategoryInterface $categoryRepository
    ){}

    public function showLoginPage(){
        session()->put('previousUrl', url()->previous());
        return view(
            ViewPath::LOGIN
        );
    }

    public function login(loginRequest $request)
    {
        $attemptResult = $this->loginRepository->login($request);
        if( $attemptResult === true){
            return redirect(session('previousUrl')?? RouteServiceProvider::HOME) ;
        }
        return redirect()->back()->withErrors($attemptResult);

    }
}
