<?php

namespace App\Http\Controllers\Web\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\Admin\Auth\AuthInterface;
use App\Http\Interfaces\Web\Customer\Auth\LogoutInterface;
use App\Http\Repositories\Web\Admin\Auth\AuthRepository;
use App\Http\Requests\Web\Admin\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\View\AdminViewPath;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected AuthInterface $authRepository,
    ){}

    public function showLoginPage(){session()->put('previousUrl', url()->previous());
       return view(AdminViewPath::LOGIN);
   }
   public function login(LoginRequest $request){
       $attemptResult = $this->authRepository->login($request);
       if($attemptResult === true){
           return redirect(session('previousUrl')?? 'admin.home.show') ;
       }
       return redirect()->back()->withErrors($attemptResult);
   }
   public function logout(){
        $this->authRepository->logout();
        return redirect(route('admin.login.show'));
   }

}
