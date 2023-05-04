<?php

namespace App\Http\Repositories\Web\Admin;
use App\Http\Interfaces\Web\Admin\OrderInterface;
use App\Http\Repositories\Web\Customer\CartItemRepository;
use App\Http\Rules\DoesProductStockHasEnoughAmount;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\ShippingInfo;
use Illuminate\Support\Collection;


class OrderRepository implements OrderInterface
{

    public function __construct(protected CartItemRepository $cartItemRepository)
    {}

    public static function CheckOutRules()
    {
        return [
          'customer_full_name'=>'required',
          'address_1'         =>'required|min:5',
          'address_2'         =>'nullable|sometimes|min:5',
          'city'              =>'required|min:3',
          'state'             =>'required|min:3',
          'zip_code'          =>'required|numeric|min:4',
          'country'           =>'required|min:3',
          'phone_number'      =>'required|numeric'

        ];
    }


    public function checkout(\App\Http\Requests\Web\Customer\CheckOutRequest $request)
    {
        $cart= $this->cartItemRepository->getCart();
        return \DB::transaction(function ()use ($cart,$request){
            $shippingInfo = ShippingInfo::create([
                'customer_full_name'=>$request->customer_full_name,
                'address_1'         =>$request->address_1,
                'address_2'         =>$request->address_2??null,
                'city'              =>$request->city,
                'state'             =>$request->state ,
                'zip_code'          =>$request->zip_code ,
                'country'           =>$request->country,
                'phone_number'      =>$request->phone_number
            ]);

            $order = Order::create([
                'user_id'            =>\Auth::id(),
                'total_price'       =>$cart['total_price'],
                'shipping_info_id'  =>$shippingInfo->id,
                'status'=>'pending',
            ]);

            foreach ($cart['cartItems'] as $cartItem){
                OrderItems::create([
                    'order_id'  =>$order->id,
                    'product_id'=>$cartItem->product_id,
                    'unit_price'=>$cartItem->unit_price,
                    'count'     =>$cartItem->amount,
                ]);
                Product::where( 'id', $cartItem->product_id)->decrement('stock', $cartItem->amount);

            }
            CartItem::where('user_id',\Auth::id())->delete();
            return $order;
        });


    }
}
