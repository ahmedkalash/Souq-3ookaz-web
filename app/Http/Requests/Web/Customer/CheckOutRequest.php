<?php

namespace App\Http\Requests\Web\Customer;

use App\Http\Repositories\Web\Admin\OrderRepository;
use App\Http\Repositories\Web\Customer\CartItemRepository;
use App\Http\Rules\DoesProductStockHasEnoughAmount;
use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CheckOutRequest extends FormRequest
{

    public function __construct(protected CartItemRepository $cartItemRepository, array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

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
        return OrderRepository::CheckOutRules();
    }


    /**
     * @param Validator $validator
     */
    public function setValidator(Validator $validator): void
    {
        $this->validator = $validator;
        $cart= $this->cartItemRepository->getCart();
        $this->validator->after(function (Validator $validator) use ($cart){
             foreach ($cart['cartItems'] as $cartItem)
             {
                 $product = Product::find($cartItem->product_id);
                 if(!$product ){
                     \Alert::warning("Product Not Found");
                     throw (new ValidationException($validator));
                 }
                 if( $product->stock<$cartItem->amount) {
                    // $validator->errors()->add('product_id','no enough amount');
                     \Alert::warning("No enough amount from product $product->name_en just $product->stock are left!");
                     throw (new ValidationException($validator));
                 }
             }
         });
    }


}
