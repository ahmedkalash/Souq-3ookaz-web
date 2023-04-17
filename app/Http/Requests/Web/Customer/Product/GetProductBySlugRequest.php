<?php

namespace App\Http\Requests\Web\Customer\Product;

use App\Http\Repositories\Web\Customer\ProductRepository;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetProductBySlugRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return ProductRepository::GetProductBySlugRules();
    }

    public function validationData()
    {
        return array_merge(
            parent::validationData(),
            ['slug'=>  $this->route('product_slug')]
        );
    }
    protected function failedValidation(Validator $validator)
    {
        throw new NotFoundHttpException();
    }
}
