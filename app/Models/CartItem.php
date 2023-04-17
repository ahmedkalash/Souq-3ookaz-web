<?php

namespace App\Models;

use App\Models\Traits\getTableNameStaticallyTrait;
use App\Rules\DoesProductInUserCartRule;
use App\Rules\DoesProductStockHasEnoughAmount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\CartItem
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $amount
 * @property int $product_id
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CartItem whereUserId($value)
 * @mixin \Eloquent
 */
class CartItem extends Model
{
    use HasFactory;
    use getTableNameStaticallyTrait;
    protected $fillable = ['amount', 'product_id', 'user_id'];



    public static function deleteCartItemRules(){
        return[
            'product_id'=>['required','integer',new DoesProductInUserCartRule()]
        ];
    }
    public static function decrementItemCountRules()
    {
       return[
         'product_id'=>['required','integer',new DoesProductInUserCartRule()]
       ];
    }

    public static function emptyCurrentUserCart(){
        CartItem::where('user_id','=',Auth::id())->delete();
    }

    /***
     * delete product from cart along with all of its amount
    */
    public static function deleteItemFromCurrentUserCart($request){
          CartItem::where([
              ['user_id','=',Auth::id()],
              ['product_id','=',$request->product_id]
              ])->delete();
    }

    /**
     * decrement the amount of an item  or delete the item if its amount is one
     * */
    public static function decrementItemFromCurrentUserCart($request)
    {
        /***
         * @var  $cartItem CartItem
         */
        $cartItem  = CartItem::where([
              ['user_id','=',Auth::id()],
              ['product_id','=',$request->product_id]
              ])->get()->first();

        if($cartItem->amount>1) {
            $cartItem->update([
                'amount' => $cartItem->amount - 1
            ]);
        }
        else{
            $cartItem->delete();
        }


    }



}
