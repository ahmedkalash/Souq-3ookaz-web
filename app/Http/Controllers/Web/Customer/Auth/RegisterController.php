<?php

namespace App\Http\Controllers\Web\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\Auth\RegisterInterface;
use App\Http\Interfaces\Web\Customer\CategoryInterface;
use App\Http\Requests\Web\Customer\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\View\ViewPath;
use Illuminate\Support\Facades\Auth;
use function App\Http\Helper\cartItems;

class RegisterController extends Controller
{
    public function __construct(
        protected RegisterInterface $registerRepository,
        protected CategoryInterface $categoryRepository
    ){}

    public function showRegisterPage(){
        return view(
            ViewPath::REGISTER,
            mergeData: cartItems()
        );
    }
    public function create(RegisterRequest $request)
    {
        $user =$this->registerRepository->create($request);
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }

}
