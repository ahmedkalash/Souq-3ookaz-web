<?php

namespace App\Http\Requests\Web\Customer;

use App\Http\Repositories\Web\Customer\ProductReviewRepository;
use Illuminate\Foundation\Http\FormRequest;

class AddProductReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $stopOnFirstFailure=true;
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return ProductReviewRepository::addReviewRules();
    }
}
