<?php

namespace App\Http\Repositories\Web\Admin;
use App\Http\Interfaces\Web\Admin\ProfileInterface;
use App\Http\Traits\ImagesTrait;
use App\Rules\UniqueOrNotChanged;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class ProfileRepository implements ProfileInterface
{
    use ImagesTrait;
    public static function updateProfileRules()
    {
        return [
            'first_name'=>'required|min:3',
            'last_name'=>'required|min:3',
            'email'=>['required','min:5','email',new UniqueOrNotChanged()],
            'password'=> ['required','current_password'],
            'phone'=>['required','regex:/^(\+20)?1[0125]\d{8}$/','min:10',new UniqueOrNotChanged()],
        ];
    }

    public function updateProfile(\App\Http\Requests\UpdateProfileRequest $request)
    {
        $user = Auth::user();
        DB::transaction(
            function ()use (&$user, $request){
                $user->update([
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'email'=>$request->email,
                    'phone'=>$request->phone,
                ]);
                if($request->image){
                    $imagePath = $this->uploadImage(
                        $request->image,
                        time().'_user_'.$user->id.'_image.png',
                        'admin/profile',
                        $user->image_url
                    );
                    $user->image_url=$imagePath;
                    $user->save();
                }
            }
        );



    }
}
