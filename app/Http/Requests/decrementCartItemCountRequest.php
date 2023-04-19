<?php

namespace App\Http\Requests;

use App\Http\Repositories\Web\Customer\CartItemRepository;
use App\Models\CartItem;
use Illuminate\Foundation\Http\FormRequest;

class decrementCartItemCountRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return CartItemRepository::decrementItemCountRules();
    }

    public function validationData()
    {
        return array_merge(
            parent::validationData(),
            ['product_id'=>$this->route('product_id')]
        );
    }






}
