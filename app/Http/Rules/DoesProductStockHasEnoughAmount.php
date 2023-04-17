<?php

namespace App\Http\Rules;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class DoesProductStockHasEnoughAmount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $product = Product::find(request('product_id'));
        if($product){
            $stock = $product->stock;

            $cartItem = CartItem::where([
                ['user_id',Auth::id()],
                ['product_id',request('product_id')]
                ])->get()->first();

            $amountInCart = $cartItem->amount ?? 0;
            $requiredAmount = $amountInCart+request('amount');

            if($stock>=$requiredAmount){
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'مفيش كمية كفية من المنتج دا';
    }
}
