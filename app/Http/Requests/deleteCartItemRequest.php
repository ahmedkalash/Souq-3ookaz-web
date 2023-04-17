<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\specifyValidationDataTrait;

use App\Models\CartItem;
use Illuminate\Foundation\Http\FormRequest;

class deleteCartItemRequest extends FormRequest
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
        return CartItem::deleteCartItemRules();
    }

    public function validationData()
    {
        return array_merge(
            parent::validationData(),
            ['product_id'=>$this->route('product_id')]
        );
    }
}
