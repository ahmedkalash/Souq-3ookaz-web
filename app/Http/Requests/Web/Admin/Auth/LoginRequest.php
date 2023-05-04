<?php

namespace App\Http\Requests\Web\Admin\Auth;


use App\Http\Repositories\Web\Admin\Auth\AuthRepository;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return AuthRepository::loginRules();
    }


}
