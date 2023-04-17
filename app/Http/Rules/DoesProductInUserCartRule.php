<?php

namespace App\Rules;

use App\Models\CartItem;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class DoesProductInUserCartRule implements Rule
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
        return CartItem::where([
              ['user_id','=',Auth::id()],
              ['product_id','=',request('product_id')]
              ])->exists();

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This user does not has this product in his cart';
    }
}
