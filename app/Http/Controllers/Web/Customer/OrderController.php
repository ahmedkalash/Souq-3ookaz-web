<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Web\Admin\OrderRepository;
use App\Http\Requests\Web\Customer\CheckOutRequest;
use App\Models\Order;
use App\Models\ShippingInfo;
use App\View\ViewPath;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function __construct(
        protected OrderRepository $orderRepository,
    )
    {}

    public function showCheckoutPage(){

        return view(
            ViewPath::CHECK_OUT
        );
    }
    public function checkout(CheckOutRequest $request){
        $order =$this->orderRepository->checkout($request);
        $order->load('shipping_info');
        $this->order = $order;
        //$shippingInfo  = ShippingInfo::where('')
        return view(
            ViewPath::ORDER_SUCCESS,
            compact('order')

        );
    }
     public function success(Request $request ){
         $order = Order::find(130);
        $order->load('shipping_info');
        return view(
            ViewPath::ORDER_SUCCESS,
             compact('order')
        );
    }




}
