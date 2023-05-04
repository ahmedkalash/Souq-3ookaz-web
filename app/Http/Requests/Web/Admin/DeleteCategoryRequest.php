<?php

namespace App\Http\Requests\Web\Admin;

use App\Http\Repositories\Web\Admin\CategoryRepository;
use Illuminate\Foundation\Http\FormRequest;

class DeleteCategoryRequest extends FormRequest
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
        return CategoryRepository::deleteCategoryRules();
    }
    public function validationData()
    {
        return array_merge(
            parent::validationData(),
            ['category_id'=>$this->route('category_id')]
        );
    }
}
