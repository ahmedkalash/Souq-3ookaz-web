<?php

namespace App\Http\Repositories\Web\Customer;
use App\Http\Interfaces\Web\Customer\CartItemInterface;
use App\Models\CartItem;
use App\Http\Rules\DoesProductStockHasEnoughAmount;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartItemRepository implements CartItemInterface
{

    public static function addCartItemRules()
    {
        return[
            'amount'=>['required', 'integer','gt:0'],
            'product_id'=>['required','integer','exists:products,id', new DoesProductStockHasEnoughAmount()],
        ];
    }

    /**
     *  adds new product to the cart or increments the amount of the product
     *  if the product already in the cart
     * */
    public function addProduct($request)
    {
        $cartItem = CartItem::where([
            ['user_id',auth()->id()],
            ['product_id',$request->product_id]
        ])->get()->first();

        if($cartItem){
            $cartItem->update([
                'amount'=>($cartItem->amount+$request->amount)
            ]);
        }else{
            CartItem::create([
                'amount'=>$request->amount,
                'product_id'=>$request->product_id,
                'user_id'=> Auth::id()
            ]);
        }

    }

    public function getCart()
    {
        try {
            define("App\Http\Repositories\Web\Customer\prod", 'prod');
            define("App\Http\Repositories\Web\Customer\cat", 'cat');
            define("App\Http\Repositories\Web\Customer\cart", 'cart');
            define("App\Http\Repositories\Web\Customer\poster", 'poster');
       }catch (\Exception){}

        $rows =[
            prod.".id as product_id", "amount", prod.".name_en", prod.".name_ar",
            "price as unit_price", "stock", "brand", "status", "cat.name_en as category_name_en",
            "poster.url as poster",
        ];
        $products = DB::query()
            ->select($rows)
            ->selectRaw( prod.".price * ".cart.".amount as sub_total")
            ->from(CartItem::getTableName(), cart)
            ->join(Product::getTableName()." as ".prod,prod.".id",'=',cart.".product_id")
            ->join(Image::getTableName()." as ".poster,poster.".id",'=',prod.".poster_id")
            ->join(Category::getTableName(). " as ".cat, cat.".id",'=',prod.".category_id")
            ->where(cart.".user_id",'=',Auth::id())
            ->get();



        $total_price = $products->sum('sub_total');
        return [
            'cartItems' => $products,
            'total_price' => $total_price,
        ];

    }

    public function emptyCart()
    {
        CartItem::emptyCurrentUserCart();
        return $this->apiResponse(200,'خد',null,CartItem::getCurrentUserCartForShow());
    }


    /***
     * delete product from cart along with all of its amount
     ****/
    public function deleteItem($request)
    {
        CartItem::deleteItemFromCurrentUserCart($request);
        return $this->apiResponse(200,'تمام مسحتهولك علي الله يطمر',null,CartItem::getCurrentUserCartForShow());
    }

    /**
     * decrement the amount of an item  or delete the item if its amount is one
     * */
    public function decrementItemCount($request)
    {
       CartItem::decrementItemFromCurrentUserCart($request);
       return $this->apiResponse(200,'تمام مسحتهولك علي الله يطمر',null,CartItem::getCurrentUserCartForShow());

    }
}
