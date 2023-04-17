<?php

namespace App\Http\Requests\Web\Customer\Product;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Repositories\Web\Customer\CategoryRepository;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetProductsByCategoryIDRequest extends FormRequest
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
        return CategoryRepository::validateCategoryIdRules();
    }
    public function validationData()
    {
        return array_merge(
            parent::validationData(),
            ['id'=>  $this->route('category_id')]
        );
    }
    protected function failedValidation(Validator $validator)
    {
        throw new NotFoundHttpException();
    }

}
