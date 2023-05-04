<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Web\Admin\ProfileRepository;
use App\Http\Requests\UpdateProfileRequest;
use App\View\AdminViewPath;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(protected ProfileRepository $profileRepository)
    {}

    public function showProfile(){
        $user = \Auth::user();
        return view(
            AdminViewPath::PROFILE,
            compact('user')
        );
    }
    public function updateProfile(UpdateProfileRequest $request){
        $this->profileRepository->updateProfile($request);
        \Alert::success('success','your Data Was Changed');
        return redirect()->back();
    }


}
